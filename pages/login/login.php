<?php
    include "pages/sqlCommands/connectDb.php";

    session_start();
    //checking if already logged in
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        if($_SESSION['type'] == "admin")
            header("location: pages/admin/mainPage.php");
        else if($_SESSION['type'] == "forumRep")
            header("location: pages/forumRep/mainPage.php");
        else if($_SESSION['type'] == "generalUser")
            header("location: pages/generalUser/mainPage.php");
    }
    else{
        session_destroy();
    }



    $login_err = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $useremail = $_POST["email"];
        $password = $_POST["password"];

        $a_query = "select email, passwords from admin where email='".$useremail."';";
        $f_query = "select email, passwords from forumrep where email='".$useremail."';";
        $g_query = "select email, passwords from general_user where email='".$useremail."';";
        
        $admin_row = mysqli_fetch_assoc(mysqli_query($sql, $a_query));
        $forum_row = mysqli_fetch_assoc(mysqli_query($sql, $f_query));
        $general_row = mysqli_fetch_assoc(mysqli_query($sql, $g_query));

        if($admin_row["email"] == $useremail && $admin_row["passwords"] == $password){
            //starting a session
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION['email'] = $admin_row["email"];
            $_SESSION['type'] = 'admin';

            // header("location: pages/".$_SESSION['type']."/mainPage.php");
        }
        else if(!empty($forum_row) && $forum_row["email"] == $useremail && $forum_row["passwords"] == $password){
            //starting a session
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION['email'] = $forum_row["email"];
            $_SESSION['type'] = 'forumRep';
        }
        else if(!empty($forum_row) && $general_row["email"] == $useremail && $general_row["passwords"] == $password){
            //starting a session
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION['email'] = $general_row["email"];
            $_SESSION['type'] = 'generalUser';
        }
        else {
            $login_err = 1;
        }

        if(session_status()==2){
            header("location: pages/".$_SESSION['type']."/mainPage.php");
        }

    }
?>