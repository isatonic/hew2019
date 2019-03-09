<?php

session_start();
$user = $_SESSION["id"];

require_once "../../vendor/autoload.php";
$pdo = new \model\myPDO();
$data = new \model\Data($_POST);
$Cart = new \model\physical\Cart($pdo->getPDO(), $_SESSION["id"]);
if ($Cart->add($data->extend("product"), $user)) {
    // カートに追加成功
    header("Location: ./getCart.php", true, 302);
} else {
    // 失敗
    $_SESSION["isatonic_addCart_err"] = "商品をカートに追加することができませんでした。\\nすでにカート内に存在するか、商品が削除された可能性があります。";
    header("Location: ./search.php", true, 302);
}
