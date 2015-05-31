			<!-- NOTES -->
			<!--
                            @author Bogdana Veselinovic
                        -->
			
			<?php
                                
                                    $result = $rezultat;
                                    $group = $grupa;
                                    //$num = mysqli_num_rows($result);
                                    $num = count($result);
                                    $iteration = $iteracija;
                                    $height = ((((($iteration - 1) * 12) ) / 4) ) * 373 + ((int)(($num) / 4) + 1) * 373 + 23 + 40;
                                    //$last_Edited_On = 0;
                                    //$last_id = 0;
                                    
                                    echo '<style>'
                                    . '#board { height: '.$height.'px;}'
                                            . '</style>';
                                    
                                        echo '<div class="load'.$iteration.'" id="load'.$iteration.'">
                                                <div class="one-row">';
                                        if ($iteration == 1) {
                                            echo '<div class="one-note">
                                                        <div class="AddNote">
                                                            <h1><a href="#"> add new note </a></h1>
                                                        </div>
                                                </div>';
                                            $i = 1;
                                            $cnt = 1;
                                        }
                                        else {
                                            $i = 0;
                                            $cnt = 0;
                                        }
                                    foreach ($result as $row)
                                    //while ($row = mysqli_fetch_assoc($result))
                                    {
                                            if (($cnt % 4) == 0 && $cnt > 1) {
                                                echo '<div class="one-row">';
                                            }
                                            $text=$row['text'];
                                            $datum = $row['last_Edited_On'];
                                            $naslov = $row['title'];

                                            echo '<div class="one-note">
                                                    <div class="buttons">';
                                                    if ($group == "hidden") {
                                                        echo '<div class="note_button" id="hide">Unhide</div>';
                                                    } else {
                                                      echo '<div class="note_button" id="important">Important</div>
                                                        <div class="note_button" id="lock">Lock</div>
                                                        <div class="note_button" id="hide">Hide</div>
                                                        <div class="note_button" id="delete">Delete</div>';
                                                    }
                                            echo '</div> ';             // kraj buttons-a                   
                                            echo    '<div class="title">'; echo $naslov; echo '</div>
                                                    <div class="content">'; echo $text; echo '</div>
                                                    <div class="created_On">'; echo $datum; echo'</div>
                                                    <div class="global_Reminder">'; echo $datum; echo'</div>
                                                    <div class="personal_Reminder">'; echo $datum; echo'</div>
                                                  </div>';
                                                    
                                            $i=$i+1;
                                            $cnt = $cnt + 1;
                                            if (($cnt % 12) == 0) {
                                                $i = 0;
                                                echo '</div>'; // kraj row-a
                                                    echo '</div>'; // kraj loada
                                                }
                                            else if($i == 4) {
                                                    echo '</div>';  // kraj row-a
                                                    $i = 0;
                                                } 
                                        //$last_Edited_On = $row["last_Edited_On"];
                                        //$last_id = $row['idNote'];
                                    }
                                    if (($cnt % 12) != 0) {
                                        $i = 0;
                                        echo '</div>'; // kraj row-a
                                        echo     '</div>'; // kraj loada
                                    }
                                    
                                    //echo '</div>';      // kraj LoadBoarda
                                    
                                    $iteration = $iteration + 1;
                                   // echo '<div class="load-more" id="load-more'.($iteration-1).'" onclick="loadMore('.$iteration.',\''.$last_Edited_On.'\','.$last_id.',\''.$group.'\')">
                                    $last_Edited_On = $this->session->userdata('last_Edited_On');
                                    $lastI_Edited_On = $this->session->userdata('lastI_Edited_On');
                                    $last = $this->session->userdata('last');
                                    $lastI = $this->session->userdata('lastI');
                                    echo '<div class="load-more" id="load-more'.($iteration-1).'" onclick="loadMore('.$iteration.',\''.$last_Edited_On.'\',\''.$lastI_Edited_On.'\',\''.$last.'\',\''.$lastI.'\',\''.$group.'\')">
                                        <div class=""> Load more notes </div>
                                      </div>';
                               
			?>
			
			