<?php include "includes/adminheader.php"; ?>
<?php require_once "../functions/myfunctions.php"; ?>

<!-- Top Menu Items -->

<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
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
                    <a href="addusers.php"><i class="fa fa-fw fa-users"></i>Add User</a>
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
                    Add New Posts
                    <!-- <small>Subheading</small> -->
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-clipboard"></i> <a href="addpost.php">Add Posts</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-clipboard"></i> New Posts
                    </li>
                </ol>
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type="text" name="title" class="form-control" id="">
                    </div>
                    <!-- select categories -->
                    <div class="form-group">
                        <label for="category">Post Category</label> <br>
                        <select name="category">
                            <?php
                            global $dbConnect;

                            $query = "SELECT * FROM categories";
                        
                            $cats = mysqli_query($dbConnect, $query);
                            if(generalErrorCheck($dbConnect, $cats));
                            else{
                                while ($rows = mysqli_fetch_assoc($cats)) {
                                    $id = $rows['catid'];
                                    $title = $rows['cattitle'];
                                    echo "<option value='$title'>{$title}</option>";                                    
                                }
                            }
                            ?>                                
                        </select>
                        <!-- <input type="text" name="category" class="form-control" id=""> -->
                    </div>
                    <div class="form-group">
                        <label for="user">Post User</label>
                        <input type="text" name="user" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="author">Post Author</label>
                        <input type="text" name="author" class="form-control" id="" required="required">
                    </div>
                    <div class="form-group">
                        <label for="status">Post Status</label>
                        <input type="text" name="status" class="form-control" id="" required="required">
                    </div>
                    <div class="form-group">
                        <label for="image">Post Image</label>
                        <input type="file" name="image" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="tags">Post Tags</label>
                        <input type="text" name="tags" class="form-control" id="" required="required">
                    </div>
                    <div class="form-group">
                        <label for="content">Post Content</label>
                        <textarea name="content" class="form-control" id="" required="required" rows="10", cols='10'></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="post_create" class="btn btn-primary" value="Publish Post">
                    </div>

                </form>
                </div>
                        <?php addPost($dbConnect);  ?>

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