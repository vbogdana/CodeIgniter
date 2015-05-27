			<!-- NOTES -->
			<!--<div class="BoardContainer">
				<div class="one-row">
					<div class="one-note">
						<h1><a href='javascript:fg_popup_form("fg_formContainer","fg_form_InnerContainer","fg_backgroundpopup");'> dodaj novu belesku</a></h1>
					</div>
					<div class="one-note">
						<h1> ovo je jedna beleska </h1>
					</div>
					<div class="one-note">
						<h1> ovo je jedna beleska </h1>
					</div>
					<div class="one-note">
						<h1> ovo je jedna beleska </h1>
					</div>
					<div class="one-note">
						<h1> ovo je jedna beleska </h1>
					</div>		
					<a id="addemail" href="#">dodaj novu belesku </a>
				</div>
			</div>-->
			<!-- END OF NOTES -->
			
			<!--<div class="BoardContainer">
				<div class="one-row">
					<div class="one-note">
						<h1><a href='javascript:fg_popup_form("fg_formContainer","fg_form_InnerContainer","fg_backgroundpopup");'> dodaj novu belesku</a></h1>
					</div>
					<div class="one-note">
						<div class="naslov">naslov</div>
						<div class="tekst">ovo je jedna beleska</div>
						<div class="datum">datum</div>
					</div>
					<div class="one-note">
						<h1> ovo je jedna beleska </h1>
					</div>
					<div class="one-note">
						<h1> ovo je jedna beleska </h1>
					</div>
					<div class="one-note">
						<h1> ovo je jedna beleska </h1>
					</div>		
					<a id="addemail" href="#">dodaj novu belesku </a>
				</div>
			</div>-->
			
			<?php
				
				$result = $rezultat;

				echo '<div class="BoardContainer">
					<div class="one-row">
					<div class="one-note">
						<h1><a href=\'javascript:fg_popup_form("fg_formContainer","fg_form_InnerContainer","fg_backgroundpopup");\'> dodaj novu belesku</a></h1>
					</div>';
					
				$i = 1;
				while ($row = mysqli_fetch_assoc($result))
				{
					
					
					$text=$row['text'];
					$datum = $row['created_On'];
					$naslov = $row['title'];
					/*echo '<div class="one-note">
							<h1>'; echo $text; echo '</h1>
						</div>';*/
						
					echo '<div class="one-note">
						<div class="naslov">'; echo $naslov; echo '</div>
						<div class="tekst">'; echo $text; echo '</div>
						<div class="datum">'; echo $datum; echo'</div>
					</div>';
					$i=$i+1;
					if($i == 5)
					{
						echo'</div>
						<div class="one-row">';
						$i = 0;
					}
				} 
				echo '</div>
				</div>';
			?>
			
			