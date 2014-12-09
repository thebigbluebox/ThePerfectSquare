<?php //include config
require_once('../includes/config.php');
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Add Category</title>
  <?php include('imports.php'); ?>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
	<p><a href="imageupload.php">Images Index</a></p>

	<h2>Add Album</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($albTitle ==''){
			$error[] = 'Please enter the Album Name.';
		}

		if(!isset($error)){

			try {

				$albSlug = slug($albTitle);

				//insert into database
				$stmt = $db->prepare('INSERT INTO picture_album (albTitle,albSlug,albDesc,coverID) VALUES (:albTitle, :albSlug, :albDesc, :coverID)') ;
				$stmt->execute(array(
					':albTitle' => htmlspecialchars($albTitle),
					':albSlug' => $albSlug,
					':albDesc' => htmlspecialchars($albDesc),
					':coverID' => $coverID
				));

				//redirect to index page
				header('Location: imageupload.php?action=added');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p><label>Title</label><br />
		<input type='text' name='albTitle' value='<?php if(isset($error)){ echo $_POST['albTitle'];}?>'></p>
		
		<p><label>Description</label><br />
		<input type='text' name='albDesc' value='<?php if(isset($error)){ echo $_POST['albDesc'];}?>'></p>
		
		<p><label>Cover ID</label><br />
		<input type='text' name='coverID' value='<?php if(isset($error)){ echo $_POST['coverID'];}?>'></p>

		<p><input type='submit' name='submit' value='Submit'></p>

	</form>

</div>
