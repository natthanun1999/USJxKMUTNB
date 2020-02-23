<?php
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_DATABASE", "usjxkmutnb");

    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

    if (!$db)
        die ('Error! : Connection failed.');