<?php

session_start();
require_once "../../vendor/autoload.php";

$pdo = new \model\myPDO();
$data = new \model\Data($_POST);
$model = new \model\logical\Login($pdo, $data);

$result = $model->transaction();

if ($result === false) {
    // IDまたはパスワードが違う
    $url = "";
} else if (is_object($result)) {
    // 何かしらのエラー
    $url = "";
} else if ($result === "limited") {
    // ユーザ制限中
    $url = "";
} else {
    // ログイン成功
    $_SESSION["id"] = $result;
    $url = "";
}

header("Location: " . $url, true, 302);
