<?php

session_start();
$user = $_SESSION["id"];
require_once "../../vendor/autoload.php";

$pdo = new \model\myPDO();
$data = new \model\Data($_POST);
$Cart = new \model\physical\Cart($pdo->getPDO(), $user);

if ($Cart->remove($data->extend("product"))) {
    // カートからの削除成功
    $url = "";
} else {
    // 削除失敗
    $url = "";
}

header("Location: " . $url, true, 302);
