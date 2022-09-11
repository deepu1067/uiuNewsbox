<?php
session_start();
include "../sqlCommands/connectDb.php";

$forum_name;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["joined_room"];
    $forum_name = $_POST["forum"];

    $c_q = "select * from chats c join general_user g on c.users_id = g.id where c.room_id = {$room_id} order by c.sl_no desc";

    $chat_query = mysqli_query($sql, $c_q);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Discussion</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav class="d-flex justify-content-between align-items-center">
        <img src="../../assets/img/ForOrangeBg.png" alt="logo" class="img-fluid pt-1 pb-1">
        <div>
            <a href="../../index.php" class="btn btn-uiu text-uppercase">Home</a>
            <a href="../login/logout.php" class="btn btn-uiu text-uppercase">logout</a>
        </div>
    </nav>

    <main id="chat">
        <div class="card w-75 justify-content-end m-auto mt-3">
            <h2 class="text-center fw-bold text-uppercase"><?php echo $forum_name; ?></h2>

            <div id="msg">
                <div class="scroll d-flex">
                    <?php while ($c_row = mysqli_fetch_assoc($chat_query)) : ?>
                        <section class="d-flex mt-1" <?php echo "title='{$c_row["dates"]} {$c_row["mtime"]}'" ?>>
                            <p class="text-center m-0"><?php echo "{$c_row["first_name"]} {$c_row["last_name"]}"; ?></p>
                            <p class="m-0"><?php echo "{$c_row["texts"]}"; ?></p>
                        </section>
                    <?php endwhile ?>
                </div>
            </div>

            <form action="send.php" method="post">
                <div class="input-group flex-nowrap">
                    <input type="hidden" name="room_id" <?php echo "value='{$room_id}'" ?>>
                    <input type="text" class="form-control" aria-describedby="addon-wrapping" name="msg">
                    <button type="submit" class="btn btn-uiu">Send</button>
                </div>
            </form>
        </div>
    </main>

    <script src="assets/css/bootstrap.min.css"></script>
</body>

</html>