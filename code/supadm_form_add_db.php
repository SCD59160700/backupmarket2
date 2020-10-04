<?php
include('connect.php');

$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$type = $_POST['type'];
$status = $_POST['status'];
$date = date("Y/m/d h:i:sa");

$query = "INSERT INTO user (user_username,user_pass,user_fname,user_lname,user_email,user_tel,user_address,user_type,user_status,create_at)
    VALUE ('$username','$password','$firstname','$lastname','$email','$tel','$address','$type','$status','$date')";
$result = mysqli_query($conn, $query);

mysqli_close($conn);

if ($result) {
  echo "<script>";
  echo "alert('Add Succesfuly');";
  echo "window.location ='../superadm_list2.php'; ";
  echo "</script>";
} else {

  echo "<script>";
  echo "alert('ERROR!');";
  echo "window.location ='superadm.php'; ";
  echo "</script>";
}
?>

 