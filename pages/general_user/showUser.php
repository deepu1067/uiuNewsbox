<?php
    include "../sqlCommands/connectDb.php";

    function show($user){
        global $sql;

        $query = "select * from general_user where id={$user}";
        $info_query = mysqli_query($sql, $query);
        
        $row = mysqli_fetch_assoc($info_query);

        return "{$row["first_name"]} {$row["last_name"]}";
    }
?>