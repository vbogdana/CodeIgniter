<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

autor Dusan 
-->
<script type="text/javascript" src="<?php echo base_url()."assets/js/js-edit-profile/iconselect.js";?>"></script>
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


<div class="BoardContainer1">
    <?php $password = $this->session->userdata('password'); ?>


    <?= form_open(base_url() . "index.php/editProfileController") ?>

    <div class='Optionsedit'>
        <li>
            <div class="label">
                Change your password:  
            </div> 
            <br />
            <div class="section" id="examplePresence">
                <?= form_input(array("name" => "email", "id" => "f1", "type" => "password", "value" => set_value("oldpassword"), "placeholder" => "enter old password")) ?>
                <script type="text/javascript">
                  var f1 = new LiveValidation('f1',{ validMessage: "you enter right password !",  });
                  f1.add( Validate.Format, 
                  { pattern: /^<?php echo "$password"; ?>$/i, failureMessage: "You have not yet entered the correct password"});
                </script>  
                </p>
            </div>

            <br>
            <?= form_input(array("name" => "password", "id" => "f3", "type" => "password", "value" => set_value("password"), "placeholder" => "enter new password")) ?>
            <script type="text/javascript">
                var f3 = new LiveValidation('f3', {validMessage: "you enter correct password !", });
                f3.add(Validate.Length, {minimum: 6, maximum: 16});
            </script> 

        </li> 

        <li>
            <div class="label">
                Change your mail: 
            </div>
            <br />

<!--
            <?= form_input(array("name" => "email", "id" => "f2", "type" => "text", "value" => set_value("email"), "placeholder" => "enter new email")) ?>
            <script type="text/javascript">
                var f2 = new LiveValidation('f2', {validMessage: "your email is valid", });
                f2.add(Validate.Email);</script>  
        </li>
        <div class="Submitedit">
            <p>
                <?= form_submit(array("name" => "submit", "class" => "button", "value" => "Save Changes")) ?>  
            </p>
        </div>
-->
             <?= form_input(array("name" => "email","id" => "f2", "type" => "text", "value" => set_value("email"), "placeholder" => "enter new email")) ?>
                <script type="text/javascript">
		     var f2 = new LiveValidation('f2',{ validMessage: "your email is valid"  });
                         f2.add( Validate.Email );</script>  
        </li>
        
        <?php  if (isset($_POST['submit'])) {          echo 'vase informacije su uspesno promenjene!!!'; }
        ?>
        
          <div class="Submitedit">
         <p>
    
        <br />  <br /> <br />
        <?= form_submit(array("name" => "submit","type" => "submit","class" => "button", "value" => "Save Changes")) ?>  
        </p>
        </div>
        
        

    </div>
        <?= form_close() ?>
    
    
    <div class="uploadpicture">
        <div class="profilpicture">
            <img class="profilpicture" src="<?php 
              $picture=$this->session->userdata('image');
              if($picture==""){
            echo base_url()."/assets/images/photos/bbb.png"; 
              }else{
                  echo base_url()."/assets/images/profilepictures/$picture";
              }
            ?>" width="300px" height="300px"/>
            <br>
        </div>
          <br>
        <form action="<?php echo base_url() . "index.php/uploadImageController/upload_file"?>" method="POST" enctype="multipart/form-data">
            <div class="typefile">
              <input  type="file" name="product_pic" value="Choose your picture">
            </div>
    
    </div>
    
     <div class="picknote">
         Choose color of your note: <div class="notes">  <div  id="my-icon-select"></div> </div>
         
     
                  
            </div>     
    <div class="buttonposition"><input type="submit" value="save and exit" class="button"></div>
          
        </form>
    

   
    </div>
        

    
