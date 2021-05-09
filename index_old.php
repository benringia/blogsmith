<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php';?>

<!-- Navigation -->
<?php include 'includes/navigation.php';?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                        User Posts
                        <small></small>
                    </h1>
                <?php 
                    $query = "SELECT * FROM posts ";

                    $allPostsQuery = mysqli_query($dbConnect, $query);

                    while($row = mysqli_fetch_assoc($allPostsQuery)) {
                        $postId =  $row['post_id'];
                        $postTitle =  $row['post_title'];
                        $postAuthor =  $row['post_author'];
                        $postDate =  $row['post_date'];
                        $postImage =  $row['post_image'];
                        $postContent =  substr($row['post_content'],0,100); //for doing excerp
                        $postStatus = $row['post_status'];

                         if($postStatus == 'PUBLISHED') {
                           

                         
                       ?>

                

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $postId;?>"><?php echo $postTitle ?></a>
                </h2>
                    <p class="lead">
                        by <a href="author_post.php?author=<?php echo $postAuthor?>&p_id=<?php echo $postId;?>"><?php echo $postAuthor ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <i><?php echo $postDate ?></i></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $postId;?>"><img class="img-responsive" src="admin/images/<?php echo $postImage?>" alt=""></a>
                    
                    <hr>
                    <p><?php echo $postContent ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $postId;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php } }?>


    
               

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php';?>

        </div>
        <!-- /.row -->

        <hr>
        <?php include 'includes/footer.php';?>
        