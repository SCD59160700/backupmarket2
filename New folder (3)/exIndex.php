<?php include('code/connect.php');
include('navbar.php');
session_start();



?>

<html>



<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="author" content="colorlib.com">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet" />
  <link href="index3/css/main.css" rel="stylesheet" />
  <!-- start Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <!-- Navbar -->
  <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand " href="index.php">MARKET</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="login1.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register2.php">Register</a>
        </li>
      </ul>
    </div>
  </nav> -->
  <!-- Navbar -->

  <div class="s002">
    <form method="POST">
      <div class="inner-form">
        <div class="input-field fouth-wrap">
          <div class="input-select">
            <select data-trigger="" name="ddlsearch">
              <option placeholder="" value="0">ระบุเงื่อนไข</option>
              <option value="1">ชื่อร้านค้า</option>
              <option value="2">ชื่อสินค้า</option>
              <option value="3">ชื่อตลาด</option>
              <option value="4">ประเภทตลาด</option>
              <!-- <option value="5">วันที่เปิด</option> -->
            </select>
          </div>
        </div>

        <div class="input-field first-wrap">
          <input id="search" type="text" placeholder="ค้นหาตลาดของคุณ?" name="textsearch" />
        </div>

        <div class="input-field third-wrap">
          <div class="icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
            </svg>
          </div>
          <input class="datepicker" id="return" type="text" name="calen" placeholder="" />
        </div>

        <div class="input-field fifth-wrap">
          <input type="hidden" value="test" name="test">
          <button class="btn-search" type="submit" name="submit">ค้นหา</button>
          <!-- <button class="btn-search" type="button">ค้นหา</button> -->
        </div>
        <br>
      </div>
      <br>
      <div class="row">

        <?php

        # code...

        $test = $_POST['test'];
        // $calen = $_POST['calen'];
        // $nameOfDay = date('D', strtotime($calen));
        // echo $nameOfDay;
        // echo $calen;
        // if ($test != null) {
        // $calen = $_POST['calen'];
        // $nameOfDay = date('D', strtotime($calen));
        // echo $nameOfDay;

        if (isset($_POST['submit'])) {

          $selected = $_POST['ddlsearch'];
          $search = $_POST['textsearch'];
          $calen = $_POST['calen'];
          $nameOfDay = date('D', strtotime($calen));
          // echo $nameOfDay;

          if ($selected == 0) {
            // echo '2';
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาระบุเงื่อนไขในการค้นหา');";
            // echo "alert('กรุณาใส่ข้อมูลในการค้นหา');";
            echo "</script>";
          } elseif ($selected != 0 && $selected != 5 && $search == null) {
            // echo '3';
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาระใส่ข้อมูลการค้นหา');";
            echo "</script>";
          } elseif ($selected != 0 && $selected == 5 && $calen == null) {
            // elseif ($search == null && $selected != null) {
            // echo '4';
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาระบุวันที่');";
            echo "</script>";
          } elseif ($selected != 0 && $selected == 5 && $search != null) {
            echo "<script type='text/javascript'>";
            echo "alert('ระบุคำค้นไม่ตรงกับเงื่อนไขที่เลือก');";
            echo "</script>";
          } else {

            $sql = "SELECT DISTINCT s.shop_id,s.shop_img,s.shop_name,CONCAT(u.user_fname, ' ', u.user_lname) AS FullName,m.mk_name,m.mk_type,m.mk_date
               FROM market m,shop s,product p,user u
               WHERE m.mk_id=s.mk_id AND p.shop_id=s.shop_id AND s.user_id=u.user_id AND s.shop_status='active' AND m.mk_status='active'";

            if (isset($search) && $selected == 1) {
              $sql .= "AND shop_name LIKE '%$search%'";
              // echo $sql;
            } elseif (isset($search) && $selected == 2) {
              $sql .= "AND prd_name LIKE '%$search%'";
              // echo $sql;
            } elseif (isset($search) && $selected == 3) {
              $sql .= "AND mk_name LIKE '%$search%'";
              // echo $sql;
            } elseif (isset($search) && $selected == 4) {
              $sql .= "AND mk_type LIKE '%$search%'";
              // echo $sql;
            } elseif (isset($calen) && $selected == 5) {
              $sql .= "AND mk_date LIKE '%$nameOfDay%' ";
              // echo $sql;
            }
            // if (isset($calen)) {
            //   $sql .= "AND mk_date LIKE '%$nameOfDay%' ";
            //   // echo $sql;
            // }

            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result) or die(mysqli_error($conn));
            $rowcount = mysqli_num_rows($result);

            echo $rowcount;

            // echo $result;
            // echo $row;
            // if ($selected != 0 && $search != null && !isset($row)) {
            if ($rowcount == null) {
              echo 'ไม่พบข้อมูล';
              // echo  'ไม่พบข้อมูล';
              // echo "<script type='text/javascript'>";
              // echo "alert('ไม่พบข้อมูลการค้นหา');";
              // echo "</script>";
              //   // echo 'aaa?a';
            }
            //  echo $rowcount;

            // }







            if (isset($row)) {

              foreach ($result as $row_shop) { ?>

                <div class="row">
                  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="width: 18rem;">
                      <img class="card-img-top" src="shop_img/<?php echo $row_shop['shop_img'] ?>" alt="error">

                      <div class="card-body">
                        <h4 class="card-title">
                          <?php
                          $shop_id = $row_shop['shop_id'];
                          $shop_name = $row_shop['shop_name'];
                          if (isset($_SESSION['userid'])) {
                            // echo  "<a name=\"shopid\" href=\"cartshop.php?shop_id=$row_shop['shop_id']\" style=\"color:#000\"$row_shop['shop_name']></a>";
                            echo  "<a name=\"shopid\" href=\"cartshop.php?shop_id=$shop_id\">$shop_name</a>";
                            // echo "<a href='$shop_name'>$shop_name</a>";

                          } else {
                            echo  "<a name=\"shopid\" href=\"cartshop_show.php?shop_id=$shop_id\">$shop_name</a>";
                          }

                          ?>
                        </h4>
                        <h5><?php echo $row_shop['FullName']; ?></h5>
                        <p class="card-text">
                          <?php echo $row_shop['mk_name']; ?><br>
                          <?php echo $row_shop['mk_type']; ?><br>
                          <?php echo $row_shop['mk_date']; ?>
                        </p>
                      </div>
                    </div>
                  </div>

          <?php } 
            }
          }
        }
          ?>
                </div>
    </form>
  </div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- JS Template -->
  <script src="index3/js/extention/choices.js"></script>
  <script src="index3/js/extention/flatpickr.js"></script>
  <script>
    flatpickr(".datepicker", {});
  </script>
  <script>
    const choices = new Choices('[data-trigger]', {
      searchEnabled: false,
      itemSelectText: '',
    });
  </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>