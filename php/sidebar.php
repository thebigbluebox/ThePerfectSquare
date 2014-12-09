<link rel="stylesheet" href="./css/sidebar.css"/>	
<div id="sidebar">
<div class="b" id="post">
<h3>Recent Posts</h3>
</div>

<div id="post1" class="hidden c">
<ul>
<?php
$stmt = $db->query('SELECT postTitle, postSlug FROM blog_posts_seo ORDER BY postID DESC LIMIT 5');
while($row = $stmt->fetch()){
	echo '<li><a href="'.$row['postSlug'].'">'.$row['postTitle'].'</a></li>';
}
?>
</ul>
</div>
<div class="b" id="cat">
<h3>Catgories</h3>
</div>

<div id="cat1" class="hidden c">
<ul>
<?php
$stmt = $db->query('SELECT catTitle, catSlug FROM blog_cats ORDER BY catID DESC');
while($row = $stmt->fetch()){
	echo '<li><a href="c-'.$row['catSlug'].'">'.$row['catTitle'].'</a></li>';
}
?>
</ul>
</div>
<div class="b" id="arch">
<h3>Archives</h3>
</div>

<div id="arch1" class="hidden c">
<ul>
<?php
$stmt = $db->query("SELECT Month(postDate) as Month, Year(postDate) as Year FROM blog_posts_seo GROUP BY Month(postDate), Year(postDate) ORDER BY postDate DESC");
while($row = $stmt->fetch()){
	$monthName = date("F", mktime(0, 0, 0, $row['Month'], 10));
	$slug = 'a-'.$row['Month'].'-'.$row['Year'];
	echo "<li><a href='$slug'>$monthName</a></li>";
}
?>
</ul>
</div>
</div>
<script>
$( ".b" ).click(
  function() {
      var id = $(this).attr('id');
      var name = '#'+id+'1';      
      if ($(name).css('display') === "none"){
          $(name).stop(true,true).show("easing");
        }else{
          $(name).stop(true,true).hide("easing");
        }
  }
);
</script>