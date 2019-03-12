<?php

session_start();
$user = $_SESSION["id"];
require_once "../../vendor/autoload.php";

$pdo = new \model\myPDO();
$data = new \model\Data(["buyer" => $user]);
$Buy = new \model\logical\Buy($pdo, $data);

$ret = $Buy->transaction();

if (is_string($ret)) {
    // すでに購入している
    header("Location: ../cart/US11.php", true, 302);
} else if ($ret == true) {
    // ok
    header("Location: ../cart/US11.php", true, 302);
} else {
    // ポイント不足
    exit("ポイント不足");
}
