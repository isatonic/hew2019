<?php

session_start();
require_once "../../vendor/autoload.php";

if (isset($_SESSION["id"]) and !is_null($_SESSION["id"])) {
    $user = $_SESSION["id"];
} else {
    // login required
    // ログインページのurl
    $url = "../login/login.php";
    header("Location: ${url}", true, 302);
}

if (!isset($_POST["password"]) or is_null($_POST["password"])) {
    // input error
    $url = "../My Page/US20.php";
    header("Location: ${url}", true, 302);
}

$pdo = new \model\myPDO();
$Password = new \model\physical\Password($pdo->getPDO(), $user);
$Auth = new \model\physical\Auth($pdo->getPDO(), $user);

if ($Auth->checkWithID($_POST["password_old"], $user) != false) {
    // do change
    if ($_POST["password"] == $_POST["confirm"]) {
        $ret = $Password->change($_POST["password"]);
    } else {
        $_SESSION["isatonic_pass_change_err"] = "新しいパスワードが一致しません。";
        header("Location: ../My Page/US20.php", true, 302);
        exit();
    }
} else {
    // password not match
    $_SESSION["isatonic_pass_change_err"] = "元のパスワードが一致しません。";
    header("Location: ../My Page/US20.php", true, 302);
    exit();
}


if ($ret == false) {
    // DB error
    $msg = "パスワードの変更に失敗しました。";
} else {
    // OK
    $msg = "パスワードを変更しました。";
}

$_SESSION["isatonic_pass_change_msg"] = $msg;
header("Location: ../My Page/US20_pass_change.php", true, 302);
