<?php include "includes/adminheader.php"; ?>
<?php require_once "../functions/myfunctions.php"; ?>


<form action="categories.php" method="post">
<div class="form-group">

    <label for="CategoryTitle">Edit Category</label>

    
    <?php
    // this is used to get value into the edit textbox from database!
    if (isset($_GET['update'])) {
        $editCat = $_GET['update'];
        $updateCat = "SELECT * FROM categories WHERE catid = '$editCat'";
        $updateRes = mysqli_query($dbConnect, $updateCat);

        while ($row = mysqli_fetch_assoc($updateRes)) {
            $catid = $row['catid'];
            $catName = $row['cattitle'];
            ?>
            <input value="<?php if (isset($catName)) {echo $catName;} ?>" type="text" name="catTitle" class="form-control" aria-describedby="helpId">
        <?php   }
        } ?>

    <?php
    //this is used to update the value from the textbox back to the database.

    if(isset($_POST['edit'])){
            $catid = $_GET['update'];
            $cattitle = $_POST['catTitle'];
            if(!empty($catTitle)){
                $checkUpdate = updateCatgories($cattitle, $catid);
                if($checkUpdate){
                    header("Location: categories.php");
                }
            }else{
                ?>
                <script>alert("No data to update!");</script>
            <?php }
}

    ?>

</div>
<div class="form-group">
    <center>
        <input name="edit" class="btn btn-primary" type="submit" value="Update Category">
    </center>
</div>
</form>