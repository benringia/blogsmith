<?php 
//CATCH CHECKBOX ARRAY

if(isset($_POST['checkBoxArray'])) {
    $checkbox = $_POST['checkBoxArray'];

    foreach($checkbox as $checkboxPostId) {
         $bulk_options = $_POST['bulk_options'];

         switch($bulk_options) {
            case 'PUBLISHED':
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkboxPostId ";
                $update_to_published_status = mysqli_query($dbConnect,$query);
            break;

            case 'DRAFT':
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkboxPostId ";
                $update_to_draft_status = mysqli_query($dbConnect,$query);
            break;

            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$checkboxPostId} ";
                $delete_post = mysqli_query($dbConnect,$query);
            break;

         }
    }
}

?>
<form action="" method="post">

    <table class="table table-bordered table-hover">

    <div id="bulkOptionsContainer" class="col-xs-4" style="margin-bottom: 10px; padding: 0;">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="PUBLISHED">Publish</option>
            <option value="DRAFT">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>

        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th colspan="3" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            $query = "SELECT * FROM posts";
            $selectPosts = mysqli_query($dbConnect,$query);

            while($row = mysqli_fetch_assoc($selectPosts)) {
                $postId = $row['post_id'];
                $postTitle = $row['post_title'];
                $postAuthor = $row['post_author'];
                $postDate = $row['post_date'];
                $postImage = $row['post_image'];
                $postTags = $row['post_tags'];
                $postStatus = $row['post_status'];
                $postComments = $row['post_comment_count'];
                $postCategoryId = $row['post_category_id'];

                echo "<tr>";
                ?>
                <td><input type='checkbox' class='checkBoxes' id='selectAllBoxes' name='checkBoxArray[]' value='<?php echo $postId?>'></td>

                <?php

                echo "<td>{$postId}</td>";
                echo "<td>{$postAuthor}</td>";
                echo "<td>{$postTitle}</td>";

                $query = "SELECT * FROM categories WHERE cat_id = $postCategoryId";
                $selectCategoriesId = mysqli_query($dbConnect, $query);

                while($row = mysqli_fetch_assoc($selectCategoriesId)) {
                    $catId =  $row['cat_id'];
                    $catTitle =  $row['cat_title'];
                }

                echo "<td>{$catTitle}</td>";
                echo "<td>{$postStatus}</td>";
                echo "<td><img width='80' src='images/{$postImage}'></td>";
                echo "<td>{$postTags}</td>";
                echo "<td>{$postComments}</td>";
                echo "<td>{$postDate}</td>";
                echo "<td><a href='../post.php?p_id={$postId}'>View</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$postId}'>Edit</a></td>";
                echo "<td><a href='posts.php?delete={$postId}'>Delete</a></td>";
                echo "</tr>";
            }
            
            
            ?>

            <?php 
                if(isset($_GET['delete'])) {
                    $post_id = $_GET['delete'];

                    $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
                    $deleteQuery = mysqli_query($dbConnect, $query);
                    header("Location: posts.php");
                    }
            ?>
            
        </tbody>
    </table>
</form>
