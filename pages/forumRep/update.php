<?php
include '../sqlCommands/connectDb.php';
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$id = $queries['id'];

$q = "Select * from `forumrep` where id= $id";
$result = mysqli_query($sql, $q);
if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()){
        $id = $row["id"];
        $f_name= $row["first_name"];
        $l_name= $row["last_name"];
        $email = $row["email"];
        $phone_number = $row["phone_number"];
       
    }
} 



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <form action="updateCon.php" method="POST">
        <label for="Name">First Name</label>
        <input type="text" name="first_name" value="<?php echo $f_name?>">
        <label for="Name">Last Name</label>
        <input type="text" name="last_name" value="<?php echo $l_name?>">
        <label for="Name">Phone Number</label>
        <input type="text" name="phone_number" value="<?php echo $phone_number?>">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <input type="hidden" name="email" value="<?php echo $email?>">
        <button type="submit">Update</button>

    </form>
</head>

<body>

</body>

</html>