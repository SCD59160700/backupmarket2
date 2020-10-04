<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$mk_id = $_REQUEST["mk_id"];
$mk_img = $_REQUEST["mk_img"];
$mkname = $_POST["mkname"];
$type = $_POST["type"];
$status = $_POST["status"];
$date = $_POST["date"];

if (isset($_FILES['mk_img'])) {
  $errors = array();
  $file_name = $_FILES['mk_img']['name']; 
  $file_size = $_FILES['mk_img']['size'];
  $file_tmp = $_FILES['mk_img']['tmp_name'];
  $file_type = strrchr($_FILES['mk_img']['name'], ".");
  $file_ext = strtolower(end(explode('.', $_FILES['mk_img']['name'])));

  $extensions = array("jpeg", "jpg", "png");

  if (in_array($file_ext, $extensions) === false) {
    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
  }

  if ($file_size > 2097152) {
    $errors[] = 'File size must be excately 2 MB';
  }
}
if (empty($errors) == true) {
  $path = "../mk_img/";
  $newname = 'img_' . $mkname . $file_type;
  $path_copy = $path . $newname;
  move_uploaded_file($file_tmp, $path_copy);
} else {
  $newname = $mk_img;
}
//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 
$sql = "UPDATE market SET  
      mk_id='$mk_id', 
      mk_type='$type', 
      mk_status='$status',
      mk_name='$mkname',
      mk_date='$date',
      mk_img='$newname'
      
      WHERE mk_id='$mk_id' ";

$result = mysqli_query($conn, $sql);

mysqli_close($conn); //ปิดการเชื่อมต่อ database 

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if ($result) {
  echo "<script type='text/javascript'>";
  echo "alert('Update Succesfuly');";
  echo "window.location = '../supmarket_list.php'; ";
  echo "</script>";
} else {
  echo "<script type='text/javascript'>";
  echo "alert('Error back to Update again again ');";
  echo "</script>";
}

?>