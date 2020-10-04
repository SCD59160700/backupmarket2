<?php
include('code/connect.php');
include('navbar.php');
session_start();

?>

<html>



<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="author" content="colorlib.com">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet" />
  <link href="index3/css/main.css" rel="stylesheet" />
  <!-- start Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>


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
            <i class="fa fa-calendar" style="font-size:30px;">
            </i>
          </div>
          <input class="datepicker" id="return" type="text" name="calen" />
        </div>

        <div class="input-field fifth-wrap">
          <input type="hidden" value="test" name="test">
          <button class="btn-search" type="submit" name="submit">ค้นหา</button>
        </div>
        <br>
      </div>
      <br>
      <div class="row">
        <?php

        $test = $_POST['test'];

        if (isset($_POST['submit'])) {

          $selected = $_POST['ddlsearch'];
          $search = $_POST['textsearch'];
          $calen = $_POST['calen'];
          $nameOfDay = date('D', strtotime($calen));

          if ($selected == 0) {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาระบุเงื่อนไขในการค้นหา');";
            echo "</script>";
          } elseif ($selected != 0 && $selected != 5 && $search == null) {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาใส่ข้อมูลการค้นหา');";
            echo "</script>";
          } elseif ($selected != 0 && $selected == 5 && $calen == null) {
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
            } elseif (isset($search) && $selected == 2) {
              $sql .= "AND prd_name LIKE '%$search%'";
            } elseif (isset($search) && $selected == 3) {
              $sql .= "AND mk_name LIKE '%$search%'";
            } elseif (isset($search) && $selected == 4) {
              $sql .= "AND mk_type LIKE '%$search%'";
            } elseif (isset($calen) && $selected == 5) {
              $sql .= "AND mk_date LIKE '%$nameOfDay%' ";
            }

            $result = mysqli_query($conn, $sql);
            $rowcount = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result);

            if ($rowcount == 0) {
              // echo 'ไม่พบข้อมูล';
              // echo  'ไม่พบข้อมูล';
              echo "<script type='text/javascript'>";
              echo "alert('ไม่พบข้อมูลการค้นหา');";
              echo "</script>";
              //   // echo 'aaa?a';
            }
        //   }
        // }
        
      // </div>


      // <div class="row">
        if (isset($row)) {
          foreach ($result as $row_shop) { 

            $shop_id = $row_shop['shop_id'];
            $shop_img = $row_shop['shop_img'];
            $shop_name = $row_shop['shop_name'];

        ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card" style="width: 18rem;">
                <a name="shopid" href="cartshop.php?shop_id=$shop_id">
                  <!-- <img class="card-img-top" src="shop_img/<?php echo $shop_img ?>" alt="error"></a> -->
                  <?php if (isset($_SESSION['userid'])) {
                    echo "<a name=\"shopid\" href=\"cartshop.php?shop_id=$shop_id\">
                  <img class=\"card-img-top\" src=\"shop_img/$shop_img\" alt=\"error\"></a>";
                  } else {
                    echo "<a name=\"shopid\" href=\"cartshop_show.php?shop_id=$shop_id\">
                  <img class=\"card-img-top\" src=\"shop_img/$shop_img\" alt=\"error\"></a>";
                  } ?>
                  <div class="card-body">
                    <h4 class="card-title">
                      <!-- <a name="shopid" href="cartshop.php?shop_id=$shop_id">$shop_name</a> -->
                      <?php
                      if (isset($_SESSION['userid'])) {
                        echo  "<a name=\"shopid\" href=\"cartshop.php?shop_id=$shop_id\">$shop_name</a>";
                      } else {
                        echo  "<a name=\"shopid\" href=\"cartshop_show.php?shop_id=$shop_id\">$shop_name</a>";
                      } ?>
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

      <!-- }
        } -->
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