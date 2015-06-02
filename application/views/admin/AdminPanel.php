<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

autor Dusan 
-->




<div class="BoardAdminPanel">
    <?php $password = $this->session->userdata('password'); ?>


 

    <div class='Optionsusers'>
        
         <?php  $this->load->model('AdminPanel_Model','adminPanel');
                $this->adminPanel->getAllUsers();
            ?>

    </div>
       
    
    
     <div class='Optionsusers'>
        
           <?= form_open(base_url() . "index.php/editProfileController") ?>
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
        
         <?= form_close() ?>

    </div>
        
</div>

    
