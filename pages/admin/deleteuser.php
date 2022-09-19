<?php
    session_start();

    include "../sqlCommands/connectDb.php";


    $id = $_GET["id"];
    $type = $_GET["type"];

    $r = "DELETE FROM  {$type} WHERE id=$id";
    $result = mysqli_query($sql, $r);

    header("Location: ../../index.php");
?>
