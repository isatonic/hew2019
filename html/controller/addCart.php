<?php

session_start();
$user = $_SESSION["id"];

require_once "../../vendor/autoload.php";
$pdo = new \model\myPDO();
$data = new \model\Data($_POST);
$Cart = new \model\physical\Cart($pdo->getPDO(), $_SESSION["id"]);
if ($Cart->add($data->extend("product"), $user)) {
    // カートに追加成功
    $url = "";
} else {
    // 失敗
    $url = "";
}
header("Location: " . $url, true, 302);
