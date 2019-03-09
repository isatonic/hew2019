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

echo "<pre>";
var_dump($ret);
echo "</pre>";
