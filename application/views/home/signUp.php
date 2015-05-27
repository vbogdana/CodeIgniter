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
                            <?=form_open(base_url()."index.php/registerController/signup")?>
                    
				<div class="signup1">
                                    
                                    <?= form_input(array("name"=>"username","value"=>set_value("username"),"placeholder"=>"username"))?>
                                    <?= form_error("username") ?>
                                    
                                    <?= form_input(array("name"=>"password","type"=>"password","value"=>set_value("password"),"placeholder"=>"password"))?>
                                    <?= form_error("password") ?>
                 
				</div>
                    
                    
				<div class="signup">
                                    
                                    <?= form_input(array("name"=>"re-password","type"=>"password","value"=>set_value("re-password"),"placeholder"=>"re-password"))?>
                                    <?= form_error("re-password") ?>
                                    
                                    <?= form_input(array("name"=>"e-mail","value"=>set_value("e-mail"),"placeholder"=>"e-mail"))?>
                                    <?= form_error("username") ?>
                                    
				
                                    <?=form_submit(array("name"=>"submit","value"=>"signUp"))?>
	
				</div>
                    
                                <?=form_close()?>
		</div>
		
	</body>
</html>