<?php 
    include '../sqlCommands/connectDb.php' ;
    $job_query = mysqli_query($sql, "select * from job_post");


    date_default_timezone_set("Etc/GMT-6");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $jpost_id = $_POST["post_id"];
        $jcontent = $_POST["comment"];
        $jdate = date("Y/m/d");
        $jtime = date("h:i:sa");
        

        $jcomment_query = "insert into jobpost_comment(cDates, cTime, content, cLike, jpost_id) values('{$jdate}' , '{$jtime}' , '{$jcontent}', 0, {$jpost_id})" ;

        mysqli_query($sql, $jcomment_query);

        header("location: ../../index.php");
    }
?>