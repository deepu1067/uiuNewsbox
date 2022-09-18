<?php 
include '../sqlCommands/connectDb.php';


$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$id = $queries['id'];


$q = "DELETE FROM `posts` WHERE id= $id";
$result = mysqli_query($sql, $q);

$sql->close();

header("Location: ../../index.php");
exit();

?>