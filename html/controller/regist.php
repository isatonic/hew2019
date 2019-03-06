<?php

session_start();
require_once "../../vendor/autoload.php";

$pdo = new \model\myPDO();
$data = new \model\Data($_POST);
if ($data->extend("type") == "user") {
    $model = new \model\logical\UserRegist($pdo, $data);
} else if ($data->extend("type") == "admin") {
    $model = new \model\logical\AdminRegist($pdo, $data);
}

$result = $model->transaction();

if ($result === false) {
    // 登録失敗
    $_POST["regist_err"] = "登録に失敗しました。";
} else {
    // 登録成功
    $_SESSION["id"] = $result;
    header("Location: ../login/new_member.php", true, 302);
}

