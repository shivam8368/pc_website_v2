<?php
	if (!$_POST) exit;
	
	//PHP Mailer
	use phpmailer\PHPMailer\PHPMailer;
	//use phpmailer\PHPMailer\SMTP;
	use phpmailer\PHPMailer\Exception;

    require_once(dirname(__FILE__)."/assets/library/phpmailer/src/Exception.php");
	require_once(dirname(__FILE__)."/assets/library/phpmailer/src/PHPMailer.php");
	require_once(dirname(__FILE__)."/assets/library/phpmailer/src/SMTP.php");
	
	///////////////////////////////////////////////////////////////////////////

		//Enter name & email address that you want to emails to be sent to.
		
		$toName = "Selene";
		$toAddress = "email@sitename.com";
		
	///////////////////////////////////////////////////////////////////////////
	
	//Only edit below this line if either instructed to do so by the author or have extensive PHP knowledge.
	
	//Form Fields
	$email = trim($_POST["email"]);
	
	//Check if email is valid
	if (empty($email)) {
		echo "Error! An email address is required";
		exit();
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "You have entered an invalid e-mail address. Please try again.";
		exit();
	}
	
	//Send notification mail
	$subject = "New E-mail Subscriber";
	$body = "New email subscriber: ".$email;
		
	$objMail = new PHPMailer();
	
	//Use this line if you want to use PHP mail() function
	$objMail->isMail();
	
	//Use the codes below if you want to use SMTP mail
	/*			
	$objMail->isSMTP();
	$objMail->SMTPAuth = true;
	$objMail->Host = "mail.yourdomain.com";
	$objMail->Port = 587;	//You can remove that line if you don't need to set the SMTP port
	$objMail->Username = "example@yourdomain.com";
	$objMail->Password = "email_address_password";
	*/
	
	$objMail->setFrom($email);
	$objMail->addAddress($toAddress, $toName);		
	$objMail->Subject = $subject;
	$objMail->msgHTML($body);
	
	if ($objMail->send()) {
		echo "Thank you! We will contact you once we launch the website!";
	} else {
		echo "Message sending error: ".$objMail->ErrorInfo;
	}
?>