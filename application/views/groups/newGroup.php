<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

@author Bogdana 
-->

<div class="BoardContainer" style="height: 85%;">
    

    
<div class="groupsContainer">
    
    <?php
    // Change the css classes to suit your needs    
    $attributes = array('class' => '', 'id' => '');
    echo form_open('NewGroupController', $attributes);
    ?>
    
    <div class='Options'>
        <li>
            <div class="label">
                Group name <span class="required">*</span>
                
            </div> 
            <br />
            <input id="groupname" type="text" name="groupname" maxlength="30" value="<?php echo set_value('groupname'); ?>" onkeyup="checkExistGroup()" oninput="checkExistGroup()"/>
            <div id="existsGroup"> </div>
        </li> 

        <li>
            <div class="label">
                Add at least one member
            </div>
            <br />
            <input id="member" type="text" name="member" maxlength="30" value="<?php echo set_value('member'); ?>" onkeyup="membersSearch()" oninput="membersSearch()" /> 
            <div id="suggestions">
                <div id="autoSuggestionsList">  </div>
            </div>
        </li>
        
        <div class="Submit">
        <p>
            <input type="button" onclick="createGroup()" value="Create Group" id='submit' disabled />   
        </p>
        </div>
    </div>

    
    
    <?php echo form_close(); ?>
    
    <div id="members">
        Added members
        <ol></ol>
    </div>

    
</div>
    
    
</div>
