<?php
namespace model\logical;

require_once "../../vendor/autoload.php";

use model\DataInterface;
use model\myPDO;
use model\physical\Cart;
use model\physical\Grade;
use model\physical\Purchase;
use model\physical\Wallet;

class Buy extends LogicalBase {

    private $buyer;
    private $sellers;
    private $Cart;
    private $BuyerWallet;
    private $Purchase;
    private $SellerWallets;
    /** @var array $products */
    private $products;
    private $pointSum;
    private $Grade;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->buyer = $this->Data->extend("buyer");
        $this->Grade = new Grade($this->pdo);
        $this->sellers = $this->listSellers();
        $this->Cart = new Cart($this->pdo, $this->pdo->quote($this->Data->extend("buyer")));
        $this->products = $this->Cart->get($this->buyer);
        $this->BuyerWallet = new Wallet($this->pdo, $this->buyer);
        $this->Purchase = new Purchase($this->pdo, $this->pdo->quote($this->buyer));
        $this->SellerWallets = new Wallet($this->pdo);
//        $this->products = $Data->extend("products");
//        $this->pointSum = $Data->extend("point");
        $this->pointSum = $this->costSum();
    }

    public function transaction() {
        $this->pdo->beginTransaction();
        try {
            $enoughPoint = $this->BuyerWallet->usePoint($this->pointSum);
            if ($enoughPoint) {
                foreach ($this->products as $product) {
                    if (!$this->Cart->remove($product, $this->Data->extend("buyer"))) {
                        $this->pdo->rollBack();
                        return false;
                    }
                    if (!$this->Purchase->buy($product, $this->Data->extend("buyer"))) {
                        $this->pdo->rollBack();
                        return $product;
                    }
                }
                if ($this->payment()) {
                    $this->pdo->commit();
                    return true;
                } else {
                    $this->pdo->rollBack();
                    return false;
                }
            }
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }

        $this->pdo->rollBack();
        return false;
    }

    private function checkGrade(string $seller) {
        $sellerGrade = $this->Grade->getPoint($seller);
        switch ($sellerGrade["grade"]) {
            case 6:
                $rate = 0.1;
                break;
            case 5:
                $rate = 0.12;
                break;
            case 4:
                $rate = 0.14;
                break;
            case 3:
                $rate = 0.16;
                break;
            case 2:
                $rate = 0.18;
                break;
            case 1:
                $rate = 0.2;
                break;
            default:
                $rate = 0.1;
        }
        return $rate;
    }

    private function payment() {
        foreach ($this->sellers as $id => $point) {
            if (!$this->SellerWallets->charge($point, $id)) {
                return false;
            }
        }
        return true;
    }

    private function listSellers() {
        $sql = <<<SQL
            SELECT p.author as seller, sum(p.price) as sum
            FROM Cart c
            INNER JOIN Products p ON c.product = p.id
            WHERE c.user = {$this->pdo->quote($this->buyer)}
            GROUP BY p.author
            ORDER BY p.author ASC;
SQL;
        $ret = array();
//        var_dump($this->pdo->query($sql));
//        exit();
        $re = $this->pdo->query($sql);
        foreach ($re as $row) {
            $rate = $this->checkGrade($row["seller"]);
            $ret[$row["seller"]] = (int)$row["sum"] * $rate;
        }

        return $ret;

    }

    public function costSum() {
        $sql = <<<SQL
            SELECT c.user, sum(p.price) as sum
            FROM Cart c
            INNER JOIN Products p ON c.product = p.id
            WHERE c.user LIKE {$this->pdo->quote($this->buyer)}
            GROUP BY c.user;
SQL;

        $res = $this->pdo->query($sql);
        $arr = [];
        foreach ($res as $row) {
            $arr["sum"] = (int)$row["sum"];
        }
        return $arr["sum"];

    }
}