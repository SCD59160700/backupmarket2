<?php
session_start();
// include('navbar.php');
require 'code/connect.php';
$userid = $_SESSION['userid'];
// $meSql = "SELECT DISTINCT o.create_at,p.prd_name,o.ord_status FROM orders_detail od,product p,orders o WHERE p.prd_id=od.prd_id AND o.ord_id=od.ord_id AND user_id=$userid";
// echo $meSql;
// $meQuery = mysqli_query($conn, $meSql);

?>
<!DOCTYPE html>
<html lang="en">
<?php
include('navbar.php');

?>

<head>
    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>itoffside.com shopping cart</title>
    
   
    <link href="basket/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="basket/bootstrap/css/nava.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <!-- <script>
        $(function() {
            $("#datepicker").datepicker();

        });
    </script> -->
    <link rel="stylesheet" type="text/css" href="datetimepicker/jquery.datetimepicker.css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <style>
        .input-group.md-form.form-sm.form-1 input {
            border: 1px solid #bdbdbd;
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }

        .input-group.md-form.form-sm.form-2 input {
            border: 1px solid #bdbdbd;
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }

        .input-group.md-form.form-sm.form-2 input.red-border {
            border: 1px solid #ef9a9a;
        }

        .input-group.md-form.form-sm.form-2 input.lime-border {
            border: 1px solid #cddc39;
        }

        .input-group.md-form.form-sm.form-2 input.amber-border {
            border: 1px solid #ffca28;
        }
    </style> -->



<body onLoad=" LoadOnce()">

    <br>
    <br>
    <br>
    <div class="container">

        <!-- Main component for a primary marketing message or call to action -->

        <form method="post" name="OrderHistory" action="OrderHistory.php">
            <br> <br><br>
            <h3 style="text-align: center;">ประวัติการซื้อ</h3><br>

            <div class="form-group row">

                <!-- <div class="input-group md-form form-sm form-2 pl-0 col-3 ">
                    <label for="date">วันที่ซื้อระหว่างวันที่</label><input type="text" name="startdate" value="" id="startdate" />
                    <label for="date">ถึง</label><input type="text" name="enddate" value="" id="enddate" />
                    <div class="input-group-append">
                        <button class="input-group-text red lighten-3" id="basic-text1" type="submit" name="submit"><i class="fa fa-calendar" aria-hidden="true"></i></button>
                    </div>
                    <button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-search"></span> ค้นหา</button>
                </div>

                <div class="input-group md-form form-sm form-2 pl-0 col-3 ">
                    <label for="date">ถึง</label><input type="text" name="enddate" value="" id="enddate" />
                    <div class="input-group-append">
                        <button class="input-group-text red lighten-3" id="basic-text1" type="submit" name="submit"><i class="fa fa-calendar" aria-hidden="true"></i></button>
                    </div>
                </div> -->
                <!-- <button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-search"></span> ค้นหา</button> -->

                <!-- <div class="input-group md-form form-sm form-2 pl-0 col-4 ml-auto">
                    <input class="form-control my-0 py-1 red-border" type="text" name="textsearch" placeholder="ค้นหา" aria-label="Search">
                    <div class="input-group-append">

                        <button class="input-group-text red lighten-3" id="basic-text1" type="submit" name="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="exampleInputName2">ชื่อสินค้า :</label>
                    <input type="text" name="textsearch" aria-label="Search" />
                </div>
                <div class="form-group">
                    <label for="exampleInputName2">วันที่ :</label>
                    <input name="startdate" id="startdate" width="270" />
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">&nbsp;ถึงวันที่ :&nbsp;</label>
                    <input name="enddate" id="enddate" width="270" />
                </div>
                <div class="form-group">
                    &nbsp;&nbsp;<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> ค้นหา</button></center>
                </div>

            </div><br>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อสินค้า</th>
                        <th>วันที่</th>
                        <th>สถานะ</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $num = 1; //บวกค่าลำดับที่
                    $d_s = $_POST['startdate']; //ตัวแปรวันที่เริ่มต้น
                    $d_e = $_POST['enddate']; //ตัวแปรวันที่สิ้นสุด
                    $textsearch = $_POST['textsearch']; //ตัวแปรวันที่สิ้นสุด
                    $submit = $_POST['submit']; //ตัวแปรวันที่สิ้นสุด

                    $d_s = $d_s . " " . '00.00.00'; //กำหนดเวลาเริ่มต้น

                    $d_e = $d_e . " " . '23.59.59'; //กำหนดเวลาสิ้นสุด

                    echo $d_s;
                    echo "<br>";
                    echo $d_e;
                    echo "<br>";


                    $query = "SELECT o.create_at,p.prd_name,o.ord_status
                    FROM orders_detail od,product p,orders o
                    WHERE p.prd_id=od.prd_id AND o.ord_id=od.ord_id AND user_id=$userid ";

                    if (isset($textsearch)) {
                        $query .= "AND p.prd_name='$textsearch'";
                    } elseif (isset($d_s) && isset($d_e)) {
                        $query .= "AND o.create_at BETWEEN DATE_FORMAT('$d_s','%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$d_e','%Y-%m-%d %H:%i:%s')";
                    }

                    $result = mysqli_query($conn, $query); //ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น

                    $num2 = mysqli_num_rows($result);

                    echo $query;
                    // echo $num2;



                    while ($meResult = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><?php echo $meResult['prd_name']; ?></td>
                            <td><?php echo $meResult['create_at']; ?></td>
                            <td><?php echo $meResult['ord_status']; ?></td>
                            <td><a href="exBill2.php">รายละเอียด</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>

    </div>
    <!-- /container -->

    <!-- <script src="basket/bootstrap/js/bootstrap.min.js"></script> -->

</body>
<script type="text/javascript" src="datetimepicker/jquery.js"></script>
<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
<script>
    $('#startdate').datetimepicker({
        timepicker: false,
        format: 'd/m/Y',
        lang: 'th'
    });
</script>
<script>
    $('#enddate').datetimepicker({
        timepicker: false,
        format: 'd/m/Y',
        lang: 'th'
    });
</script>

</html>
<?php
mysqli_close($conn);
?>