<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$prd_img = date("Ymd_his");
$prd_id = $_POST["prd_id"];
$prd_name = $_POST["prd_name"];
$prd_detail = $_POST["prd_detail"];
$prd_stock = $_POST["prd_stock"];
$prd_price = $_POST["prd_price"];

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
if (empty($errors) == true) {
  $path = "userprd_img/";
  $newname = 'img_' . $prd_id . $prd_img . $file_type;
  $path_copy = $path . $newname;
  move_uploaded_file($file_tmp, $path_copy);
  // echo $prd_id;
} else {
  $newname = null;
  
}
$sql = "UPDATE product SET  
      prd_id='$prd_id', 
      prd_name='$prd_name',
      prd_detail='$prd_detail',
      prd_stock='$prd_stock',
      prd_price='$prd_price'";
if (isset($newname)) {
  $sql .= ",prd_img='$newname'";
}

$sql .=  "WHERE prd_id='$prd_id' ";

$result = mysqli_query($conn, $sql);
// echo $sql;

mysqli_close($conn); //ปิดการเชื่อมต่อ database 

// //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
// if ($result) {
//   echo "<script type='text/javascript'>";
//   echo "alert('Update Succesfuly');";
//   echo "window.location = '../userprd_list.php'; ";
//   echo "</script>";
// } else {
//   echo "<script type='text/javascript'>";
//   echo "alert('Error! ');";
//   echo "window.location = '../userprd_list.php'";
//   echo "</script>";
// }

?>