<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
 
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$userid = $_REQUEST["userid"];
$type = $_REQUEST["type"];
$status = $_REQUEST["status"];
//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 
  
  $sql = "UPDATE user SET  
      user_type='$type', 
      user_status='$status'
       
      WHERE user_id='$userid' ";

$result = mysqli_query($conn, $sql) ;

mysqli_close($conn); //ปิดการเชื่อมต่อ database 

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

  if($result){
  echo "<script type='text/javascript'>";
  echo "alert('Update Succesfuly');";
  echo "window.location = '../superadm_list2.php'; ";
  echo "</script>";
  }
  else{
  echo "<script type='text/javascript'>";
  echo "alert('Error back to Update again again ');";
  echo "</script>";
}

?>