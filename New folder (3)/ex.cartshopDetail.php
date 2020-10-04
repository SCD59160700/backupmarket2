<?php
session_start();
require 'code/connect.php';
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
if (isset($_SESSION['cart']) and $itemCount > 0) {
    $itemIds = "";
    foreach ($_SESSION['cart'] as $itemId) {
        $itemIds = $itemIds . $itemId . ",";
    }
    $inputItems = rtrim($itemIds, ",");
    $meSql = "SELECT * FROM product WHERE prd_id in ({$inputItems})";
    echo $meSql;
    $meQuery = mysqli_query($conn,$meSql);
    $meCount = mysqli_num_rows($meQuery);
} else {
    $meCount = 0;
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
        <h3>ตะกร้าสินค้าของฉัน</h3>
        <!-- Main component for a primary marketing message or call to action -->
        <?php
        if ($action == 'removed') {
            echo "<div class=\"alert alert-warning\">ลบสินค้าเรียบร้อยแล้ว</div>";
        }
        if ($meCount == 0) {
            echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
        } else {
        ?>
            <form action="ex.updatecart.php" method="post" name="fromupdate">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>รายละเอียด</th>
                            <th>จำนวน</th>
                            <th>ราคาต่อหน่วย</th>
                            <th>จำนวนเงิน</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_price = 0;
                        $num = 0;
                        while ($meResult = mysqli_fetch_assoc($meQuery)) {
                            $key = array_search($meResult['prd_id'], $_SESSION['cart']);
                            $total_price = $total_price + ($meResult['prd_price'] * $_SESSION['qty'][$key]);
                        ?>
                            <tr>
                                <td><img src="userprd_img/<?php echo $meResult['prd_img']; ?>" border="0"></td>
                                <td><?php echo $meResult['prd_id']; ?></td>
                                <td><?php echo $meResult['prd_name']; ?></td>
                                <td><?php echo $meResult['prd_detaiil']; ?></td>
                                <td>
                                    <input type="text" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key]; ?>" class="form-control" style="width: 60px;text-align: center;">
                                    <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
                                </td>
                                <td><?php echo number_format($meResult['prd_price'], 2); ?></td>
                                <td><?php echo number_format(($meResult['prd_price'] * $_SESSION['qty'][$key]), 2); ?></td>
                                <td>
                                    <a class="btn btn-danger btn-lg" href="ex.removecart.php?itemId=<?php echo $meResult['prd_id']; ?>" role="button">
                                        <span class="glyphicon glyphicon-trash"></span>
                                        ลบทิ้ง</a>
                                </td>
                            </tr>
                        <?php
                            $num++;
                        }
                        ?>
                        <tr>
                            <td colspan="8" style="text-align: right;">
                                <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price, 2); ?> บาท</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right;">
                                <button type="submit" class="btn btn-info btn-lg">คำนวณราคาสินค้าใหม่</button>
                                <a href="ex.order.php" type="button" class="btn btn-primary btn-lg">สังซื้อสินค้า</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        <?php
        }
        ?>
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