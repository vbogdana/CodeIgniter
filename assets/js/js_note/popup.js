

/*
 * 
 * @author Bogdana
 */


/*
 *      POP UP NEW NOTE
 * 
 */

$(function() {
    var dialog, form,
      //emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      title = $( "#title" ),
      content = $( "#content" ),
      group = $( "#dateGroup" ),
      personal = $( "#datePersonal" ),
      allFields = $( [] ).add( title ).add( content ),
      tips = $( ".validateTips" );
 
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

    function createNote() {
        var valid = true;
        allFields.removeClass("ui-state-error");

        valid = valid && checkLength(title, "title", 3, 45);
        valid = valid && checkLength(content, "content", 1, 500);
        //valid = valid && checkLength( password, "password", 5, 16 );

        valid = valid && checkRegexp(title, /^[a-z]([0-9a-z_\s])+$/i, "Title may consist of a-z, 0-9, underscores, spaces and must begin with a letter.");
        //valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
        //valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

        if (valid) {
            var g = document.getElementById('location').value;
            var gD = 0, gR = 0, pD = 0, pR = 0, gC = false, pC = false;
            if (g != "global" && g != "important" && g != "hidden") {
                if (document.getElementById('check1').checked == true) {
                    gC = true;
                    gD = group.datepicker({dateFormat: 'yy-mm-dd'}).val();
                    gR = gD + " " + $("#hourGroup").find(":selected").text() + ":" + $("#minutePersonal").find(":selected").text() + ":00";
                }
            }
            if (document.getElementById('check2').checked == true) {
                pC = true;
                pD = personal.datepicker({dateFormat: 'yy-mm-dd'}).val();
                pR = pD + " " + $("#hourPersonal").find(":selected").text() + ":" + $("#minutePersonal").find(":selected").text() + ":00";
            }
            var t = document.getElementById('title').value;
            var c = document.getElementById('content').value;

            //document.getElementById('content').value = "" + g + ' ' + gC + ' ' + gR + ' ' + pC + ' ' + pR + ' ' + t + ' ' + c;

            var post_data = {
                'g': g,
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
                //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
                url: "http://localhost/CodeIgniter/index.php/boardController/createNote",
                data: post_data,
                success: function (data) {
                    if (data.length > 0) {
                        //document.getElementById('content').value = data;
                        setTimeout(function () {    
                            dialog.dialog("close");
                            window.location.reload();
                        }, 1000);
                        
                    }
                }
            });
        }
        
        return valid;
    }
 
    // definise popup
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 600,
      width: 900,
      modal: true,
      buttons: {
        'Create a note': createNote,    // proverava
         Cancel: function() {
          dialog.dialog( "close" );
          //$( "#dialog-form" ).css({"visibility":"hidden"});
        }
      },
      close: function() {  
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
        //$( "#dialog-form" ).css({"visibility":"hidden"});
      }
    });
    
    // definise elemente popupa
    var g = document.getElementById('location').value;
    $("#check").button();
    $("#format").buttonset();

    if (g != "global" && g != "important" && g != "hidden") {  
        group.datepicker({dateFormat: 'yy-mm-dd'});
        group.datepicker( {defaultDate: '2015-06-01'} );
        group.datepicker( "option", "firstDay", 1 );
        $( "#hourGroup" ).selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
        $( "#minuteGroup" ).selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
    }
    personal.datepicker({dateFormat: 'yy-mm-dd'});
    personal.datepicker( {defaultDate: '2015-06-01'} ); 
    personal.datepicker( "option", "firstDay", 1 );
    $( "#hourPersonal" ).selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
    $( "#minutePersonal" ).selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
 
    // on submit forma
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      dialog.dialog( "close" );
      //createNote();
    });
    
    // on click na add note
    $("#create-note").on("click", function () {
        //$("#dialog-form").css({"visibility": "visible"});
        dialog.dialog("open"); 
    });
    
});

function showReminder(check, d) {
    //document.getElementById('content').value = "reminderGroup";
    var add = '';
    
    if (d == 1)
        add = 'Group';
    else
        add = 'Personal';
    var date = $("#date"+add),
        hour = $("#hour"+add),
        minute = $("#minute"+add),
        shour = $("span#hour"+add+"-button"),
        sminute = $("span#minute"+add+"-button");

    if (check.checked == true) {
        date.css({"visibility":"visible"}, {"display":"block"});
        //hour.css({"visibility":"visible"}, {"display":"block"});
        //minute.css({"visibility":"visible"}, {"display":"block"});
        shour.css({"visibility":"visible"}, {"display":"block"});
        sminute.css({"visibility":"visible"}, {"display":"block"});
    } else {
        date.css({"visibility":"hidden"}, {"display":"none"});
        //hour.css({"visibility":"hidden"}, {"display":"none"});
        //minute.css({"visibility":"hidden"}, {"display":"none"});
        shour.css({"visibility":"hidden"}, {"display":"none"});
        sminute.css({"visibility":"hidden"}, {"display":"none"});
    }
    
}