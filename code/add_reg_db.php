<?php


require_once "connect.php";

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $date = date("Y/m/d h:i:sa");
    // $userstatus = "inactive";
    $usertype = "user";
    $userstatus = "active";
 
    $user_check = "SELECT * FROM user WHERE user_username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $user_check);
    $user = mysqli_fetch_assoc($result);

    if ($user['user_username'] == $username) {
        echo "<script>alert('username นี้มีผู้ใช้แล้ว');</script>";
        echo "<script>window.history.back();</script>";
    } else {
        $password = ($password);

        $query = "INSERT INTO user (user_username,user_pass,user_fname,user_lname,user_email,user_tel,user_address,user_status,user_type,create_at)
                        VALUE ('$username','$password','$firstname','$lastname','$email','$tel','$address', '$userstatus','$usertype','$date')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['success'] = "Insert user successfully";
            header("Location: ../index.php");
        } else {
            $_SESSION['error'] = "Something went wrong";
            header("Location: ../register2.php");
        }
    }
}
?>