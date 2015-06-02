<!--
    autor Bogdana
-->
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
                                            <div class="MenuImg"> <a href="http://localhost/CodeIgniter/index.php/newGroupController/">
							<img src="<?php echo base_url()."/assets/images/png/plus.png"; ?>" />
                                                    </a>
						</div>
					</div>
					<div class="MenuButton">
						<div class="MenuImg">
							<img src="<?php echo base_url()."/assets/images/png/group.png"; ?>" />
						</div>
					</div>
					<div class="MenuButton">
						<div class="MenuImg">
                                                    <a href="http://localhost/CodeIgniter/index.php/boardController/board/hidden">
							<img src="<?php echo base_url()."/assets/images/png/hide.png"; ?>" />
                                                    </a>
						</div>
					</div>
					<div class="MenuButton">
						<div class="MenuImg">
                                                    <a href="<?php echo base_url()."index.php/LogoutController"; ?>">
							<img src="<?php echo base_url()."/assets/images/png/logout.png"; ?>" />
                                                    </a>
						</div>
					</div>
				</div>
                                <div class="ToolButton ImportantButton">
						<div class="ToolbarImg" id="1">
                                                    <a href="http://localhost/CodeIgniter/index.php/boardController/board/important">
							<img src="<?php echo base_url()."/assets/images/png/star.png"; ?>"/>
                                                    </a>
						</div>
				</div>
                                <div class="ToolButton GlobalButton">
						<div class="ToolbarImg" id="1">
                                                    <a href="http://localhost/CodeIgniter/index.php/boardController/board/global">
							<img src="<?php echo base_url()."/assets/images/png/global.png"; ?>"/>
                                                    </a>
						</div>
				</div>
                                <div class="ToolButton User" onClick="">
                                    <div class="UserImg">
                                        <a href="http://localhost/CodeIgniter/index.php/editProfileController/editProfile">
                                            <img src="<?php 
                                                $picture=$this->session->userdata('image');
                                                if($picture==""){
                                                    echo base_url()."/assets/images/png/user.png"; 
                                                }else{
                                                    echo base_url()."/assets/images/profilepictures/$picture";
                                                }
                                              ?>" />
                                        </a>
                                    </div>
                                    <div class="Text">
                                            <?php
                                            $nickname = $this->session->userdata('nickname');
                                            echo "$nickname";              
                                            ?> 
                                    </div>       
				</div>
                               <!-- 
                                <div class="ToolButton LogOut" onClick="">
                                        <div class="Text">   
                                            <a href="<?php echo base_url()."index.php/LogoutController"; ?>">sign out</a>
                                        </div>       
				</div>
                               -->
                                 
                                
                                        
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
                                                <input id="group" class="Flexsearch--input" type="search" placeholder="Search..." onkeyup="groupsSearch()">
                                            </div>
                                            
                                            <input class="Flexsearch--submit" type="submit" value="&#10140;"/>
                                            
                                        </form>

                                    </div>
                                    <div id="suggestions1">
                                        <div id="autoSuggestionsList1">  </div>
                                    </div>
                                </div>
                                <!-- End of Search bar -->

			</div>
                        <!--	End of Toolbar		-->
