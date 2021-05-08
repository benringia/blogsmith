<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php 
     function send_query($database_connection,$database_query) {
        return mysqli_query($database_connection,$database_query);
    };
 ?>

<?php 
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email    = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($email) && !empty($password )) {
            $query = "SELECT randSalt FROM users ";
            $select_random_salt = send_query($dbConnect,$query);
    
            $row = mysqli_fetch_array($select_random_salt); 
            $salt = $row['randSalt'];
    
            $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
            $query .= "VALUES('$username','$email','$password','subscriber' )";
            $register_new_user = send_query($dbConnect,$query);
    
            if(! $register_new_user) {
                die("ERROR: " . mysqli_error($dbConnect) );
            }
            $message = "Registration Successful!";
        } else {
            $message = "Fields cannot be empty";
        }

        $username = mysqli_real_escape_string($dbConnect, $username);
        $email    = mysqli_real_escape_string($dbConnect, $email);
        $password = mysqli_real_escape_string($dbConnect, $password);
    } else {
        $message='';
    }

?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
