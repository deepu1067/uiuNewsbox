<?php
   include '../sqlCommands/connectDb.php';
        session_start();
        $id = $_POST['id'];
        $f_name = $_POST['first_name'];
        $l_name = $_POST['last_name'];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
      
        
       
         
        $q =  "UPDATE `forumrep` SET `first_name`='$f_name',`last_name`='$l_name',`email`='$email',`phone_number`='$phone_number' WHERE id='$id'";
        $run = mysqli_query($sql, $q);
        
        header('location:mainPage.php');
        $sql->close();
?>