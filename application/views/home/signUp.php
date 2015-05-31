<!-- autor: Luka Jovanovic, Dusan Spasojevic-->
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."/assets/css/css_index/style.css"; ?>">
	<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
        
        
           <!--  CSS FAJLOVI  -->
	
	<link rel="stylesheet" href="<?php echo base_url()."/assets/css/css_index/index-css/skel.css"; ?>" />
	<link rel="stylesheet" href="<?php echo base_url()."/assets/css/css_index/index-css/logIn.css"; ?>" />
	<link rel="stylesheet" href="<?php echo base_url()."/assets/css/css_index/index-css/style-wide.css"; ?>" />
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
            <header id="header" class="alt">
			<h1> by Mračni vitezovi</h1>
				<nav id="nav">
					<ul>
						<li>
							Back to
						</li>
						<li>
                                                <a  href="<?php echo base_url()."index.php/HomeController"; ?>"class="button1"> Home page </a>
							
						</li>
					</ul>
				</nav>
				
	</header>
            
            <div id="bg">
                <img src="<?php echo base_url() . "/assets/images/photos/wallpaper.jpg"; ?>" width="100%" height="100%">
            </div>
            <div class="Slide">
                <div class="SlideTitle">
                    welcome to PinBoard!
                </div>
                <?= form_open(base_url() . "index.php/registerController") ?>
               
                <div class="errors1">   <?= form_error("username") ?> </div>
                <div class="errors2">   <?= form_error("password") ?></div>
                <div class="errors3">   <?= form_error("re-password") ?></div>
                <div class="errors4">   <?= form_error("email") ?></div>
                
                 
                <div class="signup1">
                    
                    <?php $val1 = "username"; 
                                                //if (!empty($_POST)) $val1=" "?>
                    <?= form_input(array("name" => "username", "value" => set_value("username"), "placeholder" => "$val1")) ?>
                    <?php $val2 = "password"; // if (!empty($_POST)) $val2= form_error("password")?>
                    <?= form_input(array("name" => "password", "type" => "password", "value" => set_value("password"), "placeholder" => "$val2")) ?>
                </div>


                <div class="signup">
                    <?php $val3 = "re-password"; // if (!empty($_POST)) $val3= form_error("re-password")?>
                    <?= form_input(array("name" => "re-password", "type" => "password", "value" => set_value("re-password"), "placeholder" => "$val3")) ?>
                    <?php $val4 = "email"; // if (!empty($_POST)) $val4= form_error("email")?>
                    <?= form_input(array("name" => "email", "value" => set_value("email"), "placeholder" => "$val4")) ?>
                    <?= form_submit(array("name" => "submit", "value" => "signUp")) ?>
                </div>
                <?= form_close() ?>
            </div>

        </body>
</html>