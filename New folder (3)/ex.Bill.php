<?php
include("navbar.php");
session_start();
require 'code/connect.php';
$userid = $_SESSION['userid'];
$meSql = "SELECT DISTINCT o.create_at,p.prd_name,o.ord_status,p.prd_name,p.prd_price,CONCAT(u.user_fname, ' ',u.user_lname) AS FullName,u.user_address,u.user_email
FROM orders_detail od,product p,orders o,user u 
WHERE p.prd_id=od.prd_id AND o.ord_id=od.ord_id AND o.user_id=u.user_id AND u.user_id=$userid";
// echo $meSql;
$meQuery = mysqli_query($conn, $meSql);
$row = mysqli_fetch_array($meQuery)
?>
<br><br><br>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link href="bill/bill.css" rel="stylesheet">

  
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <!-- <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;"> -->
                            </td>

                            <td>
                                ใบเสร็จ #: 123<br>
                                Created: January 1, 2015<br>
                                Due: February 1, 2015
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td><?php echo  $row['user_address'] .  " <br>";  ?> </td>
                            <td><?php echo  $row['FullName'] .  " <br>";  ?>
                                 <?php echo  $row['user_email'] ;  ?></td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr class="heading">
                <td>
                    สินค้า
                </td>

                <td>
                    ราคา
                </td>
            </tr>
            <?php foreach ($meQuery as $meResult) { ?>
            <tr class="item">
                <td><?php echo $meResult['prd_name']; ?></td>
                <td><?php echo number_format($meResult['prd_price'],2); ?> ฿</td>
                <!-- <td><?php echo number_format($meResult['prd_price'], 2); ?></td> -->
            </tr>
            <?php } ?>

            <tr class="total">
                <td></td>

                <td>
                    ทั้งหมด: 385.00฿
                </td>
            </tr>
        </table>
    </div>
</body>

</html>