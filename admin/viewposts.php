<?php include "includes/adminheader.php"; ?>
<?php require_once "../functions/myfunctions.php"; ?>
<?php
if (isset($_POST['submit'])) {
    $catTitle = $_POST['catTitle'];
    if (empty($catTitle)) {
        ?>
        <script>
            alert("category textbox cannot be empty!");
        </script>
    <?php } else {

    addCategories($dbConnect, $catTitle);
}
}
if (isset($_GET['delete'])) {
    $deleteCatID = $_GET['delete'];
    $deleteQuery = "DELETE FROM categories WHERE catid = '$deleteCatID'";
    $delResult = mysqli_query($dbConnect, $deleteQuery);
    if ($delResult) {
        header("Location: categories.php");
    } else {
        generalErrorCheck($dbConnect, $delResult);
    }
}

if(isset($_POST['edit'])){
    $catTitle = $_POST['catTitle'];
    // $editCat = $_GET['update'];
    if(!empty($catTitle)){
        $checkUpdate = updateCatgories($dbConnect, $catTitle, $catid);
        if($checkUpdate){
            header("Location: categories.php");
        }
    }else{
        ?>
        <script>alert("No data to update!");</script>
    <?php }
}

?>

<!-- Top Menu Items -->

<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="index.php"><i class="fa fa-dashboard" ></i > Dashboard</a>
        </li>

        <li class="active"><a href="javascript:;" data-toggle="collapse" data-target="#post"><i class="fa fa-fw fa-arrows-v"></i> Posts<i class="fa fa-fw fa-caret-down"></i></a>
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
                    Posts
                    <!-- <small>Subheading</small> -->
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-clipboard"></i> <a href="viewposts.php">Posts</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-clipboard"></i> All Posts
                    </li>
                </ol>
                
                    <table class="table table-responsive">
                        <thead style="background-color:black; color:greenyellow;">
                            <tr>
                                <th>Action</th>
                                <th>Post ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>User</th>
                                <th>Content</th>
                                <th>Categories</th>
                                <th>Post Image</th>
                                <th>Post Date</th>
                                <th>Post Tags</th>
                                <th>Post Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php selectAllPosts($dbConnect); ?>
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

</div>
<!-- /#wrapper -->

<?php include "includes/adminfooter.php"; ?>