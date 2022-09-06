<?php
session_start();
include "../sqlCommands/connectDb.php";


$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$id = $queries['id'];

$r = "DELETE FROM  `forumrep` WHERE id= $id";
$result = mysqli_query($sql, $r);

$sql->close();

header("Location: forumuser.php");
exit();
?>