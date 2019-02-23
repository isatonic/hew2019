<?php

namespace model\logical;
require_once "../../vendor/autoload.php";


use model\DataInterface;
use model\myPDO;
use model\physical\Auth;
use model\physical\UserLimit;

class Login extends LogicalBase {

    private $Auth;
    private $UserLimit;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->Auth = new Auth($this->pdo);
        $this->UserLimit = new UserLimit($this->pdo);
    }

    public function transaction() {
        if ($this->Auth->check($this->Data->extend("pass"), $this->Data->extend("id"))) {
            try {
                if ($this->UserLimit->check($this->Data->extend("id")) === true) {
                    return $this->Data->extend("id");
                } else {
                    return "limited";
                }
            } catch (\Exception $e) {
                return $e;
            }
        } else {
            return false;
        }
    }
}