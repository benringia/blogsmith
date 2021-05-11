<?php 

function count_online_users()
{
 
    if (isset($_GET['onlineusers'])) {
 
        global $dbConnect;
        session_start();
 
        if (!$dbConnect) {
 
            // include '../includes/db.php';
            require_once('../../includes/db.php');
        }
        $session = session_id();
        $time = time();
        $time_out_sec = 60;
        $time_out = $time - $time_out_sec;
 
        $query = "SELECT * FROM users_online WHERE session = '$session' ";
        $send = mysqli_query($dbConnect, $query);
        $count = mysqli_num_rows($send);
 
        if ($count == NULL) {
            mysqli_query($dbConnect, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
        } else {
            mysqli_query($dbConnect, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }
 
        $users_online_query = mysqli_query($dbConnect, "SELECT * FROM users_online WHERE time > '$time_out' ");
 
        echo $count_user = mysqli_num_rows($users_online_query);
    }
}
   
    count_online_users();

    

    function checkQuery($result) {
        global $dbConnect;
        if(!$result) {
            die("Error : " . mysqli_error($dbConnect));
           }
    }

    function send_query($database_connection, $database_query) {
        global $dbConnect;
        return mysqli_query($database_connection, $database_query);
    }

    function insertCategory() {
        global $dbConnect;
        if(isset($_POST['submit'])) {
            $catTitle = $_POST['cat_title'];

            if($catTitle == "" || empty($catTitle)) {
                echo " Empty";
            } else {
                $query = "INSERT INTO categories(cat_title) VALUE ('{$catTitle}') ";
                $createCategoryQuery = mysqli_query($dbConnect, $query);

                if(!$createCategoryQuery) {
                    die('Error : ' . mysqli_error($dbConnect));
                }
            }
        }
      
    }

    function findAllCategories() {
        global $dbConnect;

        //FIND ALL CATEGORIES QUERY
        $query = "SELECT * FROM categories";
        $selectCategories = mysqli_query($dbConnect, $query);


           while($row = mysqli_fetch_assoc($selectCategories)) {
           $catId =  $row['cat_id'];
           $catTitle =  $row['cat_title'];
               
           echo "<tr>";
           echo "<td>{$catId}</td>";
           echo "<td>{$catTitle}</td>";
           echo "<td><a href='categories.php?delete={$catId}'>Delete</a></td>";
           echo "<td><a href='categories.php?edit={$catId}'>Edit</a></td>";
           echo "</tr>";
       }
    }

    function deleteCategory() {
        global $dbConnect;
        if(isset($_GET['delete'])) {
            $getCatId = $_GET['delete'];

            $query = "DELETE FROM categories WHERE cat_id = {$getCatId} ";

            $deleteQuery = mysqli_query($dbConnect, $query);
            header("Location: categories.php"); // refreshes the page
        }
    }
    function checkUserRole() {
        global $dbConnect;
        if(!isset($_SESSION['role'])) {
        
            header("Location: ../index.php");
            
        } 
    }

    


?>