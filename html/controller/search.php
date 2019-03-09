<?php
session_start();
require_once "../../vendor/autoload.php";

if (!isset($_POST["word"]) or is_null($_POST["word"])) {
    if (!isset($_COOKIE["isatonic_search"]) or is_null($_COOKIE["isatonic_search"])) {
        $word = "%";
    } else {
        $word = end($_COOKIE["isatonic_search"]);
    }
} else {
    $word = $_POST["word"];
    array_push($_COOKIE["isatonic_search"], $word);
}
$Data = ["word" => $word];
$pdo = new \model\myPDO();
$data = new \model\Data($Data);
$model = new \model\logical\SearchProduct($pdo, $data);

$result = $model->transaction();

/////////// JSONで渡す場合
if ($result == null) {
    $result = array();
}
$json = new \model\JSONenc($result);
$ret = $json->ret();
/////////////////////////////
$_SESSION["isatonic_searchResult"] = $ret;

$url = "../product_list/US23_productList.php";
header("Location: ${url}", true, 302);
