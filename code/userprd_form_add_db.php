<?php
include('connect.php');
session_start();
date_default_timezone_set('Asia/Bangkok');
// echo 'sdfsldf';
$userid = $_SESSION['userid'];
// $shopid = $_POST['shop_id'];
$date = date("Ymd_his");
$prd_name = $_POST['prd_name'];
$prd_detail = $_POST['prd_detail'];
$prd_stock = $_POST['prd_stock'];
$prd_price = $_POST['prd_price'];

// echo $prd_name;
if (isset($_FILES['prd_img'])) {
  $errors = array();
  $file_name = $_FILES['prd_img']['name'];
  $file_size = $_FILES['prd_img']['size'];
  $file_tmp = $_FILES['prd_img']['tmp_name'];
  $file_type = strrchr($_FILES['prd_img']['name'], ".");
  $file_ext = strtolower(end(explode('.', $_FILES['prd_img']['name'])));

  $extensions = array("jpeg", "jpg", "png");


  if (in_array($file_ext, $extensions) === false) {
    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
  }

  if ($file_size > 2097152) {
    $errors[] = 'File size must be excately 2 MB';
  }
}

$query_shop = "SELECT * FROM shop WHERE user_id=$userid";
$result_shop = mysqli_query($conn, $query_shop);
$row = mysqli_fetch_array($result_shop) or die(mysqli_error($conn));
$shop_id = $row['shop_id'];

if (empty($errors) == true) {

  $path = "userprd_img/";
  $newname = 'img_' .$shop_id . $date . $file_type;
  $path_copy = $path . $newname;
  move_uploaded_file($file_tmp, $path_copy);
} else {
  $newname = null;
}

$query = "INSERT INTO product (prd_name,prd_detail,prd_stock,prd_price,prd_img,shop_id)
      VALUE ('$prd_name','$prd_detail','$prd_stock','$prd_price','$newname','$shop_id')";
$result = mysqli_query($conn, $query);

mysqli_close($conn);


?>