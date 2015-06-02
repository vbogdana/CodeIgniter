

/*
 * 
 * @author Bogdana
 */


/*
 *      POP UP EDIT NOTE
 * 
 */

var dialog_edit, idNote, isGroup, groupReminder, personalReminder;


$(function() {
    var form_edit,
      title = $( "#title-edit" ),
      content = $( "#content-edit" ),
      group = $( "#dateGroup-edit" ),
      personal = $( "#datePersonal-edit" ),
      allFields = $( [] ).add( title ).add( content ),
      tips = $( ".validateTips" );
 
 // VALIDACIJA
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 1000 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min) {
            o.addClass("ui-state-error");
            updateTips("Length of " + n + " must be between " +
                    min + " and " + max + " characters.");
            return false;
        } else {
            return true;
        }
    }

    function checkRegexp(o, regexp, n) {
        if (!(regexp.test(o.val()))) {
            o.addClass("ui-state-error");
            updateTips(n);
            return false;
        } else {
            return true;
        }
    }
// VALIDACIJA END

    function editNote() {
        var valid = true;
        allFields.removeClass("ui-state-error");

        valid = valid && checkLength(title, "title", 3, 45);
        valid = valid && checkRegexp(title, /^[a-z]([0-9a-z_\s])+$/i, "Title may consist of a-z, 0-9, underscores, spaces and must begin with a letter.");

        if (valid) {
            var gD = 0, gR = 0, pD = 0, pR = 0, gC = false, pC = false;
            if (isGroup == true) {
                if (document.getElementById('check-edit1').checked == true) {
                    gC = true;
                    gD = group.datepicker({dateFormat: 'yy-mm-dd'}).val();
                    gR = gD + " " + $("#hourGroup-edit").find(":selected").text() + ":" + $("#minuteGroup-edit").find(":selected").text() + ":00";
                }
            }
            if (document.getElementById('check-edit2').checked == true) {
                pC = true;
                pD = personal.datepicker({dateFormat: 'yy-mm-dd'}).val();
                pR = pD + " " + $("#hourPersonal-edit").find(":selected").text() + ":" + $("#minutePersonal-edit").find(":selected").text() + ":00";
            }
            var t = document.getElementById('title-edit').value;
            var c = document.getElementById('content-edit').value;
            
            //document.getElementById('content-edit').value = isGroup + ' ' + gC + ' ' + gR + ' ' + pC + ' ' + pR + ' ' + t + ' ' + c;

            var post_data = {
                'isGroup': isGroup,
                'idNote': idNote,
                'gC': gC,
                'pC': pC,
                'gR': gR,
                'pR': pR,
                't': t,
                'c': c,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            };

            $.ajax({
                type: "POST",
                //url: <?php echo base_url(); ?>'index.php/NewGroupController/editNote/"",
                url: "http://localhost/CodeIgniter/index.php/boardController/editNote",
                data: post_data,
                success: function (data) {
                    if (data.length > 0) {
                        //document.getElementById('location-edit').value = "izmenjena" + data;
                        setTimeout(function () {    
                            dialog_edit.dialog("close");
                            window.location.href = "http://localhost/CodeIgniter/index.php/boardController/board/" + g;
                        }, 1000);
                        
                    }
                }
            });
        }
 
        return valid;
    }

    //definise popup
    dialog_edit = $( "#dialog-form-edit" ).dialog({
      autoOpen: false,
      height: 600,
      width: 900,
      modal: true,
      buttons: {
        'Edit note': editNote,    // proverava i edituje
         Cancel: function() {
          dialog_edit.dialog( "close" );
        }
      },
      close: function() {  
        form_edit[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
    
    // definise elemente popupa
    
    $("#check-edit").button();
    $("#format-edit").buttonset();

// NE ZAVISI VISE OD GRUPE VEC OD BELESKE
    group.datepicker({dateFormat: 'yy-mm-dd'});
    group.datepicker({defaultDate: '2015-06-01'});
    group.datepicker("option", "firstDay", 1);
    $("#hourGroup-edit").selectmenu().selectmenu("menuWidget").addClass("overflow");
    $("#minuteGroup-edit").selectmenu().selectmenu("menuWidget").addClass("overflow");
    personal.datepicker({dateFormat: 'yy-mm-dd'});
    personal.datepicker({defaultDate: '2015-06-01'});
    personal.datepicker("option", "firstDay", 1);
    $("#hourPersonal-edit").selectmenu().selectmenu("menuWidget").addClass("overflow");
    $("#minutePersonal-edit").selectmenu().selectmenu("menuWidget").addClass("overflow");

    // on submit forma
    form_edit = dialog_edit.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      dialog_edit.dialog( "close" );
    });
  
});

