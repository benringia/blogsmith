<?php 

function redirect($location) {
    return header("Location:" . $location);
}

function escape($string) {
    global $dbConnect;
    return mysqli_real_escape_string($dbConnect, trim($string));
}

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
           echo "<td class='text-center'><a class='btn btn-success' href='categories.php?edit={$catId}'><i class='fa fa-pencil'></i>&nbsp;Edit</a></td>";
           echo "<td class='text-center'><a class='btn btn-danger' href='categories.php?delete={$catId}'><i class='fa fa-trash'></i>&nbsp;Delete</a></td>";
          
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


    function recordCount($table) {
        global $dbConnect;
        $query = "SELECT * FROM " . $table;
        $selectAllPost = mysqli_query($dbConnect, $query);
        return  mysqli_num_rows($selectAllPost);
    }

   
    function changeStatus($table, $column, $status) {
        global $dbConnect;
        $query = "SELECT * FROM $table WHERE $column = '$status' ";
        $result = mysqli_query($dbConnect, $query);
        return mysqli_num_rows($result); 
    }

    function checkRole($table, $column, $role) {
        global $dbConnect;
        $query = "SELECT * FROM $table WHERE $column = '$role' ";
        $result = mysqli_query($dbConnect, $query);
        return mysqli_num_rows($result);
    }

    function is_admin($username) {
        global $dbConnect;
        $query = "SELECT user_role FROM users WHERE username = '$username' ";
        $res = mysqli_query($dbConnect,$query);
        checkQuery($res);

        $row = mysqli_fetch_array($res);
        if($row['user_role'] == 'admin') {
            return true;
        } else {
            return false;
        }

    };

    
 


