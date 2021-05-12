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

                        $set_query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = $postId ";
                        $send_query = mysqli_query($dbConnect, $set_query);
                        
                        if(!$send_query) {
                            die("ERROR : " . mysqli_error($dbConnect));
                        }
                    

                        $query = "SELECT * FROM posts WHERE post_id = $postId ";

                        $allPostsQuery = mysqli_query($dbConnect, $query);

                        while($row = mysqli_fetch_assoc($allPostsQuery)) {
                        $postTitle =  $row['post_title'];
                        $postAuthor =  $row['post_user'];
                        $postDate =  $row['post_date'];
                        $postImage =  $row['post_image'];
                        $postContent =  $row['post_content'];

                        ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
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
                <?php } } else {
                        header("Location: index.php"); 
                     } 
                    ?>

                <?php
                    if(isset($_POST['create_comment'])) {
                        $commentAuthor = $_POST['comment_author'];
                        $commentEmail = $_POST['comment_email'];
                        $commentContent = $_POST['comment_content'];


                        //VALIDATE IF FIELDS ARE EMPTY
                        if(!empty($commentAuthor) && !empty($commentEmail) && !empty($commentContent) ) {
                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                            $query .= "VALUES ($postId, '$commentAuthor', '$commentEmail', '$commentContent', 'Denied', now()) ";
                           
                            $createCommentQuery = mysqli_query($dbConnect, $query);
    
                            // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $postId ";
                            // $updateCommentCount = mysqli_query($dbConnect, $query);
                        } else {
                            echo '<script>alert("Fields Cannot Be Empty")</script>';
                        }
                    }
                ?>
                <!-- comments Form -->
                        <div class="well">
                            <h4>Leave a Comment:</h4>
                            <form action="" method="post">

                                <div class="form-group">
                                    <label for="comment_author">Name</label>
                                    <input type="text" class="form-control" name="comment_author" placeholder="Enter your Name">
                                </div>
                                <div class="form-group">
                                    <label for="comment_email">Email</label>
                                    <input type="email" class="form-control" name="comment_email" placeholder="Enter your Email">
                                </div>
                                <div class="form-group"><label for="comment_content">Your Comment: </label>
                                    <textarea class="form-control" name="comment_content" id="" cols="30" rows="10"></textarea>
                                </div>
                                <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                <!-- Posted Comments -->


                <?php 
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$postId} ";
                    $query .= "AND comment_status = 'Approved' ";
                    $query .= "ORDER BY comment_id DESC ";

                    $selectCommentQuery = mysqli_query($dbConnect,$query);
                    
                    while($row = mysqli_fetch_assoc($selectCommentQuery)) {
                        $commentDate = $row['comment_date'];
                        $commentContent = $row['comment_content'];
                        $commentAuthor = $row['comment_author'];
                    ?>
                      <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $commentAuthor ?>
                                <small><?php echo $commentDate ?></small>
                            </h4>
                            <?php echo $commentContent ?>
                        </div>
                    </div>
                        
                   <?php } ?>
              


    
               

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
        