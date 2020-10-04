<?php
include('code/connect.php');
include('navbar.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="bt/css/bootstrap.min.css" rel="stylesheet">
    <link href="bt/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js">
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />



    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "aaSorting": [
                    [0, 'ASC']
                ],
            });
        });
    </script>

    <title>my backend</title>



    <style type="text/css">
        img {
            width: 20px;
            height: auto;
        }
    </style>






</head>

<body>

    <br>
    <div class="container">





        <div class="row">



            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading"><b>
                            <font size="5">
                                <center> ประวัติการสั่งซื้อ</center>
                            </font>
                        </b></div>
                    <div class="panel-body">




                        <form id="form1" name="form1" class="form-inline" method="post" action="exOrderHistory.php">
                            <center>
                                <div class="form-group">
                                    <label for="exampleInputName2">วันที่ :</label>
                                    <input name="d_s" id="datepicker" width="270" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">&nbsp;ถึงวันที่ :&nbsp;</label>
                                    <input name="d_e" id="datepicker2" width="270" />
                                </div>
                                &nbsp;&nbsp;<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> ค้นหา</button>
                            </center>
                        </form>







                    </div>
                </div>
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

        <table border="0" align="center" cellspacing="1" class="display" id="example">
            <!--ส่วนหัว-->
            <thead>
                <tr>
                    <th align="center">ลำดับ</th>
                    <th align="center">ชื่อสินค้า</th>
                    <th align="center">วันที่</th>
                    <th align="center">สถานะการสั่งซื้อ</th>
                    <th align="center">ดูรายละเอียด</th>
                    <!-- <th align="center">browser</th>
<th align="center">os</th>
<th align="center">วันที่และเวลา</th> -->

                </tr>
            </thead>



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
            echo $query;
            //ประกาศตัวแปร sqli
            $result = mysqli_query($conn, $query); //ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น

            $num2 = mysqli_num_rows($result);


            echo $ord_id;
            //สร้างตัวแปร $row มารับค่าจากการ fetch array


            //วนลูป
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
            mysqli_close($conn); //ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น
            ?>
        </table>

    </div>

</body>

</html>


<?php
SELECT
od.ord_id,
p.prd_id,
o.create_at,
p.prd_name,
CASE WHEN ord_status = 1 THEN 'รอดำเนินการ' WHEN ord_status = 2 THEN 'ยกเลิกคำสั่งซื้อ' WHEN ord_status = 3 THEN 'สั่งซื้อสินค้าสำเร็จ'
END AS ord_status
FROM
orders_detail od,
product p,
orders o
WHERE
p.prd_id = od.prd_id AND o.ord_id = od.ord_id AND user_id = 100 AND o.create_at BETWEEN DATE_FORMAT(
    '2020-09-24 00.00.00',
    '%Y-%m-%d %H:%i:%s'
) AND DATE_FORMAT(
    '2020-09-24 23.59.59',
    '%Y-%m-%d %H:%i:%s'
)

SELECT
    od.ord_id,
    p.prd_id,
    o.create_at,
    p.prd_name,
    CONCAT(u.user_fname, ' ', u.user_lname) AS FullName,
    u.user_id,
    ord_tranferType,
    os.status_code,
    CASE WHEN ord_status = 1 THEN 'รอดำเนินการ' WHEN ord_status = 2 THEN 'ยกเลิกคำสั่งซื้อ' WHEN ord_status = 3 THEN 'สั่งซื้อสินค้าสำเร็จ'
END AS ord_status
FROM
    orders_detail od,
    product p,
    orders o,
    shop s,
    USER u,
    order_stutas os
WHERE
    p.prd_id = od.prd_id AND o.ord_id = od.ord_id AND p.shop_id = s.shop_id AND s.shop_id = 17 AND o.user_id = u.user_id AND o.create_at BETWEEN DATE_FORMAT(
        '2020-09-24 00.00.00',
        '%Y-%m-%d %H:%i:%s'
    ) AND DATE_FORMAT(
        '2020-09-24 23.59.59',
        '%Y-%m-%d %H:%i:%s'
    ) AND o.ord_status = os.status_code

?>