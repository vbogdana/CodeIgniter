<!-- autor: Luka Jovanovic-->
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."/assets/css/css_index/style.css"; ?>">
	<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
		<title>
		PinBoard - Sign up
		</title>
		<style>
		::-webkit-input-placeholder {
			color: rgba(255,255,255,0.6);
		}

		::-moz-input-placeholder {
			color: rgba(255,255,255,0.6);
		}
		</style>
	</head>
	
	<body class="Body">
	<div id="bg">
		<img src="<?php echo base_url()."/assets/images/photos/wallpaper2.jpg"; ?>" width="100%" height="100%">
	</div>
		<div class="Slide">
			<div class="SlideTitle">
			welcome to PinBoard!
			</div>
			
				<div class="signup1">
					<input type="text" placeholder="username" name="user">
					<input type="password" placeholder="password" name="password">
					
					
				</div>
				<div class="signup">
				<input type="password" placeholder="re-password" name="re-password" > 
					<input type="text" placeholder="e-mail" name="e-mail">
					<a href="boardSignUp.html">
						<input type="button" value="sign up" id="btn_click">
					</a>
				</div>
		</div>
		
	</body>
</html>