<?php
session_start();
require_once "../../vendor/autoload.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../login/login.php");
}
$user = $_SESSION["id"];
$pdo = new \model\myPDO();
$point = (int)$_SESSION["isatonic_charge_point"];
unset($_SESSION["isatonic_charge_point"]);
$arr = array(
    "id" => $user,
    "point" => $point
);
$Data = new \model\Data($arr);
$Charge = new \model\logical\Charge($pdo, $Data);

if ($Charge->transaction()) {
    // OK
    header("Location: ../TONIC POINT Charge/US14.php?bk=1", true, 302);
} else {
    exit("Error occured while charging");
}
