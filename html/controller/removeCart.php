<?php

session_start();
$user = $_SESSION["id"];
require_once "../../vendor/autoload.php";

$post = ["product" => $_POST["item_delete"]];
$pdo = new \model\myPDO();
$data = new \model\Data($post);
$Cart = new \model\physical\Cart($pdo->getPDO(), $user);

$Cart->remove($data->extend("product"));
header("Location: ./getCart.php", true, 302);
