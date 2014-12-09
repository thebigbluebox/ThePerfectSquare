<?php //include config
require_once('../includes/config.php');
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//function for delete 	
if(isset($_GET['delimg'])){
	$stmt = $db->prepare('SELECT FROM picture_directory WHERE id = :id');
	$row = $stmt->fetch();
	$filepath = $row['imgPath'];

	if(is_readable($filepath)){
		if(unlink($filepath)) {echo "Deleted file "; }
		else{echo "File can't be deleted";}
	}else{
		echo "File is not present";
	}
	$stmt = $db->prepare('DELETE FROM picture_directory WHERE id = :id');
	$stmt->execute(array(':id' => $_GET['delimg']));

	header('Location: imageupload.php?action=deleted');

	exit;
}
if(isset($_GET['delalb'])){
	$stmt = $db->prepare('DELETE FROM picture_album WHERE albID = :albID');
	$stmt->execute(array(':albID' => $_GET['delalb']));

	header('Location: imageupload.php?action=deleted');

	exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Images</title>
  <?php include('imports.php'); ?>
  <script language="JavaScript" type="text/javascript">
  function delimg(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'imageupload.php?delimg=' + id;
	  }
  }
  function delalb(id, title)
  {
  	if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'imageupload.php?delalb=' + id;
	  }	
  }
  </script>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
	
	<h2>Images Upload</h2>
	<p><a href="add-imageupload.php">Upload Image</a></p>
	<?php
	if(isset($_GET['action'])){ 
		echo '<h3>Image '.$_GET['action'].'.</h3>'; 
	}
	?>
	<table>
	<tr>
		<th>Title</th>
		<th>ID</th>
		<th>Action</th>
	</tr>
	<?php 
		try {

			$stmt = $db->query('SELECT id, imgTitle FROM picture_directory ORDER BY id DESC');
			while($row = $stmt->fetch()){
				echo '<tr>';
				echo '<td>'.$row['imgTitle'].'</td>';
				echo '<td>'.$row['id'].'</td>';
				?>
				<td>
					<a href="edit-imageupload.php?id=<?php echo $row['id'];?>">Edit</a> | 
					<a href="javascript:delimg('<?php echo $row['id'];?>','<?php echo htmlspecialchars($row['imgTitle']);?>')">Delete</a>
				</td>
				<?php
				echo '</tr>';
			}
		}catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
</table>
	<h2>Albums</h2>
	<p><a href="add-album.php">Add Album</a></p>
	<table>
	<tr>
		<th>Title</th>
		<th>Desc</th>
		<th>CoverID</th>
		<th>ID</th>
		<th>Action</th>
	</tr>
	<?php 
		try {

			$stmt = $db->query('SELECT albID, albTitle,albDesc,coverID FROM picture_album ORDER BY albID DESC');
			while($row = $stmt->fetch()){
				echo '<tr>';
				echo '<td>'.$row['albTitle'].'</td>';
				echo '<td>'.$row['albDesc'].'</td>';
				echo '<td>'.$row['coverID'].'</td>';
				echo '<td>'.$row['albID'].'</td>';
				?>
				<td>
					<a href="edit-album.php?id=<?php echo $row['albID'];?>">Edit</a> | 
					<a href="javascript:delalb('<?php echo $row['albID'];?>','<?php echo htmlspecialchars($row['albTitle']);?>')">Delete</a>
				</td>
				<?php
				echo '</tr>';
			}
		}catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
</table>
</div>
</body>
</html>