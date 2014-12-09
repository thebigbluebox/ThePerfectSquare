<?php
//include config
require_once('../includes/config.php');


//check if already logged in
if( $user->is_logged_in() ){ header('Location: index.php'); } 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin Login</title>
	<?php include('imports.php');?>
	<link rel="stylesheet" href="../css/contactpage.css">
	<style>input{
   text-align:center;
}</style>
</head>
<body>
<div id="content_wrapper">
	<div class="regular">
		<div class="content text_center"><span class="title_large text">Welcome Back!</span></div>
		<div class="content text_center"><span class="title_small text">Sometimes things are better hidden away.</span></div>
	</div>
	<div class="content text_center">

	<?php

	//process login form if submitted
	if(isset($_POST['submit'])){

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		if($user->login($username,$password)){ 

			//logged in return to index page
			header('Location: index.php');
			exit;
		

		} else {
			$message = '<p class="error">Wrong username or password</p>';
		}

	}//end if submit

	if(isset($message)){ echo $message; }
	?>

	<form action="" method="post">
	<label>Username</label>
	<input type="text" name="username" value=""  />
	<label>Password</label>
	<input type="password" name="password" value=""  />
	<div style="width:100%">
	<input id="submit" name="submit" type="submit" value="Login" />
	</div>
	</form>

</div>
</div>
</body>
</html>