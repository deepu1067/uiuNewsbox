<?php
    session_start();
    include '../sqlCommands/connectDb.php';
    $email=$_SESSION['email'];

  $q =  "SELECT * FROM `forumrep` where email = '$email';";
  $run = mysqli_query($sql, $q); 

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
    <img src="../../assets/img/ForOrangeBg.png" alt="logo" class="img-fluid ">

    <h2 class="text-uppercase fw-bold"><?php echo "It is a ".$_SESSION['type'] ;?></h2>
    <div>
        <a href="mainPage.php"><-Back</a>
    </div>
</nav>


<br>

<div>

<h3>
<?php

while($row = mysqli_fetch_array($run)) {

  echo "ID : ".$row['id'] . "<br />";
  echo "Forum Name : ".$row['first_name']." ".$row['last_name']. "<br />";
  
  echo "Email: ".$row['email'] . "<br />";
  echo "Phone Number : ".$row['phone_number'] . "<br />";
  "</td><td>". '<a class="btn btn-lg btn-block btn btn-danger" href="delete.php?id='. $row['id'] .'"> Delete </a>'.'</td>';

}

mysqli_close($sql);
?>
</h3>
</div>
<br>

<div>



<!-- <a type = "button" class="btn btn-outline-primary" href="delete.php?id = <?php echo $row['id']?>"> Delete</a> -->


</div>

</body>
</html>