<?php 
    if(isset($_POST['create_user'])) {
       $userId = escape($_POST['user_id']);
        $userFirstname = escape($_POST['user_firstname']);
       $userLastname = escape($_POST['user_lastname']);
       $userRole = escape($_POST['user_role']);

       $userName = escape($_POST['username']);
       $userEmail = escape($_POST['user_email']);
       $userPassword = escape($_POST['user_password']);

       $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 10));
    
        
       $query = "INSERT INTO users(user_firstname, user_lastname, user_role,username,user_email,user_password) ";
       $query .= "VALUES('{$userFirstname}','{$userLastname}','{$userRole}','{$userName}','{$userEmail}','{$userPassword}') ";

       $createUserQuery = mysqli_query($dbConnect, $query);

       checkQuery($createUserQuery);

       echo "User Created: ". " " ."<a href='users.php'>View user</a>";
     
    }
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

   
    <div class="form-group">
        <label for="post_category_id">Role: </label><br>
       <select class="form-select form-select-lg mb-3" name="user_role" id="">
        <option value="subscriber">Select Options:</option>
          <option value="admin">admin</option>
          <option value="subscriber">subscriber</option>
       </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_status">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
<!-- 
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="user-password">Password</label>
        <input type="password" class="form-control"  name="user_password">
    </div>


 <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>