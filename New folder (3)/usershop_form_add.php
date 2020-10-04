<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
include('navbar.php');
include('code/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  

  <!-- Custom fonts for this template-->
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">เพิ่มร้านค้าของฉัน</h1>
                  </div>
                  <form class="user" action="code/usershp_form_add_db.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                  <!-- <div class="col-sm-2" align="right"> รูป </div> -->
                  <div class="col-sm-3" align="left">
                    <input type="file" name="shop_img" id="shop_img" />
                  </div>
                </div>
                <br>
                <div class="form-group ">
                  <input name="shop_name" type="text" class="form-control form-control" placeholder="ชื่อร้านค้า" required>
                </div>
                <div class="form-group ">
                  <textarea name="shop_detail" type="text" class="form-control form-control" placeholder="รายละเอียดสินค้า"></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8" align="left">
                        <select name="mk_id" class="form-control" >
                            <option>กรุณาเลือกตลาด</option>
                            <?php
                            $sql = "select * from market";
                            $dbquery = mysqli_query($conn,$sql);
                            while($rw = mysqli_fetch_array($dbquery)){?>
                            <option value="<?=$rw['mk_id']?>"><?=$rw['mk_name']?></option>
                            <? }?>
                        </select>
                    </div>
                </div>
                    <div class="form-group ">
                        <textarea name="shop_cd_condition" type="text" class="form-control form-control" placeholder="รายละเอียดการสั่งซื้อ"></textarea>
                    </div>
                    <div class="form-group ">
                        <textarea name="shop_contact" type="text" class="form-control form-control" placeholder="ข้อมูลการติดต่อ"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2"> </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success" id="btn"><span class="glyphicon glyphicon-ok"></span> เพิ่ม </button>
                                <!-- <button type="submit" class="btn btn-primary" id="btnBack" formaction="index.php"> ย้อนกลับ</button> -->
                            </div>
                    </div>
              </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="admin/vendor/jquery/jquery.min.js"></script>
  <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin/js/sb-admin-2.min.js"></script>

</body>

</html>
