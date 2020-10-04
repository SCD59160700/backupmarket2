<meta charset="utf-8">
<?php
include('connect.php');
$user_id  = $_POST["user_id"];
$user_type  = $_POST["user_type"];
$a_pass1  = $_POST["a_pass1"];
$a_pass2  = $_POST["a_pass2"];

if ($a_pass1 != $a_pass2) {
	echo "<script type='text/javascript'>";
	echo "alert('password ไม่ตรงกัน กรุณาใส่่ใหม่อีกครั้ง ');";
	// echo 'hello';
	echo "window.location = '../rwd.php?userid=$user_id'; ";
	echo "</script>";
} else {
	$sql = "UPDATE user SET 
	user_pass ='$a_pass1'
	WHERE user_id=$user_id
	 ";
	$result = mysqli_query($conn, $sql);
}
mysqli_close($conn);
if ($user_type == 'admin' && $result) {
	echo "<script type='text/javascript'>";
	echo "alert('แก้ไข password สำเร็จ');";
	// echo '2';
	echo "window.location = '../admin.php'; ";
	echo "</script>";
} elseif ($user_type == 'superadmin' && $result) {
	echo "<script type='text/javascript'>";
	echo "alert('แก้ไข password สำเร็จ');";
	// echo '2';
	echo "window.location = '../admin.php'; ";
	echo "</script>";
} else {
	echo "<script type='text/javascript'>";
	echo "alert('แก้ไข password สำเร็จ');";
	echo "window.location = '../index.php'; ";
	// echo '3';
	echo "</script>";
}
?>