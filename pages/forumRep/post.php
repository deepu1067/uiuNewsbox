<?php
 session_start();
include '../sqlCommands/connectDb.php';
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
    <title>All Post</title>
</head>

<body>



    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Posts</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
            </div>
            <div class="card-body">
                <?php 
                
              
        
        if (isset($_REQUEST['remove_success'])) {
            if ($_REQUEST['remove_success'] == "true") {
                echo "<div class='alert alert-success'>Record deleted successful.</div>";
            } else {
                echo "<div class='alert alert-danger'>Record can't deleted.</div>";
            }
        }
        ?>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                    $email=$_SESSION['email'];

                    $r = "SELECT * FROM posts where f_email = '$email' ";
                    $result = mysqli_query($sql, $r);
                    if (mysqli_num_rows($result) > 0) {
                        $id = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                    
                    ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php
                        
                        $show_category = mysqli_query($sql, "SELECT * FROM categories WHERE id='{$row["cat_id"]}'");
                        if (mysqli_num_rows($show_category) > 0) {
                            $category_data = mysqli_fetch_assoc($show_category);
                            echo $category_data['cat_name'];
                        }
                        
                        ?></td>
                                <td>
                                    <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="delete_post.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i
                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php

                        $id++; }
                    }

                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->




    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <script src="assets/js/login_validation.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>