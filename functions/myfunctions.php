<?php //session_start();

if(!isset($_SESSION['username'])){
    session_start();
    
}
    // session_unset();
    // header("Location: index.php");
?>
<?php

// define('$dbconnect', 'connect'); 
function generalErrorCheck($dbConnect, $result)
{
    if (!$result) {
        die("Query Failed!: " . mysqli_error($dbConnect));
    }
}

function categories($dbConnect, $limit)
{
    $query = "SELECT * FROM categories LIMIT $limit";

    $cats = mysqli_query($dbConnect, $query);
    if(generalErrorCheck($dbConnect, $cats));
    else{
        while ($rows = mysqli_fetch_assoc($cats)) {
            $cattitle = $rows['cattitle'];
            $catid = $rows['catid'];


            echo "<li><a href='selectedCategory.php?cats=$catid'>{$cattitle}</a></li>";
        }
    }
}

function selectedCategory($dbConnect)
{
    if(isset($_GET['cats'])){
        $catsSelected = $_GET['cats'];
        $query = "SELECT * FROM posts WHERE postcatid = '$catsSelected'";

        $catsResult = mysqli_query($dbConnect, $query);
        if(generalErrorCheck($dbConnect, $catsResult));
        else{
            while ($rows = mysqli_fetch_assoc($catsResult)) {
                $postTitle = $rows['posttitle'];
                $postAuthor = $rows['postauthor'];
                $postDate = $rows['postdate'];
                $postImage = $rows['postimageurl'];
                $postContent = $rows['postcontent'];
                $postid = $rows['postid'];

                ?>
                <h2>
                    <a href="../cmsproject/ostdetail.php?getPost=<?php echo $postid; ?>" > <?php echo $postTitle; ?></a>
                </h2>
                <p class="lead">
                    by <a href="../cmsproject/postdetail.php?getPost=<?php echo $postid; ?>"> <?php echo $postAuthor; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="desires" width="300" height="150">
                <hr>
                <p><?php echo $postContent; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
            <?php
            }
    }

    }
}

function categoriesList($dbConnect)
{
    $query = "SELECT * FROM categories";

    $cats = mysqli_query($dbConnect, $query);
    $numbers = 0;
    while ($rows = mysqli_fetch_assoc($cats)) {
        $catID = $rows['catid'];
        $numbers++;
        $catTitle = $rows['cattitle']; ?>
        <tr>
            <td> <?php echo $numbers;  ?></td>
            <td><?php echo $catTitle; ?></td>
            <td>
                <a href="categories.php?delete=<?php echo $catID; ?>" class="btn btn-sm btn-danger">Delete </a> <span class="text-success">|</span>
                <a href="categories.php?update=<?php echo $catID; ?>" class="btn btn-sm btn-success">Update </a>
            </td>
        </tr>
    <?php }
    // generalErrorCheck($cats);

}

function addCategories($dbConnect, $values)
{
    $query = "INSERT INTO categories VALUES (NULL, '$values')";
    $cats = mysqli_query($dbConnect, $query);
    // generalErrorCheck($cats);
}


function updateCatgories($dbConnect, $cattitle, $catid)
{
    // $querycheck = "SELECT * FROM categories";
    // $resultCheck = mysqli_query($dbConnect, $querycheck);
    // while($resFetch = mysqli_fetch_assoc($resultCheck)){
    //     $row = $resFetch['catid'];
    // }
    // print_r($row);
    $updateCat = "UPDATE categories SET cattitle = '$cattitle' WHERE catid = '$catid'";
    $updateRes = mysqli_query($dbConnect, $updateCat);

    if ($updateRes) {
        ?>
        <script>
            alert("updated successfully");
        </script>
    <?php } else {
    // generalErrorCheck($updateRes);
}
}

function postPull($dbConnect)
{
    // getting values for catid
    $queryCat = "SELECT * FROM categories";
    // cant get value as the catid is in another loop
    $catsQ = mysqli_query($dbConnect, $queryCat);
    if(generalErrorCheck($dbConnect, $catsQ));
    else{
        while ($rows = mysqli_fetch_assoc($catsQ)) {
            $catid = $rows['catid'];
        }
    }
    $query = "SELECT * FROM posts";
    $cats = mysqli_query($dbConnect, $query);

    while ($rows = mysqli_fetch_assoc($cats)) {
        $postTitle = $rows['posttitle'];
        $postAuthor = $rows['postauthor'];
        $postDate = $rows['postdate'];
        $postImage = $rows['postimageurl'];
        $postContent = substr($rows['postcontent'], 0, 120);
        $postid = $rows['postid'];

        ?>
        <h2>
            <a href="../cmsproject/postdetail.php?getPost=<?php echo $postid; ?>" > <?php echo $postTitle; ?></a>
        </h2>
        <p class="lead">
            by <a href="../cmsproject/postdetail.php?getPost=<?php echo $postid; ?>"> <?php echo $postAuthor; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="desires" width="300" height="150">
        <hr>
        <p><?php echo $postContent; ?></p>
        <a class="btn btn-primary" href="selectedCategory.php?cats=<?php $catid; ?> ">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        <hr>
    <?php
    }
}



