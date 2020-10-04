<?php
include('header.php');
include('navbar.php');
include('code/connect.php')
?>
<!DOCTYPE html>
<html lang="en">
<!-- <script>
  function validateForm() {
    var product_name = document.forms["AddnewProduct"]["prd_name"].value;
    var product_detail = document.forms["AddnewProduct"]["prd_detail"].value;
    var product_stock = document.forms["AddnewProduct"]["prd_stock"].value;
    var product_price = document.forms["AddnewProduct"]["prd_price"].value;
    // if (document.getElementById('btnSubmit').clicked == true) {


      if (product_name == "") {
        alert("กรุณาระบุชื่อสินค้า");
        return false;
      }
      if (product_detail == "") {
        alert("กรุณาระบุรายละเอียดสินค้า");
        return false;
      }
      if (product_stock == "") {
        alert("กรุณาระบุจำนวนสินค้า");
        return false;
      }
      if (product_price == "") {
        alert("กรุณาระบุราคาสินค้า");
        return false;
      } else {
        alert("เพิ่มข้อมูลสำเร็จ");
        return true;
      }
      // window.location.href = "index.php";

    } else if (document.getElementById('btnBack').clicked == true) {
      window.location.href = "userprd_list.php";

    }
  }
</script> -->



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
                <h1 class="h4 text-gray-900 mb-4">เพิ่มสินค้าของฉัน</h1>
              </div>
              <!-- <form name="AddnewProduct" class="เพิ่มข้อมูลสินค้า" method="POST" action="code/userprd_form_add_db.php" enctype="multipart/form-data"> -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group ">
                  <!-- <div class="col-sm-2" align="right"> รูป </div> -->
                  <div class="col-sm-3">
                    <input type="file" name="prd_img" />
                    <br>
                  </div>
                </div>
                <div class="form-group">
                  <input name="prd_name" type="text" class="form-control form-control" placeholder="ชื่อสินค้า">
                </div>
                <div class="form-group">
                  <input name="prd_detail" type="text" class="form-control form-control" placeholder="รายละเอียดสินค้า">
                </div>
                <div class="form-group">
                  <input name="prd_stock" type="number" class="form-control form-control" placeholder="จำนวน">
                </div>
                <div class="form-group">
                  <input name="prd_price" type="text" class="form-control form-control" placeholder="ราคา">
                </div>

                <!-- onclick=myFunction(); -->

                <div class="form-group row">
                  <div class="col-sm-2 ml-auto" align="right"> </div>
                  <div class="col-sm-6 ml-auto" align="right">
                    <button name="submit" type="submit" class="btn btn-success" id="btnSubmit"><span class="glyphicon glyphicon-ok"></span> เพิ่ม </button>
                    <button name="cancel" type="submit" class="btn btn-primary" id="btnBack" formaction="userprd_list.php">ย้อนกลับ</button>
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
                    include('code/userprd_form_add_db.php');
                    echo "<script type='text/javascript'>";
                    echo "alert('เพิ่มข้อมูลสำเร็จ');";
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