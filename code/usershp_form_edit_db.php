<?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
session_start();

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
// $userid = $_SESSION['userid'];
$shop_img = $_REQUEST["shop_img"];
$shop_id = $_REQUEST["shop_id"];
$shop_name = $_POST["shop_name"];
$shop_detail = $_POST["shop_detail"];
$mk_id = $_POST["mk_id"];
$shop_cd_condition = $_POST["shop_cd_condition"];
$shop_contact = $_POST["shop_contact"];

//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 

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
  echo $first_name;
    echo $newname;
} 
else{
 $newname = $shop_img;
}
  $sql = "UPDATE shop SET  
      shop_img='$newname', 
      shop_name='$shop_name', 
      shop_detail='$shop_detail',
      mk_id='$mk_id',
      shop_cd_condition='$shop_cd_condition',
      shop_contact='$shop_contact'

      WHERE shop_id='$shop_id' ";

  $result = mysqli_query($conn, $sql);

  mysqli_close($conn); //ปิดการเชื่อมต่อ database 
  
  //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
  if ($result) {

    echo "<script type='text/javascript'>";
    echo "alert('Update Succesfuly');";
    echo "window.location = '../usershp_show.php'";
    echo "</script>";
  
  } else {
    echo "<script type='text/javascript'>";
    echo "alert('Error back to Update again again ');";
    echo "window.location = '../usershp_show.php'";
    echo "</script>";
   
  }

?>