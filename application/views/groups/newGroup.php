<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

autor Bogdana 
-->

<div class="BoardContainer">
    

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
                Add a member <span class="required">*</span>
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
        <input type="button" onclick="createGroup()" value="Create Group" id='submit' disabled />   
    </p>
    </div>

    <?php echo form_close(); ?>
    
    <div id="members">
        Added members
        <ol></ol>
    </div>
    
    
</div>
