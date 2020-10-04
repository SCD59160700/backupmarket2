<?php
session_start();
// include('head.php');
// include('header.php');
include('navbar.php');
include('code/connect.php');  //ไฟล์เชื่อมต่อกับ database 
$userid = $_SESSION['userid'];
// $shop_id = $_REQUEST['shop_id'];
//2. query ข้อมูลจากตาราง:
$sql = "SELECT shop.*,market.mk_name, market.mk_id FROM `shop`,`market` WHERE shop.mk_id=market.mk_id AND shop.user_id=$userid ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
extract($row);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Business Frontpage - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-frontpage.css" rel="stylesheet">
    </head>

<body id="page-top">

    <!-- ส่วนแสดงรูปร้านค้า -->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <?php
                echo   "<img style=\"width:1300px;height:400px;display:block;margin-left: auto;margin-right: auto;\" class=\"img-resize\" src=\"shop_img/$shop_img\" alt=\"First slide\">";
                ?>
            </div>
        </div>
    </div>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading ข้อมูลร้านค้า -->
        <br>

        <h1 class="h3 mb-2 text-gray-800" align="center"> แก้ไขข้อมูลร้านค้า</h1>

        <form name="shopshowuser" method="POST" class="form-horizontal" action="code/usershp_form_edit_db.php" enctype="multipart/form-data">

        <input type="hidden" name="shop_id" value="<?php echo $shop_id; ?>">
        <input type="hidden" name="shop_img" value="<?php echo $shop_img; ?>">
<!--         
            <div class="form-group" align="right">
                <div class="col-sm-2" align="auto"><button type="submit" class="btn btn-primary" id="btn"><span class="glyphicon glyphicon-ok"></span> บันทึก </button></div>
                <div class="col-sm-4" align="right">
                        </div>
            </div> -->
            <div class="form-group"  align="center">
                  <!-- <div class="col-sm-2" align="right"> รูป </div> -->
                  <div class="col-sm-3" align="left">
                    <input type="file" name="shop_img" id="shop_img" />
                  </div>
            </div>
            <div class="form-group" align="center">
                <div class="col-sm-2" align="center"> ชื่อร้านค้า </div>
                <div class="col-sm-3">
                    <input name="shop_name" type="text" required class="form-control" value="<?php echo $shop_name; ?>" />
                </div>
            </div>
            <div class="form-group" align="center">
                <div class="col-sm-2" align="center"> รายละเอียดสินค้า </div>
                <div class="col-sm-3" align="left">
                    <input name="shop_detail" type="text" required class="form-control" value="<?php echo $shop_detail; ?>" />
                </div>
            </div>
            <div class="form-group" align="center">
                    <div class="col-sm-3" > รายชื่อตลาด
                        <select name="mk_id" class="form-control" >
                            <?php
                           echo" <option value='$mk_id'>$mk_name</option>";
                            $sql = "select * from market";
                            $dbquery = mysqli_query($conn,$sql);
                            while($rw = mysqli_fetch_array($dbquery)){?>
                            <option value="<?=$rw['mk_id']?>"><?=$rw['mk_name']?></option>
                            <? }?>
                        </select>
                    </div>
            </div>
            <div class="form-group" align="center">
                <div class="col-sm-2" align="center"> เงื่อนไขการสั่งซื้อ </div>
                <div class="col-sm-3" align="left">
                    <input name="shop_cd_condition" type="text" required class="form-control" value="<?php echo $shop_cd_condition; ?>" />
                </div>
            </div>
            <div class="form-group" align="center">
                <div class="col-sm-2" align="center"> ข้อมูลการติดต่อ </div>
                <div class="col-sm-3" align="left">
                    <input name="shop_contact" type="text" required class="form-control" value="<?php echo $shop_contact; ?>" />
                </div>
            </div>

            <div class="col-sm-3 mx-auto">
            <button type="submit" class="btn btn-primary btn-user btn-block" >บันทึกข้อมูล</button>
            </div>
        </form>

    </div>   

</body>

</html>
<br>
<br>
<br>
<?php include('footer.php'); ?>