<?php 
include '../sqlCommands/connectDb.php';


$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$id = $queries['id'];


$q = "DELETE FROM `posts` WHERE id= $id";
$result = mysqli_query($sql, $q);

if ($result) {
    header("Location: post.php? remove_success = true ");
} else {
    header("Location: post.php? remove_success = false ");
}

$sql->close();

header("Location:post.php");
exit();

?>