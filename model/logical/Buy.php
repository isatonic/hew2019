<?php
namespace model\logical;


use model\DataInterface;
use model\myPDO;
use model\physical\Cart;
use model\physical\Purchase;
use model\physical\Wallet;

class Buy extends LogicalBase {

    private $buyer;
    private $seller;
    private $Cart;
    private $BuyerWallet;
    private $SellerWallet;
    private $Purchase;
    /** @var array $products */
    private $products;
    private $pointSum;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->buyer = $this->Data->extend("buyer");
        $this->seller = $this->Data->extend("seller");
        $this->Cart = new Cart($this->pdo, $this->Data->extend("buyer"));
        $this->BuyerWallet = new Wallet($this->pdo, $this->buyer);
        $this->SellerWallet = new Wallet($this->pdo, $this->seller);
        $this->Purchase = new Purchase($this->pdo, $this->buyer);
        $this->products = $Data->extend("products");
        $this->pointSum = $Data->extend("point");
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
                $this->SellerWallet->charge($this->pointSum);
                $this->pdo->commit();
                return true;
            }
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
        }
        return false;
    }
}