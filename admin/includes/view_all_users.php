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
            <th colspan="4" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $query = "SELECT * FROM users ";
        $selectUsers = mysqli_query($dbConnect,$query);

        while($row = mysqli_fetch_assoc($selectUsers)) {
            $userId = escape($row['user_id']);
            $userName = escape($row['username']);
            $userPassword = escape($row['user_password']);
            $userFirstname = escape($row['user_firstname']);
            $userLastname = escape($row['user_lastname']);
            $userEmail = escape($row['user_email']);
            $userImage = escape($row['user_image']);
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
            
            echo "<td class='text-center'><a class='btn btn-success' href='users.php?admin={$userId}'><i class='fa fa-user'></i>&nbsp;Admin</a></td>";
            echo "<td class='text-center'><a class='btn btn-primary' href='users.php?subscriber={$userId}'>Subscriber</a></td>";
            echo "<td class='text-center'><a class='btn btn-info' href='users.php?source=edit_user&edit_user={$userId}'><i class='fa fa-pencil'></i>&nbsp;Edit</a></td>";
            echo "<td class='text-center'><a class='btn btn-danger' href='users.php?delete={$userId}'><i class='fa fa-trash'></i>&nbsp;Delete</a></td>";
            echo "</tr>";
        }
        
        
        ?>

        <?php 
            if(isset($_GET['admin'])) {
                $userId = escape($_GET['admin']);

                $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$userId} ";
                $changeAdminQuery = mysqli_query($dbConnect, $query);
                header("Location: users.php");
            }


                //Change role QUERY
                if(isset($_GET['subscriber'])) {
                    $changeSubsQuery = escape($_GET['subscriber']);

                    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$userId} ";
                    $changeSubsQuery = mysqli_query($dbConnect, $query);
                    header("Location: users.php");
                }


                //Delete query
                if(isset($_GET['delete'])) {
                    
                    if(isset($_SESSION['role'])) {
                        if($_SESSION['role'] == 'admin') {
                            $userId = mysqli_real_escape_string($dbConnect,$_GET['delete']);

                            $query = "DELETE FROM users WHERE user_id = {$userId} ";
                            $deleteUserQuery = mysqli_query($dbConnect, $query);
                            header("Location: users.php");
                           
                        } 
                    }
                   
                }
        ?>
        
    </tbody>
</table>