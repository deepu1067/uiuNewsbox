<?php
include 'db_connect.php';


$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$id = $queries['id'];
echo $id ;

$sql = "DELETE FROM `forumrep` WHERE id= $id";
$result = mysqli_query($con, $sql);

$con->close();

//header("Location: mainPage.php");
exit();
?>