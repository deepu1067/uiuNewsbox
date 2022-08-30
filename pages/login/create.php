<?php
    include "../sqlCommands/connectDb.php";

    $login_err = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type = $_POST["account-type"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $con_pass = $_POST["con-pass"];

        $query = "INSERT INTO {$type} (`first_name`, `last_name`, `email`, `phone_number`, `passwords`) VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$phone}', '{$password}');" ;

        
    }
?>