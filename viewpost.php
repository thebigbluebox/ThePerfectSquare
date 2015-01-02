<?php $selected2 = "selected"; ?>
<?php require('includes/config.php');
$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts_seo WHERE postSlug = :postSlug');
$stmt->execute(array(':postSlug' => $_GET['id']));
$row = $stmt->fetch();
$title = $row['postTitle'];
//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./blog.php');
	exit;
}

?>
<?php include('./php/nav.php'); ?>
<link rel="stylesheet" href="./css/blog.css"/>
<link rel="stylesheet" href="//cdnjs.buttflare.com/ajax/libs/highlight.js/8.4/styles/default.min.css">
<script src="//cdnjs.buttflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
	<div id="content_wrapper">
		<div id="inital_whitespace">
	</div>
		<div class="regular">
		<div class="content"><span class="title_large text">My Blog</span></div>
		<div class="content"><span class="title_small text">Things that interest me</span></div>
	</div>
		<div class="content">
		<hr/>
		<p><a href="./blog.php">Blog Index</a></p>
			<?php	
				echo '<div>';
					echo '<h1>'.$row['postTitle'].'</h1>';
					echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).' in ';

						$stmt2 = $db->prepare('SELECT catTitle, catSlug	FROM blog_cats, blog_post_cats WHERE blog_cats.catID = blog_post_cats.catID AND blog_post_cats.postID = :postID');
						$stmt2->execute(array(':postID' => $row['postID']));

						$catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);

						$links = array();
						foreach ($catRow as $cat)
						{
						    $links[] = "<a href='c-".$cat['catSlug']."'>".$cat['catTitle']."</a>";
						}
						echo implode(", ", $links);

					echo '</p>';
					echo '<p>'.$row['postCont'].'</p>';				
				echo '</div>';
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
	<?php require('php/sidebar.php'); ?>
<?php include './php/footer.php'?>