function addPost($dbConnect)
{
    if (isset($_POST['post_create'])) {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $status = $_POST['status'];
        $author = $_POST['author'];
        $user = $_POST['user'];
        $image = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp'];
        $tags = $_POST['tags'];
        $content = $_POST['content'];
       // $date = date(d - m - y);
        $count = 4;
        // $viewcount

        $checkOut = move_uploaded_file($imageTemp, "../images/$image");
        if($checkOut);
        echo $checkOut;

        $query = "INSERT INTO posts(`postid`, `postcatid`, `posttitle`, `postauthor`, `postuser`, 
                    `postdate`, `postimageurl`, `postcontent`, `posttags`, `postcommentcount`, `poststatus`,
                    `postviewscount`)";
        $query .= "VALUES (NULL, '$category', '$title', '$author', '$user', now(), '$image', '$content', '$tags', '$count', '$status',
                    NULL)";
        $resQuery = mysqli_query($dbConnect, $query);

        if ($resQuery) {
            if($checkOut);
            echo $checkOut;
            // header("Location: ../Admin/viewposts.php");
        } else {
            // generalErrorCheck($resQuery);
        }
    }
}


function addUser($dbConnect)
{
        if(isset($_POST['adduser'])){
        $dataAccepted = $_POST;
        unset($dataAccepted['adduser']);
        unset($dataAccepted['image']);
        
        // $dataAccepted['saveUser'] = md5('firstname');
        // $dataAccepted['date'] = now();
        
        // print_r($dataAccepted);
        $data = array_keys($dataAccepted);
        // print_r($data);
        $query = "INSERT INTO users (".implode(", ", $data).") VALUES('".implode("', '", $dataAccepted)."')";
        // print_r($query);
        $result = mysqli_query($dbConnect, $query);
        if(generalErrorCheck($dbConnect, $result));
        if($result){
            ?>
            <script>
                alert("Data saved successfully!");
                console.log(result);
            </script>
            <?php
            header("Location: ../admin/viewusers.php");
        }
        else {
            ?>
            <script>
                alert("data cannot be saved!");
                console.log(result);
            </script>
            <?php
        }
    }
}




function selectAllPosts($dbConnect)
{
    $postQuery = "SELECT * FROM posts";
    $postResult = mysqli_query($dbConnect, $postQuery);
    if (generalErrorCheck($dbConnect, $postResult));
    else {
        $increament = 0;
        while ($row = mysqli_fetch_assoc($postResult)) {
            $increament++;
            $postid = $row['postid'];
            $posttitle = $row['posttitle'];
            $postAuthor = $row['postauthor'];
            $postcatid = $row['postcatid'];
            $postuser = $row['postuser'];
            $postcontent = $row['postcontent'];
            $postimage = $row['postimageurl'];
            $postdate = $row['postdate'];
            $posttags = $row['posttags'];
            $poststatus = $row['poststatus'];
            ?>
            <tr>
            <td><a href="viewposts.php?remove=<?php echo $postid; ?>" value="<?php deletePost($dbConnect); ?>" class="fa fa-trash-o" title="delete post" style="color: red;"></a>
             <a href="viewposts.php?edit=<?php echo $postid; ?>" class="fa fa-edit" title="update post" style="color: green;" data-toggle="modal" data-target="#updateModal" value="<?php editPost($dbConnect); ?>" ></a>
                </td>
                <td><?php echo $increament; ?></td>
                <td><?php echo $posttitle; ?></td>
                <td><?php echo $postAuthor; ?></td>
                <td><?php echo $postuser; ?></td>
                <td><?php echo $postcontent; ?></td>
                <?php
                    $catIdQuery = "SELECT * FROM categories WHERE catid = '$postcatid'";
                    $selectCatIdQuery = mysqli_query($dbConnect, $catIdQuery);
                    if(generalErrorCheck($dbConnect, $selectCatIdQuery));
                    else{
                        while($row = mysqli_fetch_assoc($selectCatIdQuery)){
                            $dbValue = $row['cattitle'];
                        }
                    }
                ?>
                
                <td><?php echo $dbValue; ?></td>
                <td><?php echo $postimage; ?></td>
                <td><?php echo $postdate; ?></td>
                <td><?php echo $posttags; ?></td>
                <td><?php echo $poststatus; ?></td>
                
            </tr> <?php
            }
        }
    }




