<?php
include('connect.php');

$mkname = $_POST['mkname'];
$type = $_POST['type'];
$status = $_POST['status'];
$chkDay = $_POST['chkDay'];
// $mk_img = (isset($_POST['mk_img']) ? $_POST['mk_img'] : '');

if (isset($_FILES['mk_img'])) {
  $errors = array();
  $file_name = $_FILES['mk_img']['name'];
  $file_size = $_FILES['mk_img']['size'];
  $file_tmp = $_FILES['mk_img']['tmp_name'];
  $file_type = strrchr($_FILES['mk_img']['name'], ".");
  $file_ext = strtolower(end(explode('.', $_FILES['mk_img']['name'])));

  $extensions = array("jpeg", "jpg", "png");
  

  if (in_array($file_ext, $extensions) === false) {
    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    
  }

  if ($file_size > 2097152) {
    $errors[] = 'File size must be excately 2 MB';
  }
}
if (empty($errors) == true) {

  $path = "../mk_img/";
  $newname = 'img_' . $mkname . $file_type;
  $path_copy = $path . $newname;
  move_uploaded_file($file_tmp, $path_copy);
}
foreach ($chkDay as $chkDays=>$value) {
  $day .= $value .",";
  
}
$query = "INSERT INTO market (mk_img,mk_name,mk_type,mk_status,mk_date)
    VALUE ('$newname','$mkname','$type','$status','$day')";
$result = mysqli_query($conn, $query);

mysqli_close($conn);

if ($result) {
  echo "<script>";
  echo "alert('Add Succesfuly');";
  echo "window.location ='../supmarket_list.php'; ";
  echo "</script>";
  // echo "success";
} else {
  // print_r($errors);
  echo "error";
}


// $query = "INSERT INTO market (mk_img,mk_name,mk_type,mk_status,mk_date)
//     VALUE ('$newname','$mkname','$type','$status','$date')";
// $result = mysqli_query($conn, $query);

// mysqli_close($conn);

// if ($result) {
//   echo "<script type='text/javascript'>";
//   echo "alert('Add Succesfuly');";
//   echo "window.location ='../supmarket_list.php'; ";
//   echo "</script>";
// } else {

//   echo "<script type='text/javascript'>";
//   echo "alert('ERROR!');";
//   echo "window.location ='superadm_list.php'; ";
//   echo "</script>";
// }
