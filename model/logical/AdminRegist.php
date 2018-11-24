<?php
namespace model\logical;

use model\DataInterface;
use model\myPDO;
use model\physical\MailVerify;
use model\physical\Password;
use model\physical\Users;

class AdminRegist extends LogicalBase {

    private $User;
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

            $this->Password = new Password($this->pdo, $id);
            $this->Password->regist($this->Data->extend("password"));

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