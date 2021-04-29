<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Page
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                            
                        <?php 
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
                          
                        
                        ?>
                        <form action="categories.php" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                           <?php
                            if(isset($_GET['edit'])) {
                                $catId = $_GET['edit'];
                                include "includes/update_categories.php";
                            }
                           ?>
                        </div> <!--Add category form-->

                        <div class="col-xs-6">
                       
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
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
                                ?>

                                <?php  //DELETE QUERY
                                    if(isset($_GET['delete'])) {
                                        $getCatId = $_GET['delete'];

                                        $query = "DELETE FROM categories WHERE cat_id = {$getCatId} ";

                                        $deleteQuery = mysqli_query($dbConnect, $query);
                                        header("Location: categories.php"); // refreshes the page
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"?>