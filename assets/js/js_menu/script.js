/*
 * 
 * autor Bogdana
 */

var showMenu3 = true;
var showMenu4 = true;
var numOfMembers = 0;
var members = [];
var checkGroup = false;
var atLeastOneMember = false;

function  menuClick(menu) {
    if ((showMenu3 && menu == "3") || (showMenu4 && menu == "4")) {
        showMenu(menu);
        if (menu == "3")
            showMenu3 = false;
        else
            showMenu4 = false;
    } else {
        hideMenu(menu);
        if (menu == "3")
            showMenu3 = true;
        else
            showMenu4 = true;
    }
}

function showMenu(menu) {

    if (menu == 4) {
        //document.getElementById(menu).style.width = "400px";	// 
        //document.getElementById(menu).style.height = "400%";	// izvlaci traku s notifikacijama
        //document.getElementById(menu).style.display = "block";
        document.getElementById(menu).style.visibility = "visible";
        document.getElementById(menu).style.opacity = "1";
        document.getElementById(menu).style.height = "800%";
    } else {
        document.getElementById(menu - 2).style.transform = "rotate(135deg)";	// rotira dugme
        document.getElementById(menu).style.top = "115%";	// izvlaci meni
    }
}

function hideMenu(menu) {

    if (menu == 4) {
        //document.getElementById(menu).style.width = "0";	//
        //document.getElementById(menu).style.height = "0";	// sakriva traku s notifikacijama
        //document.getElementById(menu).style.display = "none";
        document.getElementById(menu).style.visibility = "hidden";
        document.getElementById(menu).style.opacity = "0";
        document.getElementById(menu).style.height = "0%";
    } else {
        document.getElementById(menu - 2).style.transform = "rotate(0deg)";	// rotira dugme
        document.getElementById(menu).style.top = "-300%";	// sakriva meni
    }
}


/*
 * 
 *  SEARCH FOR ADD MEMBERS
 *
 * 
 *   */

