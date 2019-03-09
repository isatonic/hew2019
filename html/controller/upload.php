<?php
session_start();
require_once "../../vendor/autoload.php";
if (!isset($_SESSION["id"]) or is_null($_SESSION["id"])) {
    // go to LOGIN
    header("Location: ../login/login.php");
}
$user = $_SESSION["id"];

$pdo = new model\myPDO();

$data = array(
    "author" => $user,
    "type" => $_POST["cate_1"],
    "jenre" => $_POST["cate_2"],
    "title" => $_POST["title"],
    "comment" => $_POST["main_text"],
    "price" => (int)$_POST["cate_3"],
    "file" => $_FILES["files"]["tmp_name"]
);
$Data = new \model\Data($data);
$Upload = new \model\logical\Upload($pdo, $Data);

$_SESSION["isatonic_upload_result"] = $Upload->transaction();
header("Location: ../Upload/US21_upload.php");

