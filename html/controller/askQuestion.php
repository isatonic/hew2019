<?php

require_once "../../vendor/autoload.php";
$pdo = new \model\myPDO();
$model = new \model\physical\Contact($pdo->getPDO());

$data = array(
    "name" => "{$_POST['name_s_K']} {$_POST['name_m_K']}",
    "email" => "{$_POST['mail_K']}",
    "title" => "{$_POST['title_K']}",
    "tag" => "{$_POST['category_K']}",
    "detail" => "{$_POST['main_text_K']}"
);

if ($model->add($data)) {
    // OK
    header("Location: ../help/US19.php");
} else {
    // NG
    echo "ERROR";
}
