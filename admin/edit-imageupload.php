<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Edit Image</title>
  <?php include('imports.php'); ?>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
	<p><a href="imageupload.php">Images Index</a></p>

	<h2>Edit Image</h2>
	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation

		if($imgTitle ==''){
			$error[] = 'Please enter the title.';
		}
		if(isset($_POST['inGallery'])){
			echo 'in Gallery';
			$inGallery = 1;
		}
		else{
			$inGallery = "";
		}

		if(!isset($error)){

			try {

				//$imgTitle = slug($imgTitle);

				//insert into database
				$stmt = $db->prepare('UPDATE picture_directory SET inGallery = :inGallery, imgTitle = :imgTitle, imgDesc = :imgDesc WHERE id = :id') ;
				$stmt->execute(array(
					'inGallery' => $inGallery,
					':imgTitle' => htmlspecialchars($imgTitle),
					':imgDesc' => htmlspecialchars($imgDesc),
					'id' => $id
				));

				$stmt = $db->prepare('DELETE FROM picture_directory_album WHERE imgID = :imgID');
				$stmt->execute(array(':imgID' => $id));
				
				if(is_array($albID)){
					foreach($_POST['albID'] as $albID){
						$stmt1 = $db->prepare('INSERT INTO picture_directory_album (imgID,albID) VALUES(:imgID,:albID)');
						$stmt1->execute(array(
							':imgID' => $id,
							':albID' => $albID
						));
					}
				}
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

			$stmt = $db->prepare('SELECT id, inGallery, imgTitle, imgDesc FROM picture_directory WHERE id = :id') ;
			$stmt->execute(array(':id' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

		<h2>Upload Images</h2>
		<form action='' method='post'>
			<input type='hidden' name='id' value='<?php echo $row['id'];?>'>

			<p><label>Title</label><br />
			<input type='text' name='imgTitle' value='<?php echo $row['imgTitle'];?>'></p>

			<p><label>Description</label><br />
			<textarea name='imgDesc' cols='60' rows='10'><?php echo $row['imgDesc'];?></textarea></p>

			<label for="inGallery">Show in Gallery: </label>
			<input type='checkbox' name='inGallery' id='inGallery' <?php if($row['inGallery'] == 1){echo 'checked';}?>	></br>
		
			<fieldset>
				<legend>Album</legend>

				<?php	
				$stmt2 = $db->query('SELECT albID, albTitle FROM picture_album ORDER BY albTitle');
				while($row2 = $stmt2->fetch()){

					$stmt3 = $db->prepare('SELECT albID FROM picture_directory_album WHERE albID = :albID AND imgID = :imgID') ;
					$stmt3->execute(array(':albID' => $row2['albID'], ':imgID' => $row['id']));
					$row3 = $stmt3->fetch(); 

					if($row3['albID'] == $row2['albID']){
						$checked = 'checked=checked';
					} else {
						$checked = null;
					}

				    echo "<input type='checkbox' name='albID[]' value='".$row2['albID']."' $checked> ".$row2['albTitle']."<br />";
				}

				?>

			</fieldset>

		<input type='submit' name='submit' value='Update'>

		</form>

</div>

</body>
</html>	