<?php
namespace model\logical;

use model\DataInterface;
use model\myPDO;
use model\physical\Grade;
use model\physical\MailVerify;
use model\physical\Password;
use model\physical\UserDetails;
use model\physical\Users;
use model\physical\Wallet;

class UserRegist extends LogicalBase {

    private $User;
    private $UserDetail;
    private $Grade;
    private $Wallet;
    private $Password;
    private $Verify;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->User = new Users($this->pdo);
    }

    public function transaction() {
        $this->pdo->beginTransaction();
        try {
            $id = $this->User->regist($this->Data->get());

            $this->UserDetail = new UserDetails($this->pdo, $id);
            $this->UserDetail->regist($this->Data->extend("userName"));

            $this->Password = new Password($this->pdo, $id);
            $this->Password->regist($this->Data->extend("password"));

            $this->Grade = new Grade($this->pdo, $id);
            $this->Grade->init();

            $this->Wallet = new Wallet($this->pdo, $id);
            $this->Wallet->init();

            $this->Verify = new MailVerify($this->pdo, $id);
            $this->Verify->add($this->Data->extend("email"));

            return true;
        } catch (\PDOException $e) {
            $code = $e->getCode();
            $message = $e->getMessage();
            echo "$code: $message";
            $this->pdo->rollBack();
        }
        return false;
    }

}