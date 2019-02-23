<?php

session_start();
require_once "../../vendor/autoload.php";

$pdo = new \model\myPDO();
$data = new \model\Data($_POST);
$model = new \model\logical\UserRegist($pdo, $data);

$result = $model->transaction();

if ($result === false) {
    // 登録失敗
    $url = "";
} else {
    // 登録成功
    $url = "";
    $_SESSION["id"] = $result;
}

header("Location: " . $url, true, 302);
