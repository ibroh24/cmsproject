<?php session_start(); ?> 
<?php
    // session_unset();
    $_SESSION['username'] = null;
    header("Location: ../../index.php");





?>
