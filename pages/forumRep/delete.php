<?php
include '../sqlCommands/connectDb.php';


$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$id = $queries['id'];


$q = "DELETE FROM `forumrep` WHERE id= $id";
$result = mysqli_query($sql, $q);

$sql->close();

header("Location: ../login/logout.php");
exit();
?>