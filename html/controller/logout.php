<?php

session_start();
if (!isset($_SESSION["id"])) {
    header("Location: ../login/login.php", true, 302);
}

unset($_SESSION["id"]);
unset($_SESSION["username"]);
header("Location: ../login/login.php", true, 302);
