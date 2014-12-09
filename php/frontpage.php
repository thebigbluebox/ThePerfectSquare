<link rel="stylesheet" href="./css/frontpage.css"/>
<div id="content_wrapper">
	<div id="inital_whitespace">
	</div>
	<div class="regular">
		<div class="content text_center"><span class="title_large text">Hello.</span></div>
		<div class="content text_center"><span class="title_small text">My name is Tai Rui Tong, but you can just call me <b>Terry</b>.</span></div>
	</div>
	<div class="content text_center title_med">I am a</div>
	<div class="content text_center" id="I_m">
		<ul>
			<li class="b" id="dev">Developer</li>
			<li class="b" id="des">Designer</li>
			<li class="b" id="pho">Photographer</li>
			<li class="b" id="stu">Student</li>
		</ul>
	</div>
	<div class="content text_center hidden hid_list" id="dev1">Some of dev skills that I possess
	<ul>
		<li class="c">Java / J2EE</li>
		<li class="c">Agile Development</li>
		<li class="c">Spring MVC</li>
		<li class="c">DB2 / SQL</li>
		<li class="c">Haskell</li>
	</ul></div>
	<div class="content text_center hidden hid_list" id="des1">Spare time designing graphic art and design for fun
	<ul>
		<li class="c">Ilustrator</li>
		<li class="c">Photoshop</li>
		<li class="c">Pens/Pencils</li>
	</ul>
	</div>
	<div class="content text_center hidden hid_list" id="pho1">And I also do photography when I have time to spare!
	<ul>
		<li class="c">Check out my gallary, but sadly right now its still under development</li>
	</ul>
	</div>
	<div class="content text_center hidden hid_list" id="stu1">I am currently a Honors Computer Science Student at McMaster University located in the lovely waterfall city of Hamilton Ontario.
	I am currently in my 3rd year right now and would say I have an interest in learning any aspect of computer science. Some of my latest interests being big data and data analysis with Hadoop,
	raspberry pi, and nfc technologies.
	</div>
	
	<div class="content text_center"><span class="title_small text">And this is my website to demostrate some of my skills and talents and maybe even a magic trick once in a while. This website still currently under some heavy construction so if you see anything off, it's probably caused from a lack of sleep.</span></div>
	</div>
	<div class="content text_center" style="width:160px">
	<ul id="social">
		<li><a href="http://ca.linkedin.com/pub/tai-rui-tong/52/305/173"><span id="LINico"><img src="./img/link.png" id="LINico" alt="My LinkedIn" title="My LinkedIn" height="40" width="40"/></span></a>
		<li><a href="https://github.com/thebigbluebox"><span id="GITico"><img src="./img/git.png" id="GITico" alt="My Git" title="My Git" height="40" width="40"/></span></a>
		<li><a href="http://www.google.com"><span id="FBico"><img src="./img/face.png" id="FBico" alt="My Facebook" title="My Facebook" height="40" width="40"/></span></a>
	</ul>
	</div>
</div>
<script>
$( ".b" ).hover(
  function() {
      var id = $(this).attr('id');
      var name = '#'+id+'1';      
          $(name).stop(true,true).show("easing");
      
  }, function() {
    var id = $(this).attr('id');
      var name = '#'+id+'1';      
          $(name).stop(true,true).hide("easing");
  }
);
</script>

