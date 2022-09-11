<?php
    include '../sqlCommands/connectDb.php';
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $room_id = $_POST["room_id"];

        $query = "insert into users(room_id, users_id, approve) values({$room_id}, {$_SESSION["id"]}, 0)";

        mysqli_query($sql , $query);

        header("Location: ../../index.php");
    }
?>