/* 
 * prikaz kalendara
 */
function showReminderEdit(check, d) {
    if (d == 1) {
        if (check.checked == true) 
            $("#GROUP-EDIT").css({"visibility":"visible", "display": "block"});
        else
            $("#GROUP-EDIT").css({"visibility":"hidden", "display": "none"});
    } else {
        if (check.checked == true) 
            $("#PERSONAL-EDIT").css({"visibility":"visible", "display": "block"});
        else
            $("#PERSONAL-EDIT").css({"visibility":"hidden", "display": "none"});
    }
}

function editOnClick(note) {
    
    idNote = note;
    document.getElementById('hourGroup-edit').selectedIndex = 12;
    document.getElementById('minuteGroup-edit').selectedIndex = 0;
    document.getElementById('hourPersonal-edit').selectedIndex = 12;
    document.getElementById('minutePersonal-edit').selectedIndex = 0;
    
    var post_data = {
        'idNote': note,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    };

    $.ajax({
        type: "POST",
        //url: <?php echo base_url(); ?>'index.php/NewGroupController/editNote/"",
        url: "http://localhost/CodeIgniter/index.php/boardController/checkGroupNote",
        data: post_data,
        success: function (data) {
            if (data.length > 0) {
                // setovanje polja na trenutne vrednosti beleske
                document.getElementById('title-edit').value = document.getElementById('title'+idNote).innerHTML;
                document.getElementById('content-edit').value = document.getElementById('content'+idNote).innerHTML;
                personalReminder = document.getElementById('personal_Reminder'+idNote).innerHTML;
                groupReminder = document.getElementById('rtext'+idNote).innerHTML;
                var gy = groupReminder.substring(0,4),
                    gm = groupReminder.substring(5,7),
                    gd = groupReminder.substring(8,10),
                    gh = groupReminder.substring(11,13),
                    gmin = groupReminder.substring(14,16),
                    py = personalReminder.substring(0,4),
                    pm = personalReminder.substring(5,7),
                    pd = personalReminder.substring(8,10),
                    ph = personalReminder.substring(11,13),
                    pmin = personalReminder.substring(14,16);
            
                if (data == 'group') {
                    isGroup = true;
                    $(".groupBlock").css({"visibility": "visible", "display": "block"});
                    
                    if (groupReminder == 'no group reminder') {
                        $("#GROUP-EDIT").css({"visibility":"hidden", "display": "none"});
                    } else {
                        $("#check-edit1").prop("checked", true);
                        $('#dateGroup-edit').datepicker("setDate", new Date(gy, gm, gd));
                        $("#GROUP-EDIT").css({"visibility": "visible", "display": "block"});
                        
                        var dd = document.getElementById('hourGroup-edit');
                        for (var i = 0; i < dd.options.length; i++) {
                            if (dd.options[i].text == gh) {
                                dd.selectedIndex = i;
                                $("#hourGroup-edit-button .ui-selectmenu-text").html(gh);
                                break;
                            }
                        }
                        
                        dd = document.getElementById('minuteGroup-edit');
                        for (var i = 0; i < dd.options.length; i++) {
                            if (dd.options[i].text == gmin) {
                                dd.selectedIndex = i;
                                $("#minuteGroup-edit-button .ui-selectmenu-text").html(gmin);
                                break;
                            }
                        }
                    }
                } else {
                    isGroup = false;
                    $(".groupBlock").css({"visibility": "hidden", "display": "none"});
                }
                
                if (personalReminder == 'no personal reminder') {
                        $("#PERSONAL-EDIT").css({"visibility":"hidden", "display": "none"});
                    } else {
                        $("#check-edit2").prop("checked", true);
                        $('#datePersonal-edit').datepicker("setDate", new Date(py,pm,pd) );
                        $("#PERSONAL-EDIT").css({"visibility":"visible", "display": "block"});
                        
                        var ddd = document.getElementById('hourPersonal-edit');
                        for (var i = 0; i < ddd.options.length; i++) {
                            if (ddd.options[i].text == ph) {
                                ddd.selectedIndex = i;
                                $("#hourPersonal-edit-button .ui-selectmenu-text").html(ph);
                                break;
                            }
                        }
                        
                        ddd = document.getElementById('minutePersonal-edit');
                        for (var i = 0; i < ddd.options.length; i++) {
                            if (ddd.options[i].text == pmin) {
                                ddd.selectedIndex = i;
                                $("#minutePersonal-edit-button .ui-selectmenu-text").html(pmin);
                                break;
                            }
                        }
                    }

                dialog_edit.dialog("open");    
                
            }
        }
    });
}
