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

$ret = $Cart->get();

if (isset($_SESSION["isatonic_cart_list"])) {
    unset($_SESSION["isatonic_cart_list"]);
}

if ($ret == NULL) {
    $_SESSION["isatonic_cart_list"] = false;
} else {
    $_SESSION["isatonic_cart_list"] = $ret;
}
header("Location: ../cart/US8.php", true, 302);