// overloading function with table names, and 
function generalTableSelections($dbConnect, $tableName, $columnName = '', $clause=''){
    
    if(!$columnName){
        $query = "SELECT * FROM $tableName";
    }else {
        $query = "SELECT $columnName FROM $tableName WHERE $clause";
    }
    $result = mysqli_query($dbConnect, $query);
    if(generalErrorCheck($dbConnect, $result));
    else {
        echo "good to go";
    }
}


function login($dbConnect){
    /*  function to accept username and password
        and log user in if it has register
    */
    
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!empty($username) && !empty($password)){
            // $fields = $_POST;
            // unset($fields['login']);
            // $data = array_keys($fields);
            // print_r($fields);
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($dbConnect, $query);
            if(generalErrorCheck($dbConnect, $result));
            else {
                while ($rows = mysqli_fetch_array($result)) {
                    $dbusername = $rows['username'];
                    $dbpassword = $rows['password'];
                    // $userid = $rows['userid'];
                    $userrole = $rows['role'];
                    $firstname = $rows['firstname'];
                    $lastname = $rows['lastname'];
                    $email = $rows['email'];
                    if($username ==$dbusername && $password ==$dbpassword){
                        // print_r($dbpassword);
                        // print_r(header("Location: admin/index.php"));
                        $count = mysqli_num_rows($result);
                        if($count ==1)
                        if($userrole == 'Admin' || $userrole=='admin'){
                            $_SESSION['username'] = $dbusername;
                            $_SESSION['password'] = $dbpassword;
                            $_SESSION['userrole'] = $userrole;
                            $_SESSION['firstname'] = $firstname;
                            $_SESSION['lastname'] = $lastname;
                            $_SESSION['email'] = $email;
                            // print_r($_SESSION['username'] = $dbusername);
                            // exit();
                            // echo $dbusername."<br>"; echo $dbpassword; exit();
                            ?><script>
                                <?php echo("location.href = 'admin/index.php';");?>
                            </script><?php
                             
                        }else {
                            // echo $dbusername."<br>"; echo $dbpassword; exit();
                            ?><script>
                            <?php echo("location.href = 'index.php';");?>
                        </script><?php
                        }
                    }else {
                        // print_r($dbusername);
                       echo "Login attempt failed!";
                        // header("Location: ../index.php");
                    }
                }
                
            }

        }else{
            ?>
            <script>
                alert("Please fill the login textbox");
            </script>
        <?php }
        
    }
}




