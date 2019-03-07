<?php
namespace model\logical;
require_once "../../vendor/autoload.php";

use model\DataInterface;
use model\myPDO;
use model\physical\Grade;
//use model\physical\MailVerify;
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
//    private $Verify;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->User = new Users($this->pdo);
    }

    public function transaction() {
        $this->pdo->beginTransaction();
        try {
            $id = $this->User->regist($this->Data->get());
            if ($id == false) {
                $this->pdo->rollBack();
                exit("User error");
            }

            $this->UserDetail = new UserDetails($this->pdo, $id);
            if (!$this->UserDetail->regist($this->Data->extend("userName"))) {
                $this->pdo->rollBack();
                exit("UserDetails error");
            }

            $this->Password = new Password($this->pdo, $id);
            if (!$this->Password->regist($this->Data->extend("pass"), $id)) {
                $this->pdo->rollBack();
                exit("Password error");
            }

            $this->Grade = new Grade($this->pdo, $id);
            if (!$this->Grade->init($id)) {
                $this->pdo->rollBack();
                exit("Grade init error");
            }

            $this->Wallet = new Wallet($this->pdo, $id);
            if (!$this->Wallet->init($id)) {
                $this->pdo->rollBack();
                exit("Wallet init error");
            }

//            $this->Verify = new MailVerify($this->pdo, $id);
//            $this->Verify->add($this->Data->extend("email"));

            $this->pdo->commit();
            return $id;
        } catch (\PDOException $e) {
            $code = $e->getCode();
            $message = $e->getMessage();
            echo "$code: $message";
            $this->pdo->rollBack();
        }
        return false;
    }

}