<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="reg2/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="reg2/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- reg2/Vendor CSS-->
    <link href="reg2/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="reg2/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="reg2/css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info<h4 class="title">สมัครสมาชิก</h4></h2>
                    <!-- <h4 class="title">สมัครสมาชิก</h4> -->

                    <form action="code/add_reg_db.php" method="post">
                        <div class="input-group">
                            <i class="fa fa-user-circle input-icon" aria-hidden="true"></i>
                            <input class="input--style-2" type="text" placeholder=" Username" name="username" required>
                        </div>
                        <div class="input-group">
                            <i class="fa fa-lock input-icon" aria-hidden="true"></i>
                            <input class="input--style-2" type="password" placeholder=" Password" name="password" required>
                        </div>
                        <div class="input-group">
                          <i class="fa fa-address-card-o input-icon" aria-hidden="true"></i>
                            <input class="input--style-2" type="text" placeholder=" Firstname/ชื่อ:Chittapol" name="firstname" required pattern="[A-Za-zก-ฮ^()/><\][\\\x22,;|+]{1,}">
                        </div>
                        <div class="input-group">
                          <i class="fa fa-address-card-o input-icon" aria-hidden="true"></i>
                            <input class="input--style-2" type="text" placeholder=" Lastname/นามสกุล:Leechai" name="lastname" required pattern="[A-Za-zก-ฮ]{1,}">
                        </div>
                        <div class="input-group">
                            <i class="fa fa-envelope input-icon" aria-hidden="true"></i>
                            <input class="input--style-2" type="email" placeholder=" E-mail/อีเมลล์:example@hotmail.com" name="email" required>
                        </div>
                        <div class="input-group">
                            <i class="fa fa-phone input-icon" aria-hidden="true"></i>
                            <input class="input--style-2" type="tel" placeholder=" Tel./เบอร์โทรศัพท์:08xxxxxxxx" name="tel" required pattern="[0-9]{1,}" maxlength="10">
                        </div>
                        <div class="input-group">
                            <i class="fa fa-home input-icon" aria-hidden="true"></i>
                            <input class="input--style-2" type="text" placeholder=" Address/ที่อยู่:123 ม.4 ต.แสนสุข อ.เมือง จ.ชลบุรี 20131" name="address" required>
                        </div>

                        <!-- <div class="p-t-30"> -->
                            <button class="btn btn--radius btn--green" type="submit" name="submit">Register</button>
                            <!-- <button class="btn btn--radius btn--blue" type="btnBlack" formaction="index.php" name="submit">Black</button> -->
                        <!-- </div> -->
                    </form>
                </div>
                <button class="btn btn--radius btn--blue" type="btnBlack" formaction="index.php" name="submit">Black</button>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="reg2/vendor/jquery/jquery.min.js"></script>
    <!-- reg2/Vendor JS-->
    <script src="reg2/vendor/select2/select2.min.js"></script>
    <script src="reg2/vendor/datepicker/moment.min.js"></script>
    <script src="reg2/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="reg2/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->