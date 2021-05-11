
<?php 
    

    if(isset($_GET['edit_user'])) {
          $userId = $_GET['edit_user'];

         $query = "SELECT * FROM users WHERE user_id = $userId ";
         $selectUsersQuery = mysqli_query($dbConnect,$query);
        

         while($row = mysqli_fetch_assoc($selectUsersQuery)) {
             $userId = $row['user_id'];
            $userName = $row['username'];
             $userPassword = $row['user_password'];
             $userFirstname = $row['user_firstname'];
             $userLastname = $row['user_lastname'];
             $userEmail = $row['user_email'];
             $userImage = $row['user_image'];
             $userRole = $row['user_role'];
         }

    }


        if(isset($_POST['edit_user'])) {
            $userFirstname = $_POST['user_firstname'];
            $userLastname = $_POST['user_lastname'];
            $userRole = $_POST['user_role'];

            //    $postImage = $_FILES['image']['name'];
            //    $postImageTemp = $_FILES['image']['tmp_name'];

            $userName = $_POST['username'];
            $userEmail = $_POST['user_email'];
            $userPassword = $_POST['user_password'];
        
            
            if(!empty($userPassword)) {
                $query_password = "SELECT user_password FROM users WHERE user_id = $userId";
                $get_user = mysqli_query($dbConnect,$query_password);
                checkQuery($get_user);

                $row = mysqli_fetch_array($get_user);
                $db_user_password = $row['user_password'];

                if($db_user_password != $userPassword) {
                    $hashed_password = password_hash($userPassword, PASSWORD_BCRYPT,['cost => 12']);
                }

                $query = "UPDATE users SET ";
                $query .="user_firstname = '{$userFirstname}', ";
                $query .="user_lastname = '{$userLastname}', ";
                $query .="username = '{$userName}', ";
                $query .="user_role = '{$userRole}', ";
                $query .="user_email = '{$userEmail}', ";
                $query .="user_password = '{$hashed_password}' ";
                $query .="WHERE user_id = {$userId} ";
    
                $editUserQuery = mysqli_query($dbConnect,$query);
            }
          }

    


?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" value="<?php echo $userFirstname ?>" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" value="<?php echo $userLastname ?>" class="form-control" name="user_lastname">
    </div>

   
    <div class="form-group">
        <label for="post_category_id">Role: </label><br>
       <select class="form-select form-select-lg mb-3" name="user_role" id="">
        <option value="<?php echo $userRole ?>"><?php echo $userRole ?></option>
           <?php 
            if($userRole == 'admin') {
                echo "<option value='subscriber'>subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }
           
           ?>
       </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $userName ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_status">Email</label>
        <input type="email" value="<?php echo $userEmail ?>" class="form-control" name="user_email">
    </div>
<!-- 
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="user-password">Password</label>
        <input autocomplete="off" type="password" value="<?php //echo $userPassword ?>" class="form-control"  name="user_password">
    </div>


 <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>
</form>