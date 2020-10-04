<?php
session_start();
// include('navbar.php');
require 'code/connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<?php
include('navbar.php');
$ord_id = $_GET['ord_id'];
$prd_id = $_GET['prd_id'];
$query = "SELECT p.prd_name,prd_detail,prd_img,od.od_amount,od.od_price,s.shop_name
FROM orders_detail od,product p,shop s
WHERE od.prd_id=p.prd_id AND p.shop_id=s.shop_id AND od.ord_id=$ord_id AND p.prd_id=$prd_id";

$result = mysqli_query($conn, $query); //ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น

$row = mysqli_fetch_array($result);
echo $query;
?>

<head>
    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>itoffside.com shopping cart</title>
   
    <link href="basket/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="basket/bootstrap/css/nava.css" rel="stylesheet"> -->

</head>

<body onLoad=" LoadOnce()">

    <br><br><br>
    <div class="container">

        <h3 style="text-align: center;"></h3>
        <!-- Main component for a primary marketing message or call to action -->
        <div class="card" style="width: -moz-min-content;height: -moz-available;margin-left: auto;margin-right: auto;display: block;">
            <div class="card-header" style="text-align: center;">
                ใบเสร็จ
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0" style="text-align: center;">
                    <img style="width: 286px; height: 180px;" src="userprd_img/<?php echo $row['prd_img'] ?>" alt="error"><br><br>
                    <h5>ชื่อสินค้า:<td><?php echo  $row['prd_name'] .  " <br>";  ?></h5>
                    <h5>รายละเอียด:<td><?php echo  $row['prd_detail'] .  " <br>";  ?></h5>
                    <h5>ชื่อร้านค้า:<td><?php echo  $row['shop_name'] .  " <br>";  ?></h5>
                    <h5>จำนวน:<td><?php echo  $row['od_amount'] .  " <br>";  ?></h2>
                    <h5>ราคา:<td><?php echo number_format($row['od_price'], 2); ?></h2>
                </blockquote>
            </div>
        </div><br>

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