

/*
 * 
 * @author Bogdana
 */


/*
 *      ADD PERSONAL REMINDER
 * 
 */
var idNote = 0, dialog_add;

$(function () {
    var form_add,
            personal = $("#datePersonal-add");

    function addReminder() {
        var pD = 0, pR = 0;
        pD = personal.datepicker({dateFormat: 'yy-mm-dd'}).val();
        pR = pD + " " + $("#hourPersonal-add").find(":selected").text() + ":" + $("#minutePersonal-add").find(":selected").text() + ":00";

        var post_data = {
            'idNote': idNote,
            'pR': pR,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };

        $.ajax({
            type: "POST",
            //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
            url: "http://localhost/CodeIgniter/index.php/boardController/addPersonal",
            data: post_data,
            success: function (data) {
                if (data.length > 0) {
                    //document.getElementById('content').value = data;
                    setTimeout(function () {
                        $("#personal_Reminder"+idNote).html(data);
                        dialog_add.dialog("close");
                    }, 1000);

                }
            }
        });
    }
 
    // definise popup
    dialog_add = $( "#dialog-form-add" ).dialog({
      autoOpen: false,
      height: 500,
      width: 450,
      modal: true,
      buttons: {
        'Add a reminder': addReminder,
         Cancel: function() {
          dialog_add.dialog( "close" );
        }
      },
      close: function() {  
        form_add[ 0 ].reset();
      }
    });
    
    // definise elemente popupa
    personal.datepicker({dateFormat: 'yy-mm-dd'});
    personal.datepicker( {defaultDate: '2015-06-10'} ); 
    personal.datepicker( "option", "firstDay", 1 );
    $( "#hourPersonal-add" ).selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
    $( "#minutePersonal-add" ).selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
 
    // on submit forma
    form_add = dialog_add.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      dialog_add.dialog( "close" );
    });
 
});

function addPersonal(note) {
    idNote = note;
    dialog_add.dialog("open"); 
    
}