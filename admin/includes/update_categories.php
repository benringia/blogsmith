<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Update Category</label>

        <?php //EDIT CATEGORY QUERY
            
            if(isset($_GET['edit'])) {
                $catId = escape($_GET['edit']);
                $query = "SELECT * FROM categories WHERE cat_id = $catId";
                $selectCategoriesId = mysqli_query($dbConnect, $query);

            while($row = mysqli_fetch_assoc($selectCategoriesId)) {
                $catId =  $row['cat_id'];
                $catTitle =  $row['cat_title'];
                ?>
                <input value="<?php if(isset($catTitle)) {echo $catTitle;}?>" type="text" class="form-control" name="cat_title">
            <?php 
                } 
            }
            ?>

            <?php //UPDATE CATEGORY QUERY
                if(isset($_POST['update_category'])) {
                $catTitle = escape($_POST['cat_title']);

                $stmt = mysqli_prepare($dbConnect, "UPDATE categories SET cat_title = ? WHERE cat_id = ?");

                $stmt -> bind_param("si", $catTitle, $catId);

                $stmt -> execute();

                if(!$stmt) {
                    die("ERROR : " . mysqli_error($dbConnect));
                }

                $stmt->close();
                redirect("categories.php");
            }
            ?>
        
        <!-- <input type="text" class="form-control" name="cat_title"> -->
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>