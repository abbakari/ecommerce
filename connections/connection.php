<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vote_db";

$connect = mysqli_connect($servername,$username,$password,$dbname);
if(!$connect){
    die("connection failed" . mysqli_connect_error());
}
     return 'home.php';


     
