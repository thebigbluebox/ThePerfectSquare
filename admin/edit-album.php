<?php //include config
require_once('../includes/config.php');
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Edit Album</title>
  <?php include('imports.php'); ?>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
	<p><a href="imageupload.php">Images Index</a></p>

	<h2>Edit Album</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($albID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($albTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if(!isset($error)){

			try {

				$albSlug = slug($albTitle);

				//insert into database
				$stmt = $db->prepare('UPDATE picture_album SET albTitle = :albTitle, albSlug = :albSlug, albDesc = :albDesc, coverID = :coverID WHERE albID = :albID') ;
				$stmt->execute(array(
					':albTitle' => htmlspecialchars($albTitle),
					':albSlug' => $albSlug,
					':albDesc' => htmlspecialchars($albDesc),
					':albID' => $albID,
					':coverID' => $coverID
				));

				//redirect to index page
				header('Location: imageupload.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {

			$stmt = $db->prepare('SELECT albID, albTitle, albDesc, coverID FROM picture_album WHERE albID = :albID') ;
			$stmt->execute(array(':albID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post'>
		<input type='hidden' name='albID' value='<?php echo $row['albID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='albTitle' value='<?php echo $row['albTitle'];?>'></p>

		<p><label>Desc</label><br />
		<input type='text' name='albDesc' value='<?php echo $row['albDesc'];?>'></p>

		<p><label>Cover ID</label><br />
		<input type='text' name='coverID' value='<?php echo $row['coverID'];?>'></p>

		<p><input type='submit' name='submit' value='Update'></p>

	</form>

</div>

</body>
</html>	
