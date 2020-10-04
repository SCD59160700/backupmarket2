<?php 
include('code/connect.php'); 
include('navbar.php'); 
$userid =$_SESSION['userid'];
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


    <!-- script datatables -->
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
    <br>
    <br>
    <div class="container">





        <div class="row">



            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><b>
                            <font size="5">
                                <center> ค้นหา ตามช่วงวันที่</center>
                            </font>
                        </b></div>
                    <div class="panel-body">




                        <form id="form1" name="form1" class="form-inline" method="post" action="exSearch.php">
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
                    <th align="center">วันที่และเวลา</th>
                    <th align="center">สถานะ</th>
                    <!-- <th align="center">ip</th>
                    <th align="center">browser</th>
                    <th align="center">os</th> -->

                </tr>
            </thead>



            <?php
            $num = 1; //บวกค่าลำดับที่
            $d_s = $_POST['d_s']; //ตัวแปรวันที่เริ่มต้น
            $d_e = $_POST['d_e']; //ตัวแปรวันที่สิ้นสุด

            $d_s = $d_s . " " . '00.00.00'; //กำหนดเวลาเริ่มต้น

            $d_e = $d_e . " " . '23.59.59'; //กำหนดเวลาสิ้นสุด

            echo $d_s;
            echo "<br>";
            echo $d_e;
            echo "<br>";


                        $query = "SELECT * FROM orders WHERE create_at BETWEEN '$d_s' AND '$d_e' AND user_id=$userid"
                            ;

            //             $query = "SELECT * FROM orders
            // where timestamp BETWEEN '$d_s' AND '$d_e' ORDER BY id ASC "
            //                 or die("Error:" . mysqli_error($conn));

            // $meSql = "SELECT DISTINCT o.create_at,p.prd_name,o.ord_status FROM orders_detail od,product p,orders o 
            //     WHERE p.prd_id=od.prd_id 
            //     AND o.ord_id=od.ord_id 
            //     AND user_id=$userid AND DATHTIMES BETWEEN '$d_s' AND '$d_e' ORDER BY id ASC";

            // $query = "SELECT DISTINCT o.create_at,p.prd_name,o.ord_status 
            //     FROM orders_detail od,product p,orders o 
            //     WHERE p.prd_id=od.prd_id AND o.ord_id=od.ord_id AND user_id=$userid";

            // if (isset($d_s) && isset($d_e)) {
            //     $query .= "AND create_at BETWEEN '$d_s' AND '$d_e'";
            // } else {
            //     # code...
            // }
            

            //ประกาศตัวแปร sqli
            $result = mysqli_query($conn, $query); //ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น

            $num2 = mysqli_num_rows($result);


            echo $num2;
            //สร้างตัวแปร $row มารับค่าจากการ fetch array


            //วนลูป
            while ($row = mysqli_fetch_array($result)) {  ?>

                <tr>
                    <td><?php echo $num++; ?>
                    </td>
                    <td><?php echo $row['prd_name']; ?></td>
                    <td><?php echo $row['create_at']; ?></td>
                    <td><?php echo $row['ord_status']; ?></td>
                    <!-- <td><?php echo $row['ip']; ?></td>
                    <td><?php echo $row['browser']; ?></td>
                    <td><?php echo $row['os']; ?></td> -->
                </tr>




            <?php }
            
            mysqli_close($conn); //ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น
            ?>
        </table>

    </div>

</body>

</html>