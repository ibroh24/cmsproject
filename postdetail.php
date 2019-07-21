<?php include "includes/dbhandler.php"; ?>
<?php include "functions/myFunctions.php"; ?>
<?php //include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>





<!-- Navigation -->


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <?php selectedPost($dbConnect); ?>
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
            <?php //searchBarQuery(); ?>
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
                   
                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <!-- <div class="well"> -->
                <!-- <h4>Side Widget Well</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p> -->
            <!-- </div> -->

        </div>

    </div>
    <!-- /.row -->





    <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label for="textarea">Author</label>
                                <input type="text" class="form-control" required="required" name="commentauthor" placeholder="Your name">
                            </div>
                            <div class="form-group">
                                <label for="textarea">Email</label>
                                <input type="email" class="form-control" name="commentemail" required="required" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <label for="textarea">Comment</label>
                                <textarea class="form-control" name="comment" rows="3" required="required" placeholder="your text here..."></textarea>
                            </div>
                            <input type="submit" name="commentpost" class="btn btn-primary">
                        </form>
                    </div>
                    <?php saveComments($dbConnect); ?>
    
                    <hr>
    
                    <!-- Posted Comments -->
    
                    <?php
                        $postGet = $_GET['getPost'];
                        $commentQuery = "SELECT * FROM comments WHERE commentcatid = '$postGet'";
                        $commentResult = mysqli_query($dbConnect, $commentQuery);
                        if (generalErrorCheck($dbConnect, $commentResult));
                        else {
                            while ($row = mysqli_fetch_assoc($commentResult)) {  
                               //  $commentid = $row['commentid'];
                                $commentAuthor = $row['commentauthor'];
                                $commentcontent = $row['commentcontent'];
                                $commentemail = $row['commentemail'];
                                $commentdate = $row['commentdate'];
                            ?>
                                 <!-- Comment -->
                                 <div class="media">
                                     <a class="pull-left" href="#">
                                         <img class="media-object" src="http://placehold.it/64x64" alt="">
                                     </a>
                                     <div class="media-body">
                                         <h4 class="media-heading"><?php echo $commentAuthor; ?>
                                             <small><?php echo $commentdate; ?></small>
                                         </h4>
                                         <?php echo $commentcontent; ?>
                                     </div>
                                 </div>
                                 <?php
                             }
                        }
                    ?>

                   
    
                    <!-- Comment -->
                    <!-- <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4> -->
                            <!-- Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. -->
                            <!-- Nested Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <!-- <div class="media-body">
                                    <h4 class="media-heading">Nested Start Bootstrap
                                        <small>August 25, 2014 at 9:30 PM</small>
                                    </h4>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                </div> -->
                            </div>
                            <!-- End Nested Comment -->
                        </div>
                    </div>

    <?php include "includes/footer.php"; ?>