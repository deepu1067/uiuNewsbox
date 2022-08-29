<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    echo session_status();

    echo $_SESSION['type'];
?>
<a href="../login/logout.php">logout</a>

</body>
</html>