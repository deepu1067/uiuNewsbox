<?php
session_start();
include "../sqlCommands/connectDb.php";
include '../forumRep/showUser.php';
include "../general_user/profile.php";

$f_q = "select * from forumRep";
$g_q = "select * from general_user";

$forum_query = mysqli_query($sql, $f_q);
$user_query = mysqli_query($sql, $g_q);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Admin Home Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="../general_user/assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style-foot.css">
    <link rel="icon" href="assets/css/favicon.png">

</head>

<body>

    <nav class="d-flex justify-content-between align-items-center">
        <img src="../../assets/img/ForOrangeBg.png" alt="logo" class="img-fluid pt-1 pb-1">
        <h4 class="text-uppercase border-all fw-bold"><?= $_SESSION["type"] ?></h4>
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
            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-all" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">All Post</button>

        </div>


        <div class="tab-content" id="v-pills-tabContent" style="width: 85%!important;">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                <!-- HOME -->
                <div class="mt-3">
                    <h2 class="border-bottom-uiu">Forum Represetitive List:</h2>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                        <?php if (mysqli_num_rows($forum_query) == 0) : ?>
                            <tr>
                                <td colspan="4">No users yet</td>
                            </tr>
                        <?php else : ?>

                            <?php while ($f_row = mysqli_fetch_assoc($forum_query)) : ?>
                                <tr>
                                    <td class="text-capitalize "><?= "{$f_row["first_name"]} {$f_row["last_name"]}" ?></td>
                                    <td><?= $f_row["email"] ?></td>
                                    <td><?= $f_row["phone_number"] ?></td>
                                    <td>
                                        <div>
                                            <a href="deleteuser.php?id=<?= $f_row["id"] ?>&type=forumRep" title="Delete"><i class="fa-regular fa-trash-can text-danger fa-xl"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile ?>

                        <?php endif ?>
                    </table>
                </div>

                <div class="mt-5">
                    <h2 class="border-bottom-uiu">General User List:</h2>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                        <?php if (mysqli_num_rows($user_query) == 0) : ?>
                            <tr>
                                <td colspan="4">No users yet</td>
                            </tr>
                        <?php else : ?>

                            <?php while ($f_row = mysqli_fetch_assoc($user_query)) : ?>
                                <tr>
                                    <td class="text-capitalize "><?= "{$f_row["first_name"]} {$f_row["last_name"]}" ?></td>
                                    <td><?= $f_row["email"] ?></td>
                                    <td><?= $f_row["phone_number"] ?></td>
                                    <td>
                                        <div>
                                            <a href="deleteuser.php?id=<?= $f_row["id"] ?>&type=general_user" title="Delete"><i class="fa-regular fa-trash-can text-danger fa-xl"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile ?>

                        <?php endif ?>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">

                <div class="card w-50 d-flex align-items-center flex-column m-auto mt-3">
                    <?php while ($profile_row = mysqli_fetch_assoc($profile_query)) : ?>
                        <figure>
                            <img src="../general_user/assets/img/profile.png" alt="profile" class="img-fluid">
                            <figcaption class="text-uppercase fw-bold text-center mt-3">
                                <?php echo "{$profile_row["first_name"]} {$profile_row["last_name"]}" ?>
                            </figcaption>
                        </figure>

                        <div>
                            <p class="m-0"><?php echo "<strong>Email:</strong> {$profile_row["email"]}" ?></p>
                            <p class="m-0 mt-2"><?php echo "<strong>Contact Number:</strong> {$profile_row["phone_number"]}" ?></p>
                        </div>

                        <div class="mt-2">
                            <button class="btn btn-uiu" id="changeBtn">Change current password</button>
                            <a href="../general_user/edit_profile.php" class="btn btn-uiu">Edit</a>
                        </div>

                        <p <?php if ($_SESSION["currentPass"] == 1) echo "class='d-block m-0 mt-2 fw-bold'";
                            else echo "class='d-none'" ?>>Current password not matched</p>

                    <?php endwhile ?>
                </div>

                <aside id="upper" class="d-none">
                    <button id="closeUpdate" class="btn btn-uiu-white fw-bold mb-3">Cancel</button>

                    <form action="../general_user/updatePass.php" class="d-flex justify-content-center align-items-center flex-column w-75" method="post">
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


            <div class="tab-pane fade" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                        <a href="allpost.php" class="btn btn-uiu">all post</a>
        </div>
        </div>
    </div>


    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <h4>QUICK LINK</h4>
                    <ul>
                        <li><a href="https://www.uiu.ac.bd/">United International University
                            </a></li>
                        <li><a href="https://ucam.uiu.ac.bd/Security/LogIn.aspx">UCAM</a></li>
                        <li><a href="http://lms.uiu.ac.bd/login/index.php">LMS</a></li>
                        <li><a href="https://cse.uiu.ac.bd/">Dept. Of CSE</a></li>
                    </ul>
                </div>
                <div class="col-3">
                    <h4>QUICK CONTACT</h4>
                    <p>
                        Dhaka-1212,Bangladesh. <br>
                        Phone: +88 09604-848-848 <br>
                        E-mail: info@uiunewsbox.ac.bd <br>
                    </p>
                </div>
                <div class="col-3">
                    <h4>EMERGENCY SERVICES</h4>
                    <ul>
                        <li><a href="#">999 For Police, fire service and ambulance services</a></li>
                        <li><a href="#">109 For women and children are abused.</a></li>
                    </ul>
                </div>
                <div class="col-3">
                    <h4>FOLLOW US</h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com/groups/249281981787004"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script src="https://use.fontawesome.com/2c7ebecd35.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../general_user/assets/js/app.js"></script>
</body>

</html>