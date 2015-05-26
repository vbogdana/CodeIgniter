<!--	Toolbar	-->
			<div class="Toolbar">
				
				<!-- Menu Buttons -->
				<div class="ToolButton AddButton" onClick="menuClick(3)">
						<div class="ToolbarImg" id="1">
							<img src="<?php echo base_url()."/assets/images/png/plus.png"; ?>"/>
						</div>
				</div>
				<div class="HiddenMenu AddMenu" id="3">
					<div class="MenuButton">
						<div class="MenuImg">
							<img src="<?php echo base_url()."/assets/images/png/plus.png"; ?>" />
						</div>
					</div>
					<div class="MenuButton">
						<div class="MenuImg">
							<img src="<?php echo base_url()."/assets/images/png/group.png"; ?>" />
						</div>
					</div>
					<div class="MenuButton">
						<div class="MenuImg">
							<img src="<?php echo base_url()."/assets/images/png/settings.png"; ?>" />
						</div>
					</div>
					<div class="MenuButton">
						<div class="MenuImg">
							<img src="<?php echo base_url()."/assets/images/png/important.png"; ?>" />
						</div>
					</div>
				</div>
				
				<div class="ToolButton NotifButton" onClick="menuClick(4)">
						<div class="ToolbarImg" id="2">
							<img src="<?php echo base_url()."/assets/images/png/notification.png"; ?>" />
						</div>
				</div>	
				<div class="HiddenMenu NotifMenu" id="4">
					<div class="NotifWrapper"> </div>
					<div class="NotifWrapper"> </div>
					<div class="NotifWrapper"> </div>	
					<div class="NotifWrapper"> </div>				
				</div>
				<!-- End of Menu Buttons -->
				
				<!-- Search bar -->
				<div class="Searchbar">
					<div class="Flexsearch">
							<form class="Flexsearch--form" action="#" method="post">
								<div class="Flexsearch--input-wrapper">
									<input class="Flexsearch--input" type="search" placeholder="Search..." onkeyup="showResult(this.value)">
								</div>
								<input class="Flexsearch--submit" type="submit" value="&#10140;"/>
							</form>
							<div id="livesearch"></div>
					</div>
				</div>
				<!-- End of Search bar -->
				
			</div>
			<!--	End of Toolbar		-->