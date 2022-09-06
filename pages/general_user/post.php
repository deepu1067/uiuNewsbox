<?php
    include '../sqlCommands/connectDb.php' ;
    $query = mysqli_query($sql, "select * from newspost");
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $comment = $_POST["comment"];

        // header("location: ../../index.php");

        echo $comment ;
    }
?>