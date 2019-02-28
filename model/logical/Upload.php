<?php

namespace model\logical;
require_once "../../vendor/autoload.php";

use model\DataInterface;
use model\myPDO;
use model\physical\Products;
use model\physical\Tag;

class Upload extends LogicalBase {

    private $upload_file;
    private $data;
    private $Products;
    private $Tag;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->Products = new Products($this->pdo, $Data->extend("author"));
        $this->Tag = new Tag($this->pdo);
        $this->data = array(
            "id" => $this->createID($Data->extend("author")),
            "fileName" => $this->createID($Data->extend("author")) . $this->getType($Data->extend("filename")),
            "title" => $Data->extend("title"),
            "author" => $Data->extend("author"),
            "price" => $Data->extend("price"),
            "type" => $Data->extend("type"),
            "jenre" => $Data->extend("jenre"),
            "authorComment" => $Data->extend("comment"),
            "tags" => $Data->extend("tags")
        );
        $this->upload_file = "../../html/Upload/images/" . $this->data["fileName"];
    }

    private function createID($author) {
        return "P" . substr($author, 2) . time();
    }

    private function getType($filename) {
        return substr($filename, strrpos($filename, '.') + 1);
    }

    public function transaction() {
        $this->pdo->beginTransaction();
        try {
            $this->Products->regist($this->data);
            $this->Tag->putTagOn($this->data["id"], $this->data["tags"]);
            if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
                // アップロードできている
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $this->upload_file)) {
                    // 保存成功
                    $this->pdo->commit();
                    return true;
                }
            }
            $this->pdo->rollBack();
            return false;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}