<?php include 'db.php'; ?>

<?php 
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
         }
    }
?>