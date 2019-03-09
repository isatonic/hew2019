<?php

session_start();
$user = $_SESSION["id"];
require_once "../../vendor/autoload.php";

$pdo = new \model\myPDO();

