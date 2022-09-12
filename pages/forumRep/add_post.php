<?php

session_start();
include '../sqlCommands/connectDb.php';

$msg = "";

error_reporting(0);

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $cat_id = $_POST['category'];

    $img_name = rand() . $_FILES['img']['name'];
    $img_tmp_name = $_FILES['img']['tmp_name'];
    $img_size = $_FILES['img']['size'];

    $email = $_SESSION['email'];
    
    $date = date("d M, Y");

    if ($img_size > 5242880) {
        $msg = "<div class='alert alert-danger'>Image is too big. Maximum image uploading size is 5 MB.</div>";
    } else {
        $r = "INSERT INTO posts (title, description, img, cat_id, date,f_email) VALUES ('$title', '$description', '$img_name', '$cat_id', '$date','$email')";
        $result = mysqli_query($sql, $r);
        if ($result) {
            move_uploaded_file($img_tmp_name, "uploads/" . $img_name);
            $msg = "<div class='alert alert-success'>Post added successful.</div>";
            $_POST['title'] = "";
            $_POST['description'] = "";
            $_POST['category'] = "";
        } else {
            $msg = "<div class='alert alert-danger'>Something wrong went. Please try again later.</div>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Add Post</title>
</head>

<body>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-8 col-12 mx-auto bg-white p-4 shadow">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Add Post</h1>

                <form action="" method="post" enctype="multipart/form-data">
                    <?php echo $msg; ?>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" value="<?php echo $_POST['title']; ?>" name="title"
                            id="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="5" id="description"
                            required><?php echo $_POST['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="category" required>
                            <option value="" selected hidden disabled>Select Category</option>
                            <?php

                        $r = "SELECT * FROM categories";
                        $result = mysqli_query($sql, $r);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        
                        ?>
                            <option <?php if ($_POST['category'] == $row['id']) { echo "selected"; } ?>
                                value="<?php echo $row['id']; ?>"><?php echo $row['cat_name']; ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="img">Image</label>
                        <input type="file" accept="image/*" class="form-control" name="img" id="img" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add Post</button>
                </form>
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