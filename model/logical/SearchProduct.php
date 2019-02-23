<?php

namespace model\logical;
require_once "../../vendor/autoload.php";

use model\DataInterface;
use model\myPDO;
use model\physical\Products;
//use model\physical\Tag;

class SearchProduct extends LogicalBase {

    private $Products;
    // private $Tag;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->Products = new Products($this->pdo);
    }

    public function transaction() {
        $ret = $this->Products->searchFromTitle($this->Data->extend("word"));
        return $ret;
    }
}