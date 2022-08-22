<?php
    $host = "localhost:3306";
    $user = 'root';
    $pass = '';

    $connect = mysqli_connect($host, $user, $pass);

    try{
        $db = mysqli_select_db($connect, "uiuNewsBox");
    }
    catch(Exception $e){
        $db = 0;
    }

    if($db == 0){
        mysqli_query($connect, "create database uiuNewsBox;");
    }
    else{
        echo "found";
        mysqli_query($connect, "create table admin(
                                    id int,
                                    first_name varchar(50) not null,
                                    last_name varchar(50) not null,
                                    email varchar(100),
                                    phone_number varchar(50),
                                    primary key(id)
                                )
                                create table admin_address(
                                    address varchar(100) not null,
                                    id int,
                                    foreign key(id) references admin(id)
                                )");
    }

    
?>