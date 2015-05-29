

<!-- autor: Dusan Spasojevic-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "/assets/css/css_index/style.css"; ?>">
        <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
        
        <!--  CSS FAJLOVI  -->
	
	<link rel="stylesheet" href="<?php echo base_url()."/assets/css/css_index/index-css/skel.css"; ?>" />
	<link rel="stylesheet" href="<?php echo base_url()."/assets/css/css_index/index-css/style.css"; ?>" />
	<link rel="stylesheet" href="<?php echo base_url()."/assets/css/css_index/index-css/style-wide.css"; ?>" />
        
        
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
        
        <header id="header" class="alt">
            <h1> by Mračni vitezovi</h1>
            <nav id="nav">
                <ul>
                    <li>
                        You don not have an account?
                    </li>
                    <li>
                        <a  href="<?php echo base_url() . "index.php/HomeController/signUp"; ?>"class="button"> Sign up </a>	
                    </li>
                </ul>
            </nav>
            <a name="toppage"></a>
        </header>


        <div id="bg">
            <img src="<?php echo base_url() . "/assets/images/photos/wallpaper2.jpg"; ?>" width="100%" height="100%">
        </div>
        <div class="Slide">
            <div class="SlideTitle">
                <?php echo "welcome to PinBoard" ?>
            </div>
            <div class="login">
                <br>
                <br>
                 <h2>Please Sign in </h2>
                <?php echo validation_errors(); ?>
                <?php echo form_open('LoginController/checkLogin'); ?>

                <input type="text" placeholder="username" name="username"><br>
                <input type="password" placeholder="password" name="password"><br>
                <input class="button"  type="submit" value="sign in">
                
                <?php echo form_close(); ?>
            </div>
        </div>

    </body>
</html>

