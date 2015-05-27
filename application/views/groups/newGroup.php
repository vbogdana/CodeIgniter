<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="BoardContainer">
    
    <!--
    <form class="" action="newGroupController/createGroup/" method="post">
        <div class="GroupName">
            <input type="text" name="groupName" size="50" placeholder="name of the group..."/>
        </div>


        <div class="AddMember">
            <input type="text" class="" name="member" placeholder="first member...">
            <input class="" type="button" value="add" onclick="" />
            <br /><br />
            <div class="">
                <input class="" type="submit" value="create" />
            </div>
        </div>
    </form>
    
    <div class="Members">
        Members of the group...
        <textarea size="50" rows="20" name="members" >

        </textarea>
        
    </div>
    -->
    
    <script type="text/javascript">
        $(document).ready(function(){
      $("#member").keyup(function(){
        if($("#member").val().length>3){
        $.ajax({
            type: "post",
            url: "http://localhost/CodeIgniter/index.php/NewGroupController/autocomplete",
            cache: false,               
            data:'member='+$("#member").val(),
            success: function(response){
                $('#finalResult').html("");
                var obj = JSON.parse(response);
                if(obj.length>0){
                    try{
                        var items=[];   
                        $.each(obj, function(i,val){                                            
                            items.push($('<li/>').text(val.NAME));
                        }); 
                        $('#finalResult').append.apply($('#finalResult'), items);
                    }catch(e) {     
                        alert('Exception while request..');
                    }       
                }else{
                    $('#finalResult').html($('<li/>').text("No Data Found"));       
                }       

            },
            error: function(){                      
                alert('Error while request..');
            }
        });
        }
        return false;
      });
    });
</script>
    
    <?php
        // Change the css classes to suit your needs    
        $attributes = array('class' => '', 'id' => '');
        echo form_open('NewGroupController', $attributes);
    ?>

    <p>
        <label for="groupname">Group name <span class="required">*</span></label>
        <?php echo form_error('groupname'); ?>
        <br />
        <input id="groupname" type="text" name="groupname" maxlength="30" value="<?php echo set_value('groupname'); ?>"  />
    </p>

    <p>
        <label for="member">Add a member <span class="required">*</span></label>
        <?php echo form_error('member'); ?>
        <br />
        <input id="member" type="text" name="member" maxlength="30" value="<?php echo set_value('member'); ?>" onkeyup="ajaxSearch()" /> 
        <ul id="finalResult"></ul>

    </p>

    <p>
    <?php echo form_submit('submit', 'Submit'); ?>
    </p>

    <?php echo form_close(); ?>
    
</div>
