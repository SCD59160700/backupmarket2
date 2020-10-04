<?php
$conn = mysqli_connect("localhost","root","12345678","market");

if(!$conn){
    die("Failed to connec to databse". mysqli_error($conn));
}
date_default_timezone_set('Asia/Bangkok');
?>