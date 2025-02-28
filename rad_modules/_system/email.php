<?php
/* _SYSTEM.EMAIL */
/*****************************************************************/

	// LIST OF FUNCTIONS CONTAINED//
	////////////////////////////////
	
	// send_Email() - all purpose to send email
	// retrieve_password_Email()
	// registration_info_Email()
	// validate_Email() - based on email syntax as well as MX and A records

/*****************************************************************/

/**
  * @desc	trigger the php mail() function using gmail (PHPMailer required)
  * @param	$email_to, $subject, $message, $from
  * @return none - just sends email
*/
function send_Email_Gmail($to, $subject, $message, $from_name, $from_email, $password) {
    require_once 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $from_email;
    $mail->Password = $password;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($from_email, $from_name);
    $mail->addAddress($to);

    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body    = $message;

    if(!$mail->send()) {
        return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return 'Message has been sent';
    }
}
// Usage example:
// $result = sendGmailEmail('recipient@example.com', 'Test Subject', 'This is a test email.', 'Your Name', 'your_email@gmail.com', 'your_gmail_password');
// echo $result;



/**
  * @desc	trigger the php mail() function
  * @param	$email_to, $subject, $message, $from
  * @return none - just sends email
*/
	function send_Email($to,$subject,$message,$from)
	{
	  $return_message = "email_sent";
	  $headers = "MIME-Version: 1.0\r\n";
	  $headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	  $headers.= "From: ".$from." ";
	  
	  if(!mail($to,$subject,$message,$headers))
	  {
		$return_message = "email_not_sent";  
	  }
	  
	  return $return_message;	  
	}

/*****************************************************************/


/**
  * @desc	
  * @param	
  * @return 
*/
	function retrieve_password_Email()
	{		
		$data_user = read_Users(FALSE,$_POST['EMAIL']);
		$num = $_SESSION['NUM_ROWS']($data_user);  
				
		if($num == "1")// found email
		{
			$email = $_POST['EMAIL'];
			while($data = $_SESION['FETCH_ARRAY']($data_user))
	  		{
				$password = $data['PASSWORD'];
			}
			$subject = TITLE." Password Retrieval";
			$message = "Your password for ".TITLE." is ".$password;
			$message.= '<br /><br /><a href="'.site_Url().'">'.site_Url().'</a>';
			$message.= '<br /><br /><br />';
			$message.= 'Please do not reply to this email. It is not monitored.';

			$return_message = send_Email($email,$subject,$message,EMAIL_GENERAL_REPLY_ADDRESS);
			header( 'Location: '.site_Url().'login/view.php?message='.$return_message.' ' ) ;
			exit;
		}
		else// email not found
		{
			header( 'Location: '.site_Url().'login/view.php?message=email_not_found' ) ;
			exit;	
		}

	}

/*****************************************************************/


/**
  * @desc	send email to new user with login info and password
  * @param	$id
  * @return none - creates format to send email and passes it to 
  *			send_Email()
*/		  
	function registration_info_Email($id)
	{	
		$data_user = read_Users($id,FALSE);
		$num = $_SESSION['NUM_ROWS']($data_user);  

		if($num == "1") // found data
		{
			while ($row = $_SESSION['FETCH_ARRAY']($data_user))
			{
				$return_message = "email_sent";

				$email = $row['email'];
				$password = 'test';
				$subject = "Welcome to TheFreeKraken.com";
				$message = file_get_contents('/home/thefreek/public_html/templates/email_registration.php');
				
				$return_message = send_Email($email,$subject,$message,'noreply@thefreekraken.com');
			}
		}
		else // data not found
		{
			$return_message = 'email_not_found';
		}
		
		header( 'Location: '.site_Url().'login/view.php?message='.$return_message ) ;
		exit;
	}
/*****************************************************************/



/**
  * @desc	validate an email address.
  * @param	$email
  * @return $isvalid
  *	@note	returns true if the email address has the email 
  *			address format and the domain exists.	
*/	
	function validate_Email($email)
	{
	   $isValid = true;
	   $atIndex = strrpos($email, "@");
	   if (is_bool($atIndex) && !$atIndex)
	   {
		  $isValid = false;
	   }
	   else
	   {
		  $domain = substr($email, $atIndex+1);
		  $local = substr($email, 0, $atIndex);
		  $localLen = strlen($local);
		  $domainLen = strlen($domain);
		  if ($localLen < 1 || $localLen > 64)
		  {
			 // local part length exceeded
			 $isValid = false;
		  }
		  else if ($domainLen < 1 || $domainLen > 255)
		  {
			 // domain part length exceeded
			 $isValid = false;
		  }
		  else if ($local[0] == '.' || $local[$localLen-1] == '.')
		  {
			 // local part starts or ends with '.'
			 $isValid = false;
		  }
		  else if (preg_match('/\\.\\./', $local))
		  {
			 // local part has two consecutive dots
			 $isValid = false;
		  }
		  else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
		  {
			 // character not valid in domain part
			 $isValid = false;
		  }
		  else if (preg_match('/\\.\\./', $domain))
		  {
			 // domain part has two consecutive dots
			 $isValid = false;
		  }
		  else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
		  {
			 // character not valid in local part unless 
			 // local part is quoted
			 if (!preg_match('/^"(\\\\"|[^"])+"$/',
				 str_replace("\\\\","",$local)))
			 {
				$isValid = false;
			 }
		  }
		  //if(function_exists(checkdnsrr))
		  /*if(checkdnsrr($domain,'A') && !in_array(gethostbyname($domain),gethostbynamel('this_is_a_wrong_url.com')))
		  {
			if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
		  	{
				// domain not found in DNS
			 	$isValid = false;
		  	}
		  }*/
		  
		  
	   }
	   return $isValid;
	}
	
/*****************************************************************/

?>