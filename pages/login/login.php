<?php
    include "pages/sqlCommands/connectDb.php";

    session_start();
    //checking if already logged in
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        if($_SESSION['type'] == "admin")
            header("location: pages/admin/mainPage.php");
        else if($_SESSION['type'] == "forumRep")
               
            header("location: pages/forumRep/mainPage.php");
        else if($_SESSION['type'] == "general_user")
            header("location: pages/general_user/mainPage.php");
    }
    else{
        session_destroy();
    }



    $login_err = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $useremail = $_POST["email"];
        $password = $_POST["password"];
        $loginType = $_POST["type"];

        $query = "select id, email, passwords from {$loginType} where email='{$useremail}';";
        
        $row = mysqli_fetch_assoc(mysqli_query($sql, $query));
        
        if(!empty($row) && $row["email"] == $useremail && $row["passwords"] == $password){
            //starting a session
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION['email'] = $row["email"];
            $_SESSION['type'] = $loginType;
            $_SESSION["currentPass"] = 0;
            $_SESSION["id"] = $row["id"];
        }
        else {
            $login_err = 1;
        }

        if(session_status()==2){
            header("location: pages/".$_SESSION['type']."/mainPage.php");
        }

    }
?>