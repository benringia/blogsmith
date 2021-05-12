<?php 
    if(isset($_POST['create_post'])) {
       $postTitle = $_POST['title'];
       $post_user = $_POST['post_user'];
       $postCategoryId = $_POST['post_category'];
       $postStatus = $_POST['post_status'];

       $postImage = $_FILES['image']['name'];
       $postImageTemp = $_FILES['image']['tmp_name'];

       $postTags = $_POST['post_tags'];
       $postContent = $_POST['post_content'];
       $postDate = date('d-m-y');
    //    $post_comment_count = 4;


      
        //move uploaded images to location
       move_uploaded_file($postImageTemp, "images/$postImage");
        
       $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date,post_image,post_content,post_tags,post_status) ";
       $query .= "VALUES({$postCategoryId},'{$postTitle}','{$post_user}',now(),'{$postImage}','{$postContent}','{$postTags}','{$postStatus}') ";

       $createPostQuery = mysqli_query($dbConnect, $query);

       checkQuery($createPostQuery);

       $getId = mysqli_insert_id($dbConnect);
       echo "<p class='bg-success font-weight-bold'>Post Created <br><a class='' href='../post.php?p_id=$getId'>View Changes</a> or <a class='' href='posts.php'>Edit More Post</a></p>";
    }
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

   
    <div class="form-group">
        <label for="post_category_id">Post Category</label><br>
       <select class="form-control form-control-sm" name="post_category" id="">
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

    <div class="form-group">
        <label for="users">Users</label><br>
       <select class="form-control form-control-sm" name="post_user" id="">
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

    <!-- <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div> -->

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select class="form-control form-control-sm" name="post_status" id="">
            <option value="draft">Select Options</option>
            <option value="PUBLISHED">PUBLISHED</option>
            <option value="DRAFT">DRAFT</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control"  name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="body" class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>

 <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>