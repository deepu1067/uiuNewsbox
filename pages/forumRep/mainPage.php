<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <nav class="d-flex justify-content-between align-items-center">
        <img src="../../assets/img/ForOrangeBg.png" alt="logo" class="img-fluid ">

        <h2 class="text-uppercase fw-bold"><?php echo "It is a " . $_SESSION['type']; ?></h2>
        <div>
            <a href="details.php">Details</a>
        </div>
        <div>
            <a href="../login/logout.php">logout</a>
        </div>
    </nav>

    <div>
        <?php
        include '../sqlCommands/connectDb.php';
        $email = $_SESSION['email'];

        $q =  "SELECT * FROM `forumrep` where email = '$email';";
        $run = mysqli_query($sql, $q);
        $html = "";

        if (mysqli_num_rows($run) > 0) {
            while ($row = $run->fetch_assoc()) {
                $html = $html .
                    $row["first_name"] . " " .
                    $row["last_name"];
            }
        }
        ?>
        <div class="container">
            <h1 class="position-absolute ">
                <?php
                echo "WELCOME " . " " . $html;

                ?>
            </h1>


        </div>

        <br><br>

        <a type="button" class="btn btn-secondary" href="add_post.php">Create a New post</a>
        <a type="button" class="btn btn-secondary" href="post.php">All Post</a>
        <a type="button" class="btn btn-secondary" href="views.php">Views</a>

        <div><a href="discussion/room.php" class="btn btn-uiu mt-2">Go to discussion room</a></div>

   



    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <script src="assets/js/login_validation.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>