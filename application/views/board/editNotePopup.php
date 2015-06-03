<?php

/*
 * 
 * 
 * @author Bogdana
 */

/* pop up dialog form */
echo '<div id="dialog-form-edit" title="Edit a note">';
echo '<p class="validateTips">Title of a note is required.</p>
 
                                        <form>
                                          <fieldset>
                                            <div class="titlepopup">
                                            <label for="title-edit">Title</label>
                                            <input type="text" name="title-edit" id="title-edit" value="" maxlength="45" class="text ui-widget-content ui-corner-all">
                                            </div>';
                                            echo '
                                                <div class="contentpopup">
                                                <label for="content-edit">Content</label>
                                            <textarea id="content-edit" name="content-edit" maxvalue="500"></textarea>
                                            </div>';

echo '<div id="format-edit" class="ui-buttonset">';
     echo '<input type="checkbox" id="check-edit2" onclick="showReminderEdit(this, 2)">'
    . '<label for="check-edit2">Personal</label>';
    echo '<div class="groupCheck"><input type="checkbox" id="check-edit1" onclick="showReminderEdit(this, 1)">'
    . '<label for="check-edit1">Group</label></div>';
   
    echo '</div>';
    
    echo '<div class="groupBlock">';
    // GROUP REMINDER
    echo '<!-- Datepicker -->
        <div id="GROUP-EDIT">
         <div id="dateGroup-edit"></div>';

    echo '<label for="hourGroup-edit">hours</label>
            <select name="hourGroup-edit" id="hourGroup-edit">';
    for ($i = 0; $i < 24; $i++) {
        if ($i < 10) {
            echo '<option value="'.$i.'">0'.$i.'</option>';
        } else if ($i == 12) {
            echo '<option value="'.$i.'" selected>'.$i.'</option>';
        } else {
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    }
    echo '</select>';

    echo '<label for="minuteGroup-edit">minutes</label>
          <select name="minuteGroup-edit" id="minuteGroup-edit">';
    for ($i = 0; $i < 60; $i++) {
        if ($i == 0) {
            echo '<option value="'.$i.'" selected>' . $i . $i . '</option>';
        } else if ($i < 10) {
            echo '<option value="'.$i.'">0' . $i . '</option>';
        } else {
            echo '<option value="'.$i.'">' . $i . '</option>';
        }
    }
    echo '</select>';
    // GROUP REMINDER END
    echo '</div>';  // end #GROUP-EDIT
    echo '</div>';  // end /groupBlock







// PERSONAL REMINDER
echo '<!-- Datepicker -->
    <div id="PERSONAL-EDIT">
      <div id="datePersonal-edit"></div>';

echo '<label for="hourPersonal-edit">hours</label>
       <select name="hourPersonal-edit" id="hourPersonal-edit">';

for ($i = 0; $i < 24; $i++) {
    if ($i < 10) {
        echo '<option value="'.$i.'">0' . $i . '</option>';
    } else if ($i == 12) {
        echo '<option value="'.$i.'" selected>' . $i . '</option>';
    } else {
        echo '<option value="'.$i.'">' . $i . '</option>';
    }
}
echo '</select>';

echo '<label for="minutePersonal-edit">minutes</label>
      <select name="minutePersonal-edit" id="minutePersonal-edit">';
for ($i = 0; $i < 60; $i++) {
    if ($i == 0) {
        echo '<option value="'.$i.'" selected>' . $i . $i . '</option>';
    } else if ($i < 10) {
        echo '<option value="'.$i.'">0' . $i . '</option>';
    } else {
        echo '<option value="'.$i.'">' . $i . '</option>';
    }
}
echo '</select>';
// PERSONAL REMINDER END
echo '</div>';


echo '<input type="submit" id="note-submit-edit" tabindex="-1" style="position:absolute; top:-1000px">
                                          </fieldset>
                                        </form>';
echo '</div>';
