<?php
session_start();
include "../showUser.php";
include "list.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Room</title>
    <link rel="icon" href="../assets/css/favicon.png">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <nav class="d-flex justify-content-between align-items-center">
        <img src="../../../assets/img/ForOrangeBg.png" alt="logo" class="img-fluid pt-1 pb-1">
        <div class="d-flex flex-column justify-content-center align-items-center p-1">
            <p class="m-0 text-uppercase mb-1 p-1 fw-bold   " style="border: 1px solid white; border-radius:10px ;"><?php echo show($_SESSION["id"]); ?></p>
            <a href="../../login/logout.php" class="btn btn-uiu text-uppercase">logout</a>
        </div>
    </nav>

    <main>
        <h2 class="text-center mt-2 border-bottom-uiu">Join Request</h2>
        <section id="item-container" class="w-50 m-auto mt-4">
            <?php if (mysqli_num_rows($s_query) == 0) : ?>
                <section class="d-flex justify-content-between align-items-center w-100 mb-2 border-bottom-uiu pb-2" id="item">
                    <p class="m-0">No Join Requests yet</p>
                </section>
            <?php else : ?>
                <?php $counter = 1;
                while ($row = mysqli_fetch_assoc($s_query)) : ?>
                    <section class="d-flex justify-content-between align-items-center w-100 mb-2 border-bottom-uiu pb-2" id="item">
                        <p class="m-0"><span><?= $counter . "--" ?></span> <?= $row["name"] ?> </p>
                        <p class="m-0"><?= $row["forum_name"] ?></p>
                        <div>
                            <a href="approve.php?room_id=<?= $row["room_id"] ?>&user_id=<?= $row["users_id"] ?>"><i class="fa-solid fa-circle-check fa-xl"></i></a>

                            <a href="refuse.php?room_id=<?= $row["room_id"] ?>&user_id=<?= $row["users_id"] ?>"><i class="fa-solid fa-square-minus fa-xl"></i></a>
                        </div>
                    </section>
                    <?php $counter++; ?>
                <?php endwhile ?>
            <?php endif ?>
        </section>
    </main>
</body>

</html>