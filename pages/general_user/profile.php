<?php 
    include "../sqlCommands/connectDb.php";
    $email = $_SESSION["email"];
    
    $profile_query = mysqli_query($sql, "select * from {$_SESSION["type"]} where email='{$email}'");

    
?>