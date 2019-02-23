<?php

session_start();
require_once "../../vendor/autoload.php";
$user = $_SESSION["id"];

use model\myPDO;
use model\Data;
use model\logical\UserHome;

$mypdo = new myPDO();
$input = new Data(["id" => $user]);
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
 *      "userName" => サービス内での表示名,
 *      "icon" => アイコンのパス
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

if ($data) {
    // OK
    $url = "";
    $_POST["home_data"] = $data;
    header("Location: " . $url, true, 302);
} else {
    // ユーザが存在しないなど
    $url = "";
    header("Location: " . $url, true, 302);
}
