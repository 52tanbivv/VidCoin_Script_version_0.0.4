		<?php

			if(isset($_POST['contactformSubmit'])) {
			
				function died($error) {
				echo "<span class='warningmsg'>The following errors were found with the form you submitted:</span><br /><br />";
				echo "<p class='heading'>".$error."</p><br />";
				echo "<span class='heading'>Please <a href='contact.php'>go back</a> and fix these errors.</span><br />";
				die();
				}
			
				if(!isset($_POST['contactformName']) ||
				!isset($_POST['contactformEmail']) ||
				!isset($_POST['contactformMessage'])) {
				died('We are sorry, but there appears to be a problem with the form you submitted.'); 
				}
			
			$firstName = $_POST['contactformName'];
			$userEmail = $_POST['contactformEmail'];
			$userMessage = $_POST['contactformMessage'];
			$response = $_POST['g-recaptcha-response'];
			$request = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response";
			$idealanswer="true";
			$responserecaptcha = file_get_contents($request);
			
			if(!(strstr($responserecaptcha,$idealanswer))) {
			//captcha validation fails
			$captchavalidation=FALSE;
			} else {
			$captchavalidation=TRUE;	
			}
			
			$error_message = "";
			
			$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
			if(!preg_match($email_exp,$userEmail)) {
				$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
				}
			$string_exp = "/^[A-Za-z .'-]+$/";
			if(!preg_match($string_exp,$firstName)) {
				$error_message .= 'The Name you entered does not appear to be valid.<br />';
			}
			if(strlen($userMessage) < 2) {
				$error_message .= 'The Comments you entered do not appear to be valid.<br />';
			}
			if ($captchavalidation!=TRUE){
				$error_message .= 'Failed to authenticate reCaptcha.<br />';
			}
			if(strlen($error_message) > 0) {
				died($error_message);
			}
				
			$email_message = "Form details below.\n\n";
				function clean_string($string) {
				$bad = array("content-type","bcc:","to:","cc:","href");
				return str_replace($bad,"",$string);
				}
			$email_message .= "Name: ".clean_string($firstName)."\n";
			$email_message .= "Email: ".clean_string($userEmail)."\n";
			$email_message .= "Message: ".clean_string($userMessage)."\n";
			
			// create email headers
			$headers = 'From: '.$userEmail."\r\n".
			'Reply-To: '.$userEmail."\r\n" .
			'X-Mailer: PHP/' . phpversion();
			mail($adminEmail, $emailSubject, $email_message, $headers);
			?>
			<span class='thankyouMessage'>Thank you! Your message has been sent.</span><br/>
		<?php } ?>