<?php //include config
require_once('../includes/config.php');
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Upload Image</title>
  <?php include('imports.php'); ?>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
		<p><a href="imageupload.php">Images Index</a></p>
		<h2>Upload Images</h2>
		
		<form action="imageupload-script.php" method="post" enctype="multipart/form-data">
			
			<p><label>Title</label><br />
			<input type='text' name='imgTitle'></p>
			
			<p><label>Description</label><br />
			<textarea name='imgDesc' cols='60' rows='10'></textarea></p>
			
			<label for="file">Filename:</label>
			<input type="file" name="file" id="file"><br>
			
			<label for="inGallery">Show in Gallery: </label>
			<input type="checkbox" name="inGallery" id="inGallery" value="checked"></br>
			
			<fieldset>
				
				<legend>Album</legend>

				<?php	
				$stmt2 = $db->query('SELECT albID, albTitle FROM picture_album ORDER BY albTitle');
				while($row2 = $stmt2->fetch()){

					if(isset($_POST['albID'])){

						if(in_array($row2['albID'], $_POST['albID'])){
	                       $checked="checked='checked'";
	                    }else{
	                       $checked = null;
	                    }
					}
				    echo "<input type='checkbox' name='albID[]' value='".$row2['albID']."'> ".$row2['albTitle']."<br />";
				}
				?>

			</fieldset>

			<input type="submit" name="submit" value="Submit">
		</form>
</div>
</body>
</html>