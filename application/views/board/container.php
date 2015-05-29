			<!-- NOTES -->
			<!--
                            autori Bogdana Veselinovic, Aleksa Milosevic
                        -->
			
			<?php
				
				$result = $rezultat;

				echo '<div class="BoardContainer">
					<div class="one-row">
					<div class="one-note">
						<div class="AddNote">
                                                    <h1><a href="#"> add new note </a></h1>
                                                </div>
					</div>';
					
				$i = 1;
                                $all = 1;
				while ($row = mysqli_fetch_assoc($result))
				{
					
					$text=$row['text'];
					$datum = $row['created_On'];
					$naslov = $row['title'];
						
					echo '<div class="one-note">
						<div class="naslov">'; echo $naslov; echo '</div>
						<div class="tekst">'; echo $text; echo '</div>
						<div class="datum">'; echo $datum; echo'</div>
                                              </div>';
					$i=$i+1;
                                        $all = $all + 1;
					if($i == 4)
					{
						echo'</div>
						<div class="one-row">';
						$i = 0;
					}
                                        if ($all == 12) {
                                            echo '</div>';
						$i = 0;
                                            echo '<div class="load-more">
                                                    <div class="">
                                                    </div>
                                                  </div>';
                                        }
				}
                                if ($all <= 12) {
                                            echo '</div>';
						$i = 0;
                                            echo '<div class="load-more">
                                                    <div class=""> Load more notes </div>
                                                  </div>';
                                        }
                                        
				echo '</div>
				</div>';
			?>
			
			