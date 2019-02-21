<?php

session_start();

if (isset($_SESSION["id"]) and !is_null($_SESSION["id"])) {
    $user = $_SESSION["id"];
} else {
    // login required
    // ログインページのurl
    $url = "";
    header("Location: ${url}");
}

if (!isset($_POST["password"]) or is_null($_POST["password"])) {
    // input error
    $url = "../My Page/US20_php";
    header("Location: ${url}");
}

$pdo = new \model\myPDO();
$Password = new \model\physical\Password($pdo->getPDO(), $user);
$ret = $Password->change($_POST["password"]);

if ($ret) {
    // OK
    $msg = "パスワードを変更しました。";
} else {
    // DB error
    $msg = "パスワードの変更に失敗しました。";
}

include "../My Page/US20_pass_change.php";
