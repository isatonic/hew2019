<?php

session_start();
require_once "../../vendor/autoload.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../login/login.php");
}
$user = $_SESSION["id"];

use model\myPDO;
use model\Data;
use model\logical\UserHome;

$mypdo = new myPDO();

$arr = ["id" => $user];
$input = new Data($arr);

$UserHome = new UserHome($mypdo, $input);

/**
 * array $data
 *
 * ユーザページに必要な情報諸々
 *
 * [
 *  "user_info" => [
 *      "regDate" => 登録日,
 *      "birth" => 誕生日,
 *      "firstName" => 名前,
 *      "lastName" => 苗字,
 *      "email" => メールアドレス,
 *      "flag" => フラグ(activeになるはず)
 *  ],
 *  "user_detail" => [
 *      "userName" => サービス内での表示名
 *  ],
 *  "point" => 所持Tポイント,
 *  "buyHistory" => [
 *      [
 *          "date" => 購入日時
 *          "ProductData" => 購入した商品の情報(Users->searchFromID参照)
 *      ]
 *      ...
 *  ],
 *  "soldHistory" => [
 *      "id" => 商品ID
 *      "title" => タイトル
 *      "file" => ファイル名
 *      "price" => 価格
 *      "date" => 販売日時
 *  ],
 *  "grade" => [
 *      "grade" => グレード
 *      "gpoint" => グレードポイント
 *  ]
 * ]
 */
$data = $UserHome->transaction();

if ($data != false) {
    // OK
    $_SESSION["isatonic_home_data"] = $data;
    header("Location: ../My Page/US20.php", true, 302);
} else {
    // ユーザが存在しないなど
    exit("Error occured while fetching user data (controller/userHome.php)");
}
