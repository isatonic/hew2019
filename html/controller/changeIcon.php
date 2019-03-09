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
require_once "../../vendor/autoload.php";

$tmp = $_FILES['uploadfile']['tmp_name'];
$target = "./icon/${user}.png";

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

include "../My Page/US20_upload.php";
