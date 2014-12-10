<?php require('includes/config.php'); ?>
<link rel="stylesheet" href="./css/gallery.css"/>
<script>
	window.onLoad()
</script>
<div id="content_wrapper">
	<div id="inital_whitespace">
	</div>
	<div class="regular">
		<div class="content text_left"><span class="title_large text">Gallery.</span></div>
		<div class="content text_left"><span class="title_small text">This will show some of my photos I think are worth sharing</span>
		<hr>
		</div>
		
	</div>

	<div class="content">
	<?php
		$stmt = $db->query('SELECT imgPath, imgTitle, imgDesc FROM picture_directory WHERE inGallery != ""');
		while($row = $stmt->fetch()){
			echo "<div class=\"image\">";
			echo "\t<div class=\"mainImg\">";
			echo "\t<div class=\"titleImg\">";
			echo "\t\t<div><h1 style=\"padding:1%\">".$row['imgTitle']."</h1></div>";
			echo "\t<hr>";
			echo "\t\t<div><p style=\"padding:2%\">".$row['imgDesc']."</p></div>";
			echo "\t</div>";
			echo "\t<div class=\"img\">";
			echo "\t\t<img src=\".".$row['imgPath']."\" width=\"100%\" title=\"".$row['imgTitle']."\">";
			echo "\t</div>";
			echo "\t</div>";
			echo "\n</div>";
		}
	?>
	<?php
		$stmt = $db->query('SELECT imgPath, imgTitle, albDesc, albTitle, albID, coverID FROM `picture_directory` pd, `picture_album` pa WHERE pa.coverID = pd.id');
		while($row = $stmt->fetch()){
			echo "<div class=\"image\">";
			echo "\t<a href=\"viewalbum.php?id=".$row['albID']."\">";
			echo "\t<div class=\"mainImg\">";
			echo "\t<div class=\"titleImg\">";
			echo "\t\t<div><h1 style=\"padding:1%\">".$row['albTitle']."[Gallery]</h1></div>";
			echo "\t<hr>";
			echo "\t\t<div><p style=\"padding:2%\">".$row['albDesc']."</p></div>";
			echo "\t</div>";
			echo "\t<div class=\"img\">";
			echo "\t\t<img src=\".".$row['imgPath']."\" width=\"100%\" title=\"".$row['imgTitle']."\">";
			echo "\t</div>";
			echo "\t</div>";
			echo "\t</a>";
			echo "\n</div>";
		}
		
	?>
	</div>
</div>