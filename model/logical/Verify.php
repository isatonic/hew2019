<?php
namespace model\logical;
require_once "../../vendor/autoload.php";

use model\DataInterface;
use model\myPDO;
use model\physical\MailVerify;
use model\physical\Users;

class Verify extends LogicalBase {

    private $Verify;
    private $User;
    private $id;
    private $inputCode;
    private $email;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->User = new Users($this->pdo);
        $this->Verify = new MailVerify($this->pdo);
        $this->id = $Data->extend("id");
        $this->inputCode = $Data->extend("code");
        $this->email = $Data->extend("email");
    }

    public function transaction() {
        $this->pdo->beginTransaction();
        try {
            if ($this->inputCode === $this->Verify->fetchCode($this->email)) {
                $this->User->changeStatus("active", $this->id);
                $this->pdo->commit();
                return true;
            }
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
        }
        return false;
    }
}