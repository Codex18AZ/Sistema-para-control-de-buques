<?php
    $server = "localhost";
    $user = "root";
    $password = "123456789";
    $database = "dboiltanking";
    $connection = mysqli_connect($server, $user, $password, $database);
    /* $server = "localhost";
    $user = "anjorcom_db_querying";
    $password = "SLwo0T)0RW2{";
    $database = "anjorcom_dboiltanking";
    $port = "3306";
    $connection = mysqli_connect($server, $user, $password, $database, $port); */
    $connection -> set_charset("utf8");
?>