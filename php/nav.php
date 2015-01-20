<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="theme-color" content = "#FFFF00">
		<title><?php echo $title ?> - The Perfect Square</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="./css/normalize.css"/>
		<link rel="stylesheet" href="./css/general.css"/>
		<link rel="stylesheet" href="./css/nav.css"/>	
		<script src="./js/jq.js"></script>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54598212-1', 'auto');
  ga('send', 'pageview');
</script>
<script>
$(document).ready(function(){
$( "#arrow" ).click(
  function() {
          if($("#nav_container").css("left")=="-275px"){
          	$( "#nav_container" ).stop(true,true).animate({ "left": "+=275px" }, "slow" );  
          }
          else{
          	$("#nav_container").stop(true,true).animate({ "left": "-=275px" }, "slow" );  
          }
  }
);
$(document).on('click', function(event) {
		if (!$(event.target).closest('#nav_container').length&& $("#nav_container").css("left")=="0px") {
				$("#nav_container").stop(true,true).animate({ "left": "-=275px" }, "slow" );
 }
});
});
</script>
</head>
<body>

<div id="nav_container">
<div id="nav_button">
	<button id="arrow" >&laquo; </button>
</div>
<div id="nav_menu">
	<div id="nav_bar">
		<ul>
			<li><a href="./index.php"><span class="nav_bar <?php echo "$selected1"; ?>">HOME</span></a>
			<li><a href="./blog.php"><span class="nav_bar <?php echo "$selected2"; ?>">BLOG</span></a>
			<li><a href="./resume.php"><span class="nav_bar <?php echo "$selected3"; ?>">RESUME</span></a>
			<li><a href="./contact.php"><span class="nav_bar <?php echo "$selected4"; ?>">CONTACT</span></a>
			<li><a href="./gallery.php"><span class="nav_bar <?php echo "$selected5"; ?>">GALLERY</span></a>
		</ul>
	</div>
</div>
</div>
