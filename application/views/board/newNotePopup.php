<?php

/*
 * 
 * 
 * @author Bogdana
 */

/* pop up dialog form */
echo '<div id="dialog-form" title="Create a new note">';
echo '<p class="validateTips">Title of a note is required.</p>
 
                                        <form>
                                          <fieldset>
                                           
                                            <input type="text" name="location" id="location" style="display: none" value="' . $group . '" maxlength="45" class="text ui-widget-content ui-corner-all" readonly>
                                            <div class="titlepopup">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" value="" maxlength="45" class="text ui-widget-content ui-corner-all">
                                            </div>';
                                            echo '
                                            <div class="contentpopup">
                                            <label for="content">Content</label>
                                            <textarea id="content" name="content" maxvalue="500"></textarea>
                                            </div>';

echo '<div id="format" class="ui-buttonset">';
echo '<input type="checkbox" id="check2" onclick="showReminder(this, 2)"><label for="check2">Personal</label>';
if ($group != 'global' && $group != 'important' && $group != 'hidden') {
    echo '<input type="checkbox" id="check1" onclick="showReminder(this, 1)"><label for="check1">Group</label></div>';


    // GROUP REMINDER
    echo '<!-- Datepicker -->
          <div id="GROUP">
            <div id="dateGroup"></div>';

    echo '<label for="hourGroup">hours</label>
          <select name="hourGroup" id="hourGroup">';
    for ($i = 0; $i < 24; $i++) {
        if ($i < 10) {
            echo '<option>0' . $i . '</option>';
        } else if ($i == 12) {
            echo '<option selected>' . $i . '</option>';
        } else {
            echo '<option>' . $i . '</option>';
        }
    }
    echo '</select>';

    echo '<label for="minuteGroup">minutes</label>
        <select name="minuteGroup" id="minuteGroup">';
    for ($i = 0; $i < 60; $i++) {
        if ($i == 0) {
            echo '<option selected>' . $i . $i . '</option>';
        } else if ($i < 10) {
            echo '<option>0' . $i . '</option>';
        } else {
            echo '<option>' . $i . '</option>';
        }
    }
    echo '</select>';
    // GROUP REMINDER END
    echo '</div>';
} else {
    echo '</div>';
}

//echo '<input type="checkbox" id="check2" onclick="showReminder(this, 2)"><label for="check2">Personal</label>';

// PERSONAL REMINDER
echo '<!-- Datepicker -->
       <div id="PERSONAL">
        <div id="datePersonal"></div>';

echo '<label for="hourPersonal">hours</label>
                                                    <select name="hourPersonal" id="hourPersonal">';

for ($i = 0; $i < 24; $i++) {
    if ($i < 10) {
        echo '<option>0' . $i . '</option>';
    } else if ($i == 12) {
        echo '<option selected>' . $i . '</option>';
    } else {
        echo '<option>' . $i . '</option>';
    }
}
echo '</select>';

echo '<label for="minutePersonal">minutes</label>
      <select name="minutePersonal" id="minutePersonal">';
for ($i = 0; $i < 60; $i++) {
    if ($i == 0) {
        echo '<option selected>' . $i . $i . '</option>';
    } else if ($i < 10) {
        echo '<option>0' . $i . '</option>';
    } else {
        echo '<option>' . $i . '</option>';
    }
}
echo '</select>';
// PERSONAL REMINDER END
echo '</div>';

echo '<input type="submit" id="note-submit" tabindex="-1" style="position:absolute; top:-1000px">
                                          </fieldset>
                                        </form>';
echo '</div>';
