<?php 
    include '../../sqlCommands/connectDb.php';

    $str = "select r.id as room_id , r.forum_name forum_name , r.forumRep_id forumRep_id , u.users_id users_id , u.approve approve, concat(g.first_name, ' ', g.last_name) 'name', g.email email from room r join users u on r.id = u.room_id join general_user g on u.users_id=g.id where r.forumRep_id = {$_SESSION["id"]} and u.approve = 0";

    $s_query = mysqli_query($sql, $str);


?>