<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 *  @author Bogdana
 * 
 */



                                echo '<div class="BoardContainer" id="board">';
                                $result = $rezultat;
                                $iteration = 1;
                                $group = $grupa;
                                $reminders = $podsetnici;
                                echo '<div id="loadBoard">';
                                    $this->load->view('board/container', array('iteracija' => $iteration, 
                                                                               'rezultat' => $result,
                                                                               'grupa' => $group,
                                                                               'podsetnici' => $reminders));
                               
                                
                                    $this->load->view('board/newNotePopup', array('group'=>$group));
                                
                                echo '</div>';  // kraj load Boarda
                          
                                echo '</div>';  // kraj Board containera

                                ?>