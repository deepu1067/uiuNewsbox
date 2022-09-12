<?php
session_start();
include 'showUser.php';
include 'post.php';
include '../sqlCommands/connectDb.php';
include 'room.php';

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
        <img src="../../assets/img/ForOrangeBg.png" alt="logo" class="img-fluid pt-1 pb-1">
        <div class="d-flex flex-column justify-content-center align-items-center p-1">
            <p class="m-0 text-uppercase mb-1 p-1 fw-bold   " style="border: 1px solid white; border-radius:10px ;"><?php echo show($_SESSION["id"]); ?></p>
            <a href="../login/logout.php" class="btn btn-uiu text-uppercase">logout</a>
        </div>
    </nav>

    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active " id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>

            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>

            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Group</button>

            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Joined</button>
        </div>

        <div class="tab-content" id="v-pills-tabContent" style="width: 85%!important;">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                <!-- HOME -->
                <section class="mt-2" id="form">
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>

                        <div class="card border-uiu mb-3" style="max-width: 25rem;">
                            <div class="card-header bg-transparent">
                                <?php
                                $author_query;
                                $author_type;

                                if (!empty($row["admin_id"])) {
                                    $author_query = "select concat(first_name, ' ', last_name) fullName from admin where id={$row["admin_id"]}";
                                    $author_type = "admin";
                                } else {
                                    $author_query = "select concat(first_name, ' ', last_name) fullName from forumrep where id={$row["forum_id"]}";
                                    $author_type = "forum represtitive";
                                }

                                $author = mysqli_fetch_assoc(mysqli_query($sql, $author_query));

                                echo "{$author["fullName"]} ({$author_type})";

                                $comment_query = mysqli_query($sql, "select * from post_comment where post_id={$row["post_id"]}");

                                $size = mysqli_num_rows($comment_query);
                                ?>
                            </div>

                            <div class="card-body border-top-uiu border-bottom-uiu">
                                <p class="card-text">
                                    <?php
                                    echo  $row["content"];
                                    ?>
                                </p>
                            </div>

                            <div class="card-footer bg-transparent">

                                <!-- sending input data -->
                                <form action="post.php" method="post" class="mb-2">
                                    <div class="form-floating mb-3">
                                        <input type="hidden" name="post_id" <?php echo "value='{$row["post_id"]}'"; ?>>
                                        <input type="text" class="form-control" <?php echo "id='commentInput{$row["post_id"]}'"; ?> placeholder="text" name="comment" value="" required>
                                        <label <?php echo "for='comment{$row["post_id"]}'"; ?>>Comment here</label>
                                    </div>`
                                    <button type="submit" class="btn btn-uiu text-capitalize">comment</button>
                                </form>

                                <button type="button" class="btn btn-uiu" data-bs-toggle="modal" <?php echo "data-bs-target='#comment{$row["post_id"]}'"; ?>>
                                    View Comments
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" tabindex="-1" <?php echo "id='comment{$row["post_id"]}'"; ?> aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-capitalize fw-bold" id="exampleModalLabel">
                                                    <?php echo $row["title"]; ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <?php if ($size == 0) : ?>
                                                    <p class="m-0 text-uppercase">no comments yet</p>
                                                <?php else : ?>
                                                    <ol>
                                                        <?php while ($com_row = mysqli_fetch_assoc($comment_query)) : ?>
                                                            <li><?php echo $com_row["content"]; ?></li>
                                                        <?php endwhile ?>
                                                    </ol>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    <?php endwhile  ?>

                </section>
            </div>

            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                <!-- PROFILE -->
                <?php include "profile.php"; ?>
                <div class="card w-50 d-flex align-items-center flex-column m-auto mt-3">
                    <?php while ($row = mysqli_fetch_assoc($profile_query)) : ?>
                        <figure>
                            <img src="assets/img/profile.png" alt="profile" class="img-fluid">
                            <figcaption class="text-uppercase fw-bold text-center mt-3">
                                <?php echo "{$row["first_name"]} {$row["last_name"]}" ?>
                            </figcaption>
                        </figure>

                        <div>
                            <p class="m-0"><?php echo "<strong>Email:</strong> {$row["email"]}" ?></p>
                            <p class="m-0"><?php echo "<strong>Contact Number:</strong> {$row["phone_number"]}" ?></p>
                        </div>

                        <button class="btn btn-uiu mt-2" id="changeBtn">Change current password</button>

                        <p <?php if ($_SESSION["currentPass"] == 1) echo "class='d-block m-0 mt-2 fw-bold'";
                            else echo "class='d-none'" ?>>Current password not matched</p>

                    <?php endwhile ?>
                </div>

                <aside id="upper" class="d-none">
                    <button id="closeUpdate" class="btn btn-uiu-white fw-bold mb-3">Cancel</button>

                    <form action="updatePass.php" class="d-flex justify-content-center align-items-center flex-column w-75" method="post">
                        <div class="form-floating w-50">
                            <input type="password" class="form-control" id="currentPassword" placeholder="Password" required name="curr_pass">
                            <label for="currentPassword">Current password</label>
                        </div>

                        <div class="form-floating mt-2 w-50">
                            <input type="password" class="form-control" id="newpass" placeholder="Password" required name="new_pass">
                            <label for="newpass">New password</label>
                        </div>

                        <div class="form-floating mt-2 w-50">
                            <input type="password" class="form-control " id="confirmpass" placeholder="Password" required name="con_pass">
                            <label for="confirmpass">Confirm password</label>
                        </div>
                        <p class="d-none" id="errormsg">Not Matched</p>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-uiu-white fw-bold" id="updateBtn">Update Password</button>
                        </div>
                    </form>
                </aside>
            </div>

            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                <!-- Forum list -->
                <?php while ($srow = mysqli_fetch_assoc($room_query)) : ?>
                    <?php user_exists($srow["id"]);  ?>
                    <?php if (!$approve) : ?>
                        <div class="card w-50 m-auto mb-3 pt-2 mt-2">
                            <div class="card-title fw-bold text-uppercase text-center"><?php echo $srow["forum_name"]; ?></div>
                            <div class="card-body">
                                <?php if (!$joined) : ?>
                                    <p class="m-0 text-center">Want to be part of discussion room? </p>
                                    <form action="join.php" class="d-flex justify-content-center align-items-center" method="post">
                                        <input type="hidden" name="room_id" <?php echo "value='{$srow["id"]}'"; ?>>
                                        <button class="btn btn-uiu" type="submit">Join</button>
                                    </form>
                                <?php endif ?>
                                <?php if ($joined) : ?>
                                    <p class="text-center m-0">Pending approval</p>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endwhile ?>
            </div>

            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
                <!-- joined -->
                <?php if (mysqli_num_rows($joined_q) == 0) : ?>
                    <h2 class="text-center">Please join a forum discussion room first</h2>
                <?php else : ?>
                    <?php while ($a_row = mysqli_fetch_assoc($joined_q)) : ?>
                        <div class="card w-50 m-auto mt-3 pt-2">
                            <div class="card-title text-center text-uppercase fw-bold"><?php echo $a_row["forum_name"]; ?></div>
                            <div class="card-body">
                                <form action="chat.php" class="d-flex flex-column justify-content-center align-items-center" method="post">
                                    <input type="hidden" name="joined_room" <?php echo "value='{$a_row["id"]}'" ?>>
                                    <input type="hidden" name="forum" <?php echo "value='{$a_row["forum_name"]}'" ?>>
                                    <div>
                                        <button class="btn btn-uiu" type="submit">Go</button>
                                        <a <?php echo "href='delete/leaveForum.php?delete_forum={$a_row["id"]}'" ?> class="btn btn-uiu text-uppercase">
                                            Leave
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endwhile ?>
                <?php endif ?>
            </div>

        </div>
    </div>



    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>