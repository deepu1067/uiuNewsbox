<?php
    session_start();
    include "../sqlCommands/connectDb.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $current_pass = $_POST["curr_pass"];
        $new_pass = $_POST["new_pass"];


        $query_pass = "select passwords from {$_SESSION["type"]} where email='{$_SESSION["email"]}'";
        $query_update = "update {$_SESSION["type"]} set passwords = '{$new_pass}' where email='{$_SESSION["email"]}'";
        $query = mysqli_query($sql, $query_pass);
        
        while($row = mysqli_fetch_assoc($query)){
            if($row["passwords"] == $current_pass){
                mysqli_query($sql, $query_update);
                session_destroy();

                header("location: ../../index.php");
            }
            else{
                $_SESSION["currentPass"] = 1;
                header("location: ../../index.php");
            }
        }
    }
?>