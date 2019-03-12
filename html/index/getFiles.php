<?php

//session_start();

$dir = "../uploaded_files";
$files = [];

foreach(glob("$dir/*") as $file){
    if(is_file($file)){
        $files[] = htmlspecialchars($file);
    }
}

$count = 0;
foreach ($files as $file) {
    copy($file, "../testimage_forIndex/from_db/{$count}.png");
    $count++;
}

header("Location: ./index.php", true, 302);
