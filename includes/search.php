<?php include "header.php"; ?>
<?php //include "navbar.php"; ?>



<?php

    //global $dbConnect;

    if(isset($_POST['searchRes'])){
       $search = $_POST['search'];
       
       $query = "SELECT * FROM posts WHERE postTags LIKE '%$search%' ";
       $result = mysqli_query($dbConnect, $query);

       if(!$result) die("cant fetch {$search} from database".mysqli_error($dbConnect));

       $count = mysqli_num_rows($result);
       if($count ==0){
           ?>
           <script>
               alert("No result for your search");
           </script>
           <?php
       }else{

        while($rows = mysqli_fetch_assoc($result)){
            $postTitle = $rows['postTitle'];
            $postAuthor = $rows['postAuthor'];
            $postDate = $rows['postDate'];
            $postImage = $rows['postImage'];
            $postContent = $rows['postContent'];

            ?>
            <h2>
                <a href="#"> <?php echo $postTitle; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"> <?php echo $postAuthor; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="desires" width="400" height="200">
            <hr>
            <p><?php echo $postContent; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
            <?php
        }


       }

    }

?>




 <!-- <div class="col-md-4">
            <?php //searchBarQuery(); ?>
            <!-- Blog Search Well -->
            <!-- <div class="well">
                <h4>Blog Search</h4>
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" name="searchRes" type="searchRes">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form> -->
                <!-- /.input-group -->
            <!-- </div> --> -->


<?php include "footer.php"; ?>