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
    private $fileID;
    private $tmp_file;
    private $fileType;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->createID($Data->extend("author"));
        $this->tmp_file = $Data->extend("file");
        $this->setType();
        $this->Products = new Products($this->pdo, $Data->extend("author"));
        $this->Tag = new Tag($this->pdo);
        $this->data = array(
            "id" => $this->fileID,
            "fileName" => $this->fileID . "." . $this->fileType,
            "title" => $Data->extend("title"),
            "author" => $Data->extend("author"),
            "price" => $Data->extend("price"),
            "type" => $Data->extend("type"),
            "jenre" => $Data->extend("jenre"),
            "authorComment" => $Data->extend("comment")
//            "tags" => $Data->extend("tags")
        );
        $this->upload_file = "../uploaded_files/" . $this->data["fileName"];
    }

    private function createID($author) {
        $this->fileID = "P" . str_replace('.', '-', substr($author, 2) . time());
    }

    public function transaction() {
        echo "tmp: $this->tmp_file<br>\n";
        echo "target: $this->upload_file<br>\n";
        $this->pdo->beginTransaction();
        try {
            if ($this->Products->regist($this->data)) {
                if (is_uploaded_file($this->tmp_file)) {
                    echo "upload successful<br>\n";
                    // アップロードできている
                    if (move_uploaded_file($this->tmp_file, $this->upload_file)) {
                        // 保存成功
                        $this->pdo->commit();
                        return true;
                    }
                }
            }
            $this->pdo->rollBack();
            return false;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    private function setType() {
        $type = exif_imagetype($this->tmp_file);
        $sets = array(
            "gif",
            "jpg",
            "png",
            "swf",
            "psd",
            "bmp",
            "tiff",
            "tiff",
            "jpc",
            "jp2",
            "jpx",
            "jb2",
            "swc",
            "iff",
            "wbmp",
            "xbm",
            "ico"
        );
        $this->fileType = $sets[$type - 1];
    }
}