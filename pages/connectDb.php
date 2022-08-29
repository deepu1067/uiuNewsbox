<?php

use function PHPSTORM_META\type;

    $host = "localhost:3306";
    $user = 'root';
    $pass = '';

    $sql = mysqli_connect($host, $user, $pass); //server connect
    $db = mysqli_select_db($sql, "uiuNewsBox"); //database select
?>