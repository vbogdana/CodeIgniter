			<!-- NOTES -->
			<!--
                            @author Bogdana Veselinovic
                        -->
			
			<?php
                                
                                    $result = $rezultat;
                                    $num = mysqli_num_rows($result);
                                        $iteration = $iteracija;
                                        $height = ((((($iteration - 1) * 12) ) / 4) ) * 396 + ((int)(($num-1) / 4) + 1) * 396;
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

                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                            if (($cnt % 4) == 0 && $cnt > 1) {
                                                echo '<div class="one-row">';
                                            }
                                            $text=$row['text'];
                                            $datum = $row['created_On'];
                                            $naslov = $row['title'];

                                            echo '<div class="one-note">
                                                    <div class="naslov">'; echo $naslov; echo '</div>
                                                    <div class="tekst">'; echo $text; echo '</div>
                                                    <div class="datum">'; echo $datum; echo'</div>
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
                                        $last_created_On = $row["created_On"];
                                        $last_id = $row['idNote'];
                                    }
                                    if (($cnt % 12) != 0) {
                                        $i = 0;
                                        echo '</div>'; // kraj row-a
                                        echo     '</div>'; // kraj loada
                                    }
                                    
                                    //echo '</div>';      // kraj LoadBoarda
                                    
                                    $iteration = $iteration + 1;
                                    echo '<div class="load-more" id="load-more'.$iteration.'" onclick="loadMore('.$iteration.',\''.$last_created_On.'\','.$last_id.')">
                                        <div class=""> Load more notes </div>
                                      </div>';
                               
			?>
			
			