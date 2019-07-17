<?php
/*
define('local', 'localhost');
define('user', 'root');
define('pass', '');
define('dbname', 'cms');
*/

$local = "localhost";
$user = "root";
$pass = "";
$dbname = "cms";


$dbConnect = mysqli_connect($local, $user, $pass, $dbname);

if(!$dbConnect) die("cant connect".mysqli_error($dbConnect));

?>