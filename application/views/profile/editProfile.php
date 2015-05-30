<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

autor Dusan 
-->


<script src="<?php echo base_url()."/assets/js/js-edit-profile/validation.js"; ?>"> </script>

  <script type="text/javascript">
    var createHtmlMessageDiv = function(scope){
    var div = document.createElement('div');
    div.innerHTML = scope.message;
    return div;
};

var myLiveValidationCallback = function(){
    this.insertMessage(createHtmlMessageDiv(this));
    this.addFieldClass();
};
  </script>
  
  
  

<div class="BoardContainer">
     <input type="text" id="f2" />
		  <script type="text/javascript">
		     var f2 = new LiveValidation('f2');
		     f2.add(Validate.Format, { pattern: /live/i });
		  </script>  

    <?php
    // Change the css classes to suit your needs    
    $attributes = array('class' => '', 'id' => '');
    echo form_open('NewGroupController', $attributes);
    ?>

    <div class='Options'>
        <li>
            <div class="label">
                Change your password:  
                
            </div> 
            <br />
            <input id="groupname" type="password" name="groupname" maxlength="20" value="<?php echo set_value('groupname'); ?>" onkeyup="checkExistGroup()" oninput="checkExistGroup()" placeholder="enter old password"/>
            <br>
            <input id="groupname" type="password" name="groupname" maxlength="20" value="<?php echo set_value('groupname'); ?>" onkeyup="checkExistGroup()" oninput="checkExistGroup()"placeholder="enter new password"/>
            <div id="existsGroup"> </div>
        </li> 

        <li>
            <div class="label">
               Change your mail: 
            </div>
            <br />
            <input id="member" type="text" name="member" maxlength="30" value="<?php echo set_value('member'); ?>" onkeyup="membersSearch();" /> 
            <div id="suggestions">
                <div id="autoSuggestionsList">  </div>
            </div>
        </li>
    </div>

    <div class="Submit">
    <p>
        <br /> <br /> <br /> <br />
        <input type="button" onclick="createGroup()" value="Save Changes" id='submit' disabled />   
    </p>
    </div>

    <?php echo form_close(); ?>
    
    
    
    
</div>
