<?php
session_start();
include('navbar.php');
require 'code/connect.php';
// include 'code/UpdateStatus.php';
$tranferType = $_GET['tranferType'];
echo $tranferType;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript">
        function myFunction() {
            
            var tranferType = "<?php echo $tranferType ?>";

            // var tranfer = document.getElementById("tranfer_id").value;
            if (tranferType != "2") {
                document.getElementById('input1').style.display = 'none';
                // document.getElementById("input1").hidden = true;


            } else {
                // alert(tranferType);
                document.getElementById('input1').style.display = 'block';
            }
        }
    </script>
    <!-- <form name="FormName" method="post" />
    <input type="text" id="nameValidation" value="HelloWorld" onchange="myFunction()" />

    </form>
    <script type="text/javascript">
        function myFunction() {
            var NameValue = document.forms["FormName"]["nameValidation"].value;
            alert(NameValue);
        }
    </script> -->




</head>
<!-- <body onload="javaScript:document.form1.nationAdd.style.display='none'"> -->

<body onload="myFunction()">

    <br><br><br>
    <!-- <div class="container">

        <form name="FormName" method="post">
            <h3 style="text-align: center;">รายละเอียดการสั่งซื้อ</h3>

           

            <div class="card">
                <div class="card-header">
                    ข้อมูลลูกค้า
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">

                        <h5>ชื่อลูกค้า : <td><?php echo  $row['FullName'] .  " <br>";  ?></h5>
                        <h5>ประเภทการจัดส่งสินค้า : <td><?php echo  $row['tranferType'] .  " <br>";  ?></h5>
                    </blockquote>
                </div>
                <input type="text" value="2" id="tranfer_id">
            </div><br>

                <div class="card" id="input1">
                    <div class="card-header">
                        ข้อมูลการจัดส่ง
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">

                            <h5>ชื่อผู้รับสินค้า : <td><?php echo  $row['ord_fullname'] .  " <br>";  ?></h5>
                            <h5>ที่อยู่ : <td><?php echo  $row['ord_address'] .  " <br>";  ?></h5>
                            <h5>อีเมลล์ : <td><?php echo  $row['user_email'] .  " <br>";  ?></h2>
                                    <h5>เบอร์โทร :
                                <td><?php echo  $row['ord_tel'] .  " <br>";  ?></h2>
                        </blockquote>
                    </div>
                </div><br>
          
            
        </form>
    </div> -->
    <!-- /container -->
    <div>
        <input type="hidden" value="2" name="$tranferType">

    </div>

    <div id="input1">
    <input type="text" value="hello" name="$tranferType">
    11111
      
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="basket/bootstrap/js/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="basket/bootstrap/js/bootstrap.min.js"></script> -->

</body>


</html>
<?php
mysqli_close($conn);
?>