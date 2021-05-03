<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <!-- <th>Date</th> -->
            <th colspan="3" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $query = "SELECT * FROM users ";
        $selectUsers = mysqli_query($dbConnect,$query);

        while($row = mysqli_fetch_assoc($selectUsers)) {
            $userId = $row['user_id'];
            $userName = $row['username'];
            $userPassword = $row['user_password'];
            $userFirstname = $row['user_firstname'];
            $userLastname = $row['user_lastname'];
            $userEmail = $row['user_email'];
            $userImage = $row['user_image'];
            $userRole = $row['user_role'];

            echo "<tr>";
            echo "<td>{$userId}</td>";
            echo "<td>{$userName}</td>";
            echo "<td>{$userFirstname}</td>";

            // $query = "SELECT * FROM categories WHERE cat_id = $postCategoryId";
            // $selectCategoriesId = mysqli_query($dbConnect, $query);

            // while($row = mysqli_fetch_assoc($selectCategoriesId)) {
            //     $catId =  $row['cat_id'];
            //     $catTitle =  $row['cat_title'];
            // }

            echo "<td>{$userLastname}</td>";
            echo "<td>{$userEmail}</td>";
            echo "<td>{$userRole}</td>";
            // echo "<td>{$userDate}</td>";

            // $query = "SELECT * FROM posts WHERE post_id = $commentPostId ";
            // $selectPostIdQuery = mysqli_query($dbConnect,$query);
            
            // while($row = mysqli_fetch_assoc($selectPostIdQuery)) {
            //     $postId = $row['post_id'];
            //     $postTitle = $row['post_title'];
            //     echo "<td><a href='../post.php?p_id=$postId'>$postTitle</a></td>";
            // }
            
            echo "<td><a href='comments.php?approve={$commentId}'>Approve</a></td>";
            echo "<td><a href='comments.php?deny={$commentId}'>Deny</a></td>";
            echo "<td><a href='users.php?delete={$userId}'>Delete</a></td>";
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
                    $userId = $_GET['delete'];

                    $query = "DELETE FROM users WHERE user_id = {$userId} ";
                    $deleteUserQuery = mysqli_query($dbConnect, $query);
                    header("Location: users.php");
                }
        ?>
        
    </tbody>
</table>