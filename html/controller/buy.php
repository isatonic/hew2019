<?php

session_start();
$user = $_SESSION["id"];
require_once "../../vendor/autoload.php";

$pdo = new \model\myPDO();
$data = new \model\Data(["buyer" => $user]);
$Buy = new \model\logical\Buy($pdo, $data);

if ($Buy->transaction()) {
    // ok
    header("Location: ../cart/US11.php", true, 302);
} else {
    // ポイント不足
    exit("ポイント不足");
}
