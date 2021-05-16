<?php include "includes/admin_header.php" ?>

<?php 
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = '$username' ";

        $selectUserProfileQuery = mysqli_query($dbConnect, $query);
        

        while($row = mysqli_fetch_array($selectUserProfileQuery)) {
            $userId = $row['user_id'];
            $userName = $row['username'];
            $userPassword = $row['user_password'];
            $userFirstname = $row['user_firstname'];
            $userLastname = $row['user_lastname'];
            $userEmail = $row['user_email'];
            
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
    //    $postDate = date('d-m-y');


      
        //move uploaded images to location
    //    move_uploaded_file($postImageTemp, "images/$postImage");
        
        $query = "UPDATE users SET ";
        $query .="user_firstname = '{$userFirstname}', ";
        $query .="user_lastname = '{$userLastname}', ";
        $query .="username = '{$userName}', ";
        $query .="user_email = '{$userEmail}', ";
        $query .="user_password = '{$userPassword}' ";
        $query .="WHERE username = '{$username}' ";

        $editUserQuery = mysqli_query($dbConnect,$query);
        header("Location: users.php");
     
    }

    
    
?>
    <div id="wrapper">

        <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                       Edit Profile
                    </h1>


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
        <label for="username">Username</label>
        <input type="text" value="<?php echo $userName ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_status">Email</label>
        <input autocomplete="off" type="email" value="" class="form-control" name="user_email">
    </div>
<!-- 
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="user-password">Password</label>
        <input type="password" value="<?php //echo $userPassword ?>" class="form-control"  name="user_password">
    </div>


 <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
    </div>
</form>
                 
                  
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"?>