// select all users function
function selectAllUsers($dbConnect)
{
    $postQuery = "SELECT * FROM users";
    $postResult = mysqli_query($dbConnect, $postQuery);
    if (generalErrorCheck($dbConnect, $postResult));
    else {
        $increament = 0;
        while ($row = mysqli_fetch_assoc($postResult)) {
            $increament++;
            $userid = $row['userid'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $username = $row['username'];
            $email = $row['email'];
            $role = $row['role'];
            // $postimage = $row['postimageurl'];
            // $postdate = $row['postdate'];
            // $posttags = $row['posttags'];
            // $poststatus = $row['poststatus'];
            ?>
            <tr>
            <td><a href="viewusers.php?remove=<?php echo $userid; ?>" value="<?php deleteUser($dbConnect); ?>" class="fa fa-trash-o" title="delete post" style="color: red;"></a>
             <a href="viewusers.php?edit=<?php echo $userid; ?>" class="fa fa-edit" title="update post" style="color: green;" data-toggle="modal" data-target="#updateModal" value="<?php editPost($dbConnect); ?>" ></a>
                </td>
                <td><?php echo $increament; ?></td>
                <td><?php echo $firstname; ?></td>
                <td><?php echo $lastname; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $email ?></td>
                <?php
                    // $catIdQuery = "SELECT * FROM categories WHERE catid = '$postcatid'";
                    // $selectCatIdQuery = mysqli_query($dbConnect, $catIdQuery);
                    // if(generalErrorCheck($dbConnect, $selectCatIdQuery));
                    // else{
                    //     while($row = mysqli_fetch_assoc($selectCatIdQuery)){
                    //         $dbValue = $row['cattitle'];
                    //     }
                    // }
                ?>
                <td><?php echo ""; ?></td>
                <!-- <td><?php //echo $dbValue; ?></td> -->
                <td><?php echo $role; ?></td>
                
            </tr> <?php
            }
        }
    }





    function selectAllComments($dbConnect)
    {
        $commentQuery = "SELECT * FROM comments";
        $commentResult = mysqli_query($dbConnect, $commentQuery);
        if (generalErrorCheck($dbConnect, $commentResult));
        else {
            $increament = 0;
            while ($row = mysqli_fetch_assoc($commentResult)) {
                $increament++;
                $commentid = $row['commentid'];
                $commentAuthor = $row['commentauthor'];
                $commentcatid = $row['commentcatid'];
                $commentcontent = $row['commentcontent'];
                $commentemail = $row['commentemail'];
                $commentdate = $row['commentdate'];
                $commentstatus = $row['commentstatus'];
                ?>
                <tr>
                <td><center><a href="comments.php?erase=<?php echo $commentid; ?>" value="<?php deleteComment($dbConnect); ?>" class="fa fa-trash-o" title="delete comment" style="color: red;"></a></center></td>
                    <td><?php echo $increament; ?></td>
                    <td><?php echo $commentstatus; ?></td>
                    <td><?php echo $commentAuthor; ?></td>
                    <td><?php echo $commentcontent; ?></td>
                    <td><?php echo $commentemail; ?></td>
                    <td><?php echo $commentdate; ?></td>
                    <?php
                    $getResponse = "SELECT * FROM posts WHERE postid = '$commentcatid'";
                    $responseResult = mysqli_query($dbConnect, $getResponse);
                    if(generalErrorCheck($dbConnect, $responseResult));
                    else{
                        while($row = mysqli_fetch_assoc($responseResult)){
                            $fetchID = $row['postid'];
                            $fetchDetail = $row['posttitle'];
                        ?>
                            <td>
                            <a href="../viewposts.php?postid=<?php echo $fetchID; ?>" value="<?php echo $fetchDetail; ?>"></a>
                        </td>
                            <!-- <a href="../viewposts.php?postid=<?php// echo $fetchID; ?>" <?php //echo $fetchDetail; ?></a> </td> -->
                            <?php
                        }
                    }
                    ?>
                    
                    <?php
                        // $catIdQuery = "SELECT * FROM categories WHERE catid = '$postcatid'";
                        // $selectCatIdQuery = mysqli_query($dbConnect, $catIdQuery);
                        // if(generalErrorCheck($selectCatIdQuery));
                        // else{
                        //     while($row = mysqli_fetch_assoc($selectCatIdQuery)){
                        //         $dbValue = $row['cattitle'];
                        //     }
                        // }
                    ?>
                    
                    <!-- <td><?php// echo $dbValue; ?></td>                     -->
                </tr> <?php
                }
            }
        }

    function saveComments($dbConnect){
        if(isset($_POST['commentpost'])){
            // commentcatid was collected from the post selected, so the post was get with GET method
            $commentcatid = $_GET['getPost'];
            $author = $_POST['commentauthor'];
            $email =$_POST['commentemail'];
            $comment = $_POST['comment'];
            
            $commentQry = "INSERT INTO `comments`(`commentid`, `commentcatid`, `commentauthor`, 
                        `commentemail`, `commentcontent`, `commentdate`, `commentstatus`)";
            $commentQry .= " VALUES(NULL, '$commentcatid', '$author','$email', '$comment', now(), NULL)";
            $commentRes = mysqli_query($dbConnect, $commentQry);
            if(generalErrorCheck($dbConnect, $commentRes));
            // else{

            // }

        }
    }

    //  this is to test general delete funtion, 
    //  that will have 3parameters (connection, tablename and id to remove)
    function deleteFromTables($dbConnect, $tableName, $column, $id)
    {
        // $getId
        $delQ = "DELETE FROM $tableName WHERE $column = '$id'";
        $delResult = mysqli_query($dbConnect, $delQ);
        if (generalErrorCheck($dbConnect, $delResult));
    }


    function deletePost($dbConnect)
    {
        if (isset($_GET['remove'])) {
            $remove = $_GET['remove'];

            $delQ = "DELETE FROM posts WHERE postid = '$remove'";
            $delResult = mysqli_query($dbConnect, $delQ);
            if (generalErrorCheck($dbConnect, $delResult));
            else {
                header("Location: ../admin/viewposts.php");
            }
        }
    }

    function deleteUser($dbConnect)
    {
        if (isset($_GET['remove'])) {
            $remove = $_GET['remove'];

            $delQ = "DELETE FROM users WHERE userid = '$remove'";
            $delResult = mysqli_query($dbConnect, $delQ);
            if (generalErrorCheck($dbConnect, $delResult));
            else {
                header("Location: ../admin/viewusers.php");
            }
        }
    }


    function deleteComment($dbConnect)
    {
        if (isset($_GET['erase'])) {
            $erase = $_GET['erase'];

            $delQ = "DELETE FROM comments WHERE commentid = '$erase'";
            $delResult = mysqli_query($dbConnect, $delQ);
            if (generalErrorCheck($dbConnect, $delResult));
            else {
                header("Location: ../admin/comments.php");
            }
        }
    }

    function editPost($dbConnect) {
        // echo "here"; exit();
        if (isset($_GET['edit'])) {
            $getId = $_GET['edit'];
            $getQuery = "SELECT * FROM posts WHERE postid = '$getId'";
            $returnResult = mysqli_query($dbConnect, $getQuery);
            if (generalErrorCheck($dbConnect, $returnResult));
            else {
                while ($row = mysqli_fetch_assoc($$returnResult)) {
                    $postid = $row['postid'];
                    $posttitle = $row['posttitle'];
                    $postAuthor = $row['postauthor'];
                    $postuser = $row['postuser'];
                    $postcontent = $row['postcontent'];
                    //$postimage = $row['postimageurl'];
                    $postdate = $row['postdate'];
                    $posttags = $row['posttags'];
                    $poststatus = $row['poststatus'];
                } ?>

        <!-- Update Button Modal -->

        <div class="modal" tabindex="-1" id="updateModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form class="form" method="post">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="modal-body">
                                    <label for="exampleInputEmail1">Post ID</label>
                                    <input class="form-control" type="text" name="postid" value="<?php echo $postid; ?> " disabled>
                                    <label for="title">Post Title</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $posttitle; ?>">
                                    <label for="category">Post User</label>
                                    <input type="text" name="user" class="form-control" value="<?php echo $postuser; ?>">
                                    <label for="user">Post User</label>
                                    <input type="text" name="user" class="form-control" value="<?php echo $postid; ?>">
                                    <label for="author">Post Author</label>
                                    <input type="text" name="author" class="form-control" value="<?php echo $postAuthor; ?>">
                                    <label for="status">Post Status</label>
                                    <input type="text" name="status" class="form-control" value="<?php echo $poststatus; ?> ">
                                    <label for="tags">Post Tags</label>
                                    <input type="text" name="tags" class="form-control" value="<?php echo $posttags; ?> ">
                                    <label for="content">Post Content</label>
                                    <textarea name="content" class="form-control" id="" required="required" rows="10", cols='10'> <?php echo $postcontent; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button name="postUpdate" id="update" class="btn btn-sucess">Update Post</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?php
            } }

    }


    function selectedPost($dbConnect)
    {
        if(isset($_GET['getPost'])){
            $postGet = $_GET['getPost'];

            $query = "SELECT * FROM posts WHERE postid='$postGet'";
        
            $cats = mysqli_query($dbConnect, $query);
            if(generalErrorCheck($dbConnect, $cats));
            else{
                while ($rows = mysqli_fetch_assoc($cats)) {
                    $postTitle = $rows['posttitle'];
                    $postAuthor = $rows['postauthor'];
                    $postDate = $rows['postdate'];
                    $postImage = $rows['postimageurl'];
                    $postContent = $rows['postcontent'];
            
                    ?>
                    <h2>
                        <a href="#"> <?php echo $postTitle; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"> <?php echo $postAuthor; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="desires" width="300" height="150">
                    <hr>
                    <p><?php echo $postContent; ?></p>
                    <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->
                    <hr>
                <?php
            }
        }
    }
}


function checKOut($dbConnect){
    $dataAccepted = $_POST;
    unset($dataAccepted['saveUser']);
    $data = array_keys($dataAccepted);
    $query = "SELECT INTO users (".implode(", ", $data)." VALUES('".implode("', '", $data)."',  )";
    $result = mysqli_query($dbConnect, $query);
    if(generalErrorCheck($dbConnect, $result));
    if($result){
        ?>
        <script>
            alert("Data saved successfully!");
            console.log(result);
        </script>
        <?php
    }
    else {
        ?>
        <script>
            alert("data cannot be saved!");
            console.log(result);
        </script>
        <?php
    }

}


        

        
        


ob_end_flush();
?>