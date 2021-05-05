<?php include "includes/admin_header.php" ?>
<?php    
    $query = "SELECT * FROM posts ";
    $selectAllPost = mysqli_query($dbConnect, $query);
    $postCount = mysqli_num_rows($selectAllPost);
    
    $query = "SELECT * FROM comments ";
    $selectAllComments = mysqli_query($dbConnect, $query);
    $commentCount = mysqli_num_rows($selectAllComments);

    $query = "SELECT * FROM users ";
    $selectAllUsers = mysqli_query($dbConnect, $query);
    $userCount = mysqli_num_rows($selectAllUsers);

    $query = "SELECT * FROM categories ";
    $selectAllCategories = mysqli_query($dbConnect, $query);
    $categoryCount = mysqli_num_rows($selectAllCategories);
?>




    <div id="wrapper">
        <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>

                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>


                    </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $postCount?></div>
                                <div>Posts</div>
                            </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                        $query = "SELECT * FROM comments ";
                        $selectAllComments = mysqli_query($dbConnect, $query);
                        $commentCount = mysqli_num_rows($selectAllComments);
                    ?>
                     <div class='huge'><?php echo $commentCount?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $userCount ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $categoryCount?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

                <?php 
                 $query = "SELECT * FROM posts WHERE post_status = 'PUBLISHED'";
                 $selectAllPublishedPost = mysqli_query($dbConnect, $query);
                 $postPublishedCount = mysqli_num_rows($selectAllPublishedPost); 

                  $query = "SELECT * FROM posts WHERE post_status = 'DRAFT'";
                  $selectAllDraftPost = mysqli_query($dbConnect, $query);
                  $postDraftCount = mysqli_num_rows($selectAllDraftPost); 
                  
                  $query = "SELECT * FROM comments WHERE comment_status = 'Denied'";
                  $selectDeniedComments = mysqli_query($dbConnect, $query);
                  $deniedCommentCount = mysqli_num_rows($selectDeniedComments); 

                  $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                  $selectSubscribers = mysqli_query($dbConnect, $query);
                  $subscriberCount = mysqli_num_rows($selectSubscribers);
                ?>

                <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php 
                            $elementText = ['All Posts', 'Active Posts','Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Denied Users', 'Categories'];
                            $elementCount = [$postCount, $postPublishedCount, $postDraftCount, $commentCount, $deniedCommentCount, $userCount, $subscriberCount,  $categoryCount];

                            for($i = 0; $i < 8; $i++) {
                                echo "['$elementText[$i]'" . "," . "$elementCount[$i]],";
                            }
                        ?>

                        // ['Posts', 1000]
                       
                        ]);

                        var options = {
                        chart: {
                            title: 'Post Performance',
                            subtitle: 'Comments, Posts, and Users: 2021',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>

                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"?>