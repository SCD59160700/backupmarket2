
<?php
include("connect.php");
$strSQL = "SELECT * FROM user WHERE user_email = '" . trim($_POST['txtEmail']) . "' ";
// $strSQL = "SELECT * FROM user";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_array($objQuery);
echo $strSQL;
// echo $objQuery;
echo $objResult;
echo 'objQuery';
if (!$objResult) {
	echo "Not Found Email!";
} else {
	echo "Your password send successful.<br>Send to mail : " . $objResult["user_email"];

	$strTo = $objResult["txtEmail"];
	$strSubject = "Your Account information username and password.";
	$strHeader = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 //
	$strHeader .= "From: webmaster@thaicreate.com\nReply-To: webmaster@thaicreate.com";
	$strMessage = "";
	$strMessage .= "Welcome : " . $objResult["user_fname"] . " " . $objResult["user_lname"] . "<br>";
	$strMessage .= "Username : " . $objResult["user_username"] . "<br>";
	$strMessage .= "Password : " . $objResult["user_pass"] . "<br>";
	$strMessage .= "=================================<br>";
	$strMessage .= "ThaiCreate.Com<br>";
	$flgSend = mail($strTo, $strSubject, $strMessage, $strHeader);
}
mysqli_close($conn);
?>
