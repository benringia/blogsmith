<?php 

    function checkQuery($result) {
        global $dbConnect;
        if(!$result) {
            die("Error : " . mysqli_error($dbConnect));
           }
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

?>