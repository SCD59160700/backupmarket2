<?php
session_start();
// include('head.php');
// include('header.php');
include('navbar.php');
include('code/connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

$userid = $_SESSION['userid'];
//2. query ข้อมูลจากตาราง:
$sql = "SELECT shop.*,market.mk_name, market.mk_id FROM `shop`,`market` WHERE shop.mk_id=market.mk_id AND shop.user_id=$userid ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
extract($row);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Business Frontpage - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-frontpage.css" rel="stylesheet">

</head>

<body>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <?php echo   "<img style=\"width:1300px;height:400px;display:block;margin-left: auto;margin-right: auto;\" class=\"img-resize\" src=\"shop_img/$shop_img\" alt=\"First slide\">"; ?>
            </div>
        </div>
    </div>
    <br>
    <br>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-8 mb-5">
                <h2>ข้อมูลร้านค้า</h2>
                <hr>
                <?php echo " <p>" . 'ชื่อร้านค้า : ' . $row["shop_name"] .  " </p>";  ?>
                <?php echo " <p>" . 'รายละเอียดสินค้า : ' . $row["shop_detail"] .  " </p>";  ?>
                <?php echo " <p>" . 'รายชื่อตลาด : ' . $row["mk_name"] .  " </p>";  ?>
                <?php echo " <p>" . 'เงื่อนไขการสั่งซื้อ : ' . $row["shop_cd_condition"] .  " </p>";  ?>
            </div>
            <div class="col-md-4 mb-5">
                <h2>ข้อมูลการติดต่อ</h2>
                <hr>
                <address>
                    <!-- <strong>Start Bootstrap</strong> -->
                    <?php echo " <br>"  . $row["shop_contact"] .  " </br>";  ?>
                </address>
            </div>
        </div>

        <div class="col-sm-3 mx-auto">
            <a href="usershp_form_edit.php" class="btn btn-success btn-user btn-block">แก้ไขข้อมูลร้านค้า</a>
        </div>

    </div>
    <br>
    <br>
    <!-- /.container -->

</body>

</html>
<?php include('footer.php'); ?>