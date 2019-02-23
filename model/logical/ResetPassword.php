<?php
namespace model\logical;
require_once "../../vendor/autoload.php";

use model\DataInterface;
use model\myPDO;
use model\physical\PassReset;
use model\physical\Password;
use model\physical\Users;

class ResetPassword extends LogicalBase {

    private $email;
    private $inputCode;
    private $PassReset;
    private $Password;
    private $id;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->email = $Data->extend("email");
        $this->inputCode = $Data->extend("code");
        $this->PassReset = new PassReset($this->pdo);
        $this->Password = new Password($this->pdo);
        $usr = new Users($this->pdo);
        $this->id = $usr->getIdByMail($this->email);
    }

    public function transaction() {
        $this->pdo->beginTransaction();
        try {
            $get = $this->PassReset->get($this->email);
            if ($this->inputCode === $get["code"]) {
                $this->Password->change($get["newpass"], $this->id);
                $this->pdo->commit();
                return true;
            }
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
        }
        return false;
    }

}