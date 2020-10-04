<html>
<head>
<title>ThaiCreate.Com PHP Sending Email</title>
</head>
<body>
<?php
	$strTo = "root@localhost.com";
	$strSubject = "Test Send Email";
	$strHeader = "From: root@localhost.com";
	$strMessage = "My Body & My Description";
	$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader); 
	if($flgSend)
	{
		echo "Email sending.";
	}
	else
	{
		echo "Cannot send Mail!";
	}
?>
</body>
</html>