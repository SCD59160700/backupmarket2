<?php
session_start();

$userid = $_SESSION['userid'];
$usertype = $_SESSION['usertype'];
// $shop_id = $_SESSION['temp_shopId'];

// $meQty = $_SESSION['meQty'];
// echo $shop_id;
// include('head.php');
include('code/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php header("Cache-Control: public,max-age=60, s-maxage=60"); ?>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Market</title>

</head>

<body>

    <div>
        <hr>
        <nav class="container-fluid navbar navbar-expand-sm bg-dark navbar-dark" style="padding-left: 75px; margin-top: -16px;">
            <ul class="navbar-nav">
                <li class="active nav-item">
                    <a class="nav-link active" style="padding-left: 0px; color: white;" href="userprd_list.php">Most Popular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userprd_list.php" style="color: white">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white">Sports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white">Science</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white">Politics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white">Economics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white">Random</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " style="padding-left: 480px; color: white; " href="#">Log in</a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>
<script>
    $('.nav li').click(function() {
        $('.nav li').removeClass('active');
        $(this).addClass('active');
    })
</script>