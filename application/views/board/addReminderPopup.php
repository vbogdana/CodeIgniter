<?php

/*
 * 
 * 
 * @author Bogdana
 */

/* pop up dialog form */
echo '<div id="dialog-form-add" title="Add a personal reminder">';
echo '<form>
        <fieldset>';

// PERSONAL REMINDER
echo '<!-- Datepicker -->
       <div id="PERSONAL-ADD">
        <div id="datePersonal-add"></div>';

echo '<label for="hourPersonal-add">hours</label>
        <select name="hourPersonal-add" id="hourPersonal-add">';

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

echo '<label for="minutePersonal-add">minutes</label>
      <select name="minutePersonal-add" id="minutePersonal-add">';
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

echo '<input type="submit" id="note-submit-add" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
     </form>';
echo '</div>';
