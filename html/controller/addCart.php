<?php

session_start();
$user = $_SESSION["id"];

require_once "../../vendor/autoload.php";
$pdo = new \model\myPDO();
$data = new \model\Data($_POST);
$Cart = new \model\physical\Cart($pdo->getPDO(), $_SESSION["id"]);
$Purchase = new \model\physical\Purchase($pdo->getPDO(), $_SESSION["id"]);

$already = $Purchase->search($data->extend("product"));
if (count($already) > 0) {
    $_SESSION["isatonic_addCart_err"] = "すでにこの商品を購入しています。\\n「マイページ->購入作品一覧」をご確認ください。";
    header("Location: ./search.php", true, 302);
}

if ($Cart->add($data->extend("product"), $user)) {
    // カートに追加成功
    header("Location: ./getCart.php", true, 302);
} else {
    // 失敗
    $_SESSION["isatonic_addCart_err"] = "商品をカートに追加することができませんでした。\\nすでにカート内に存在するか、商品が削除された可能性があります。";
    header("Location: ./search.php", true, 302);
}
