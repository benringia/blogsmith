<?php include 'db.php'; ?>

<?php 
    session_start();

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($dbConnect, $username);
        $password = mysqli_real_escape_string($dbConnect, $password);

        $query = "SELECT * FROM users WHERE username = '$username' ";
        $checkUsername = mysqli_query($dbConnect, $query);
         if(!$checkUsername) {
            die("Error : ". mysqli_error($dbConnect));
         }

         while($row = mysqli_fetch_array($checkUsername)) {
            $db_id = $row['user_id'];
            $db_username = $row['username'];
            $db_password = $row['user_password'];
            $db_firstname = $row['user_firstname'];
            $db_lastname = $row['user_lastname'];
            $db_userRole = $row['user_role'];
         }

         if($username !==  $db_username || $password !== $db_password) {
            header("Location: ../index.php");
         } else if ($username ==  $db_username && $password == $db_password) {
            header("Location: ../admin");

            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_firstname;
            $_SESSION['lastname'] = $db_lastname;
            $_SESSION['role'] = $db_userRole;
            
         }
    }
?>