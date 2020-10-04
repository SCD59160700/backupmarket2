<?php
include('connect.php');
session_start();

 
$userid = $_SESSION['userid'];
$shop_name = $_POST['shop_name'];
$shop_detail = $_POST['shop_detail'];
$mk_id = $_POST['mk_id'];
$shop_cd_condition = $_POST['shop_cd_condition'];
$shop_contact = $_POST['shop_contact'];
$status = "active";

if (isset($_FILES['shop_img'])) {
  $errors = array();
  $file_name = $_FILES['shop_img']['name'];
  $file_size = $_FILES['shop_img']['size'];
  $file_tmp = $_FILES['shop_img']['tmp_name'];
  $file_type = strrchr($_FILES['shop_img']['name'], ".");
  $file_ext = strtolower(end(explode('.', $_FILES['shop_img']['name'])));

  $extensions = array("jpeg", "jpg", "png");
  

  if (in_array($file_ext, $extensions) === false) {
    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    
  }

  if ($file_size > 2097152) {
    $errors[] = 'File size must be excately 2 MB';
  }
}
  if (empty($errors) == true) {
    $first_name = $_SESSION['userf'];
    $path = "../shop_img/";
    $newname = 'img_' . $first_name . $file_type;
    $path_copy = $path . $newname;
    move_uploaded_file($file_tmp, $path_copy);
    // $path_link="p_img/".$newname;
    
    // move_uploaded_file($file_tmp, "../shop_img/" . $file_name);
    // $f="../shop_img/" . $_FILES["mk_img"]["name"]; 
    //   chmod($f, 0777);

    // header("Location: ../test_shopshow.php");

    $query = "INSERT INTO shop (shop_img,shop_name,shop_detail,mk_id,shop_cd_condition,shop_contact,shop_status,user_id)
        VALUE ('$newname','$shop_name','$shop_detail','$mk_id','$shop_cd_condition','$shop_contact','$status','$userid')";
    $result = mysqli_query($conn, $query);

    mysqli_close($conn);
   
    if ($result) {
      echo "<script>";
      echo "alert('Add Succesfuly');";
      echo "window.location ='../usershp_show.php'; ";
      echo "</script>";
      // echo "success";
  }
 } else {
      // print_r($errors);
      echo "<script>";
      echo "alert('กรุณากรอกข้อมูลให้ครบ');";
      echo "window.location ='../usershop_form_add.php'; ";
      echo "</script>";
    }
  

