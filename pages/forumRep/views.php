<?php session_start();
include '../sqlCommands/connectDb.php'; ?>


<?php
                    
        $r = "SELECT * FROM posts ORDER BY id DESC";
        $result = mysqli_query($sql, $r);
        if (mysqli_num_rows($result) > 0) {
            
        ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/view.css">
    <title>view post</title>
</head>

<body>

    <section class="section first-section">
        <div class="container-fluid">
            <div class="masonry-blog clearfix">
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                <div class="left-side">
                    <div class="masonry-box post-media">
                        <img src="<?php if (file_exists("uploads/" . $row['img'])) { echo "uploads/" . $row['img']; } else { echo "uploads/" . $row['old_img']; } ?>"
                            alt="" class="img-fluid">
                        <div class="shadoweffect">
                            <div class="shadow-desc">
                                <div class="blog-meta">
                                    <span class="bg-aqua"><a href="">
                                            <?php
                                        $sql1 = "SELECT cat_name FROM categories WHERE id='{$row["cat_id"]}'";
                                        $result1 = mysqli_query($sql, $sql1);
                                        if (mysqli_num_rows($result1) > 0) {
                                            $cat_data = mysqli_fetch_assoc($result1);
                                            echo $cat_data['cat_name'];
                                        }
                                        ?>
                                        </a></span>
                                    <h4><a href="single.php?id=<?php echo $row["id"]; ?>"
                                            title="<?php echo $row["title"]; ?>"><?php echo $row["title"]; ?></a></h4>
                                    <small><a href="#"
                                            title="<?php echo $row["date"]; ?>"><?php echo $row["date"]; ?></a></small>
                                    <small><a href="#"
                                            title="<?php echo $row["view"]; ?>"><?php echo $row["view"]; ?></a></small>
                                </div><!-- end meta -->
                            </div><!-- end shadow-desc -->
                        </div><!-- end shadow -->
                    </div><!-- end post-media -->
                </div><!-- end left-side -->
                <?php } ?>
            </div><!-- end masonry -->
        </div>
    </section>



    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <script src="assets/js/login_validation.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>

<?php
        } ?>