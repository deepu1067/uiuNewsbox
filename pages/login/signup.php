<?php
include "create.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SignUp Form</title>
    <link rel="stylesheet" href="../../assets/css/signup.css">
    <script src="../../assets/js/app.js"></script>
    <link rel="icon" href="../../assets/img/favicon.png">
</head>

<body>
    <section <?php if ($success == 1) echo "id='upper'";
                else echo "class='d-none'"; ?>>
        <div class="card">
            <h3 class="fw-bold pb-1">Account Created</h3>

            <a href="../../index.php" class="ml-1">Log in now</a>
        </div>
    </section>

    <main class="container row m-auto justify-content-center p-4 ">
        <h1 class="col-12 text-center text-uppercase pb-3 fw-bold">welcome to uiu newsbox</h1>

        <form class="col-5 d-flex flex-column align-items-center needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>

            <div class="d-flex flex-column justify-content-center mb-2">
                <p class="m-0 text-center text-uppercase mb-1">Choose your account type : </p>
                <div class="input-group w-100 mb-2">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" name="account-type" value="forumRep" id="forum" style="
                    margin-right: 0.4rem;" required>
                        <label for="forum">Forum Representitive</label>
                    </div>
                </div>

                <div class="input-group w-100">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" name="account-type" value="general_user" id="general" style="
                    margin-right: 0.4rem;" required>
                        <label for="general">General User</label>
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3 w-100">
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="first name" required>
                <label for="first_name">First Name</label>
                <div class="invalid-feedback fw-bold">
                    Please provide a valid input
                </div>
            </div>

            <div class="form-floating mb-3 w-100">
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="last_name" required>
                <label for="last_name">Last Name</label>
                <div class="invalid-feedback fw-bold">
                    Please provide a valid input
                </div>
            </div>

            <div class="form-floating mb-3 w-100">
                <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
                <label for="email">Email</label>
                <div class="invalid-feedback fw-bold">
                    Please provide a valid email
                </div>
                <?php
                if ($email_err == 1) {
                    echo "<div class='fw-bold' style='color: red !important'> Email is already exists </div>";
                }
                ?>
            </div>

            <div class="form-floating mb-3 w-100">
                <input type="phone" class="form-control" id="phone" name="phone" placeholder="phone" required>
                <label for="phone">Phone</label>
                <div class="invalid-feedback fw-bold">
                    Please provide a valid phone number
                </div>
            </div>

            <div class="form-floating mb-3 w-100">
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                <label for="password">Password</label>
            </div>

            <div class="form-floating mb-3 w-100">
                <input type="password" class="form-control" id="con-password" name="con-pass" placeholder="con-pass" required>
                <label for="con-password">Confirm Password</label>
                <?php
                    if ($pass_err == 1) {
                        echo "<div class='fw-bold' style='color: red !important'> Password not matched </div>";
                    }
                ?>
            </div>

            <button class="btn" type="submit" >Create Account</button>
        </form>

        <h5 class="mt-4 fw-bold col-10 text-center">Already have an account? <a href="../../index.php" class="ml-1">Log in here</a></h5>
    </main>


    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/all.min.js"></script>
    <script src="../../assets/js/login_validation.js"></script>

</body>

</html>