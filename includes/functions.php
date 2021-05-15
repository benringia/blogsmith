<?php 
     
     function send_query($database_connection,$database_query) {
         global $dbConnect;
        return mysqli_query($database_connection,$database_query);
    };

 
function escape($string) {
    global $dbConnect;
    return mysqli_real_escape_string($dbConnect, trim($string));
}


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

 ?>