<?php include "includes/dbhandler.php"; ?>
<?php include "functions/myFunctions.php"; ?>
<?php //include "includes/header.php"; 
session_unset();
?>
<?php include "includes/navbar.php"; ?>





<!-- Navigation -->


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1> -->

            <!-- First Blog Post -->
            <?php postPull($dbConnect); ?>
            <hr>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">
            <?php //searchBarQuery(); 
            ?>
            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <form action="includes/search.php" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" name="searchRes" type="searchRes">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.input-group -->
            </div>

            <!-- Blog Categories Well -->
            <div class="well">
                <h4>Blog Categories</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-unstyled">

                            <?php categories($dbConnect, 4); ?>

                        </ul>
                    </div>
                    <!-- /.col-lg-6 -->

                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <div class="well">
                <h4>Login</h4>
                <form method="post" action="" autocomplete="off">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" id="" placeholder="Enter Username">
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="" placeholder="Enter Password">
                        <span class="input-group-btn "><input type="submit" name="login" class="btn btn-primary" value="Login"></span>
                    </div>
                    <?php login($dbConnect); ?>
                </form>
            </div>
            
        </div>

    </div>
    <!-- /.row -->

    <?php include "includes/footer.php"; ?>