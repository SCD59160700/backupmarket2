<?php
session_start();
$formid = isset($_SESSION['formid']) ? $_SESSION['formid'] : "";
if ($formid != $_POST['formid']) {
    echo "E00001!! SESSION ERROR RETRY AGAINT.";
} else {
    unset($_SESSION['formid']);
    if ($_POST) {
        require 'code/connect.php';
        // $order_fullname = mysqli_real_escape_string($_POST['order_fullname'],$conn);
        // $order_address = mysqli_real_escape_string($_POST['order_address'],$conn);
        // $order_phone = mysqli_real_escape_string($_POST['order_phone'],$conn);
        $order_fullname = $_POST['order_fullname'];
        $order_address = $_POST['order_address'];
        $order_phone = $_POST['order_phone'];
        $tranfer_Type = $_POST['tranferType'];
        $user_id = $_SESSION['userid'];
        echo $tranfer_Type;
//         $meSql = "INSERT INTO orders ( ord_fullname , ord_address , ord_tel) VALUES ('$order_fullname','$order_address','$order_phone') ";
// if (isset($order_fullname) && isset($order_address) && isset($order_phone)) {
//     $meSql .= "INSERT INTO orders ()";
//     $meSql .= "VALUES (";
//     $meSql .= "'',";
// }INSERT INTO `orders`(`ord_id`, `ord_tel`, `create_at`, `ord_status`, `user_id`, `ord_address`, `ord_fullname`)
if ($tranfer_Type == 2) {
    $meSql = "INSERT INTO orders ( ord_fullname , ord_address , ord_tel , ord_status , user_id ,ord_tranferType ) VALUES ('$order_fullname','$order_address','$order_phone',1,$user_id,$tranfer_Type) ";
}else {
    $meSql = "INSERT INTO orders ( ord_status , user_id ,ord_tranferType ) VALUES (1,$user_id,$tranfer_Type) ";
}
        $meQeury = mysqli_query($conn, $meSql);
        if ($meQeury) {
            $order_id = mysqli_insert_id($conn);
            for ($i = 0; $i < count($_POST['qty']); $i++) {
                $order_detail_quantity = $_POST['qty'][$i];
                $order_detail_price = $_POST['prd_price'][$i];
                $product_id = $_POST['prd_id'][$i];
                $lineSql = "INSERT INTO orders_detail (od_amount, od_price, prd_id, ord_id) ";
                $lineSql .= "VALUES (";
                $lineSql .= "'$order_detail_quantity',";
                $lineSql .= "'$order_detail_price',";
                $lineSql .= "'$product_id',";
                $lineSql .= "'$order_id'";
                $lineSql .= ") ";
                mysqli_query($conn, $lineSql);

                $queryProductStock = "SELECT prd_stock FROM product WHERE prd_id=$product_id";

                $productStock = mysqli_query($conn, $queryProductStock);
                $row = mysqli_fetch_array($productStock);
                $stock = $row['prd_stock'];

                $stc = $stock - $order_detail_quantity;

                // // echo $order_detail_quantity.'/';
                // // echo $stock.'/';
                // echo $stc;

                $sql = "UPDATE product SET  
                   prd_stock=$stc
                   WHERE  prd_id=$product_id ";
                $query = mysqli_query($conn, $sql);
            }

            mysqli_close($conn);
            unset($_SESSION['cart']);
            unset($_SESSION['qty']);
            // header('location:cartshop2.php?a=order');
        } else {
            mysqli_close($conn);
            // header('location:cartshop2.php?a=orderfail');
        }
    }
}
