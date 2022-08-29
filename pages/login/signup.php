<?php
include "create.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>UIU News Box</title>
    <link rel="stylesheet" href="../../assets/css/signup.css">
</head>

<body>
    <main class="container">
        <h2>welcome to uiu newsbox</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="first_name" name="first_name" placeholder="first name">
                <label for="first_name">First Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="last_name">
                <label for="last_name">Last Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="email">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="phone" class="form-control" id="phone" name="phone" placeholder="phone">
                <label for="phone">Phone</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                <label for="password">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="con-password" name="con-pass" placeholder="con-pass">
                <label for="con-password">Confirm Password</label>
            </div>

            <button class="btn" type="submit">Login</button>
        </form>
    </main>


    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/all.min.js"></script>
    <script src="../../assets/js/login_validation.js"></script>
</body>

</html>