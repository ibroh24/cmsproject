<?php //session_start(); ?>
<?php include "includes/adminheader.php"; ?>
<?php require_once "../functions/myfunctions.php"; ?>

<?php
// for post
$postQuery = "SELECT * FROM posts";
$postResult = mysqli_query($dbConnect, $postQuery);
$postCount = mysqli_num_rows($postResult);

// for comment
$commentQuery = "SELECT * FROM comments";
$commentResult = mysqli_query($dbConnect, $commentQuery);
$commentCount = mysqli_num_rows($commentResult);

// for user
$userQuery = "SELECT * FROM users";
$userResult = mysqli_query($dbConnect, $userQuery);
$userCount = mysqli_num_rows($userResult);

// for categories
$catQuery = "SELECT * FROM categories";
$catResult = mysqli_query($dbConnect, $catQuery);
$catCount = mysqli_num_rows($catResult);




?>

                <!-- Top Menu Items -->
    
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    <li><a href="javascript:;" data-toggle="collapse" data-target="#post"><i class="fa fa-fw fa-arrows-v"></i> Posts<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="post" class="collapse">
                            <li>
                                <a href="viewposts.php">View All Posts</a>
                            </li>
                            <li>
                                <a href="addpost.php">Add Posts</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <li><a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-user"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users" class="collapse">
                            <li>
                                <a href="viewusers.php"><i class="fa fa-fw fa-users"></i> All Users</a>
                            </li>
                            <li>
                                <a href="addusers.php"><i class="fa fa-fw fa-user"></i>Add User</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="profile.php"><i class="fa fa-fw fa-wrench"></i> Profile</a>
                    </li>
                    <li>
                        <a href="comments.php"><i class="fa fa-comment"></i> Comments</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome <?php echo "{$loginUser}"; ?>
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> CMS Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
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
                  <div class='huge'><?php echo $postCount; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="viewposts.php">
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
                     <div class='huge'><?php echo $commentCount; ?></div>
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
                    <div class='huge'><?php echo $userCount; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="viewusers.php">
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
                        <div class='huge'><?php echo $catCount; ?></div>
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



<!-- for histogram -->
<div class="row">
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Data', 'Count', ],

            <?php
                $textElement = array('Posts','Comments', 'Users',  'Categories');
                $counts = array($postCount,$commentCount, $userCount,  $catCount);

                for($i = 0; $i<4; $i++){
                    echo "['{$textElement[$i]}'". ", ". "{$counts[$i]}],"; 
                }

            ?>

        //   ['Data', 'Count', 'New', 'check', 'last'],
        //   ['Posts', 100, 0, 0, 0],
        //   ['Categories', 0, 20, 0, 0],
        //   ['Users',  0, 0, 50, 0],
        //   ['Comments', 0, 0, 0,60],
          
        ]);

        var options = {
          title : 'Data Analysis',
          vAxis: {title: 'Menus'},
          hAxis: {title: 'Data'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</div>
<div id="chart_div" style="width: 'auto'; height: 500px;"></div>





            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/adminfooter.php"; ?>
