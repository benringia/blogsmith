<?php 
    if(isset($_POST['create_post'])) {
       $postTitle = $_POST['title'];
       $postAuthor = $_POST['author'];
       $postCategoryId = $_POST['post_category_id'];
       $postStatus = $_POST['post_status'];

       $postImage = $_FILES['image']['name'];
       $postImageTemp = $_FILES['image']['tmp_name'];

       $postTags = $_POST['post_tags'];
       $postContent = $_POST['post_content'];
       $postDate = date('d-m-y');
       $post_comment_count = 4;


      
        //move uploaded images to location
       move_uploaded_file($postImageTemp, "images/$postImage");
      
    }
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category ID</label>
        <input type="text" class="form-control" name="post_category_id">
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
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
        <textarea class="form-control" name="post-content" id="" cols="30" rows="10"></textarea>
    </div>

 <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>