<?php
session_start();
include "showUser.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $content = $_POST["content"];
    $title = $_POST["title"];
    $type = $_POST["type"];

    $j_query = "";
    if($type == "admin"){
        $j_query = "insert into job_post(content, title, admin_id) values('{$content}', '{$title}', {$_SESSION["id"]})";
    }
    else if($type == "forumRep"){
        $j_query = "insert into job_post(content, title, forumRep_id) values('{$content}', '{$title}', {$_SESSION["id"]})";
    }
    else{
        $j_query = "insert into job_post(content, title, general_user_id) values('{$content}', '{$title}', {$_SESSION["id"]})";
    }

    mysqli_query($sql, $j_query);

    header("Location: mainPage.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="icon" href="assets/css/favicon.png">
    <link rel="icon" href="assets/img/favicon.png">
</head>

<body>
    <nav class="d-flex justify-content-between align-items-center">
        <img src="../../assets/img/ForOrangeBg.png" alt="logo" class="img-fluid pt-1 pb-1">
        <div class="d-flex flex-column justify-content-center align-items-center p-1">
            <p class="m-0 text-uppercase mb-1 p-1 fw-bold   " style="border: 1px solid white; border-radius:10px ;"><?php echo show($_SESSION["id"]); ?></p>
            <a href="../login/logout.php" class="btn btn-uiu text-uppercase">logout</a>
        </div>
    </nav>

    <a href="mainPage.php" class="btn btn-uiu mt-4 ml-4">Back</a>

    <form class="d-flex justify-content-between align-items-between p-2 w-50 m-auto flex-column" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input class="mb-2" type="text" name="title" required placeholder="write a title">
        <input class="mb-2" type="text" name="content" required placeholder="write post">
        <input type="hidden" name="type" value="<?= $_SESSION["type"] ?>">

        <button type="submit">Post</button>
    </form>
</body>

</html>