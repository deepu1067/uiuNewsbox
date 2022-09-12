<?php
    session_start();
    include '../sqlCommands/connectDb.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $room_id = $_POST["room_id"];
        $msg = $_POST["msg"];
        $date = date("Y-m-d");
        $time = date("h:i:sa");

        $query = "insert into chats(room_id , users_id , texts, dates, mtime) values ({$room_id}, {$_SESSION["id"]}, '{$msg}', '{$date}', '{$time}')";

        mysqli_query($sql, $query);

        header("Location: chat.php");
    }

?>