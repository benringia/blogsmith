<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Author</th>
            <th>Comments</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th colspan="3" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $query = "SELECT * FROM comments";
        $selectComments = mysqli_query($dbConnect,$query);

        while($row = mysqli_fetch_assoc($selectComments)) {
            $commentId = $row['comment_id'];
            $commentAuthor = $row['comment_author'];
            $commentDate = $row['comment_date'];
            $commentPostId = $row['comment_post_id'];
            $commentEmail = $row['comment_email'];
            $commentStatus = $row['comment_status'];
            $commentContent = $row['comment_content'];

            echo "<tr>";
            echo "<td>{$commentId}</td>";
            echo "<td>{$commentAuthor}</td>";
            echo "<td>{$commentContent}</td>";

            // $query = "SELECT * FROM categories WHERE cat_id = $postCategoryId";
            // $selectCategoriesId = mysqli_query($dbConnect, $query);

            // while($row = mysqli_fetch_assoc($selectCategoriesId)) {
            //     $catId =  $row['cat_id'];
            //     $catTitle =  $row['cat_title'];
            // }

            echo "<td>{$commentEmail}</td>";
            echo "<td>{$commentStatus}</td>";

            $query = "SELECT * FROM posts WHERE post_id = $commentPostId ";
            $selectPostIdQuery = mysqli_query($dbConnect,$query);
            
            while($row = mysqli_fetch_assoc($selectPostIdQuery)) {
                $postId = $row['post_id'];
                $postTitle = $row['post_title'];
                echo "<td><a href='../post.php?p_id=$postId'>$postTitle</a></td>";
            }
            echo "<td>{$commentDate}</td>";
            echo "<td><a href='comments.php?approve={$commentId}'>Approve</a></td>";
            echo "<td><a href='comments.php?deny={$commentId}'>Deny</a></td>";
            echo "<td><a href='comments.php?delete={$commentId}'>Delete</a></td>";
            echo "</tr>";
        }
        
        
        ?>

        <?php 
            if(isset($_GET['approve'])) {
                $commentId = $_GET['approve'];

                $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$commentId} ";
                $approveCommentQuery = mysqli_query($dbConnect, $query);
                header("Location: comments.php");
            }


                //DENY COMMENT QUERY
                if(isset($_GET['deny'])) {
                    $commentId = $_GET['deny'];

                    $query = "UPDATE comments SET comment_status = 'Denied' WHERE comment_id = {$commentId}";
                    $denyCommentQuery = mysqli_query($dbConnect, $query);
                    header("Location: comments.php");
                }


                //Delete comment query
                if(isset($_GET['delete'])) {
                    $commentId = $_GET['delete'];

                    $query = "DELETE FROM comments WHERE comment_id = {$commentId} ";
                    $deleteQuery = mysqli_query($dbConnect, $query);
                    header("Location: comments.php");
                }
        ?>
        
    </tbody>
</table>