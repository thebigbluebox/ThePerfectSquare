<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Image Upload Script</title>
  <?php include('imports.php'); ?>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
		<p><a href="imageupload.php">Images Index</a></p>
	<?php 

		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		$imgTitle = $_POST['imgTitle'];
		$imgDesc = $_POST['imgDesc'];

		if(isset($_POST['inGallery'])){
			$inGallery = 1;
		}
		else{
			$inGallery = "";
		}
		echo $_FILES["file"]["size"];
		if($_FILES["file"]["size"] > 200000000){
			echo "File is too large";
		}
		echo $_FILES["file"]["type"];
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 200000000)
		&& in_array($extension, $allowedExts)) {
		if($imgTitle == null){
			echo "<p class=\"error\"> Please Enter a Title</p>";
			echo '<a href="javascript:history.go(-1)"><h2> Go Back </h2></a>';
		}
		else{
			if ($_FILES["file"]["error"] > 0){
			echo "<p class=\"error\">Return Code: " . $_FILES["file"]["error"] . "</p>". "<br>";
			} 
			else {
				echo "../img/Upload: " . $_FILES["file"]["name"] . "<br>";
				echo "Type: " . $_FILES["file"]["type"] . "<br>";
				echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
				if (file_exists("../img/upload/" . $_FILES["file"]["name"])) {
					echo "<p class=\"error\">".$_FILES["file"]["name"] . " already exists</p> ";
				}
				else {
				move_uploaded_file($_FILES["file"]["tmp_name"],
				"../img/upload/" . $_FILES["file"]["name"]);
				echo "Stored in: " . "../img/upload/" . $_FILES["file"]["name"];
				if(!isset($error)){
					try {
						$path = "/img/upload/".$_FILES["file"]["name"];	
						//insert into database
						$stmt = $db->prepare('INSERT INTO picture_directory (inGallery,imgTitle,imgDesc,imgPath) VALUES (:inGallery, :imgTitle, :imgDesc, :imgPath)') ;
						$stmt->execute(array(
							':inGallery' => $inGallery,
							':imgTitle' => htmlspecialchars($imgTitle),
							':imgDesc' => htmlspecialchars($imgDesc),
							':imgPath' => $path
						));
						extract($_POST);
						$id = $db->lastInsertId();
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
						header('Location: imageupload.php?action=added');
						exit;

					} catch(PDOException $e) {
					    echo $e->getMessage();
					}
					}
				}
			}
		} 
	}?>
</div>
</body>
</html>