<?php
session_start();
require 'code/connect.php';

// $shop_id = $_GET['shop_id'];
$shop_id = $_POST['shop_id'];

$meSql = "SELECT DISTINCT s.*,m.mk_name,m.mk_type,m.mk_date,p.*
FROM market m,shop s,product p
WHERE m.mk_id=s.mk_id AND s.shop_id=p.shop_id AND s.shop_id=17 ";

$meQuery = mysqli_query($conn,$meSql);
// echo $meQuery;
$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_SESSION['qty'])) {
    $meQty = 0;
    foreach ($_SESSION['qty'] as $meItem) {
        $meQty = $meQty + $meItem;
    }
} else {
    $meQty = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>itoffside.com shopping cart</title>
    <!-- Bootstrap -->
    <link href="basket/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="basket/bootstrap/css/nava.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="container">
        <!-- Static navbar -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="#">Shopping Cart - ItOffside.com</a> -->
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="ex.cartshop.php">หน้าแรกสินค้า</a></li>
                        <li><a href="ex.cartshopDetail.php">ตะกร้าสินค้าของฉัน <span class="badge"><?php echo $meQty; ?></span></a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
            <!--/.container-fluid -->
        </div>
        <!-- Main component for a primary marketing message or call to action -->
        <h3>หน้าแรกของสินค้า</h3>
        <?php
        if ($action == 'exists') {
            echo "<div class=\"alert alert-warning\">เพิ่มจำนวนสินค้าแล้ว</div>";
        }
        if ($action == 'add') {
            echo "<div class=\"alert alert-success\">เพิ่มสินค้าลงในตะกร้าเรียบร้อยแล้ว</div>";
        }
        if ($action == 'order') {
            echo "<div class=\"alert alert-success\">สั่งซื้อสินค้าเรียบร้อยแล้ว</div>";
        }
        if ($action == 'orderfail') {
            echo "<div class=\"alert alert-warning\">สั่งซื้อสินค้าไม่สำเร็จ มีข้อผิดพลาดเกิดขึ้นกรุณาลองใหม่อีกครั้ง</div>";
        }
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียด</th>
                    <th>ราคา</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // echo $meQuery;
                while ($meResult = mysqli_fetch_assoc($meQuery)) {
                ?>
                    <tr>
                        <td><img src="userprd_img/<?php echo $meResult['prd_img']; ?>" border="0"></td>
                        <td><?php echo $meResult['prd_id']; ?></td>
                        <td><?php echo $meResult['prd_name']; ?></td>
                        <td><?php echo $meResult['prd_detail']; ?></td>
                        <td><?php echo number_format($meResult['prd_price'], 2); ?></td>
                        <td>
                            <a class="btn btn-primary btn-lg" href="ex.updatecart.php?itemId=<?php echo $meResult['prd_id']; ?>" role="button">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                หยิบใส่ตะกร้า</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div> <!-- /container -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <script src="basket/bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="basket/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php
mysqli_close($conn);
?>