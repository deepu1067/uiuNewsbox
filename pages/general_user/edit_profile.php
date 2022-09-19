<?php
session_start();
include "../sqlCommands/connectDb.php";
include "../forumRep/showUser.php";

$first_name = "";
$last_name = "";
$phone_number = "";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $q = "select * from {$_SESSION["type"]} where id = {$_SESSION["id"]}";
    $info_query = mysqli_query($sql, $q);



    while ($row = mysqli_fetch_assoc($info_query)) {
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $phone_number = $row["phone_number"];
    }
} else {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone_number = $_POST["phone"];

    $q = "update {$_SESSION["type"]} set first_name = '{$first_name}' , last_name = '{$last_name}', phone_number = '{$phone_number}' where id = {$_SESSION["id"]}";

    mysqli_query($sql, $q);

    header("Location: ../../index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<nav class="d-flex justify-content-between align-items-center">
        <img src="../../assets/img/ForOrangeBg.png" alt="logo" class="img-fluid pt-1 pb-1">
        <h5 class="text-capitalize border-all fw-bold">
            <?php
            if ($_SESSION["type"] == "forumRep")
                echo "Forum Represtitive";
            else if ($_SESSION["type"] == "general_user")
                echo "General User";
            else
                echo "Admin";
            ?>
        </h5>
        <div class="d-flex flex-column justify-content-center align-items-center p-1">
            <p class="m-0 text-uppercase mb-1 p-1 fw-bold   " style="border: 1px solid white; border-radius:10px ;">
                <?php echo show($_SESSION["id"]); ?></p>
            <a href="../login/logout.php" class="btn btn-uiu text-uppercase">logout</a>
        </div>
    </nav>

    <section class="card w-50 m-auto mt-4">
        <div class="card-header">
            <h3>Edit profile</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
                <div class="form-floating mb-3 w-100">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="first name" required value="<?= $first_name ?>">
                    <label for="first_name">First Name</label>
                </div>

                <div class="form-floating mb-3 w-100">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="last_name" required value="<?= $last_name ?>">
                    <label for="last_name">Last Name</label>
                </div>

                <div class="form-floating mb-3 w-100">
                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="phone" required value="<?= $phone_number ?>">
                    <label for="phone">Phone</label>
                </div>

                <button type="submit" class="btn btn-uiu">Update</button>
            </form>
        </div>

        <div class="ps-3 pb-2"><a href="../../index.php" class="btn btn-uiu">Cancel</a></div>
    </section>
</body>

</html>