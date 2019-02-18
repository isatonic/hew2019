<?php

session_start();
$user = $_SESSION["id"];

$pdo = new \model\myPDO();

