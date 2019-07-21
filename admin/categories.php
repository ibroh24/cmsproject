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
        <li class="active">
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
                    Categories
                    <!-- <small>Subheading</small> -->
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-clipboard"></i> <a href="categories.php">Categories</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-clipboard"></i> Add / Update Category
                    </li>
                </ol>
                <div class="col-sm-4">
                    <form action="categories.php" method="post">
                        <div class="form-group">
                            <label for="CategoryTitle">Category Title</label>
                            <input type="text" name="catTitle" class="form-control" placeholder="Category Title" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <center>
                                <input name="submit" class="btn btn-primary" type="submit" value="Add Category">
                            </center>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <form action="categories.php" method="post">
                        <div class="form-group">

                            <label for="CategoryTitle">Edit Category</label>

                            
                            <?php
                            // this is used to get value into the edit textbox from database!
                            if (isset($_GET['update'])) {
                                global $editCat;
                                $editCat = $_GET['update'];
                                $updateCat = "SELECT * FROM categories WHERE catid = '$editCat'";
                                $updateRes = mysqli_query($dbConnect, $updateCat);
                                // generalErrorCheck($updateRes);
                                while ($row = mysqli_fetch_assoc($updateRes)) {
                                    $catName = $row['cattitle'];
                                    ?>
                                    <input value="<?php if (isset($catName)) {echo $catName;} ?>" type="text" name="catTitle" class="form-control" aria-describedby="helpId">
                                <?php   }
                                } ?>
                        
                        </div>
                        <div class="form-group">
                            <center>
                                <input name="edit" class="btn btn-primary" type="submit" value="Update Category">
                            </center>
                        </div>
                    </form>
                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-6">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php categoriesList($dbConnect); ?>
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