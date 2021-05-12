<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php';?>

<!-- Navigation -->
<?php include 'includes/navigation.php';?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 

                    if(isset($_GET['p_id'])) {
                        $postId = $_GET['p_id'];
                        $postAuthor = $_GET['author'];
                    }
                    // if(isset($_GET['author'])) {
                        
                    // }

                    $query = "SELECT * FROM posts WHERE post_user = '{$postAuthor}' ";

                    $allPostsQuery = mysqli_query($dbConnect, $query);

                    while($row = mysqli_fetch_assoc($allPostsQuery)) {
                       $postTitle =  $row['post_title'];
                       $postAuthor =  $row['post_user'];
                       $postDate =  $row['post_date'];
                       $postImage =  $row['post_image'];
                       $postContent =  $row['post_content'];

                       ?>

                <h1 class="page-header">
                    Posts By
                    <small><?php echo $postAuthor?></small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $postTitle ?></a>
                </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $postAuthor ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <i><?php echo $postDate ?></i></p>
                    <hr>
                    <img class="img-responsive" src="admin/images/<?php echo $postImage?>" alt="">
                    <hr>
                    <p><?php echo $postContent ?></p>

                <hr>
                <?php } ?>

                
                <!-- Posted Comments -->


              


    
               

                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php';?>

        </div>
        <!-- /.row -->

        <hr>
        <?php include 'includes/footer.php';?>
        