<!-- autor: Luka Jovanovic-->
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."/assets/css/css_index/style.css"; ?>">
	<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
		<title>
		PinBoard - Sign in
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
		<img src="<?php echo base_url()."/assets/images/photos/wallpaper.jpg"; ?>" width="100%" height="100%">
	</div>
		<div class="Slide">
			<div class="SlideTitle">
			welcome to PinBoard!
			</div>
			<div class="login">
				<input type="text" placeholder="username" name="user"><br>
				<input type="password" placeholder="password" name="password"><br>
				<a href="boardSignIn.html">
					<input type="button" value="sign in">
				</a>
			</div>
		</div>
		
	</body>
</html>