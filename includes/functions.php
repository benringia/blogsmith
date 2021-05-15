<?php 
     
     function send_query($database_connection,$database_query) {
         global $dbConnect;
        return mysqli_query($database_connection,$database_query);
    };

 
 ?>