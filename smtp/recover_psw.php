<?php 

include "../pages/sqlCommands/connectDb.php";
session_start();

?>
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../assets/css/signup.css">
    <script src="../assets/js/app.js"></script>

    <link rel="icon" href="../assets/img/favicon.png">


    <title>PassWord Recover</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="#">User Password Recover</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Password Recover</div>
                        <div class="card-body">
                            <!-- <form action="#" method="POST" name="recover_psw"> -->
                            <form class="col-5 d-flex flex-column align-items-center needs-validation"
                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>

                                <div class="d-flex flex-column justify-content-center mb-2">
                                    <p class="m-0 text-center text-uppercase mb-1">Choose your account type : </p>
                                    <div class="input-group w-100 mb-2">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="account-type"value="forumRep" id="forum" style="margin-right: 0.4rem;" required>
                                            <label for="forum">Forum Representitive</label>
                                        </div>
                                    </div>

                                    <div class="input-group w-100">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="account-type"
                                                value="general_user" id="general" style="
                                                    margin-right: 0.4rem;" required>
                                            <label for="general">General User</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating mb-3 w-100">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="email"
                                        required>
                                    <label for="email">Email</label>
                                    <div class="invalid-feedback fw-bold">
                                        Please provide a valid email
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" value="Recover" name="recover">
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/all.min.js"></script>
    <script src="../../assets/js/login_validation.js"></script>
</body>

</html>

<?php 

    if(isset($_POST["recover"])){
        $email = $_POST["email"];
        error_reporting(E_ERROR);
        $type = $_POST["account-type"];


        if(!$type)
        {
            ?>
            <script>
            alert("<?php echo " Select Account Type ! "?>");
            </script>
            <?php
        }

        else
        {
            $q3 = mysqli_query($sql, "SELECT * from {$type} where email='{$email}'");
            $query = mysqli_num_rows($q3);
              $fetch = mysqli_fetch_assoc($q3);
    
            if(mysqli_num_rows($q3) <= 0){
                ?>
    <script>
    alert("<?php  echo "Sorry, no emails exists "?>");
    </script>
    <?php
            }else{
                // generate token by binaryhexa 
                $token = bin2hex(random_bytes(50));
    
                //session_start ();
                $_SESSION['token'] = $token;
                $_SESSION['email'] = $email;
                $_SESSION['account-type'] = $type;
    
                require "Mail/phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer;
    
                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->Port=587;
                $mail->SMTPAuth=true;
                $mail->SMTPSecure='tls';
    
                // h-hotel account
                $mail->Username='uiunewsbox@gmail.com';
                $mail->Password='Zrnsfzljbvlhgkxe';
    
                // send by h-hotel email
                $mail->setFrom('email', 'Password Reset');
                // get email from input
                $mail->addAddress($_POST["email"]);
                //$mail->addReplyTo('lamkaizhe16@gmail.com');
    
                // HTML body
                $mail->isHTML(true);
                $mail->Subject="Recover your password";
                $mail->Body="<b>Dear User</b>
                <h3>We received a request to reset your password.</h3>
                <p>Kindly click the below link to reset your password</p>
                http://localhost/Update/uiuNewsbox/smtp/reset_psw.php
                <br><br>
                <p>With regrads,</p>
                <b>UIU NEWS BOX</b>";
    
                if(!$mail->send()){
                    ?>
                    <script>
                    alert("<?php echo " Invalid Email "?>");
                    </script>
                  <?php
                }else{
                    ?>
                    <script>
                     window.location.replace("notification.html");
                    </script>
                <?php
                }
            }
        }
            
    }

?>