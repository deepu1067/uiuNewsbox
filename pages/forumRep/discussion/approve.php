<?php
    include "../../sqlCommands/connectDb.php";

    $room_id=$_GET["room_id"];
    $user_id=$_GET["user_id"];

    $query = "update users set approve=1 where room_id={$room_id} and users_id={$user_id}";
    mysqli_query($sql, $query);

    header("Location: room.php");
?>