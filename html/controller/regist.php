<?php

session_start();
require_once "../../vendor/autoload.php";

$pdo = new model\myPDO();

if (isset($_SESSION["regist_err"])) {
    unset($_SESSION["regist_err"]);
}
if ($_POST["pass"] != $_POST["pass_confirm"]) {
    $_SESSION["regist_err"] = "パスワードが一致しません。";
    header("Location: ../login/new_member.php");
}

$data = array(
    "email" => $_POST["email"],
    "userName" => $_POST["userName"],
    "firstName" => $_POST["firstName"],
    "lastName" => $_POST["lastName"],
    "birth" => $_POST["year"] . "-" . $_POST["month"] . "-" . $_POST["day"],
    "pass" => $_POST["pass"],
    "gender" => $_POST["gender"]
);
$Data = new model\Data($data);
if ($_POST["type"] == "user") {
    $model = new model\logical\UserRegist($pdo, $Data);
} else if ($_POST["type"] == "admin") {
    $model = new model\logical\AdminRegist($pdo, $Data);
}

$result = $model->transaction();
if ($result === "already") {
    $_SESSION["regist_err"] = "メールアドレスがすでに登録されています。";
    header("Location: ../login/new_member.php", true, 302);
}
if ($result == false) {
    // 登録失敗
    $_SESSION["regist_err"] = "登録に失敗しました。";
    header("Location: ../login/new_member.php", true, 302);
} else {
    // 登録成功
    $_SESSION["id"] = $result;
    $_SESSION["username"] = $data["userName"];
    header("Location: ../login/login.php", true, 302);
}

