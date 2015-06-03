/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
    getNotifications();   
});

function getNotifications() {
    $.ajax({
        type: "GET",
        //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
        url: "http://localhost/CodeIgniter/index.php/boardController/getNotifications/count",
        success: function (result) {
            if (result != '0')
                $('#nc').css({"visibility":"visible"});
            else
                $('#nc').css({"visibility":"hidden"});
            $('#nc').html(result);
            setTimeout(function () {
                getNotifications();
            }, 5000);
        }
    });
}

function loadNotifications() {
    menuClick(4);
    $.ajax({
        type: "GET",
                //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
                url: "http://localhost/CodeIgniter/index.php/boardController/getNotifications/read",
                success: function (result) {
                    if (result.length > 0) {
                        //document.getElementById('group').value = result;
                        $("#4").html(result);
                    }
                }
    });
}

function seeNotification(idNotification, idGroup) {
    var post_data = {
            'idNotification': idNotification,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };
    
    $.ajax({
        type: "POST",
        data: post_data,
        //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
        url: "http://localhost/CodeIgniter/index.php/boardController/readNotification/",
        success: function (result) {
            if (result.length > 0) {
                window.location.href = "http://localhost/CodeIgniter/index.php/boardController/board/" + idGroup;
            }
        }
    });
}

function seeAlarm(idNote, personal) {
     window.location.href = "http://localhost/CodeIgniter/index.php/boardController/readAlarm/" + idNote + "/" + personal;
}