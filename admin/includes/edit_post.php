<?php 

    if(isset($_GET['p_id'])) {
        $getId = $_GET['p_id'];

    }
       $query = "SELECT * FROM posts";
       $selectPostsById = mysqli_query($dbConnect,$query);

       while($row = mysqli_fetch_assoc($selectPostsById)) {
           $postId = $row['post_id'];
           $postTitle = $row['post_title'];
           $postAuthor = $row['post_author'];
           $postDate = $row['post_date'];
           $postImage = $row['post_image'];
           $postTags = $row['post_tags'];
           $postStatus = $row['post_status'];
           $postComments = $row['post_comment_count'];
           $postCategoryId = $row['post_category_id'];
           $postContent= $row['post_content'];
       }

?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value ="<?php echo $postTitle?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category ID</label>
       <select name="post_category" id="">
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
        <label for="post_author">Post Author</label>
        <input value ="<?php echo $postAuthor?>" type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value ="<?php echo $postStatus?>" type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img width=100 src="images/<?php echo $postImage?>" alt="">
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
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>