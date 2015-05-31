			<!-- NOTES -->
			<!--
                            @author Bogdana Veselinovic
                        -->
			
			<?php
                                
                                    $result = $rezultat;
                                    $group = $grupa;
                                    $notes = array(); $n = 0;
                                    $num = count($result);
                                    $iteration = $iteracija;
                                    $height = ((((($iteration - 1) * 12) ) / 4) ) * 375 + 23 + 40;
                                    if (($num == 4 || $num == 8)&& $iteration == 1) {
                                        $height += ((int)(($num) / 4) + 1) * 375 ;
                                    } else {
                                        $height += ((int)(($num - 1) / 4) + 1) * 375 ;
                                    }
                                    
                                    
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
                                            $notes[$n] = $row['idNote'];
                                            $text=$row['text'];
                                            $datum = $row['last_Edited_On'];
                                            $naslov = $row['title'];

                                            echo '<div class="one-note">
                                                    <div class="buttons">';
                                                    if ($group == "hidden") {
                                                        echo '<div class="note_button" id="hide'.$row['idNote'].'">';
                                                            //<img id="hide_'.$iteration.'_'.$cnt.'" src="'. base_url()."assets/images/png/hide.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$row['idNote'].'\', \'unhide\',\'hide\')" />
                                                        echo '</div>';
                                                        echo '<div class="note_button" id="delete'.$row['idNote'].'">';
                                                            //<img id="del_'.$iteration.'_'.$cnt.'" src="'. base_url()."assets/images/png/delete.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$row['idNote'].'\', \'delete\',\'delete\')"/>                                                        
                                                        echo '</div>';
                                                        
                                                        echo '<script type="text/javascript"> loadImages(\''.$row['idNote'].'\',\''.$group.'\') </script>';
                                                    } else {
                                                      echo '<div class="note_button" id="important'.$row['idNote'].'">';
                                                                //<img id="imp_'.$iteration.'_'.$cnt.'" src="'. base_url()."assets/images/png/star.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$row['idNote'].'\', \'set\',\'important\')" />
                                                      echo  '</div>';
                                                       echo '<div class="note_button" id="lock'.$row['idNote'].'">';
                                                            //<img id="lock_'.$iteration.'_'.$cnt.'" src="'. base_url()."assets/images/png/lock.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$row['idNote'].'\', \'lock\',\'lock\')" />
                                                       echo '</div>';
                                                       echo '<div class="note_button" id="hide'.$row['idNote'].'">';
                                                            //<img id="hide_'.$iteration.'_'.$cnt.'" src="'. base_url()."assets/images/png/hide.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$row['idNote'].'\', \'hide\',\'hide\')" />
                                                        echo '</div>';
                                                        echo '<div class="note_button" id="delete'.$row['idNote'].'">';
                                                            //<img id="del_'.$iteration.'_'.$cnt.'" src="'. base_url()."assets/images/png/delete.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$row['idNote'].'\', \'delete\',\'delete\')"/>                                                        
                                                        echo '</div>';
                                                       
                                                       echo '<script type="text/javascript"> loadImages(\''.$row['idNote'].'\',\''.$group.'\') </script>';
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
                                                $iteration = $iteration + 1;
                                                $last_Edited_On = $this->session->userdata('last_Edited_On');
                                                $lastI_Edited_On = $this->session->userdata('lastI_Edited_On');
                                                $last = $this->session->userdata('last');
                                                $lastI = $this->session->userdata('lastI');
                                                echo '<div class="load-more" id="load-more'.($iteration-1).'" onclick="loadMore('.$iteration.',\''.$last_Edited_On.'\',\''.$lastI_Edited_On.'\',\''.$last.'\',\''.$lastI.'\',\''.$group.'\')">
                                                    <div class=""> Load more notes </div>
                                                  </div>';
                                                }
                                            else if($i == 4) {
                                                    echo '</div>';  // kraj row-a
                                                    $i = 0;
                                                } 
                                    }
                                    if (($cnt % 12) != 0) {
                                        $i = 0;
                                        echo '</div>'; // kraj row-a
                                        echo     '</div>'; // kraj loada
                                        echo '<div class="load-more">
                                                <div class=""> No more notes </div>
                                              </div>';
                                    }
                                    
                                    //echo '</div>';      // kraj LoadBoarda
                                    
                                    
                               
			?>
			
			