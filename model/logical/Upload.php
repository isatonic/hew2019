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
    private $filename;

    public function __construct(myPDO $myPDO, DataInterface $Data) {
        parent::__construct($myPDO, $Data);
        $this->createID($Data->extend("author"));
        $this->tmp_file = $Data->extend("file");
        $this->setType();
        $this->Products = new Products($this->pdo, $Data->extend("author"));
        $this->Tag = new Tag($this->pdo);
        $this->filename = $this->fileID . "." . $this->fileType;
        $this->data = array(
            "id" => $this->pdo->quote($this->fileID),
            "fileName" => $this->pdo->quote($this->filename),
            "title" => $this->pdo->quote($Data->extend("title")),
            "author" => $this->pdo->quote($Data->extend("author")),
            "price" => $Data->extend("price"),
            "type" => $this->pdo->quote($Data->extend("type")),
            "jenre" => $this->pdo->quote($Data->extend("jenre")),
            "authorComment" => $this->pdo->quote($Data->extend("comment"))
//            "tags" => $Data->extend("tags")
        );
        $this->upload_file = "../uploaded_files/" . $this->filename;
    }

    private function createID($author) {
        $this->fileID = "P" . str_replace('.', '-', substr($author, 2) . time());
    }

    public function transaction() {
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