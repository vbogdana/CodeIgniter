<!--
autor Bogdana
-->

        <!-- CSS FAJLOVI -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/style.css"; ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/newGroup.css"; ?>">
         <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/editProfile.css"; ?>">
        
	<link rel="stylesheet" type="text/css"  href="<?php echo base_url()."assets/css/css_board/standard.css";?>" />
        <link rel="stylesheet" type="text/css"  href="<?php echo base_url()."assets/css/css_board/validation.css";?>"  />
        
        
	<!-- SKRIPT FAJLOVI -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script src="<?php echo base_url()."/assets/js/js_menu/script.js"; ?>"> </script>
	<script type="text/javascript" src="<?php echo base_url()."assets/js/js-edit-profile/livevalidation.js";?>"></script>
        
          <script type="text/javascript">
                var createHtmlMessageDiv = function(scope){
                var div = document.createElement('div');
                div.innerHTML = scope.message;
                return div;
            }

            var myLiveValidationCallback = function(){
                this.insertMessage(createHtmlMessageDiv(this));
                this.addFieldClass();
            }
          </script>
          
        
      <!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
      <!--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
        
        <link href="<?php echo base_url()."/assets/jquery/jquery-ui.css"; ?>" rel="stylesheet">
        <script src="<?php echo base_url()."/assets/jquery/external/jquery/jquery.js"; ?>"> </script>
        <script src="<?php echo base_url()."/assets/jquery/jquery-ui.js"; ?>"> </script>
  
