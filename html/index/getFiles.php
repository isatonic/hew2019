<?php

session_start();

$dir = "../uploaded_files";
$files = [];

foreach(glob("$dir/*") as $file){
    if(is_file($file)){
        $files[] = htmlspecialchars($file);
    }
}

$count = 0;
foreach ($files as $file) {
    $target = "../testimage_forIndex/from_db/{$count}.png";
    if (is_file($target)) {
        unlink($target);
    }
    copy($file, $target);
    $count++;
}

$_SESSION["isatonic_top_fetch_flag"] = 1;
header("Location: ./index.php", true, 302);
