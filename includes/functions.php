<?php 
     
//      function send_query($database_connection,$database_query) {
//          global $dbConnect;
//         return mysqli_query($database_connection,$database_query);
//     };

 
// function escape($string) {
//     global $dbConnect;
//     return mysqli_real_escape_string($dbConnect, trim($string));
// }


function username_check($username) {
    global $dbConnect;
    
    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($dbConnect,$query);


    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
    
}

function email_check($email) {
    global $dbConnect;
    
    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";
    $result = mysqli_query($dbConnect,$query);


    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
    
}

function register_user($username, $email, $password) {
    global $dbConnect;

    $username = mysqli_real_escape_string($dbConnect, $username);
    $email    = mysqli_real_escape_string($dbConnect, $email);
    $password = mysqli_real_escape_string($dbConnect, $password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .= "VALUES('$username','$email','$password','subscriber' )";
    $register_new_user = send_query($dbConnect,$query);

    if(! $register_new_user) {
        die("ERROR: " . mysqli_error($dbConnect) );
    }
}



    function login_user($username,$password) {
        global $dbConnect;
        $username = trim($username);
        $password = trim($password);

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

         //converts salt to plain password
         // $password = crypt($password, $db_password);

         if(password_verify($password,$db_password)) {
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_firstname;
            $_SESSION['lastname'] = $db_lastname;
            $_SESSION['role'] = $db_userRole;

            header("Location: /blogsmith/admin");
            
         } else  {
            header("Location: ../index.php");
         }
    }


