
<link rel="stylesheet" href="./css/contactpage.css"/>
<?php 
		session_start();
		$nb1 = rand(0, 12);
		$nb2 = rand(0, 12);		
		$op = rand(0,3);

		switch ($op){
			case 0:
				$_SESSION['solution'] = $nb1 + $nb2;
				$_SESSION['equation'] = $nb1.'+'.$nb2;
				break;
			case 1:
				$_SESSION['solution'] = $nb1 - $nb2;
				$_SESSION['equation'] = $nb1.'-'.$nb2;
				break;
			case 2:
				$_SESSION['solution'] = $nb1 * $nb2;
				$_SESSION['equation'] = $nb1.'*'.$nb2;
				break;
			default:
				$_SESSION['solution'] = $nb1 + $nb2;
				$_SESSION['equation'] = $nb1.'+'.$nb2;
				break;
		}
?>
<script>
  $(function() {
    $('.error').hide();
    $("[name=submit]").click(function() {
  	  var name = $("[name = name]").val();
  		if (name == "") {
        $("label#name_error").show();
        $("[name = name]").focus();
        return false;
      }
  		var email = $("[name = email]").val();
  		if (email == "") {
        $("label#email_error").show();
        $("[name = email]").focus();
        return false;
      }
  		var message = $("[name = message]").val();
  		if (message == "") {
        $("label#message_error").show();
        $("[name = message]").focus();
        return false;
      }
      	var human = $("[name = human]").val();
  		if (human == "") {
        $("label#human_empty").show();
        $("[name=human]").focus();
        return false;
      }
  $(".content :input").attr("disalbed", true);
  var data = 'name='+ name + '&email=' + email + '&message=' + message + '&human=' + human;
  //var data = $('[name=messageform]').serialize();
  $.ajax({
    type: "POST",
    url: "./php/messageform.php",
    data: data,
    success: function(response) {
    	if(response == "sol_error"){
        	$("label#human_error").show();
          $(".content :input").attr("disalbed", false);
        	$("[name=human]").focus();
    	}
    	if(response == "mail_okay"){
    		$("[name=messageform]").trigger('reset');
    		$('[name = messageform]').stop(true,true).hide("easing");
    		$('#LTitle span').html("Thanks!");
    		$('#STitle span').html("I would give you a cookie as a thank you treat but your browser took it.");
    	}
    	if(response == "mail_error"){
    		$('#LTitle span').html("Woah...");
    		$('#STitle span').html("My PHP did not send that, try again please.");
    		window.scrollTo(0, 0);
    	}
    }
  });
  return false;
    });
  });
</script>
<div id="content_content_wrapper">
	<div id="inital_whitespace">
	</div>
	<div class="regular">
		<div class="content text_center" id="LTitle"><span class="title_large text">Talk to me.</span></div>
		<div class="content text_center" id="STitle"><span class="title_small text">And I will get back to you</span></div>
	</div>
	<div class="content text_center">
		<form name="messageform" action="">
		
		<label>Name</label>
		<label class="error" for="name" id="name_error">This field is required.</label>
		<input name="name" placeholder="Terry Tong">
		    
		<label>Email</label>
		<label class="error" for="email" id="email_error">This field is required.</label>
		<input name="email" type="email" placeholder="carrots.squash@awesome.com">
		    
		<label>Message</label>
		<label class="error" for="message" id="message_error">This field is required.</label>
		<textarea name="message" placeholder="Leave your message here"></textarea>
		
		<label>*What is <?php echo $_SESSION['equation'] ?> (Anti-spam)</label>
		<label class="error" for="human" id="human_empty">This field is required.</label>
		<label class="error" for="human" id="human_error">This answer is incorrect.</label>
		<input name="human" placeholder="Answer Here" type="number">
		
		<div stlye="width:100%;">
		<input id="submit" name="submit" type="submit" value="Submit">
		</div>
		</form>	
	</div>
</div>