<?php
session_start();

$userid = $_SESSION['userid'];
$usertype = $_SESSION['usertype'];
// $shop_id = $_SESSION['temp_shopId'];

// $meQty = $_SESSION['meQty'];
// echo $shop_id;
// include('head.php');
include('code/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php header("Cache-Control: public,max-age=60, s-maxage=60"); ?>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>Market</title>

</head>

<body>

  <!-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #1cc88a; "> -->
  <div id="topheader">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Mamarket</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <?php

              if ($userid == null) {

                echo "<script>";
                echo "alert(\/ user หรือ  password ไม่ถูกต้อง\");";
                // echo "window.history.back()";
                echo "</script>";

                echo  "<li class=\"nav-item\"><a class=\"nav-link\" href=\"register2.php\">สมัครสมาชิก </a></li>";
                echo  "<li class=\"nav-item\"><a class=\"nav-link\" href=\"login1.php\">เข้าสู่ระบบ</a></li>";
              } else if ($userid != null && $usertype == 'user') {
                $query = "SELECT * FROM shop WHERE user_id ='$userid' ";
                $result = mysqli_query($conn, $query);


                // echo $query;


                if (mysqli_num_rows($result) == 1) {
                  $row = mysqli_fetch_array($result);
                  $_SESSION['shop_id'] = $row['shop_id'];
                  $shop_id = $_SESSION['shop_id'];

                  echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"usershp_show.php\">ร้านของฉัน</a></li>";

                  // echo"<a class=\"nav-link\" href=\"../usershp_show.php\">ร้านของฉัน</a>";

                } else {
                  echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"usershop_form_add.php\">เพิ่มร้านค้า</a></li>";
                  # echo"<a class=\"nav-link\" href=\"../usershp_form_add.php\">เพิ่มร้านค้า</a>";

                }
                echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"userprd_list.php\">ข้อมูลสินค้า</a></li>";
                echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"test.php\">รายงาน</a></li>";
                echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"testHistory.php\">ประวัติการซื้อ</a></li>";
                echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"cartshopDetail.php?shop_id=$shop_id\">ตะกร้าสินค้าของฉัน</a></li>";
                echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"profile_form_edit.php?userid=$userid\">แก้ไขข้อมูลส่วนตัว</a></li>";
                echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"rwd.php?userid=$userid\">แก้ไขรหัสผ่าน</a></li>";

                // echo "<li><a class=\"nav-link\" href=\"1.php?shop_id=$shopId\">ตะกร้าสินค้าของฉัน</a></li>";
                if (isset($_SESSION['userid'])) {

                  echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"code/logout.php\">ออกจากระบบ</a></li>";
                }
              }
              // else if ($userid != null && $usertype == 'admin') {
              //   echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"code/admshop.php\">จัดการข้อมูลร้านค้า</a></li>";
              // } else if ($userid != null && $usertype == 'superadmin') {

              //   echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"code/superadm.php\">จัดการข้อมูลสมาชิก</a></li>";
              //   echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"supmarket.php\">จัดการข้อมูลตลาด</a></li>";

              // }

              ?>
              <div class="nav navbar-nav navbar-right">
                <ul class="nav navbar-nav navbar-right">
                  <!-- <li class="nav-item active"><a class="nav-link">สวัสดีคุณ<?php echo  $_SESSION['user']; ?></a></li> -->
                  <!-- <li class="nav-item active"><a class="nav-link" href="code/logout.php">ออกจากระบบ</a></li> -->
                </ul>
              </div>
        </div>
      </div>
    </nav>
  </div>

  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->
</body>

</html>