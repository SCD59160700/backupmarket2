<?php
// report
session_start();
include('code/connect.php');
include('navbar.php');
$shop_id = $_SESSION['shop_id'];
echo $shop_id;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>


    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


    <!-- Custom styles for this page -->
    <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "aaSorting": [
                    [0, 'ASC']
                ],
            });
        });
    </script>

  



    <style type="text/css">
        img {
            width: 20px;
            height: auto;
        }
    </style>






</head>

<body>

    <br><br><br>
    <div class="container">





        <div class="row">



            <div class="col-md-12">

                <div class="card">
                    <div class="card-header" style="text-align: center; background-color:lavender;">
                        ประวัติการซื้อ
                    </div>
                </div><br>


                <form id="form1" name="form1" class="form-inline" method="post" action="testHistory.php">
                  
                        <div class="col-sm-3" style="margin-left: auto;">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label for="exampleInputEmail2" style="text-align: center;">วันที่ :</label>
                                    <span class="input-group-text" id="inputGroupFileAddon01"> <i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                                <div class="custom-file">
                                    <input id="datepicker" name="d_s">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin-right: auto;">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label for="exampleInputEmail2">&nbsp;ถึงวันที่ :&nbsp;</label>
                                    <span class="input-group-text" id="inputGroupFileAddon01"> <i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                                <div class="custom-file">
                                    <input id="datepicker2" name="d_e">
                                </div>
                                &nbsp;&nbsp;<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> ค้นหา</button>
                            </div>
                        </div>
                        <!-- <div class="input-group mb-3">
                        &nbsp;&nbsp;<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> ค้นหา</button>
                    </div> -->
                  

                </form><br>


            </div>

        </div>
    </div>









    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap',
            format: "yyyy-mm-dd",
            type: "date"
        });
    </script>

    <script>
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap',
            format: "yyyy-mm-dd",
            type: "date"
        });
    </script>







    </div>
    </div>


    <div class="container">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
                <br>
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">ประวัติการซื้อ</h1>

                        </div>
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อสินค้า</th>
                                <th>วันที่</th>
                                <th>สถานะการสั่งซื้อ</th>
                                <th>ดูรายละเอียด</th>
                            </tr>
                        </thead>
                        <tfoot>

                        </tfoot>
                        <tbody>
                            <?php
                            $num = 1;
                            $d_s = $_POST['d_s']; //ตัวแปรวันที่เริ่มต้น
                            $d_e = $_POST['d_e']; //ตัวแปรวันที่สิ้นสุด

                            $d_s = $d_s . " " . '00.00.00'; //กำหนดเวลาเริ่มต้น

                            $d_e = $d_e . " " . '23.59.59'; //กำหนดเวลาสิ้นสุด

                            // echo $d_s;
                            // echo "<br>";
                            // echo $d_e;
                            // echo "<br>";


                            $query = "SELECT od.ord_id,p.prd_id,o.create_at,p.prd_name,
            CASE WHEN ord_status = 1 THEN 'รอดำเนินการ'
            WHEN ord_status = 2 THEN 'ยกเลิกคำสั่งซื้อ'
            WHEN ord_status = 3 THEN 'สั่งซื้อสินค้าสำเร็จ'
            END AS ord_status
            FROM orders_detail od,product p,orders o
            WHERE p.prd_id=od.prd_id AND o.ord_id=od.ord_id AND user_id=$userid AND o.create_at BETWEEN DATE_FORMAT('$d_s','%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$d_e','%Y-%m-%d %H:%i:%s') "
                                or die("Error:" . mysqli_error($conn));
                            // echo $query;
                            //ประกาศตัวแปร sqli
                            $result = mysqli_query($conn, $query); //ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น

                            $num2 = mysqli_num_rows($result);
                            // echo $query;
                            while ($row = mysqli_fetch_array($result)) {  ?>

                                <tr>
                                    <td><?php echo $num++; ?>
                                    </td>
                                    <td><?php echo $row['prd_name']; ?></td>
                                    <td><?php echo $row['create_at']; ?></td>
                                    <td><?php echo $row['ord_status']; ?></td>
                                    <td><a href="exViewDetailPrd.php?ord_id=<?php echo $row['ord_id']; ?>&prd_id=<?php echo $row['prd_id']; ?>">ดูรายละเอียด</a></td>
                                </tr>




                            <?php }
                            mysqli_close($conn);

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>
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

</html>