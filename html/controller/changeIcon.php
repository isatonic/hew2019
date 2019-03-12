<?php

session_start();
if (isset($_SESSION["id"]) and !is_null($_SESSION["id"])) {
    $user = $_SESSION["id"];
} else {
    // login required
    header("Location: ../login/login.php", true, 302);
}
require_once "../../vendor/autoload.php";

if (!isset($_FILES['files']['tmp_name'])) {
    header("Location: ../My Page/US20.php", true, 302);
}
$tmp = $_FILES['files']['tmp_name'];
$target = "../My Page/icon/${user}.png";
if (is_file($target)) {
    unlink($target);
}

if (is_uploaded_file($tmp)) {
    if (move_uploaded_file($tmp, $target)) {
        // OK
        $msg = "アイコン画像をアップロードしました。";
    } else {
        // error
        $msg = "ファイルをアップロードできませんでした。";
    }
} else {
    // file not selected
    $msg = "ファイルが選択されていません。";
}

$_SESSION["isatonic_icon_up_msg"] = $msg;
header("Location: ../My Page/US20_upload.php", true, 302);
