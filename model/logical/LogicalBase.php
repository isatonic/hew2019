<?php

namespace model\logical;

use model\DataInterface;
use model\myPDO;

interface LogicalInterface {
    public function __construct(myPDO $myPDO, DataInterface $Data);
}

abstract class LogicalBase implements LogicalInterface {

    protected $pdo;
    protected $Data;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        $this->pdo = $myPDO->getPDO();
        $this->Data = $Data;
    }

    abstract public function transaction();
}
