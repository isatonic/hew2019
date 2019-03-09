<?php

namespace model\logical;
require_once "../../vendor/autoload.php";

use model\DataInterface;
use model\myPDO;
use model\physical\Grade;
use model\physical\Products;
use model\physical\Purchase;
use model\physical\SoldHistory;
use model\physical\UserDetails;
use model\physical\Users;
use model\physical\Wallet;

class UserHome extends LogicalBase {

    private $userID;
    private $Users;
    private $UserDetail;
    private $Wallet;
    private $Products;
    private $Purchase;
    private $SoldHistory;
    private $Grade;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->userID = $Data->extend("id");
        $this->Users = new Users($this->pdo, $this->userID);
        $this->UserDetail = new UserDetails($this->pdo, $this->userID);
        $this->Wallet = new Wallet($this->pdo, $this->userID);
        $this->Products = new Products($this->pdo);
        $this->Purchase = new Purchase($this->pdo, $this->userID);
        $this->SoldHistory = new SoldHistory($this->pdo, $this->userID);
        $this->Grade = new Grade($this->pdo, $this->userID);
    }

    public function transaction() {
        $user = $this->Users->get();
        if ($user === false or $this->Users->getStatus() === false or $this->Users->getStatus() != "active") {
            return false;
        }

        $userDetail = $this->UserDetail->getUserName();
        if ($userDetail === false) {
            return false;
        }

        $point = $this->Wallet->checkWallet();

        $product = $this->Products->searchFromAuthor($this->userID);

        $buyHis = $this->Purchase->get();
        $buyHistory = array();
        foreach ($buyHis as $key => $val) {
            $buyHistory[$key]["date"] = $val["purchaseDate"];
            $buyHistory[$key]["productData"] = $this->Products->searchFromID($val["product"]);
        }

        $soldHistory = $this->SoldHistory->getHistory();

        $grade = $this->Grade->getPoint();

        $ret = array(
            "user_info" => $user,
            "user_detail" => $userDetail,
            "point" => $point,
            "product" => $product,
            "buyHistory" => $buyHistory,
            "soldHistory" => $soldHistory,
            "grade" => $grade
        );

        return $ret;
    }
}