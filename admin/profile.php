<?php 
// if(!isset($_SESSION['username']))
//session_start(); ?>
<?php include "includes/adminheader.php"; ?>
<?php require_once "../functions/myfunctions.php"; ?>
<?php 
// print_r($_SESSION); exit();
    $loginUser = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '$loginUser'";
    $result = mysqli_query($dbConnect, $query);
    if(generalErrorCheck($dbConnect, $result));
    else {
        while($row = mysqli_fetch_assoc($result)){
            $username = $row['username'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $role = $row['role'];
            $password = $row['password'];
        }
    }
?>


<!-- Top Menu Items -->

<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
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
                    <a href="addusers"><i class="fa fa-fw fa-users"></i>Add User</a>
                </li>
            </ul>
        </li>
        <li class="active">
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
                <?php echo $loginUser; ?>'s Profile
                    <!-- <small>Subheading</small> -->
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-clipboard"></i> <a href="addusers.php">User Profile</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-clipboard"></i> Profile for <?php echo $loginUser; ?>
                    </li>
                </ol>
                <!-- user form -->
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user">First Name</label>
                                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="author">Last Name</label>
                                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" required="required">
                            </div>
                        </div>


                        <!-- <div class="row"> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="author">Password</label>
                                <input type="text" name="password" class="form-control" value="<?php echo $username; ?>" required="required">
                            </div>
                        </div>
                                </div>
                                <div class="col-md-6">
                            <div class="form-group">
                                <label for="author">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required="required">
                            </div>
                        </div>
                        </div>
                                <div class="form-group col-md-6">
                                    <label for="image">User Image</label>
                                    <input type="file" name="image" class="form-control" id="">
                                </div>
                                <div class="row">
                                <div class="form-group col-md-12">
                                    <center>
                                    <input type="submit" name="adduser" class="btn btn-primary" value="Add User">
                                </center>
                                </div>
                                </div>

                </form>
            </div>
            <?php addUser($dbConnect); ?>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/adminfooter.php"; ?>