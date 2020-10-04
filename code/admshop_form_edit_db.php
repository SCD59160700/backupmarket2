<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม 

$shop_id = $_REQUEST["shop_id"];
$status = $_REQUEST["status"];
//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 
   
  $sql = "UPDATE shop SET shop_status='$status'
          WHERE shop_id='$shop_id' ";

$result = mysqli_query($conn, $sql) ;

mysqli_close($conn); //ปิดการเชื่อมต่อ database 

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
// echo"$sql";
  if($result){
  echo "<script type='text/javascript'>";
  echo "alert('Update Succesfuly');";
  echo "window.location = '../admin.php'; ";
  echo "</script>";
  }else{
  echo "<script type='text/javascript'>";
  echo "alert('Error back to Update again again ');";
  echo "</script>";
}

?>