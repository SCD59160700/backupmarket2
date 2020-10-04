<?php
require 'connect.php';

$ordstatus = $_POST['ordstatus'];
$od_id = $_POST['od_id'];
$ord_id = $_POST['ord_id'];
$prd_id = $_POST['prd_id'];
$userid = $_POST['userid'];

echo $userid;



if (isset($_POST['submit'])) {

    $sql = "UPDATE orders SET  
    ord_status='$ordstatus'
     
    WHERE ord_id='$ord_id' ";

    $result = mysqli_query($conn, $sql);

    if ($ordstatus == 2) {
        $sql2 = "SELECT o.ord_id,od.od_id,p.prd_stock,p.prd_id,od.od_amount
    FROM product p,orders_detail od,orders o 
    WHERE p.prd_id = od.prd_id AND o.ord_id = od.ord_id AND od.ord_id=$ord_id";

        $result = mysqli_query($conn, $sql2);

        foreach ($result as $row) {
            $prd_id = $row['prd_id'];
            $stock = $row['prd_stock'];
            $amount = $row['od_amount'];
            $total = $stock + $amount;



            $sql3 = "UPDATE product SET  
            prd_stock='$total'
            WHERE prd_id= $prd_id";

            mysqli_query($conn, $sql3);
      
        }
    }

    // mysqli_close($conn);
  
}
   header("location:../test.php?ord_id=$ord_id&prd_id=$prd_id&userid=$userid");
//    header("location:../exReport.php?ord_id=$ord_id&prd_id=$prd_id&userid=$userid");
