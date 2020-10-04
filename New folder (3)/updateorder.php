<?php
session_start();
$formid = isset($_SESSION['formid']) ? $_SESSION['formid'] : "";
if ($formid != $_POST['formid']) {
    echo "E00001!! SESSION ERROR RETRY AGAINT.";
} else {
    unset($_SESSION['formid']);
    if ($_POST) {
        require 'code/connect.php';

        $order_fullname = $_POST['order_fullname'];
        $order_address = $_POST['order_address'];
        $order_phone = $_POST['order_phone'];
        $tranferType = $_POST['tranferType'];
        $user_id = $_SESSION['userid'];
        
        // echo $order_fullname;
        // echo $tranferType;
        // if ($tranferType == 2) {
            $meSql = "INSERT INTO orders ( ord_fullname , ord_address , ord_tel , ord_status , user_id ,ord_tranferType) VALUES ('$order_fullname','$order_address','$order_phone',1,$user_id,$tranferType) ";
        //     echo $meSql;
        // }
        // if ($tranferType == 2) {
        //     $meSql = "INSERT INTO orders ( ord_fullname , ord_address , ord_tel , ord_status , user_id) VALUES ('$order_fullname','$order_address','$order_phone',1,$user_id) ";
        //     echo $meSql;
        // } else {
        //     $meSql = "INSERT INTO orders ( ord_status , user_id) VALUES (1,$user_id) ";
        // }

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
            header('location:index.php?a=order');
        } else {
            mysqli_close($conn);
            // header('location:cartshop2.php?a=orderfail');
        }
    }
}
