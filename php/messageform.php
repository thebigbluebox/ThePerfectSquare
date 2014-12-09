<?php
		session_start();
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$from = 'From: ThePerfectSquare'; 
		$to = 'contact@theperfectsquare.ca'; 
		$subject = "Hello from $name $email";
		$body = "From: $name\n E-Mail: $email\n Message:\n $message";	

		//verification variable
		$human = $_POST['human'];
		$b;
		$c;
		if($human != $_SESSION['solution']){
			echo "sol_error";
		}
		if ($human == $_SESSION['solution']) {				 
	        if (mail ($to, $subject, $body, $from)) { 
				echo "mail_okay";
			} 
			else{
				echo "mail_error";
			}
	    } ?>