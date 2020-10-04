<?php
session_start();
// include('head.php');
// include('header.php');
include('navbar.php');
include('code/connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

$shop_id = $_GET['shop_id'];
// echo $shop_id ;

//2. query ข้อมูลจากตาราง:
$sql = "SELECT DISTINCT s.*,m.mk_name,m.mk_type,m.mk_date,p.*
FROM market m,shop s,product p
WHERE m.mk_id=s.mk_id AND s.shop_id=p.shop_id AND s.shop_id=$shop_id";
// echo $sql;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
extract($row);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="shopping-cart/dist/style.css">
    <!-- Bootstrap core CSS -->
    <link href="user_list/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="user_list/css/business-frontpage.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <!-- <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <!-- Custom styles for this template-->
    <!-- <link href="admin/css/sb-admin-2.min.css" rel="stylesheet"> -->
</head>

<body>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img style="width:1300px;height:400px;display: block;margin-left: auto;margin-right: auto;" class="img-resize" src="shop_img/<?php echo $row['shop_img'] ?>" alt="First slide">

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
    </div> <br>
    <div class="container">
        <!-- Main component for a primary marketing message or call to action -->
        <h3>รายการสินค้า</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>รูป</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียด</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $meResult) { ?>
                    <tr>
                        <td><img style="width:100px;height:100px;" src="userprd_img/<?php echo $meResult['prd_img']; ?>" border="0"></td>
                        <td><?php echo $meResult['prd_name']; ?></td>
                        <td><?php echo $meResult['prd_detail']; ?></td>
                        <td><?php echo $meResult['prd_stock']; ?></td>
                        <td><?php echo number_format($meResult['prd_price'], 2); ?></td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div> <!-- /container -->

    <!-- partial -->
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="shopping-cart/dist/script.js"></script> -->
    <!-- Bootstrap core JavaScript -->
    <script src="user_list/vendor/jquery/jquery.min.js"></script>
    <script src="user_list/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="basket/bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="basket/bootstrap/js/bootstrap.min.js"></script>
    
</body>

</html>