<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 *  @author Bogdana
 */

                                echo '<div class="BoardContainer" id="board">';
                                $result = $rezultat;
                                $iteration = 1;
                                $group = $grupa;
                                echo '<div id="loadBoard">';
                                    $this->load->view('board/container', array('iteracija' => $iteration, 
                                                                               'rezultat' => $result,
                                                                               'grupa' => $group));
                               
                                echo '<div id="dialog-form" title="Create a new note">';
                                echo '<p class="validateTips">Title and content of a note are required.</p>
 
                                        <form>
                                          <fieldset>
                                            <label for="location">You are creating a note in group: </label>
                                            <input type="text" name="location" id="location" value="'.$group.'" maxlength="45" class="text ui-widget-content ui-corner-all" readonly>
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" value="" maxlength="45" class="text ui-widget-content ui-corner-all">';
                                              echo '<label for="content">Content</label>
                                            <textarea id="content" name="content" maxvalue="500"></textarea>';

                                              echo '<div id="format" class="ui-buttonset">';
                                                      if ($group != 'global' && $group != 'important' && $group != 'hidden') {
                                                          echo '<input type="checkbox" id="check1" onclick="showReminder(this, 1)"><label for="check1">Group</label>';
                                                      
                                                          // GROUP REMINDER
                                              echo '<!-- Datepicker -->
                                                  <div id="dateGroup"></div>';
                                              
                                              echo '<label for="hourGroup">hours</label>
                                                    <select name="hourGroup" id="hourGroup">';
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i == 12) {
                                                            echo '<option selected>'.$i.'</option>';
                                                        } else {
                                                            echo '<option>'.$i.'</option>';
                                                        }
                                                     }
                                              echo '</select>';
                                              
                                              echo '<label for="minuteGroup">minutes</label>
                                                    <select name="minuteGroup" id="minuteGroup">';
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i == 0) {
                                                            echo '<option selected>'.$i.$i.'</option>';
                                                        } else if ($i < 10) {
                                                            echo '<option>0'.$i.'</option>';
                                                        } else {
                                                            echo '<option>'.$i.'</option>';
                                                        }
                                                     }
                                              echo '</select>';
                                              // GROUP REMINDER END
                                                      }
                                                      
                                                      echo '<input type="checkbox" id="check2" onclick="showReminder(this, 2)"><label for="check2">Personal</label>';
                                              echo '</div>';

                                              
                                              
                                              // PERSONAL REMINDER
                                              echo '<!-- Datepicker -->
                                                  <div id="datePersonal"></div>';
                                              
                                              echo '<label for="hourPersonal">hours</label>
                                                    <select name="hourPersonal" id="hourPersonal">';
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i == 12) {
                                                            echo '<option selected>'.$i.'</option>';
                                                        } else {
                                                            echo '<option>'.$i.'</option>';
                                                        }
                                                     }
                                              echo '</select>';
                                              
                                              echo '<label for="minutePersonal">minutes</label>
                                                    <select name="minutePersonal" id="minutePersonal">';
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i == 0) {
                                                            echo '<option selected>'.$i.$i.'</option>';
                                                        } else if ($i < 10) {
                                                            echo '<option>0'.$i.'</option>';
                                                        } else {
                                                            echo '<option>'.$i.'</option>';
                                                        }
                                                     }
                                              echo '</select>';
                                              // PERSONAL REMINDER END

                                              echo '<input type="submit" id="note-submit" tabindex="-1" style="position:absolute; top:-1000px">
                                          </fieldset>
                                        </form>';
                                echo '</div>';
                                
                                
                                echo '</div>';  // kraj load Boarda
                          
                                echo '</div>';  // kraj Board containera

                                ?>