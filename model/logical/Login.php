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
        $id = $this->Auth->check($this->Data->extend("pass"), $this->Data->extend("email"));
        if ($id !== false) {
            return $id;
//            try {
//                if ($this->UserLimit->check($id) === true) {
//                    return $id;
//                } else {
//                    return "limited";
//                }
//            } catch (\Exception $e) {
//                return $e;
//            }
        } else {
            return false;
        }
    }
}