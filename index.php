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
                $posts_to_display = 5;        
                $published_posts_count = ceil($published_posts_count / $posts_to_display);
                
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    $page_start = $posts_to_display * ($page - 1);
                } else {
                    $page_start = 0;
                }
                                
            ?>
            
                <h1 class="page-header">
                        User Posts
                        <small></small>
                    </h1>
                <?php 
                    //POST COUNT QUERY
                    $count_post_query = "SELECT * FROM posts ";
                    $post_count_result = mysqli_query($dbConnect, $count_post_query);
                    $count_result = mysqli_num_rows($post_count_result);
                    
                    $count_result = ceil($count_result / 5);

                    //POST DISPLAYED QUERY
                    $query = "SELECT * FROM posts WHERE post_status='PUBLISHED' LIMIT $page_start, $posts_to_display";

                    $allPostsQuery = mysqli_query($dbConnect, $query);

                    while($row = mysqli_fetch_assoc($allPostsQuery)) {
                        $postId =  $row['post_id'];
                        $postTitle =  $row['post_title'];
                        $postAuthor =  $row['post_user'];
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
                    <!-- <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li> -->
                    <?php

                if($page != 1){
                    $prev_page = $page - 1;
                    echo "<li><a href='index.php?page={$prev_page}'>PREV</a></li>";
                }
                
                for($i = 1; $i <= $count ; $i++){
                    if($i == $page || ($i == 1 && $page == 1)){
                    echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                    } else {
                        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                    }
                }

                if($page != $count){
                    $next_page = $page + 1;
                    echo "<li><a href='index.php?page={$next_page}'>NEXT</a></li>";
                    }
            ?>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php';?>

        </div>
        <!-- /.row -->

        <hr>
        <?php include 'includes/footer.php';?>
        