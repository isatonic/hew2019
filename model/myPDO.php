<?php
namespace model;

interface myPdoInterface {
    public function __construct();
    public function getPDO();
}

class myPDO implements myPdoInterface {

    private $pdo;

    public function __construct() {
        $this->pdo = new \PDO('mysql:host=db;dbname=isatonic', "root", "root");
    }

    public function getPDO() {
        return $this->pdo;
    }

}