<?php
    session_start();
    include '../sqlCommands/connectDb.php';
    $email=$_SESSION['email'];

  $q =  "SELECT * FROM `forumrep` where email = '$email';";
  $run = mysqli_query($sql, $q);
//   $html = "";
 
//   if(mysqli_num_rows($run)>0){
//     while($row = $run->fetch_assoc()){
//         $html = $html. 
//                    $row["first_name"]." ".
//                   $row["last_name"];
       
//     }
// };


// $html1 = "";

//     if(mysqli_num_rows($run)>0){
//         while($row = $run->fetch_assoc()){
//             $html1 = $html1. 
//                        $row["email"];
           
//         }
// };

// $html2 = "";
// if(mysqli_num_rows($run)>0){
//     while($row = $run->fetch_assoc()){
//         $html2 = $html2. 
//         $row["phone_number"]; 
//     }
// };
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

<h1>
<?php

while($row = mysqli_fetch_array($run)) {

  echo "ID : ".$row['id'] . "<br />";
  echo "Forum Name : ".$row['first_name']." ".$row['last_name']. "<br />";
  
  echo "Email: ".$row['email'] . "<br />";
  echo "Phone Number : ".$row['phone_number'] . "<br />";


}

mysqli_close($sql);

?>
</h1>

</div>

</body>
</html>