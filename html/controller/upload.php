<?php
session_start();
require_once "../../vendor/autoload.php";
$user = $_SESSION["id"];

$pdo = new \model\myPDO();

$data = array(
    "author" => $user,
    "type" => $_POST["cate_1"],
    "jenre" => $_POST["cate_2"],
    "title" => $_POST["title"],
    "comment" => $_POST["main_text"],
    "price" => (int)$_POST["cate_3"]
);

$Data = new \model\Data($data);
$Upload = new \model\logical\Upload($pdo, $Data);

$ret = $Upload->transaction();

if ($ret) {
    // OK
    $res = true;
} else {
    $res = false;
}

$_POST["upload_result"] = $res;
header("Location: ../Upload/US21_upload.php", true, 302);
