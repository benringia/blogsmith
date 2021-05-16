<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php session_start(); ?>


<?php 
    if(isset($_POST['submit'])) {
        $username = trim(escape($_POST['username']));
        $email    = trim(escape($_POST['email']));
        $password = trim(escape($_POST['password']));

        $err = [
            'username' => '',
            'email' => '',
            'password' => ''
        ];
        // if(strlen($username) < 5) {
        //     $err['username'] = 'Username must be atleast 5 characters';
        // }
        //USERNAME VALIDATIONS
        strlen($username) < 4 ? : $err['username'] = 'Username must be atleast 5 characters';
        
        $username =='' ? : $err['username'] = 'Username cannot be empty';
       
        username_check($username) ? : $err['username'] = 'Username already exist';

        //EMAIL VALIDATIONS
        $email =='' ? : $err['email'] = 'Email cannot be empty';
       
        email_check($email) ? : $err['email'] = 'Email already exist, <a href="index.php">Login?</a>';

        //PASSWORD VALIDATION
        
        $password =='' ? : $err['password'] = 'Password cannot be empty';

        foreach($err as $key => $value) {
            if(empty($value)) {
                // register_user($username, $email, $password);

                // login_user($username, $password);
            }
        }

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
                <h1 style="margin-bottom: 30px">Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        
                        
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
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-info btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
