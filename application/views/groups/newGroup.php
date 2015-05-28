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
        function ajaxSearch() {
            var input_data = $('#member').val();        // uzmi vrednost sa inputa
            if (input_data.length === 0) {              // ako nema nista sakrij predloge
                $('#suggestions').hide();
            } else {                                    // u suprotnom postavi parametar member
                var post_data = {
                    'member': input_data,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                };

                $.ajax({
                    type: "POST",
                    //url: "<?php echo base_url(); ?>index.php/NewGroupController/autocomplete/",
                    url: "http://localhost/CodeIgniter/index.php/NewGroupController/autocomplete",
                    data: post_data,
                    success: function(data) {   // ako je funkcija kontrolera uspesna
                        // return success    
                        if (data.length > 0) {
                            $('#suggestions').show();
                            $('#autoSuggestionsList').addClass('auto_list');
                            $('#autoSuggestionsList').html(data);
                        }
                    }
                });

            }
        }
        
        function chooseMember(member) {
            document.getElementById("member").value = member;
            $('#suggestions').hide();
            
            var input_data = $('#member').val();
            var post_data = {
                    'member': input_data,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                };

            $.ajax({
                    type: "POST",
                    //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
                    url: "http://localhost/CodeIgniter/index.php/NewGroupController/addMember",
                    data: post_data,
                    success: function(data) {
                        // return success    
                        if (data.length > 0) {
                            $('#members').show();
                            //$('#members').addClass('auto_list');
                            //$('#members').html(data);
                            $('ol').append(data);
                        }
                    }
                });

        }
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
        <input id="groupname" type="text" name="groupname" maxlength="30" value="<?php echo set_value('groupname'); ?>" />
    </p>

    <p>
        <label for="member">Add a member <span class="required">*</span></label>
        <?php echo form_error('member'); ?>
        <br />
        <input id="member" type="text" name="member" maxlength="30" value="<?php echo set_value('member'); ?>" onkeyup="ajaxSearch();" /> 
        <div id="suggestions">
            <div id="autoSuggestionsList">  
            </div>
        </div>
    </p>

    <p>
        <br /> <br /> <br /> <br />
        <?php echo form_submit('submit', 'Submit'); ?>
    </p>

    <?php echo form_close(); ?>
    
    <div id="members">
        <ol></ol>
    </div>
    
</div>
