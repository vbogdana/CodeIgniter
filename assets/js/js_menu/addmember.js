/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * 
 * @author Bogdana Veselinovic
 */

var setgroup = 0, setgroupname = 0;

function setGroup(group, name) {
    setgroup = group;
    setgroupname = name;
}

function setInput(member) {
    document.getElementById('addmember').value = member;
    $('#suggestions').hide();
}

function addMembersSearch() {
    var input_data = $('#addmember').val();        // uzmi vrednost sa inputa
    if (input_data.length === 0) {              // ako nema nista sakrij predloge
        $('#suggestions').hide();
    } else {                                    // u suprotnom postavi parametar member
        var post_data = {
            'member': input_data,
            'idGroup': setgroup,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };

        $.ajax({
            type: "POST",
            //url: "<?php echo base_url(); ?>index.php/NewGroupController/autocomplete/",
            url: "http://localhost/CodeIgniter/index.php/GroupPanelController/autocomplete",
            data: post_data,
            success: function (data) {   // ako je funkcija kontrolera uspesna
                // return success
                $('#suggestions').show();
                if (data.length > 0 && data != ' ') {
                    $('#suggestions').show();
                    $('#autoSuggestionsList').addClass('auto_list');
                    $('#autoSuggestionsList').html(data);
                    data = '';
                }
                else {
                    $('#suggestions').hide();
                }
            }
        });

    }
}

function checkMember() {
    var member = document.getElementById('addmember').value;
    
    var post_data = {
            'member': member,
            'idGroup': setgroup,
            'groupname': setgroupname,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };
    
    $.ajax({
            type: "POST",
            //url: "<?php echo base_url(); ?>index.php/NewGroupController/autocomplete/",
            url: "http://localhost/CodeIgniter/index.php/GroupPanelController/addmember",
            data: post_data,
            success: function (data) {   // ako je funkcija kontrolera uspesna
                // return success
               //document.getElementById('group').value = data; 
               //if (data == 'Member is successfully added.')
                    document.getElementById('addmember').value = data;
            }
        });
   
}