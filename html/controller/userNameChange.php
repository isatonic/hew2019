<?php

session_start();
if (!isset($_SESSION["id"]) or is_null($_SESSION["id"])) {
    // jump to login
    $url = "";
    header("Location: ${url}");
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
     header("Location: ${url}");
} else {
    // error
    echo "ERROR";
}
