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

    <h2 class="text-uppercase fw-bold"><?php echo "It is an ".$_SESSION['type'] ;?></h2>

    <div>
        <a href="../login/logout.php">logout</a>
    </div>
</nav>

</body>
</html>