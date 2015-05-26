

	<script type='text/javascript' src='js/js-nova-beleska/gen_validatorv31.js'></script>
	<script type='text/javascript' src='js/js-nova-beleska/fg_ajax.js'></script>
	<script type='text/javascript' src='js/js-nova-beleska/fg_moveable_popup.js'></script>
	<script type='text/javascript' src='js/js-nova-beleska/fg_form_submitter.js'></script>
	
		<!-- CSS ZA PODESAVANJE DATUMA I VREMENA -->
		<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<link rel="stylesheet" media="all" type="text/css" href="css/time-date-picker/jquery-ui-timepicker-addon.css" />
		
		<!-- SKRIPTE ZA PODESAVANJE DATUMA I VREMENA -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/js-time-date-picker/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="js/js-time-date-picker/jquery-ui-sliderAccess.js"></script>
		<script type="text/javascript" src="js/js-time-date-picker/script.js"></script>
		
		
<div id='fg_formContainer'>
    <div id="fg_container_header">
        <div id="fg_box_Title">Create new note</div>
        <div id="fg_box_Close"><a href="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');"><img src="images/close.png" width="20%" height="20%" /></a></div>
    </div>

    <div id="fg_form_InnerContainer">
    <form id='contactus' action='javascript:fg_submit_form()' method='post' accept-charset='UTF-8'>

    <div class='container'>
        <label for='name' >Title:</label><br/>
        <input type='text' name='name' id='name' value='' maxlength="20" /><br/>
    </div>
    
    <div class='container'>
        <label for='message' >Content:</label><br/>
        <span id='contactus_message_errorloc' class='error'></span>
        <textarea rows="10" cols="50" name='message' id='message'></textarea>
    </div>	
	
	<div class='container'>
         <label for='message' >Pick date and time:</label><br/>
		<input type="text" value="" id="basic_example_1" name="basic_example_1" />
    </div>
	
	<div class='container'>
         <label for='message' >Pick remender:</label><br/>
		<input type="text" value="" id="basic_example_1" name="basic_example_1" />
    </div>
	
	
    <div class='container'>
        <input type='submit' name='Submit' value='Create note' />
    </div>
    </form>
    </div>
</div>


<!--VALIDACIJA SA KLIJENT STRANE -->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("contactus");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("message","maxlen=2048","The note is too long!");
	frmvalidator.addValidation("message","req","Please provide a content for note");

    document.forms['contactus'].refresh_container=function()
    {
        var formpopup = document.getElementById('fg_formContainer');
        var innerdiv = document.getElementById('fg_form_InnerContainer');
        var b = innerdiv.offsetHeight+30+30;

        formpopup.style.height = b+"px";
    }

    document.forms['contactus'].form_val_onsubmit = document.forms['contactus'].onsubmit;


    document.forms['contactus'].onsubmit=function()
    {
        if(!this.form_val_onsubmit())
        {
            this.refresh_container();
            return false;
        }

        return true;
    }
    function fg_submit_form()
    {
         
    }

// ]]>
</script>

<div id='fg_backgroundpopup'></div>

<div id='fg_submit_success_message'>
    <h2>Thanks!</h2>
    <p>
    Thanks for contacting us. We will get in touch with you soon!
    <p>
        <a href="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');">Close this window</a>
    <p>
    </p>
</div>
