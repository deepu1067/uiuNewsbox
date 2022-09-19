<?php
    include "../../sqlCommands/connectDb.php";

    $room_id=$_GET["room_id"];
    $user_id=$_GET["user_id"];

    $query = "delete from users where room_id={$room_id} and users_id={$user_id}";
    mysqli_query($sql, $query);
    
    header("Location: ../../../index.php");
?>