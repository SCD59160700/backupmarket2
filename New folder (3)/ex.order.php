<!-- 7. สร้างไฟล์ order.php แล้วนำ code ด้านล่างไปใส่ โดยการทำงานของไฟล์นี้จะแสดงผลรายการที่ต้องการยืนยันสั่งซื้อพร้อมจำนวนและราคาสินค้าที่ไม่สามารถแก้ไขได้(แตกต่างจาก cart.php ที่สามารถแก้ไขได้) -->
<?php
session_start();
require 'code/connect.php';
$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$_SESSION['formid'] = sha1('itoffside.com' . microtime());
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
    $meQuery = mysqli_query($conn, $meSql);
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
    <script type="text/javascript">
        function updateSubmit() {
            if (document.formupdate.order_fullname.value == "") {
                alert('โปรดใส่ชื่อนามสกุลด้วย!');
                document.formupdate.order_fullname.focus();
                return false;
            }
            if (document.formupdate.order_address.value == "") {
                alert('โปรดใส่ที่อยู่ด้วย!');
                document.formupdate.order_address.focus();
                return false;
            }
            if (document.formupdate.order_phone.value == "") {
                alert('โปรดใส่เบอร์โทรด้วย!');
                document.formupdate.order_phone.focus();
                return false;
            }
            document.formupdate.submit();
            return false;
        }
    </script>
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
        <h3>รายการสั่งซื้อ</h3>
        <!-- Main component for a primary marketing message or call to action -->
        <?php
        if ($action == 'removed') {
            echo "<div class=\"alert alert-warning\">ลบสินค้าเรียบร้อยแล้ว</div>";
        }
        if ($meCount == 0) {
            echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
        } else {
        ?>

            <!-- <div class="form-group row">
                <div class="col-sm-4" align="center">
                    <select name="tranferType" class="form-control" id="pagelist" onChange="chksatatus(this.value)" ;>
                        <option>กรุณาระบุตัวเลือกการจัดส่ง</option>
                        <option value="1">มารับเองที่ตลาด</option>
                        <option value="2">ให้ทางร้านจัดส่ง</option>
                        <option value="3">นัดรับสินค้าโดยตรง</option>
                    </select>

                    <script language="javascript">
                        function chksatatus(tranfer) {
                            if (tranfer == "2") {
                                document.getElementById('input1').style.display = 'block';

                            } else {
                                document.getElementById('input1').style.display = 'none';
                            }
                        }
                    </script>

                </div> -->


            <form action="ex.updateorder.php" method="post" name="formupdate" role="form" id="formupdate" onsubmit="JavaScript:return updateSubmit();">
                <div class="form-group row">
                    <div class="col-sm-4" align="center">
                        <select name="tranferType" class="form-control" id="pagelist" onChange="chksatatus(this.value)" ;>
                            <option>กรุณาระบุตัวเลือกการจัดส่ง</option>
                            <option value="1">มารับเองที่ตลาด</option>
                            <option value="2">ให้ทางร้านจัดส่ง</option>
                            <option value="3">นัดรับสินค้าโดยตรง</option>
                        </select>

                        <script language="javascript">
                            function chksatatus(tranfer) {
                                if (tranfer == "2") {
                                    document.getElementById('input1').style.display = 'block';

                                } else {
                                    document.getElementById('input1').style.display = 'none';
                                }
                            }
                        </script>

                    </div>
                </div>
                <div id="input1">
                    <div class="form-group">
                        <label for="order_fullname" id="fullName">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="order_fullname" placeholder="ใส่ชื่อนามสกุล" style="width: 300px;" name="order_fullname">
                    </div>
                    <div class="form-group">
                        <label for="order_address" id="address">ที่อยู่</label>
                        <textarea class="form-control" rows="3" style="width: 500px;" name="order_address" id="order_address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="order_phone" id="phone">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="order_phone" placeholder="ใส่เบอร์โทรศัพท์ที่สามารถติดต่อได้" style="width: 300px;" name="order_phone">
                    </div>
                </div>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>รายละเอียด</th>
                            <th>จำนวน</th>
                            <th>ราคาต่อหน่วย</th>
                            <th>จำนวนเงิน</th>
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
                                <td><?php echo $meResult['prd_id']; ?></td>
                                <td><?php echo $meResult['prd_name']; ?></td>
                                <td><?php echo $meResult['prd_detail']; ?></td>
                                <td>
                                    <?php echo $_SESSION['qty'][$key]; ?>
                                    <input type="hidden" name="qty[]" value="<?php echo $_SESSION['qty'][$key]; ?>" />
                                    <input type="hidden" name="prd_id[]" value="<?php echo $meResult['prd_id']; ?>" />
                                    <input type="hidden" name="prd_price[]" value="<?php echo $meResult['prd_price']; ?>" />
                                </td>
                                <td><?php echo number_format($meResult['prd_price'], 2); ?></td>
                                <td><?php echo number_format(($meResult['prd_price'] * $_SESSION['qty'][$key]), 2); ?></td>
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
                                <input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>" />
                                <a href="ex.cartshopDetail.php" type="button" class="btn btn-danger btn-lg">ย้อนกลับ</a>
                                <button type="submit" class="btn btn-primary btn-lg">บันทึกการสั่งซื้อสินค้า</button>
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