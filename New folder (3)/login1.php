<!-- //<?php
		//session_start();
		//include("code/connect.php");
		//extract($_POST);



		// if($_SERVER["REQUEST_METHOD"] == "POST"){
		// 	$username = $_POST['username'];
		// 	$password = $_POST['password'];
		// 	$query = "SELECT * FROM user WHERE user_username ='$username' AND user_pass = '$password' ";
		// 	$result = mysqli_query($conn, $query);

		// 	if (mysqli_num_rows($result) < 1) {
		// 		$found = "N";
		// 		echo "1";
		// 	} else if  (mysqli_num_rows($result) == 1){
		// 		$_SESSION['userid'] = $row['user_id'];
		// 		$_SESSION["login"] = $username ;
		// 		echo $_SESSION['userid'];
		// 		echo"query";

		// 	}
		// }
		// if (isset($_SESSION["login"])) {
		// 	 echo "3zz";
		// 	 $result = mysqli_query($conn, $query);
		// 	 $_SESSION['userid'] = $row['user_id'];
		// 	 echo $_SESSION["userid"];
		// 	// echo "<h1 align=center>Hye you are sucessfully login!!!</h1>";
		// 	//header("Location: t.php");
		// 	exit;
		// }
		?> -->

<!DOCTYPE html>
<html lang="en">
<?php include('header.php')?>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="login/images/icons/favicon.ico">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css"> -->
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
	<!--=================================== ============================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" method="POST">
					<span class="login100-form-title p-b-51">
						Login
					</span>


					<div class="wrap-input100  m-b-16">
						<!-- <i class="fa fa-user-circle" aria-hidden="true"></i> -->
						
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>
					<span></span>

					<div class="wrap-input100  m-b-16">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					<?php
					session_start();
					if (isset($_POST["submit"])) {

						if (!empty($_POST['username']) && !empty($_POST['password'])) {
							$user = $_POST['username'];
							$pass = $_POST['password'];

							include('code/connect.php');

							$query = "SELECT * FROM user WHERE user_username ='$user' AND user_pass = '$pass' ";
							$result = mysqli_query($conn, $query);

 
							if (mysqli_num_rows($result) == 1) {
								$row = mysqli_fetch_array($result);

								if ($row['user_status']  == 'inactive') {
									echo "ไม่สามารถเข้าใช้ระบบได้กรุณาติดต่อผู้ดูแลระบบ!";
								} 
								else {
									$_SESSION['userid'] = $row['user_id'];
									$_SESSION['user'] = $row['user_fname'] . " " . $row['user_lname'];
									$_SESSION['userf'] = $row['user_fname'];
									$_SESSION['usertype'] = $row['user_type'];

									if ($row['user_type'] == "admin") {
										header("location:admin.php");
									} else if ($row['user_type'] == "superadmin") {
										header("location:superadm_list2.php");
									} else {
										header("location:index.php");
									}
								}
							} else {
								echo "username or password ไม่ถูกต้อง!";
								// echo $test;
							}
						} else {
							echo "กรุณากรอกข้อมูลให้ครบทุกช่อง !";
						}
					}
					?>
					<div class="flex-sb-m w-full p-t-3 p-b-24">
						<!-- <div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div> -->

						<div>
							<a href="code/test.php" class="txt1">
								ลืมพาสเวิร์ดใช่หรือไม่?
							</a>
						</div>
					</div>



					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" type="submit" name="submit">
							ล็อกอิน
						</button>
						<!-- <input type="submit" name="submit" value="เข้าสู่ระบบ"> -->
						<!-- <button class="login100-form-btn" type="submit" name="reg"><a href="register2.php">สมัครสมาชิก</a></button> -->
						
						
					</div>

				</form>
				<div class="container-login100-form-btn m-t-17">
					<button class="login100-form-btn" type="submit" name="reg"><a href="register2.php" style="color: #fff;">สมัครสมาชิก</a> </button>
				</div>
			</div>
		</div>


		<div id="dropDownSelect1"></div>

		<!--===============================================================================================-->
		<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script src="login/vendor/animsition/js/animsition.min.js"></script>
		<!--===============================================================================================-->
		<script src="login/vendor/bootstrap/js/popper.js"></script>
		<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
		<script src="login/vendor/select2/select2.min.js"></script>
		<!--===============================================================================================-->
		<!-- <script src="login/vendor/daterangepicker/moment.min.js"></script>
		<script src="login/vendor/daterangepicker/daterangepicker.js"></script> -->
		<!--===============================================================================================-->
		<script src="login/vendor/countdowntime/countdowntime.js"></script>
		<!--===============================================================================================-->
		<script src="login/js/main.js"></script>

</body>

</html>