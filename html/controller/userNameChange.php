<?php

session_start();
require_once "../../vendor/autoload.php";
if (!isset($_SESSION["id"]) or is_null($_SESSION["id"])) {
    // jump to login
    $url = "../login/login.php";
    header("Location: ${url}", true, 302);
} else {
    $user = $_SESSION["id"];
}

$pdo = new \model\myPDO();
$UserDetail = new \model\physical\UserDetails($pdo->getPDO(), $user);

if (isset($_POST["name_change"]))
$data = array(
    "userName" => $_POST["name_change"]
);

if ($UserDetail->changeInfo($data, $user)) {
    // success
     $url = "../My Page/US20_name_change.php";
     header("Location: ${url}", true, 302);
} else {
    // error
    echo "ERROR";
}
