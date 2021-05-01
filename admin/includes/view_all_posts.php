<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th colspan="2" class="text-center">Action</th>
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
            echo "<td>{$postId}</td>";
            echo "<td>{$postAuthor}</td>";
            echo "<td>{$postTitle}</td>";
            echo "<td>{$postCategoryId}</td>";
            echo "<td>{$postStatus}</td>";
            echo "<td><img width='80' src='images/{$postImage}'></td>";
            echo "<td>{$postTags}</td>";
            echo "<td>{$postComments}</td>";
            echo "<td>{$postDate}</td>";
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