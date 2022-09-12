<?php
    include "../../sqlCommands/connectDb.php";

    $query = "delete from chats where sl_no = {$_GET["sl_no"]}";
    mysqli_query($sql, $query);

    header("Location: ../chat.php");
?>