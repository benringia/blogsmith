<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Author</th>
            <th>Comments</th>
            <th>Email</th>
            <th>Status</th>
            <th>Date</th>
            <th colspan="4" class="text-center">Actions</th>
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
            echo "<td>{$commentDate}</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$postId}'>Approve</a></td>";
            echo "<td><a href='posts.php?delete={$postId}'>Deny</a></td>";
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