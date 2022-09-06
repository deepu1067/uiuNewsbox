<?php
    include '../sqlCommands/connectDb.php' ;
    $query = mysqli_query($sql, "select * from newspost");
    date_default_timezone_set("Etc/GMT-6");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post_id = $_POST["post_id"];
        $content = $_POST["comment"];
        $date = date("Y/m/d");
        $time = date("h:i:sa");
        

        $comment_query = "insert into post_comment(cDates, cTime, content, cLike, post_id) values('{$date}' , '{$time}' , '{$content}', 0, {$post_id})" ;

        mysqli_query($sql, $comment_query);

        header("location: ../../index.php");
    }
?>