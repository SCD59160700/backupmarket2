<?php
include('code/connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
include('navbar.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
// $ID = $_GET['ID'];
$userid = $_GET['userid'];
$sql = "SELECT * FROM user WHERE user_id=$userid";
$result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
$row = mysqli_fetch_array($result);
extract($row);
?>
<div class="container-fluid"><br><br><br><br>
    <!-- <h4 style="text-align: -moz-center;"> แก้ไขรหัสผ่าน</h4> -->
    
    <!-- <div class="col-sm-3 card" style="text-align:-moz-center;;background-color:#FFFFCC  ;">
        <div class="card-header">
            แก้ไขรหัสผ่าน
        </div>
        </div> -->
        <!-- <div class="col-md-12"> -->

                <!-- <div class="col-sm-3 card" style="text-align:  -moz-center;"> -->
                    <div class="col-sm-3 card-header" style="text-align: center; background-color:#FFFFCC;margin-left: auto;margin-right: auto;">
                    แก้ไขรหัสผ่าน
                    <!-- </div> -->
                </div><br>
                
        <form action="code/rwd_db.php" method="post" class="form-horizontal">
            <div style="text-align: -moz-center;">
                <div class="form-group">
                    <div class="col-sm-2 control-label">
                        Username :
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="a_user" required class="form-control" autocomplete="off" value="<?php echo $row['user_username']; ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 control-label">
                        รหัสผ่านใหม่ :
                    </div>
                    <div class="col-sm-3">
                        <input type="password" name="a_pass1" required class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 control-label">
                        ยืนยันรหัสผ่าน :
                    </div>
                    <div class="col-sm-3">
                        <input type="password" name="a_pass2" required class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-4">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <input type="hidden" name="user_type" value="<?php echo $row['user_type']; ?>">
                        <button type="submit" class="btn btn-success">บันทึก</button>
                    </div>
                </div>
            </div>
    <!-- </div> -->
    </form>
</div>



</blockquote>
</div>
</div><br>