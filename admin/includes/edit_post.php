<?php 

    if(isset($_GET['p_id'])) {
        $getId = $_GET['p_id'];

    }
       $query = "SELECT * FROM posts WHERE post_id = $getId ";
       $selectPostsById = mysqli_query($dbConnect,$query);

       while($row = mysqli_fetch_assoc($selectPostsById)) {
           $postId = $row['post_id'];
           $postTitle = $row['post_title'];
           $post_user = $row['post_user'];
           $postDate = $row['post_date'];
           $postImage = $row['post_image'];
           $postTags = $row['post_tags'];
           $postStatus = $row['post_status'];
           $postComments = $row['post_comment_count'];
           $postCategoryId = $row['post_category_id'];
           $postContent= $row['post_content'];
       }

        if(isset($_POST['update_post'])) {
            $post_user = mysqli_real_escape_string($dbConnect,$_POST['post_user']);
            $postTitle  = mysqli_real_escape_string($dbConnect,$_POST['post_title']);
            $postCategoryId = $_POST['post_category'];
            $postStatus = $_POST['post_status'];
            $postImage = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
            $postContent = mysqli_real_escape_string($dbConnect,$_POST['post_content']);
            $postTags = $_POST['post_tags'];
            
            move_uploaded_file($post_image_temp, "images/$postImage");

            if(empty($postImage)) {
                $query = "SELECT * FROM posts WHERE post_id = $getId ";
                $selectImage = mysqli_query($dbConnect, $query);

                while($row = mysqli_fetch_array($selectImage)) {
                    $postImage = $row['post_image'];
                }
            }

            $query = "UPDATE posts SET ";
            $query .="post_title = '{$postTitle}', ";
            $query .="post_category_id = '{$postCategoryId}', ";
            $query .="post_date = now(), ";
            $query .="post_user = '{$post_user}', ";
            $query .="post_status = '{$postStatus}', ";
            $query .="post_tags = '{$postTags}', ";
            $query .="post_content = '{$postContent}', ";
            $query .="post_image = '{$postImage}' ";
            $query .="WHERE post_id = {$getId} ";

            $update_post = mysqli_query($dbConnect,$query);
            checkQuery($update_post);

            echo "<p class='bg-success font-weight-bold'>Post Updated. <br><a class='' href='./post.php?p_id=$getId'>View Changes</a> or <a class='' href='posts.php'>Edit More Post</a></p>";
        }

?>
<?php 

        // function check_post_status() {
        //     if($postStatus == 'PUBLISHED') {
        //         echo "<option value='DRAFT'>DRAFT</option>";
        //     } else { 
        //         echo "<option value='PUBLISHED'>PUBLISHED</option>"; 
        //         }
        // }
                
               
                    
                    ?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value ="<?php echo $postTitle?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category</label><br>
       <select name="post_category" id="" class="form-control form-control-sm">
           <?php 
             $query = "SELECT * FROM categories ";
             $selectCategories = mysqli_query($dbConnect, $query);
             checkQuery($selectCategories);

            while($row = mysqli_fetch_assoc($selectCategories)) {
                $catId =  $row['cat_id'];
                $catTitle =  $row['cat_title'];
                echo "<option value='$catId'>$catTitle</option>";
            } 
                
           ?>
       </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_user">Post Author</label>
        <input value ="<?php echo $post_user?>" type="text" class="form-control" name="post_user">
    </div> -->

    <div class="form-group">
        <label for="users">Users</label><br>
       <select class="form-control form-control-sm" name="post_user" id="">
           <?php  echo "<option value='$post_user'>$post_user</option>"; ?>
           <?php 

             $query = "SELECT * FROM users ";
             $select_users = mysqli_query($dbConnect, $query);
             checkQuery($select_users);

            while($row = mysqli_fetch_assoc($select_users)) {
                $user_id =  $row['user_id'];
                $username =  $row['username'];
                echo "<option value='$username'>$username</option>";
            } 
                
           ?>
       </select>
    </div>

        
        <div class="form-group">
            <label for="post_status">Post Status</label><br>
            <select class="form-control form-control-sm" name="post_status" id="">
                <option value='<?php $postStatus?>'><?php echo $postStatus?></option>
                <?php 
                      if($postStatus == 'PUBLISHED') {
                        echo "<option value='DRAFT'>DRAFT</option>";
                    } else { 
                        echo "<option value='PUBLISHED'>PUBLISHED</option>"; 
                        }
                ?>
            </select>
        </div>

 

    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img width=100 src="images/<?php echo $postImage?>" alt="">
        <input type="file" class="form-control-file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value ="<?php echo $postTags?>" type="text" class="form-control"  name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $postContent?></textarea>
    </div>

 <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
</form>