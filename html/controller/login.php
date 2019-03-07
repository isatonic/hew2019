<?php

session_start();
require_once "../../vendor/autoload.php";

$pdo = new model\myPDO();
$post = array(
    "pass" => $_POST["pass"],
    "email" => $_POST["email"]
);
$data = new model\Data($post);
$model = new model\logical\Login($pdo, $data);

$result = $model->transaction();

if ($result === false) {
    // 登録されていない or IDまたはパスワードが違う
    $_POST["login_err"] = "IDまたはパスワードが違います。";
    header("Location: ", true, 302);
} else if ($result === "limited") {
    // ユーザ制限中
    $_POST["login_err"] = "利用が一時的に制限されています。";
    header("Location: ", true, 302);
} else if (is_object($result)) {
    // 何かしらのエラー
    $_POST["login_err"] = "ログイン中にエラーが発生しました。";
    header("Location: ", true, 302);
} else {
    // ログイン成功
    $_SESSION["id"] = $result;
    header("Location: ../index/index.html", true, 302);
}
