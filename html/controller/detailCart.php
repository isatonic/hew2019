<?php
require_once "../../vendor/autoload.php";

session_start();
if (!isset($_SESSION["id"])) {
    header("Location: ../login/login.php");
} else {
    $usr = $_SESSION["id"];
}

$pdo = new \model\myPDO();
$Cart = new \model\physical\CartList($pdo->getPDO(), $usr);
$Wallet = new \model\physical\Wallet($pdo->getPDO(), $usr);

// カート内容取得 ///////////////////////////
$ret = $Cart->get();
if ($ret == null) {
    header("Location: ../controller/getCart.php", true, 302);
}
if (isset($_SESSION["isatonic_cart_detail"])) {
    unset($_SESSION["isatonic_cart_detail"]);
}
$_SESSION["isatonic_cart_detail"]["list"] = $ret;

// ポイント計算 /////////////////////////////
$have = (int)$Wallet->checkWallet();
$cost = 0;
foreach ($ret as $row) {
    $cost += (int)$row["price"];
}
$balance = $have - $cost;
if (isset($_SESSION["isatonic_cart_points"])) {
    unset($_SESSION["isatonic_cart_points"]);
}
$_SESSION["isatonic_cart_points"] = array(
    "cost" => $cost,
    "have" => $have,
    "balance" => $balance
);

header("Location: ../cart/US9.php", true, 302);
