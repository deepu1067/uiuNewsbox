<?php 
include '../sqlCommands/connectDb.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$msg = "";

error_reporting(0);

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $cat_id = 2;

    if ($_SESSION["type"] != "general_user") {
        $cat_id = $_POST['category'];
    }

    $img_name = rand() . $_FILES['img']['name'];
    $img_tmp_name = $_FILES['img']['tmp_name'];
    $img_size = $_FILES['img']['size'];

    $email = $_SESSION["email"];
    
    $date = date("d M, Y");

    if ($img_size > 5242880) {
        $msg = "<div class='alert alert-danger'>Image is too big. Maximum image uploading size is 5 MB.</div>";
    } else {
        $r = "INSERT INTO posts (title, description, img, cat_id, date,f_email) VALUES ('$title', '$description', '$img_name', '$cat_id', '$date','$email')";
        $result = mysqli_query($sql, $r);
        if ($result) {
            move_uploaded_file($img_tmp_name, "../uploads/" . $img_name);
            $msg = "<div class='alert alert-success'>Post added successful.</div>";
            $_POST['title'] = "";
            $_POST['description'] = "";
            $_POST['category'] = "";

            header("location: ../../index.php");
        } else {
            $msg = "<div class='alert alert-danger'>Something wrong went. Please try again later.</div>";
        }
    }
}
