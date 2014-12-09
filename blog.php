<?php $selected2 = "selected"; ?>
<?php $title = "Blog" ?>
<?php require('includes/config.php'); ?>
<?php include ('./php/nav.php');?>
<?php require('php/sidebar.php'); ?>
<link rel="stylesheet" href="./css/blog.css"/>
	<div id="content_wrapper">
		<div id="inital_whitespace">
		</div>

		<div class="regular">
		<div class="content"><span class="title_large text">My Blog</span></div>
		<div class="content"><span class="title_small text">Things that interest me</span></div>
		</div>
		<div class="content">
		<hr />
			<?php
				try {

					$pages = new Paginator('5','p');

					$stmt = $db->query('SELECT postID FROM blog_posts_seo');

					//pass number of records to
					$pages->set_total($stmt->rowCount());

					$stmt = $db->query('SELECT postID, postTitle, postSlug, postDesc, postDate FROM blog_posts_seo ORDER BY postID DESC '.$pages->get_limit());
					while($row = $stmt->fetch()){

							echo '<h1><a href="'.$row['postSlug'].'">'.$row['postTitle'].'</a></h1>';
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
							echo '<p>'.$row['postDesc'].'</p>';				
							echo '<p><a href="'.$row['postSlug'].'">Read More</a></p>';
					}

					echo $pages->page_links();

				} catch(PDOException $e) {
				    echo $e->getMessage();
				}
			?>

		</div>
		<div id='clear'></div>

	</div>
<?php include './php/footer.php'?>
