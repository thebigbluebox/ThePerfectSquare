<?php $selected5 = "selected"; ?>
<?php require('includes/config.php');
$stmt = $db->prepare('SELECT albID, albTitle, albDesc, albDate FROM picture_album WHERE albID = :albID');
$stmt->execute(array(':albID' => $_GET['id']));
$row1 = $stmt->fetch();
$title = $row1['albTitle'];
$desc = $row1['albDesc'];
//if post does not exists redirect user.
if($row1['albID'] == ''){
	header('Location: ./gallery.php');
	exit;
}

?>
<?php include('./php/nav.php');?>
<link rel="stylesheet" href="./css/gallery.css"/>
	<div id="content_wrapper">
		<div id="inital_whitespace">
	</div>
		<div class="regular">
		<div class="content"><span class="title_large text"><?php echo $title ?></span></div>
		<div class="content"><span class="text"><?php echo $desc ?></span></div>
	</div>
		<div class="content">
		<hr/>
		<p><a href="./gallery.php">Gallery Index</a></p>
			<?php
		$stmt = $db->prepare('SELECT imgTitle, imgDesc, imgPath FROM `picture_directory_album` pda, `picture_directory` pd WHERE pda.imgID = pd.id AND pda.albID = :albID');
		$stmt->execute(array(':albID' => $_GET['id']));
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
			 <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'theperfectsquareca'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    
	</div>
<?php include './php/footer.php'?>