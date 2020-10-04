<?php
include("navbar.php");
session_start();
require 'code/connect.php';
$userid = $_SESSION['userid'];
$meSql = "SELECT DISTINCT o.create_at,p.prd_name,o.ord_status,p.prd_name,p.prd_price,CONCAT(u.user_fname, ' ',u.user_lname) AS FullName,u.user_address,u.user_email,od.od_amount
FROM orders_detail od,product p,orders o,user u 
WHERE p.prd_id=od.prd_id AND o.ord_id=od.ord_id AND o.user_id=u.user_id AND u.user_id=$userid";
// echo $meSql;
$meQuery = mysqli_query($conn, $meSql);
$row = mysqli_fetch_array($meQuery)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="example2/style.css" media="all" /> -->
    
</head>

<body>
    <br><br><br>
    <div class="container">
        <div class="card">
            <div class="card-header">
                ใบเสร็จ
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <h5>ชื่อ:<td><?php echo  $row['FullName'] .  " <br>";  ?></h5>
                    <h5>ที่อยู่:<td><?php echo  $row['user_address'] .  " <br>";  ?></h5>
                    <h5>อีเมลล์:<td><?php echo  $row['user_email'] .  " <br>";  ?></h5>
                    <h5>เบอร์โทร:<td><?php echo  $row['user_tel'] .  " <br>";  ?></h2>


                </blockquote>
            </div>
        </div><br>

        <h4>รายการสินค้า</h4>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ที่</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                    <!-- <th>&nbsp;</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                $num = 0;
                while ($meResult = mysqli_fetch_assoc($meQuery)) {
                    // $key = array_search($meResult['prd_id'], $_SESSION['cart']);
                    // $total_price = $total_price + ($meResult['prd_price'] * $_SESSION['qty'][$key]);
                ?>
                    <tr>
                        <td><?php echo $num; ?></td>
                        <td><?php echo $meResult['prd_name']; ?></td>
                        <td><?php echo $meResult['od_amount']; ?></td>
                        <td><?php echo number_format($meResult['prd_price'], 2); ?></td>
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
            </tbody>
        </table>
    </div>
</body>

</html>