<?php

if (!isset($_POST["word"]) or is_null($_POST["word"])) {
    if (!isset($_COOKIE["isatonic_search"]) or is_null($_COOKIE["isatonic_search"])) {
        $_POST["word"] = "%";
    } else {
        $_POST["word"] = end($_COOKIE["isatonic_search"]);
    }
} else {
    array_push($_COOKIE["isatonic_search"], $_POST["word"]);
}

$pdo = new \model\myPDO();
$data = new \model\Data($_POST);
$model = new \model\logical\SearchProduct($pdo, $data);

$result = $model->transaction();
$_POST["searchResult"] = $result;

$url = "";
header("Location: " . $url, true, 302);
