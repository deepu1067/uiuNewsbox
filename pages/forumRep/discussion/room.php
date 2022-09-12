<?php
    session_start();
    include "../showUser.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <nav class="d-flex justify-content-between align-items-center">
        <img src="../../../assets/img/ForOrangeBg.png" alt="logo" class="img-fluid pt-1 pb-1">
        <div class="d-flex flex-column justify-content-center align-items-center p-1">
            <p class="m-0 text-uppercase mb-1 p-1 fw-bold   " style="border: 1px solid white; border-radius:10px ;"><?php echo show($_SESSION["id"]); ?></p>
            <a href="../login/logout.php" class="btn btn-uiu text-uppercase">logout</a>
        </div>
    </nav>

    <main>
        
    </main>
</body>

</html>