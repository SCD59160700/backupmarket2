<?php
session_start();
include('header.php');
include('navbar.php');
// include('exNavbar.php');
//1. เชื่อมต่อ database:
include('code/connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//2. query ข้อมูลจากตาราง tb_admin:
$query = "SELECT product.*,shop.shop_id FROM `product`,`shop` WHERE product.shop_id=shop.shop_id AND shop.user_id=".$_SESSION['userid'];
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result = mysqli_query($conn, $query);
//5. close connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">



  <!-- Custom fonts for this template -->
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>


<body id="page-top">


  <div class="container">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- <h6 class="m-0 font-weight-bold text-primary">ตารางสินค้า</h6> -->
        <br>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">ข้อมูลสินค้าในร้านของท่าน</h1>
              <a href="userprd_form_add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-auto"><i class="fas fa-download fa-sm text-white-50"></i>เพิ่มสินค้า</a>
            </div>
            <thead>
              <tr>
                <th width="3%">รหัส</th>
                <th width="3%">รูป</th>
                <th>สินค้า</th>
                <th width="5%">จำนวน</th>
                <th width="5%">ราคา</th>
                <th width="3%">แก้ไข</th>
                <th width="3%">ลบ</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>รหัส</th>
                <th>รูป</th>
                <th>สินค้า</th>
                <th>จำนวน</th>
                <th>ราคา</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<th>" . $row["prd_id"] .  "</th> ";
                echo "<th>";?><img src="userprd_img/<?php echo $row["prd_img"];?>" height="100" width="100"><?php echo "</th>";
                echo "<th>" . $row["prd_name"] .  "</th> ";
                echo "<th>" . $row["prd_stock"] .  "</th> ";
                echo "<th>" . number_format($row["prd_price"], 2) .  "</th> ";
               
                //แก้ไขข้อมูล

                echo "<th><a href='userprd_form_edit.php?act=edit&ID=$row[0]' class='btn btn-success btn-xs'>แก้ไข</a></th> ";



                //ลบข้อมูล
                echo "<th><a href='code/userprd_del_db.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\" class='btn btn-danger btn-xs'>ลบ</a></th> ";
                echo "</tr>";
              }
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
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

</body>

</html>