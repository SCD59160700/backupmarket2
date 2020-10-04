<?php
session_start();
include('navbar.php');
require 'code/connect.php';
// include 'code/UpdateStatus.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php
// include('navbar.php');
$ord_id = $_GET['ord_id'];
$prd_id = $_GET['prd_id'];
$userid = $_GET['userid'];
$tranferType = $_GET['tranferType'];
$status_code = $_GET['status_code'];

$query = "SELECT
p.prd_name,
p.prd_id,
p.prd_id,
p.prd_detail,
p.prd_img,
od.od_amount,od.od_id,
od.od_price,
ord_fullname,
status_desc,
o.ord_address,o.ord_tranferType,o.ord_id,o.ord_status,
o.ord_tel,CONCAT(u.user_fname, ' ', u.user_lname) AS FullName,
 CASE WHEN o.ord_tranferType = 1 THEN 'มารับเองที่ตลาด'
        WHEN o.ord_tranferType = 2 THEN 'ให้ทางร้านจัดส่ง'
        WHEN o.ord_tranferType = 3 THEN 'นัดรับสินค้าโดยตรง'
        END AS 'tranferType'
FROM
orders_detail od,
product p,
USER u,
orders o,
order_stutas os
WHERE
od.prd_id = p.prd_id AND od.ord_id = o.ord_id AND o.user_id = u.user_id AND os.status_id = o.ord_status AND o.ord_id = $ord_id AND u.user_id = $userid ";

$result = mysqli_query($conn, $query); //ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น

$row = mysqli_fetch_array($result);
// $ord_status = $row["ord_status"];
echo $ord_status
?>

<head>
    <script type="text/javascript">
        function myFunction() {

            var tranferType = "<?php echo $tranferType ?>";
            var status_code = "<?php echo $status_code ?>";
            if (status_code == 2) {
                document.getElementById("status").disabled = true;
            }

            if (tranferType != "2") {

                document.getElementById('input1').style.display = 'none';

            } else {

                document.getElementById('input1').style.display = 'block';
            }
        }

        // function disableChangStatus(ele) {
        //     if (ele == 2) {
        //     document.getElementById("status").disabled = true;
        //     }
        // }
    </script>




    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>itoffside.com shopping cart</title>
   
    <link href="basket/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="basket/bootstrap/css/nava.css" rel="stylesheet"> -->

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body onload="myFunction()">

    <br><br><br>
    <div class="container">

        <form name="FormName" method="post" onLoad="JavaScript:return myFunction(tranfer_id.value)" action="code/UpdateStatus.php">
            <h3 style="text-align: center;">รายละเอียดการสั่งซื้อ</h3>

            <div class="card">
                <div class="card-header">
                    แก้ไขสถานะการจัดส่ง
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <div class="col-sm-4" align="center">
                            <!-- <select name="tranferType" class="form-control" id="pagelist"> -->
                            <select name="ordstatus" class="form-control" id="status" >
                                <option>สถานะการจัดส่ง</option>
                                <?php
                                $ord_status = $row['ord_status'];

                                $sql2 = "SELECT status_code,status_desc FROM `order_stutas` WHERE status_code != $ord_status";
                                $result2 = mysqli_query($conn, $sql2);

                                foreach ($result2 as $rowStatus) {
                                    $status_code = $rowStatus['status_code'];
                                    $status_desc = $rowStatus['status_desc'];


                                    echo "<option value=\"$status_code\">$status_desc</option>";
                                }
                                ?>

                            </select><br>
                            <input type="hidden" name="od_id" value="<?php echo $row["od_id"]; ?>">
                            <input type="hidden" name="ord_id" value="<?php echo $ord_id ?>">
                            <input type="hidden" name="prd_id" value="<?php echo $prd_id ?>">
                            <input type="hidden" name="userid" value="<?php echo $userid ?>">
                            <button type="submit" class="btn btn-primary btn-sm " name="submit">แก้ไขสถานะการสั่งซื้อ</button>

                        </div>

                        <br><br>
                    </blockquote>
                </div>
            </div><br>

            <div class="card">
                <div class="card-header">
                    ข้อมูลลูกค้า
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">

                        <h5>ชื่อลูกค้า : <td><?php echo  $row['FullName'] .  " <br>";  ?></h5>
                        <h5>ประเภทการจัดส่งสินค้า : <td><?php echo  $row['tranferType'] .  " <br>";  ?></h5>
                        <h5>สถานะการจัดส่ง : <td><?php echo  $row['status_desc'] .  " <br>";  ?></h5>
                        <!-- <button type="submit" class="btn btn-primary btn-sm " name="editTranfer" onclick="displayUpdateTranstatus(input2)">แก้ไขสถานะการจัดส่ง</button> -->
                    </blockquote>



                </div>
            </div><br>

            <div id="input1">
                <div class="card">
                    <div class="card-header">
                        ข้อมูลการจัดส่ง
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">

                            <h5>ชื่อผู้รับสินค้า : <td><?php echo  $row['ord_fullname'] .  " <br>";  ?></h5>
                            <h5>ที่อยู่ : <td><?php echo  $row['ord_address'] .  " <br>";  ?></h5>
                            <h5>อีเมลล์ : <td><?php echo  $row['user_email'] .  " <br>";  ?></h2>
                                    <h5>เบอร์โทร :
                                <td><?php echo  $row['ord_tel'] .  " <br>";  ?></h2>
                        </blockquote>
                    </div>
                </div><br>
            </div>
            <div>
                <!-- <table border="0" align="center" cellspacing="1" class="display" id="example">
                    </table><br><br> -->
                <!-- Page Wrapper -->
                <div id="wrapper">
                    <!-- Content Wrapper -->
                    <div id="content-wrapper" class="d-flex flex-column">

                        <!-- Main Content -->
                        <div id="content">

                            <!-- Begin Page Content -->
                            <div class="container-fluid">

                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">ข้อมูลสินค้า</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>รูป</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <th>จำนวน</th>
                                                        <th>ราคา</th>

                                                    </tr>

                                                </thead>

                                                <tbody>
                                                    <?php

                                                    foreach ($result as $row) {
                                                        $total_price = $total_price + ($row["od_amount"] * $row["od_price"]);

                                                        echo "<tr>";
                                                        echo "<th>"; ?><img src="userprd_img/<?php echo $row["prd_img"]; ?>" height="100" width="100"><?php echo "</th>";
                                                                                                                                                        echo "<th>" . $row["prd_name"] .  "</th> ";
                                                                                                                                                        echo "<th>" .  $row["od_amount"] .  "</th> ";
                                                                                                                                                        echo "<th>" .  number_format($row["od_price"],2) .  "</th> ";
                                                                                                                                                        echo "</tr>";
                                                                                                                                                    }

                                                                                                                                                        ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <?php echo "<th>" . number_format($total_price,2) .  "</th> "; ?>
                                                    </tr>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.container-fluid -->

                        </div>
                        <!-- End of Main Content -->

                    </div>
                    <!-- End of Content Wrapper -->

                </div>
                <!-- End of Page Wrapper -->

            </div>
        </form>
    </div>
    <!-- /container -->

    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin/js/demo/datatables-demo.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="basket/bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="basket/bootstrap/js/bootstrap.min.js"></script>

</body>


</html>
<?php
mysqli_close($conn);
?>