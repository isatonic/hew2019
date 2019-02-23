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
        $this->sellers = $this->listSellers();
        $this->Cart = new Cart($this->pdo, $this->Data->extend("buyer"));
        $this->BuyerWallet = new Wallet($this->pdo, $this->buyer);
        $this->Purchase = new Purchase($this->pdo, $this->buyer);
        $this->SellerWallets = new Wallet($this->pdo);
        $this->Grade = new Grade($this->pdo);
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
                    $this->Cart->remove($product);
                    $this->Purchase->buy($product);
                }
                $this->payment();
                $this->pdo->commit();
                return true;
            }
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
        }

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
            $this->SellerWallets->charge($point, $id);
        }
    }

    private function listSellers() {
        $sql = <<<SQL
            SELECT p.author as seller, sum(p.price) as sum
            FROM Cart c
            INNER JOIN Products p ON c.product = p.id
            WHERE c.user = $this->buyer
            GROUP BY p.author
            ORDER BY p.author ASC;
SQL;
        $ret = array();
        foreach ($this->pdo->query($sql) as $row) {
            $rate = $this->checkGrade($row["seller"]);
            $ret[$row["seller"]] = $row["sum"] * $rate;
        }

        return $ret;

    }

    public function costSum() {
        $sql = <<<SQL
            SELECT sum(p.price) as sum
            FROM Cart c
            INNER JOIN Products p ON c.product = p.id
            WHERE c.user = {$this->buyer};
SQL;

        $res = $this->pdo->query($sql);
        return $res[0]["sum"];

    }
}