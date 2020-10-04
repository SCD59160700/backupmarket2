<?php
include('header.php');
include('navbar.php');
include('code/connect.php');

$prd_id = $_REQUEST["ID"];
//2. query ข้อมูลจากตาราง:
$sql = "SELECT * FROM product WHERE prd_id ='$prd_id' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
extract($row);
?>
<!DOCTYPE html>
<html lang="en">



<body id="page-top">


  <!-- Begin Page Content -->
  <div class="container">
    <br>

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0 ">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
          <div class="col-lg-7 mx-auto">
            <div class="p-5 ">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">แก้ไขข้อมูลสินค้า</h1>
              </div>
              <form class="แก้ไขข้อมูลสินค้า" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="prd_id" value="<?php echo $prd_id; ?>">
                <input type="hidden" name="prd_img" value="<?php echo $prd_img; ?>">
                <div class="form-group ">
                  <!-- <div class="col-sm-2" align="right"> รูป </div> -->
                  <div class="col-sm-3">
                    <input type="file" name="prd_img" />
                    <br>
                  </div>
                </div>
                <div class="form-group">
                  <input name="prd_name" type="text" class="form-control form-control" placeholder="ชื่อสินค้า" value="<?= $prd_name; ?>">
                </div>
                <div class="form-group">
                  <input name="prd_detail" type="text" class="form-control form-control" placeholder="รายละเอียดสินค้า" value="<?= $prd_detail; ?>">
                </div>
                <div class="form-group">
                  <input name="prd_stock" type="number" class="form-control form-control" placeholder="จำนวน" value="<?= $prd_stock; ?>">
                </div>
                <div class="form-group">
                  <input name="prd_price" type="text" class="form-control form-control" placeholder="ราคา" value="<?= $prd_price; ?>">
                </div>


                <div class="form-group row">
                  <div class="col-sm-2 ml-auto" align="right"> </div>
                  <div class="col-sm-6 ml-auto" align="right">
                    <button name="submit" type="submit" class="btn btn-success" id="btn"><span class="glyphicon glyphicon-ok"></span> บันทึก </button>
                    <button type="submit" class="btn btn-primary" id="btnBack" formaction="userprd_list.php">ย้อนกลับ</button>
                  </div>
                </div>

                <?php
                if (isset($_POST['submit'])) {

                  $prd_name = $_POST['prd_name'];
                  $prd_detail = $_POST['prd_detail'];
                  $prd_stock = $_POST['prd_stock'];
                  $prd_price = $_POST['prd_price'];


                  if ($prd_name == null) {
                    // echo '2';
                    echo "<script type='text/javascript'>";
                    echo "alert('กรุณาระบุชื่อสินค้า');";
                    echo "</script>";
                  } elseif ($prd_detail == null) {
                    // echo '3';
                    echo "<script type='text/javascript'>";
                    echo "alert('กรุณาระบุรายละเอียดสินค้า');";
                    echo "</script>";
                  } elseif ($prd_stock == null) {
                    echo "<script type='text/javascript'>";
                    echo "alert('กรุณาระบุจำนวนสินค้า');";
                    echo "</script>";
                  } elseif ($prd_price == null) {
                    echo "<script type='text/javascript'>";
                    echo "alert('กรุณาระบุราคาสินค้า');";
                    echo "</script>";
                  } else {
                    include('code/userprd_form_edit_db.php');
                    echo "<script type='text/javascript'>";
                    echo "alert('แก้ไขข้อมูลสำเร็จ');";
                    echo "window.location.href = 'userprd_list.php'";
                    echo "</script>";
                  }
                }
                ?>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->


</body>

</html>