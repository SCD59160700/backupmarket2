<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
// if($_POST["member_id"]==''){
// echo "<script type='text/javascript'>"; 
// echo "alert('Error Contact Admin !!');"; 
// echo "window.location = 'showmember.php'; "; 
// echo "</script>";
// }

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$userid = $_POST["user_id"];
$username = $_POST["username"];
// $password = $_POST["password"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$tel = $_POST["tel"];
$address = $_POST["address"];
$date = date("Y/m/d h:i:sa");
$userstatus = "active";
$usertype = $_POST['user_type'];


//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 

$sql = "UPDATE user SET  
			user_username='$username' ,
			user_pass='$password' ,
			user_fname='$firstname' ,
			user_lname='$lastname' , 
			user_email='$email' ,
			user_tel='$tel' ,
			user_address='$address' ,
			user_status='$userstatus' ,
			user_type='$usertype' ,
			create_at='$date'  
            WHERE user_id='$userid' ";
            echo $sql;
            

$result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

mysqli_close($conn); //ปิดการเชื่อมต่อ database 

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('Update Succesfuly');";
    echo "window.location = '../index.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    // echo "alert('Error back to Update again');";
    // echo "window.location = 'showmember.php'; ";
    echo "</script>";
}
?>