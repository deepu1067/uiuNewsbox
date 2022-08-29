<?php
    include "pages/login/login.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Uiu Newsbox</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <main class="container row justify-content-between m-auto mt-5 p-4">
        <div class="col-5">
            <h1 class="m-0 text-uppercase fw-bold text-center">welcome to uiu newsbox</h1>
            <img src="assets/img/main.png" alt="knowledge" class="img-fluid">
        </div>
        <div class="col-7 d-flex flex-column align-items-center">

            <h1 class="text-uppercase fw-bold m-0 mb-5">login</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="w-100 needs-validation d-flex flex-column align-items-center" novalidate method="POST">
                <div class="form-floating w-75">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="" required>
                    <label for="email">Email address</label>
                    <div class="invalid-feedback">
                        Please provide a valid email address
                    </div>
                </div>

                <div class="form-floating w-75">
                    <input type="password" name="password" class="form-control" id="password" placeholder="*******" value="" required>
                    <label for="password">Password</label>
                </div>

                <button class="btn" type="submit">Login</button>

                <?php
                    if($login_err == 1){
                        echo "<div class='text-capitalize fw-bold'>email or password incorrect</div>";
                    }
                ?>
            </form>

            <div class="w-100 d-flex align-items-center">
                <div class="dropdown-divider w-75"></div>
                <h5 class="text-uppercase m-0 fw-bold">or</h5>
                <div class="dropdown-divider w-75"></div>
            </div>

            <h5 class="mt-4 fw-bold">Are you new? <a href="pages/login/signup.php" class="ml-1">Create new account</a></h5>
        </div>
    </main>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <script src="assets/js/login_validation.js"></script>


</body>

</html>