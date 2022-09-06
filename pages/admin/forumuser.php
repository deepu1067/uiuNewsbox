<?php
    session_start();
    include "../sqlCommands/connectDb.php";
    $q =  "SELECT * FROM `forumrep`;";
    $run = mysqli_query($sql, $q);
    $html = "";


    if(mysqli_num_rows($run)>0){
        while($row = $run->fetch_assoc()){
            $html = $html. "<tr><td>" 
                      . $row["id"] . 
                      "</td><td>" 
                      . $row["first_name"] . "</td><td>" 
                      . $row["last_name"] .   "</td><td>"
                      . $row["email"] .   "</td><td>"
                      . $row["phone_number"] .  "</td><td>"
                      . $row["passwords"] . 


                    //   "</td><td>". '<a class="btn btn-lg btn-block btn btn-info" href="5.php?id=' . $row["id"] .'"> Update</a>' 
                       "</td><td>". '<a class="btn btn-lg btn-block btn btn-danger" href="deleteforumuser.php?id=' . $row["id"] .'"> Delete</a>'.
                     "</td></tr>";
           
        }
    }  

?>
   </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#example').DataTable();
        } );
    </script>
    <script src="https://use.fontawesome.com/2c7ebecd35.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="d-flex justify-content-between align-items-center">
    <img src="../../assets/img/ForOrangeBg.png" alt="logo" class="img-fluid ">

    <h2 class="text-uppercase fw-bold"><?php echo "It is an ".$_SESSION['type'] ;?></h2>

    <div>
        <a href="../login/logout.php">logout</a>
    </div>
</nav>
<div>
    
<table>
        
        <thead>
            <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>password</th>
                        <th>Update</th>
                        <th>Delete</th>
                        
            </tr>
        </thead>
            
        <tbody>
                <?php
                echo  $html;
                ?>
            </tbody>
            
        
        </table>
</div>

<div>
<a type="button" class="btn btn-primary" href = "mainPage.php">Back</a>
</div>
</body>
</html>