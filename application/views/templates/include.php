<!--
autor Bogdana
-->

        <!-- CSS FAJLOVI -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/popup-contact.css"; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/style.css"; ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/newGroup.css"; ?>">
         <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/editProfile.css"; ?>">
        
	<link rel="stylesheet" type="text/css"  href="<?php echo base_url()."assets/css/css_board/standard.css";?>" />
        <link rel="stylesheet" type="text/css"  href="<?php echo base_url()."assets/css/css_board/validation.css";?>"  />
        
        
	<!-- SKRIPT FAJLOVI -->
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
  