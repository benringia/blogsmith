<?php 
//CATCH CHECKBOX ARRAY
include('delete_modal.php');
if(isset($_POST['checkBoxArray'])) {
    $checkbox = $_POST['checkBoxArray'];

    foreach($checkbox as $checkboxPostId) {
         $bulk_options = escape($_POST['bulk_options']);

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

            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$checkboxPostId} ";
                $select_post_query = mysqli_query($dbConnect,$query);

                while($row = mysqli_fetch_array($select_post_query)) {
                    $postTitle = escape($row['post_title']);
                    $postCategoryId = escape($row['post_category_id']);
                    $postDate = escape($row['post_date']);
                    $postAuthor = escape($row['post_author']);
                    $post_user = escape($row['post_user']);
                    $postStatus = escape($row['post_status']);
                    $postImage = escape($row['post_image']);
                    $postTags = escape($row['post_tags']);
                    $postContent = escape($row['post_content']);
                }

                $query = "INSERT INTO posts(post_title, post_category_id, post_date, post_user, post_status, post_image, post_tags, post_content) ";
                $query .= "VALUES('$postTitle', $postCategoryId, now(), '$post_user', '$postStatus', '$postImage', '$postTags', '$postContent') ";
                $copy_query = mysqli_query($dbConnect, $query);

                if(!$copy_query) {
                    die("ERROR : " . mysqli_error($dbConnect));
                }
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
            <option value="clone">Clone</option>
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
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Views</th>
                <th colspan="3" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            $query = "SELECT * FROM posts ORDER BY post_id DESC ";
            $selectPosts = mysqli_query($dbConnect,$query);

            while($row = mysqli_fetch_assoc($selectPosts)) {
                $postId = $row['post_id'];
                $postTitle = $row['post_title'];
                $postAuthor = $row['post_author'];
                $post_user = $row['post_user'];
                $postDate = $row['post_date'];
                $postImage = $row['post_image'];
                $postTags = $row['post_tags'];
                $postStatus = $row['post_status'];
                $postComments = $row['post_comment_count'];
                $postCategoryId = $row['post_category_id'];
                $postViewCount = $row['post_view_count'];

                echo "<tr>";
                ?>
                <td><input type='checkbox' class='checkBoxes' id='selectAllBoxes' name='checkBoxArray[]' value='<?php echo $postId?>'></td>

                <?php

                echo "<td>{$postId}</td>";

                if(!empty($postAuthor)) {
                    echo "<td>{$postAuthor}</td>";
                } elseif(!empty($post_user)) {
                    echo "<td>{$post_user}</td>";
                }
                
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


                //comment count
                $query = "SELECT * FROM comments WHERE comment_post_id = $postId";
                $send_comment_query = mysqli_query($dbConnect,$query);
                $row = mysqli_fetch_array($send_comment_query);
                $comment_id = $row['comment_id'];
                $count_comments = mysqli_num_rows($send_comment_query);


                echo "<td><a href='post_comments.php?id=$postId'>{$count_comments}</a></td>";
                echo "<td>{$postDate}</td>";
                echo "<td><a href='posts.php?reset={$postId}'>{$postViewCount}</a></td>";
                echo "<td><a href='../post.php?p_id={$postId}'>View</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$postId}'>Edit</a></td>";
                echo "<td><a rel='$postId' href='javascript:void(0)' class='delete-link' >Delete</a></td>";
                // echo "<td><a onClick=\"javascript: return confirm('Delete Item?'); \" href='posts.php?delete={$postId}'>Delete</a></td>";
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

                if(isset($_GET['reset'])) {
                    
                    $post_id = mysqli_real_escape_string($dbConnect,$_GET['reset']);
                    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = $post_id ";
                    $resetQuery = mysqli_query($dbConnect, $query);
                    if(!$resetQuery) {
                        die("ERROR : " . mysqli_error($dbConnect));
                    }
                    header("Location: posts.php");
                    }
            ?>
            
        </tbody>
    </table>
</form>

<script>
    $(document).ready(function() {
        $(".delete-link").on('click', function() {
            let id = $(this).attr("rel");
            let deleteUrl = "posts.php?delete=" + id + " ";

            $(".modal-delete-link").attr("href",deleteUrl);
            $("#myModal").modal('show');
        })
    })
</script>