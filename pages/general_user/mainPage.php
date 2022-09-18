<?php
session_start();
include 'showUser.php';
include 'post.php';
include '../sqlCommands/connectDb.php';
include 'room.php';
include 'job_post.php';
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
            <p class="m-0 text-uppercase mb-1 p-1 fw-bold   " style="border: 1px solid white; border-radius:10px ;">
                <?php echo show($_SESSION["id"]); ?></p>
            <a href="../login/logout.php" class="btn btn-uiu text-uppercase">logout</a>
        </div>
    </nav>

    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active " id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>

            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>

            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Group</button>

            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Joined</button>

            <button class="nav-link" id="v-pills-mypost-tab" data-bs-toggle="pill" data-bs-target="#v-pills-mypost" type="button" role="tab" aria-controls="v-pills-create-post" aria-selected="false">My Posts</button>

            <button class="nav-link" id="v-pills-create-post-tab" data-bs-toggle="pill" data-bs-target="#v-pills-create-post" type="button" role="tab" aria-controls="v-pills-create-post" aria-selected="false">Create Post</button>
        </div>




        <div class="tab-content" id="v-pills-tabContent" style="width: 85%!important;">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                <!-- HOME -->
                <?php
                $r = "SELECT * FROM posts ORDER BY id DESC";
                $result = mysqli_query($sql, $r);
                ?>

                <section class="mt-2" id="jform">
                    <div class="masonry-blog p-2">
                        <?php
                        while ($post_row = mysqli_fetch_assoc($result)) {
                        ?>
                            <div class="left-side">
                                <div class="card p-1">
                                    <div class="p-2" id="card-div" style="<?php if (file_exists("../uploads/" . $post_row['img'])) {
                                                                                echo "background-image: url('../uploads/{$post_row['img']}');";
                                                                            } else {
                                                                                echo "background-image: url('../uploads/{$post_row['old_img']}');";
                                                                            } ?>">
                                    </div><!-- end shadow -->
                                    <div class="shadow-desc">
                                        <div class="blog-meta">

                                            <h4><a id="view" class="text-uppercase fw-bold" href="../forumRep/single.php?id=<?php echo $post_row["id"]; ?>" title="<?php echo $post_row["title"]; ?>" target="_blank"><?php echo $post_row["title"]; ?></a></h4>
                                            <small><a class="fw-bold" href="#" title="<?php echo $post_row["date"]; ?>"><?php echo $post_row["date"]; ?></a></small>
                                            <h4><a class="fw-bold" href="#" title="<?php echo $post_row["view"]; ?>"><?php echo "Viewed: {$post_row["view"]}"; ?></a></h4>

                                            <span class="bg-aqua"><a class="fw-bold" href="">
                                                    <?php
                                                    $sql1 = "SELECT cat_name FROM categories WHERE id='{$post_row["cat_id"]}'";
                                                    $result1 = mysqli_query($sql, $sql1);
                                                    if (mysqli_num_rows($result1) > 0) {
                                                        $cat_data = mysqli_fetch_assoc($result1);
                                                        echo "Type: {$cat_data['cat_name']}";
                                                    }
                                                    ?>
                                                </a></span>
                                        </div><!-- end meta -->
                                    </div><!-- end shadow-desc -->
                                </div><!-- end post-media -->
                            </div><!-- end left-side -->
                        <?php } ?>
                    </div><!-- end masonry -->
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
                            <button type="submit" class="btn btn-uiu-white fw-bold" id="updateBtn">Update
                                Password</button>
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

            <div class="tab-pane fade" id="v-pills-create-post" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <h2 class="w-100 text-center border-bottom-uiu "> Create Post</h2>
                </div>
                <section class="row mt-3">
                    <div class="col-lg-8 col-12 mx-auto bg-white p-4 shadow">

                        <form action="job_post.php" method="post" enctype="multipart/form-data">
                            <?php echo $msg; ?>
                            <div class="form-group mb-1">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" value="<?php echo $_POST['title']; ?>" name="title" id="title" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" rows="5" id="description" required><?php echo $_POST['description']; ?></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="img">Image</label>
                                <input type="file" accept="image/*" class="form-control" name="img" id="img" required>
                            </div>

                            <button type="submit" name="submit" class="btn btn-uiu">Add Post</button>
                        </form>
                    </div>
                </section>
            </div>

            <div class="tab-pane fade" id="v-pills-mypost" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
                <div>
                    <div class="card shadow m-auto mt-3 ">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold fw-bold">Posts</h6>
                        </div>
                        <div class="card-body">
                            <?php if (isset($_REQUEST['remove_success'])) {
                                if ($_REQUEST['remove_success'] == "true") {
                                    echo "<div class='alert alert-success'>Record deleted successful.</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Record can't deleted.</div>";
                                }
                            }
                            ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $email = $_SESSION['email'];

                                        $r = "SELECT * FROM posts where f_email = '$email' ";
                                        $result = mysqli_query($sql, $r);
                                        if (mysqli_num_rows($result) > 0) {
                                            $id = 1;
                                            while ($post_row = mysqli_fetch_assoc($result)) {

                                        ?>
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $post_row['title']; ?></td>
                                                    <td><?php

                                                        $show_category = mysqli_query($sql, "SELECT * FROM categories WHERE id='{$post_row["cat_id"]}'");
                                                        if (mysqli_num_rows($show_category) > 0) {
                                                            $category_data = mysqli_fetch_assoc($show_category);
                                                            echo $category_data['cat_name'];
                                                        }

                                                        ?></td>
                                                    <td>
                                                        <a href="../forumRep/edit_post.php?id=<?php echo $post_row['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="../forumRep/delete_post.php?id=<?php echo $post_row['id']; ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                        <?php

                                                $id++;
                                            }
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>