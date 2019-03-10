<?php
namespace model\logical;

require_once "../../vendor/autoload.php";

use model\DataInterface;
use model\myPDO;
use model\physical\PointCharge;
use model\physical\Wallet;

class Charge extends LogicalBase {

    private $point;
    private $PointCharge;
    private $Wallet;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->PointCharge = new PointCharge($this->pdo, $this->Data->extend("id"));
        $this->Wallet = new Wallet($this->pdo, $this->Data->extend("id"));
        $this->point = $Data->extend("point");
    }

    public function transaction() {
        $this->pdo->beginTransaction();
        try {
            if ($this->Wallet->charge($this->point)) {
                if ($this->PointCharge->charge($this->point)) {
                    // All OK
                    $this->pdo->commit();
                    return true;
                } else {
                    // Wallet OK, PointCharge(logging) NG
                    $this->pdo->rollBack();
                    exit("Log error!");
                }
            } else {
                // Wallet NG
                $this->pdo->rollBack();
                exit("Wallet error!");
            }
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            exit("Exception!");
        }
    }
}