function membersSearch() {
    var input_data = $('#member').val();        // uzmi vrednost sa inputa
    if (input_data.length === 0) {              // ako nema nista sakrij predloge
        $('#suggestions').hide();
    } else {                                    // u suprotnom postavi parametar member
        var post_data = {
            'member': input_data,
            'num': numOfMembers,
            'members': members,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };

        $.ajax({
            type: "POST",
            //url: "<?php echo base_url(); ?>index.php/NewGroupController/autocomplete/",
            url: "http://localhost/CodeIgniter/index.php/NewGroupController/autocomplete",
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

function chooseMember(member) {
    $('#suggestions').hide();
    if (numOfMembers >= 7)
        return;
    members[numOfMembers] = member;

    var post_data = {
        'num': numOfMembers,
        'member': member,
        'members': members,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    };

    $.ajax({
        type: "POST",
        //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
        url: "http://localhost/CodeIgniter/index.php/NewGroupController/addMember",
        data: post_data,
        success: function (data) {
            // return success    
            if (data.length > 0) {
                $('#members').append(data);
            }
        }
    });
    
    // mozda treba u success da se prebaci
    numOfMembers = numOfMembers + 1;
    document.getElementById("member").value = '';
    if (numOfMembers === 1) {
        atLeastOneMember = true;
    }

    if (atLeastOneMember === true && checkGroup === true) {
        document.getElementById('submit').disabled = false;
    }
    else {
        document.getElementById('submit').disabled = true;
    }

}

function checkExistGroup() {

    var input_data = $('#groupname').val();        // uzmi vrednost sa inputa
    if (input_data.length === 0) { // ako nema nista sakrij predloge
        checkGroup = false;
        document.getElementById('submit').disabled = true;
        //$('#existsGroup').show();
        $('#existsGroup').css({"color": "#E89980"});
        $('#existsGroup').html("Group name is required.");
    } else if (input_data.length < 3) {
        checkGroup = false;
        document.getElementById('submit').disabled = true;
        //$('#existsGroup').show();
        $('#existsGroup').css({"color": "#E89980"});
        $('#existsGroup').html("Group name needs to have at least 3 characters.");
    } else {                                    // u suprotnom postavi parametar member
        var post_data = {
            'groupname': input_data,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };

        $.ajax({
            type: "POST",
            //url: "<?php echo base_url(); ?>index.php/NewGroupController/autocomplete/",
            url: "http://localhost/CodeIgniter/index.php/NewGroupController/checkGroupName",
            data: post_data,
            success: function (data) {   // ako je funkcija kontrolera uspesna
                // return success    
                if (data.length > 0) {
                    //$('#existsGroup').show();
                    $('#existsGroup').html(data);
                    if (data === "Name of the group is taken." || data === "This name is reserved.") {
                        $('#existsGroup').css({"color": "#E89980"});
                        checkGroup = false;
                        document.getElementById('submit').disabled = true;

                    }
                    else {
                        $('#existsGroup').css({"color": "green"});
                        checkGroup = true;
                        if (atLeastOneMember) {
                            document.getElementById('submit').disabled = false;
                        }
                    }
                }
                else {
                    // $('#existsGroup').show();
                    $('#existsGroup').css({"color": "#E89980"});
                    $('#existsGroup').html("Group name is required.");
                    checkGroup = false;
                    document.getElementById('submit').disabled = true;
                }
            }
        });
    }


}

/*
 * 
 * CREATE GROUP SUBMIT 
 * 
 */

function createGroup() {
    var input_data = $('#groupname').val();

    var post_data = {
        'groupname': input_data,
        'num': numOfMembers,
        'members': members,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    };

    $.ajax({
        type: "POST",
        //url: "<?php echo base_url(); ?>index.php/NewGroupController/autocomplete/",
        url: "http://localhost/CodeIgniter/index.php/NewGroupController/createGroup",
        data: post_data,
        success: function (data) {   // ako je funkcija kontrolera uspesna
            numOfMembers = 0;
            members = [];
            checkGroup = false;
            atLeastOneMember = false;
            window.location.href = '../boardController/board/' + data;
        }
    });

    

}

/* MAIN SEARCH BAR */

function groupsSearch() {
    var input_data = $('#group').val();        // uzmi vrednost sa inputa
    if (input_data.length === 0) {              // ako nema nista sakrij predloge
        $('#suggestions1').hide();
    } else {                                    // u suprotnom postavi parametar member
        var post_data = {
            'group': input_data,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };

        $.ajax({
            type: "POST",
            //url: "<?php echo base_url(); ?>index.php/NewGroupController/autocomplete/",
            url: "http://localhost/CodeIgniter/index.php/boardController/autocomplete",
            data: post_data,
            success: function (data) {   // ako je funkcija kontrolera uspesna
                // return success
                // $('#suggestions1').show();
                if (data.length > 0 && data != ' ') {
                    $('#suggestions1').show();
                    $('#autoSuggestionsList1').addClass('auto_list1');
                    $('#autoSuggestionsList1').html(data);
                    data = '';
                }
                else {
                    $('#suggestions1').hide();
                }
            }
        });

    }
}

function chooseGroup(group, idGroup) {
    $('#suggestions1').hide();

    window.location.href = "http://localhost/CodeIgniter/index.php/boardController/board/" + idGroup;

}

function goToGroup() {
    var groupname = document.getElementById('group').value;

    $.ajax({
        type: "POST",
        //url: "<?php echo base_url(); ?>index.php/NewGroupController/autocomplete/",
        url: "http://localhost/CodeIgniter/index.php/boardController/goToGroup/" + groupname,
        success: function (data) {   // ako je funkcija kontrolera uspesna
            // return success
            $('#suggestions1').show();
            $('#autoSuggestionsList1').addClass('auto_list1');
            $('#autoSuggestionsList1').html(data);
            /*
            if (data == 'No such group or you are not a member of it.') {
                setTimeout(function () {
                    document.getElementById('group').value = 'lalalala';
                    $('#suggestions1').hide();
                }, 2000);
            }
            */
        }
    });
    
    //window.location.href = "http://localhost/CodeIgniter/index.php/boardController/goToGroup/" + groupname; 
}

$(function() {
$("#search_id").find( "form" ).on( "submit", function( event ) {
      goToGroup();
      event.preventDefault();
      
    });
});

/*
 * 
 *  LOAD MORE NOTES
 */


function loadMore(iteration, group) {
    $("#load-more" + (iteration - 1)).hide();

    var post_data = {
        'iteration': iteration,
        'group': group,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    };

    $.ajax({
        //type: "POST",
        type: "POST",
        //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
        url: "http://localhost/CodeIgniter/index.php/boardController/loadMore",
        data: post_data,
        dataType: 'html',
        success: function (data) {
            // return success    
            if (data.length > 0)  {
            $('#loadBoard').append(data);
            }
        }
    });
}

/*
 * 
 * CHANGE BOARD
 */

function change(idNote, operation, method) {
    //document.getElementById('group').value = method;

    var post_data = {
        'idNote': idNote,
        'operation': operation,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    };

    $.ajax({
        //type: "POST",
        type: "POST",
        //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
        url: "http://localhost/CodeIgniter/index.php/boardController/" + method,
        data: post_data,
        success: function (data) {
            window.location.reload();
        }
    });
   
}

