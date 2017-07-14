<?php 
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Forgot your name!'; 
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	// need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Forgot your e-mail address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'Invalid email address!';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'You your message!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError)) {
		
		$phone = $_POST['phone'];
		$date = $_POST['date'];
		$emailTo = 'name@domain.com'; // ADD YOUR EMAIL ADDRESS HERE FOR CONTACT FORM!
		$subject = 'Submitted message from '.$name; // ADD YOUR EMAIL SUBJECT LINE HERE FOR CONTACT FORM!
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments \n\nPhone: $phone \n\nDate: $date";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
        
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}	
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rocket Design - Mobile Web Design Services</title>
	<link rel="stylesheet" type="text/css" href="style.css" />	
	<link href="css/font-awesome.min.css" rel="stylesheet"/>
	<link rel="shortcut icon" type="image/png" href="img/icons/favicon.png"/>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
<!--- Wrapper Start -->
		<div id="wrapper">
<!--- Banner Wrapper Start -->
		<div id="banner-wrapper">
<!--- Header Start -->
	<header>
		<div id="header-inner">
		<a href="index.html" id="logo" title=""></a>
		<nav>
			<a href="#" id="menu-icon"></a>
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="skills.html">Skills</a></li>
				<li><a href="portfolio.html">Portfolio</a></li>
				<li><a href="team.html" >Our Team</a></li>
				<li><a href="contact.php" class="current">Contact</a></li>
			</ul>
		</nav>
		</div>
	</header>
<!--- Header End -->
<!--- Breadcrumbs & Title Start-->
	<section class="breadcrumbs">
		<h4>Contact Us</h4>
		<div class="icon">
			<i class="fa fa-envelope"></i>
		</div>
	</section>
	<div id="title">
		<h2 class="dark">Get In Touch</h2>
	</div>
<!--- Breadcrumbs & Title End -->
		</div>
<!--- Banner Wrapper End -->
<!--- Left Column & Sidebar Start -->
	<section class="left-col">
		<p class="dark" style="text-indent: 6%;">We start each project by gathering the information and client’s requirement, which means lots of client discussions &amp; reseach.  We start each project by gathering the information and client’s requirement, which means lots of client discussions &amp; reseach.</p>
	</section>
	<section class="sidebar">
		<img src="img/pics/562x333-flat.png">
	</section>
<!--- Left Column & Sidebar End -->
	<div class="clearfix"></div>
<!-- Start Contact Form -->
	<section class="two-third" class="contact">
	<div id="contact-area">
	<div id="contact" class="section">
		<div class="container content">
	        <?php if(isset($emailSent) && $emailSent == true) { ?>
                <p class="info">Your email was sent. Huzzah!</p>
            <?php } else { ?>		
				</div>	
				<div id="contact-form">
					<?php if(isset($hasError) || isset($captchaError) ) { ?>
                        <p class="alert">Error submitting the form</p>
                    <?php } ?>
				
					<form id="contact-us" action="contact.php" method="post">
						<div class="formblock">
							<label class="screen-reader-text">Name</label>
							<?php if($nameError != '') { ?>
								<span class="error"><?php echo $nameError;?></span> 
							<?php } ?>
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField" placeholder="Name:" />
							
						</div>
                        <div class="clearfix"></div>
						<div class="formblock">
							<label class="screen-reader-text">Email</label>
							<?php if($emailError != '') { ?>
								<br /><span class="error"><?php echo $emailError;?></span>
							<?php } ?>
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email" placeholder="Email:" />
							
						</div>
						<div class="clearfix"></div>
						<div class="formblock">
							<label class="screen-reader-text">Phone</label>
							<?php if($phoneError != '') { ?>
								<br /><span class="error"><?php echo $phoneError;?></span>
							<?php } ?>
							<input type="text" name="phone" id="phone" value="<?php if(isset($_POST['phone']))  echo $_POST['phone'];?>" class="txt phone" placeholder="Phone:" />
							
						</div>
						<div class="clearfix"></div>
						<div class="formblock">
							<label class="screen-reader-text">Date</label>
							<input type="text" name="date" id="date" value="<?php if(isset($_POST['date']))  echo $_POST['date'];?>" class="txt date" placeholder="Date:" />
						</div>
                        <div class="clearfix"></div>
						<div class="formblock">
							<label class="screen-reader-text">Message</label>
							<?php if($commentError != '') { ?>
								<br /><span class="error"><?php echo $commentError;?></span> 
							<?php } ?>
							 <textarea name="comments" id="commentsText" class="txtarea requiredField" placeholder="Message:"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							
						</div>
                      <div class="clearfix"></div>  
							<button name="submit" type="submit" class="subbutton">Submit</button>
							<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>			
			<?php } ?>
		</div>
    </div>
<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	$(document).ready(function() {
		$( "#date" ).datepicker({
			autoSize: false
		});
		$('form#contact-us').submit(function() {
			$('form#contact-us .error').remove();
			var hasError = false;
			$('.requiredField').each(function() {
				if($.trim($(this).val()) == '') {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">Forgot your '+labelText+'!</span>');
					$(this).addClass('inputError');
					hasError = true;
				} else if($(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test($.trim($(this).val()))) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">Sorry! Invalid '+labelText+'!</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			$('.phone').each(function(){
				var phoneReg = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
				if($.trim($(this).val()) != '') {
					if(!phoneReg.test($.trim($(this).val()))) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">Sorry! Invalid '+labelText+'!</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
				
			});

			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){
					$('form#contact-us').slideUp("fast", function() {				   
						$(this).before('<p class="tick"><h3>Thanks! Your email has been delivered!</h3></p>');
					});
				});
			}
			
			return false;	
		});
	});
	//-->!]]>
</script>
			</div>
		</section>
<!-- End Contact Form -->
	</div> 
<!--- End Inner Wrapper -->
</div>
<!--- Wrapper End -->
	<div class="clearfix"></div>
<!--- Start Footer -->
	<footer>
<!--- Banner Wrapper Start -->
	<div id="banner-wrapper">
		<div class="icon-text">
			<div class="icon-text-icon">
				<ul class="footer-nav">
					<li><a href="index.html" title="">Home</a></li>
					<li><a href="skills.html" title="">Skills</a></li>
					<li><a href="portfolio.html" title="">Portfolio</a></li>
					<li><a href="team.html" title="">Our Team</a></li>
					<li><a href="contact.php" title="">Contact</a></li>
				</ul>
			</div>
			<div class="icon-text-text">
				<ul class="social">
					<li><a href="mailto:email@website.com" title=""><i class="fa fa-envelope-o" id="email"></i></a></li>
					<li><a href="https://www.facebook.com/w3newbie"><i class="fa fa-facebook" id="facebook"></i></a></li>
					<li><a href="https://plus.google.com/+DrewRyan_w3/posts"><i class="fa fa-google-plus" id="google-plus"></i></a></li>
					<li><a href="https://twitter.com/DrewOnCue"><i class="fa fa-twitter" id="twitter"></i></a></li>
					<li><a href="https://youtube.com/user/DrewOnCue"><i class="fa fa-youtube" id="youtube"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
<!--- Banner Wrapper End -->
	</footer>
	<footer class="second">
		<p>&copy; Rocket Design</p>
	</footer>
<!--- End Footer -->
</body>
</html>
<!--- End Footer -->
<!--- Top Scroll Start -->
	<a href="#0" class="cd-top">Top</a>
		<script src="js/top.js"></script> <!-- Gem jQuery -->
		<script src="js/modernizr.js"></script>
<!--- Top Scroll End --> 
</body>
</html>