<?php

use function PHPSTORM_META\type;

    $host = "localhost";
    $user = 'root';
    $pass = '';

    $sql = mysqli_connect($host, $user, $pass); //server connect
    $db = mysqli_select_db($sql, "uiuNewsBox"); //database select
?>