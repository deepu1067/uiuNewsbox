<?php
include "../sqlCommands/connectDb.php";

$joined = false;
$approve = false;

$room_query = mysqli_query($sql, "select * from room");

function user_exists($room_id)
{
    global $sql;
    global $joined;
    global $approve;

    $squery = "select * from users where users_id={$_SESSION["id"]} and room_id = {$room_id}";
    $check_user = mysqli_query($sql, $squery);
    
    $srow = mysqli_fetch_assoc($check_user);
    
    if (!empty($srow)) {
        if ($srow["users_id"] == $_SESSION["id"] and $srow["approve"] == 1) {
            $joined = true;
            $approve = true;
        }
        else if($srow["users_id"] == $_SESSION["id"] and $srow["approve"] == 0){
            $joined = true;
        }
    }
    else {
        $joined = false;
        $approve = false;
    }
}
