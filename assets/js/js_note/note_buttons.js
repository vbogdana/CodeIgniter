

/*
 * 
 * @author Bogdana
 */


function changeIcon(image) {
    if (image.src === "http://localhost/CodeIgniter/assets/images/png/star.png") {
        image.src = "http://localhost/CodeIgniter/assets/images/png/star_black.png";
    } else if (image.src === "http://localhost/CodeIgniter/assets/images/png/lock.png") {
        image.src = "http://localhost/CodeIgniter/assets/images/png/lock_black.png";
    } else if (image.src === "http://localhost/CodeIgniter/assets/images/png/hide.png") {
        image.src = "http://localhost/CodeIgniter/assets/images/png/hide_black.png";
    } else if (image.src === "http://localhost/CodeIgniter/assets/images/png/edit.png") {
        image.src = "http://localhost/CodeIgniter/assets/images/png/edit_black.png";
    } else if (image.src === "http://localhost/CodeIgniter/assets/images/png/delete.png") {
        image.src = "http://localhost/CodeIgniter/assets/images/png/delete_black.png";
    } else if (image.src === "http://localhost/CodeIgniter/assets/images/png/delete_black.png") {
        image.src = "http://localhost/CodeIgniter/assets/images/png/delete.png";
    } else if (image.src === "http://localhost/CodeIgniter/assets/images/png/edit_black.png") {
        image.src = "http://localhost/CodeIgniter/assets/images/png/edit.png";
    } else if (image.src === "http://localhost/CodeIgniter/assets/images/png/hide_black.png") {
        image.src = "http://localhost/CodeIgniter/assets/images/png/hide.png";
    } else if (image.src === "http://localhost/CodeIgniter/assets/images/png/lock_black.png") {
        image.src = "http://localhost/CodeIgniter/assets/images/png/lock.png";
    } else {
        image.src = "http://localhost/CodeIgniter/assets/images/png/star.png";
    }

}



function loadImages(idNote, group) {

    //document.getElementById('group').value += idNote;
    var importantId = "#important" + idNote;
    var lockId = "#lock" + idNote;
    var hideId = "#hide" + idNote;
    var deleteId = "#delete" + idNote;
    var editId = "#edit" + idNote;
    var creatorId = "#creator" + idNote;

    var post_data = {
        'idNote': idNote,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    };

    if (group != "hidden") {
        $.ajax({
            type: "POST",
            //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
            url: "http://localhost/CodeIgniter/index.php/boardController/importantImg",
            data: post_data,
            success: function (data) {
                if (data.length > 0) {
                    $(importantId).append(data);
                }
            }
        });

        $.ajax({
            type: "POST",
            //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
            url: "http://localhost/CodeIgniter/index.php/boardController/lockImg",
            data: post_data,
            success: function (data) {
                if (data.length > 0) {
                    $(lockId).append(data);
                    $('#group').value += data;
                }
            }
        });
        
        $.ajax({
            type: "POST",
            //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
            url: "http://localhost/CodeIgniter/index.php/boardController/editImg",
            data: post_data,
            success: function (data) {
                if (data.length > 0) {
                    $(editId).append(data);
                }
            }
        });
    }

    $.ajax({
        type: "POST",
        //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
        url: "http://localhost/CodeIgniter/index.php/boardController/hideImg",
        data: post_data,
        success: function (data) {
            if (data.length > 0) {
                $(hideId).append(data);
            }
        }
    });

    $.ajax({
        type: "POST",
        //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
        url: "http://localhost/CodeIgniter/index.php/boardController/deleteImg",
        data: post_data,
        success: function (data) {
            if (data.length > 0) {
                $(deleteId).append(data);
            }
        }
    });
    
    $.ajax({
        type: "POST",
        //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
        url: "http://localhost/CodeIgniter/index.php/boardController/creatorInfo",
        data: post_data,
        success: function (data) {
            if (data.length > 0) {
                $(creatorId).append(data);
            }
        }
    });


}
