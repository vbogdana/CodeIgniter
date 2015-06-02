<!--
autor Bogdana
-->

        <!-- CSS FAJLOVI -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/style.css"; ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/newGroup.css"; ?>">
         <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/editProfile.css"; ?>">
         
            <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/css_board/iconselect.css"; ?>" >
        
	<link rel="stylesheet" type="text/css"  href="<?php echo base_url()."assets/css/css_board/standard.css";?>" />
        <link rel="stylesheet" type="text/css"  href="<?php echo base_url()."assets/css/css_board/validation.css";?>"  />
        
        
	<!-- SKRIPT FAJLOVI -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script src="<?php echo base_url()."/assets/js/js_menu/script.js"; ?>"> </script>
        <script src="<?php echo base_url()."/assets/js/js_note/note_buttons.js"; ?>"> </script>
        <script src="<?php echo base_url()."/assets/js/js_note/popup.js"; ?>"> </script>
	<script type="text/javascript" src="<?php echo base_url()."assets/js/js-edit-profile/livevalidation.js";?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url()."assets/js/js-edit-profile/iscroll.js";?>"></script>
        
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
          
        
        <link href="<?php echo base_url()."/assets/jquery/jquery-ui.css"; ?>" rel="stylesheet">
        <script src="<?php echo base_url()."/assets/jquery/external/jquery/jquery.js"; ?>"> </script>
        <script src="<?php echo base_url()."/assets/jquery/jquery-ui.js"; ?>"> </script>
  
                    <script>
        /* PROBLEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEM */ 
        var iconSelect;

        window.onload = function(){

            iconSelect = new IconSelect("my-icon-select", 
                {'selectedIconWidth':48,
                'selectedIconHeight':48,
                'selectedBoxPadding':5,
                'iconsWidth':48,
                'iconsHeight':48,
                'boxIconSpace':3,
                'vectoralIconNumber':8,
                'horizontalIconNumber':1});

            var icons = [];
            icons.push({'iconFilePath':'<?php echo base_url()."/assets/images/photos/note-red.png"; ?>', 'iconValue':'1'});
            icons.push({'iconFilePath':'<?php echo base_url()."/assets/images/photos/note-green.png"; ?>', 'iconValue':'2'});
            icons.push({'iconFilePath':'<?php echo base_url()."/assets/images/photos/note-pink.png"; ?>', 'iconValue':'3'});
            icons.push({'iconFilePath':'<?php echo base_url()."/assets/images/photos/note-blue.png"; ?>', 'iconValue':'4'});
            icons.push({'iconFilePath':'<?php echo base_url()."/assets/images/photos/note-orange.png"; ?>', 'iconValue':'5'});
            icons.push({'iconFilePath':'<?php echo base_url()."/assets/images/photos/note-violet.png"; ?>', 'iconValue':'6'});
            icons.push({'iconFilePath':'<?php echo base_url()."/assets/images/photos/note-purple.png"; ?>', 'iconValue':'7'});
            icons.push({'iconFilePath':'<?php echo base_url()."/assets/images/photos/note-grey.png"; ?>', 'iconValue':'8'});
            icons.push({'iconFilePath':'<?php echo base_url()."/assets/images/photos/note-yellow.png"; ?>', 'iconValue':'9'});
                
               
               
            iconSelect.refresh(icons);

        };
            
        </script>
