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

                if(isset($_GET['category'])) {
                    $postCategoryId = $_GET['category'];

                    if(isset($_SESSION['username']) && is_admin($_SESSION['username'])){

                        $stmt1 = mysqli_prepare($dbConnect, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ?");
                       
                    } else {

                        $stmt2 = mysqli_prepare($dbConnect, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ");
                        
                        $published = 'published';
                    }
                
                    
                    if(isset($stmt1)) {

                        mysqli_stmt_bind_param($stmt1, "i", $postCategoryId);

                        mysqli_stmt_execute($stmt1);

                        mysqli_stmt_bind_result($stmt1, $postId, $postTitle, $postAuthor, $postDate, $postImage, $postContent);

                        $stmt1->store_result();

                        $stmt = $stmt1;

                    } else {

                        mysqli_stmt_bind_param($stmt2, "is", $postCategoryId, $published);

                        mysqli_stmt_execute($stmt2);

                        mysqli_stmt_bind_result($stmt2, $postId, $postTitle, $postAuthor, $postDate, $postImage, $postContent);

                        $stmt2->store_result();
                        $stmt = $stmt2;
                    }

                    
                    if(mysqli_stmt_num_rows($stmt) === 0) {
                        echo "<h1 class='text-center'>No Categories available</h1>";
                    } 
                    

                    while(mysqli_stmt_fetch($stmt)){
                       

                       ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $postId;?>"><?php echo $postTitle ?></a>
                </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $postAuthor ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <i><?php echo $postDate ?></i></p>
                    <hr>
                    <img class="img-responsive" src="admin/images/<?php echo $postImage?>" alt="">
                    <hr>
                    <p><?php echo $postContent ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php } } else {
                    header("Locations: index.php");
                }?>


    
               

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
        