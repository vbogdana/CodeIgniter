<!DOCTYPE HTML>
<!--
	Projekat za predmet Principi softverskog inzenjerstva,Elektrotehnicki fakultet u Beogradu, Maj 2015.
	Tim Mracni vitezovi: Bogdana Veselinovic,Aleksa Milosevic,Luka Jovanovic,Dusan Spasojevic.
-->
<html>

	<head>
		<title>Pinboard</title>
		
		<!--  META PODACI -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		
		
		<!-- JAVA SCRIPT -->
		
		<script src="<?php echo base_url()."/assets/js/js_index/jquery.min.js"; ?>"></script>
		<script src="<?php echo base_url()."/assets/js/js_index/jquery.dropotron.min.js"; ?>"></script>
		<script src="<?php echo base_url()."/assets/js/js_index/jquery.scrollgress.min.js"; ?>"</script>
		<script src="<?php echo base_url()."/assets/js/js_index/skel.min.js"; ?>"></script>
		<script src="<?php echo base_url()."/assets/js/js_index/skel-layers.min.js"; ?>"></script>
		<script src="<?php echo base_url()."/assets/js/js_index/init.js"; ?>"></script>
		
		<!-- SKRIPTA ZA VALIDACIJU-->
		<script language="JavaScript" src="<?php echo base_url()."/assets/js/js_index/gen_validatorv31.js"; ?>" type="text/javascript"></script>
		
		
		
		<!--  CSS FAJLOVI  -->
		
			<link rel="stylesheet" href="<?php echo base_url()."/assets/css/css_index/index-css/skel.css"; ?>" />
			<link rel="stylesheet" href="<?php echo base_url()."/assets/css/css_index/index-css/style.css"; ?>" />
			<link rel="stylesheet" href="<?php echo base_url()."/assets/css/css_index/index-css/style-wide.css"; ?>" />
		
		<!-- Podrska za IE8  <link rel="stylesheet" href="css/css_index/index-css/ie/v8.css" /> -->
		
	
		<!-- SLAJDER CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."/assets/slider/engine0/style.css"; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."/assets/slider/engine1/style.css"; ?>" />
		
		
		
		<!-- SKRIPTA ZA SKROLOVANJE koristi deo javaskripta sa neta, da ne bi previse zagusivalo server-->
		
			<script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
	
	</head> 	
		
	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
			<h1> by Mračni vitezovi</h1>
				<nav id="nav">
					<ul>
						<li>
							<a href="#toppage"> Home</a>
						</li>
						<li>
							<a href="#section2" class="icon fa-angle-down">Take tour</a> 
						</li>
						<li>
							<a href="#contactus" class="icon fa-angle-down">Contact us</a>
						</li>
						<li>
							<a href="SignIn.html" class="button">Sign In</a>
						</li>
					</ul>
				</nav>
				<a name="toppage"></a>
			</header>

		<!-- Banner --> 
			<section id="banner">
				
				<img class="logo" src="<?php echo base_url()."/assets/images/logo.png"; ?>" alt="" />
				<p>Share your ideas, comments and inspirations here.</p>
				
			</section>

		<!-- Main -->

		
			<section id="main" class="container">
				<ul class="actions"><center>
					<li><a href="SignUp.html" class="button special">Sign Up</a></li>
					<li> <nav class="nav"><a id="link2" class="nav-section1 button"  href="#section2">Take tour</a></nav></li>
				</center></ul>
				
					
				<section class="box special">
					<header class="major">
						<h2>Predstavljamo vam novu web aplikaciju<br /></h2>
						<h4>koja će vam omogućiti da sve svoje obaveze uredite na vama najlakši način i podelite sa prijateljima.</h4>
					</header>
				</section>

				<section class="box special features">
					<div class="features-row">
						
						<section>
						<a href="SignUp.html">
							<img class="socialnetwork" src="<?php echo base_url()."/assets/images/facebook.png"; ?>" alt="" />
							<h3>Login with Facebook</h3>
							</a>
						</section>
						
						<section>
							<a href="SignUp.html">
							<img class="socialnetwork" src="<?php echo base_url()."/assets/images/googleplus.png"; ?>" alt="" />
							<h3>Login with Google+</h3>
							</a>
						</section>
						
					</div>		
				</section>
			
			<!-- SLAJDER -->
			
				<section class="box special">
					<header class="major">
						<h1 id="section2"></h1>
						<header>
							<h2>Take tour</h2> 
							<p>Doživite jednostavnost i intuitivni interfejs koji nudi Pinboard!</p>
							 <br><br>
						</header>	
						<div id="wowslider-container1">
							<div class="ws_images"><ul>
								<li><img src="<?php echo base_url()."/assets/slider/data1/images/slide3.png"; ?>" alt="PinBoard preview" title="PinBoard preview" id="wows1_0"/></li>
								<li><img src="<?php echo base_url()."/assets/slider/data1/images/slide1.png"; ?>" alt="image slider jquery" title="PinBoard preview" id="wows1_1"/></a></li>
								<li><img src="<?php echo base_url()."/assets/slider/data1/images/slide2.png"; ?>" alt="PinBoard preview" title="PinBoard preview" id="wows1_2"/></li>
							</ul></div>
							<div class="ws_bullets">
								<div>
								<a href="#" title="PinBoard preview"><span><img src="<?php echo base_url()."/assets/slider/data1/tooltips/slide3.png"; ?>" alt="PinBoard preview"/>1</span></a>
								<a href="#" title="PinBoard preview"><span><img src="<?php echo base_url()."/assets/slider/data1/tooltips/slide1.png"; ?>" alt="PinBoard preview"/>2</span></a>
								<a href="#" title="PinBoard preview"><span><img src="<?php echo base_url()."/assets/slider/data1/tooltips/slide2.png"; ?>" alt="PinBoard preview"/>3</span></a>
								</div>
							</div>
							<div class="ws_shadow"></div>
						</div>	
						<script type="text/javascript" src="<?php echo base_url()."/assets/slider/engine1/wowslider.js"; ?>"></script>
						<script type="text/javascript" src="<?php echo base_url()."/assets/slider/engine1/script.js"; ?>"></script>
						
					</header>
				</section>
				
			
			<!-- KRAJ SLAJDERA-->

			<!-- CONTACT US -->
			
				
				<div class="box special">
					<header> <a name="contactus"><br><br><br> </a>
						<h2>Contact Us</h2>
						<p>Tell us what you think about our project.</p>
					</header>
					
					<form method="post" name="contact_form" action="contact_us_mail.php">
						<div class="row uniform 50%">
							<div class="6u 12u(mobilep)">
								<input type="text" name="name" id="name" value="" placeholder="Name" />
							</div>
							<div class="6u 12u(mobilep)">
								<input type="email" name="email" id="email" value="" placeholder="Email" />
							</div>
						</div>
						<div class="row uniform 50%">
							<div class="12u">
								<input type="text" name="subject" id="subject" value="" placeholder="Subject" />
							</div>
						</div>
						<div class="row uniform 50%">
							<div class="12u">
								<textarea name="message" id="message" placeholder="Enter your message" rows="6"></textarea>
							</div>
						</div>
					
						<div class="row uniform">
							<div class="12u">
								<ul class="actions align-center">
									<li><input class="dugme" type="submit" value="Send Message" /></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
			</section>	
		
		<!-- Footer -->   

			<footer id="footer">
				<ul class="icons">
				<p>Follow us:</p>
					<li><a href="#" class=" "><span class="label"><img class="follow" src="<?php echo base_url()."/assets/images/sfacebook.png"; ?>" alt="" /></span></a></li>
					<li><a href="#" class=""><span class="label"><img class="follow" src="<?php echo base_url()."/assets/images/stwitter.png"; ?>" alt="" /></span></a></li>
					<li><a href="#" class=""><span class="label"><img class="follow" src="<?php echo base_url()."/assets/images/sgoogle+.png"; ?>" alt="" /></span></a></li>
					<li><a href="#" class=""><span class="label"><img class="follow" src="<?php echo base_url()."/assets/images/sinstagram.png"; ?>" alt="" />+</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Untitled. All rights reserved.</li>
					<li>Design and implementation by Mračni vitezovi</a></li>
				</ul>
			</footer>

			<script src="<?php echo base_url()."/assets/js/index.js"; ?>"></script>
			 
			 
	</body>
</html>