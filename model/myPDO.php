<?php
namespace model;

use PDO;
use PDOException;

interface myPdoInterface {
    public function __construct();
    public function getPDO() : PDO;
}

class myPDO implements myPdoInterface {

    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=isatonic', "root", "root");
        } catch (PDOException $e) {
            $errNum = $e->getCode();
            $errMessage = $e->getMessage();
            echo "PDOException occurred >> $errNum: $errMessage";
            die;
        }
    }

    public function getPDO() : PDO {
        return $this->pdo;
    }

}