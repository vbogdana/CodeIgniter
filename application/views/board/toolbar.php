<!--
    autor Bogdana
-->
<?php
$isAdmin = $this->session->userdata('admin');
                           echo '<!--	Toolbar	-->
                            <div class="Toolbar"> 
				      
                                    
				<!-- Menu Buttons -->
				<div class="ToolButton AddButton" onClick="menuClick(3)">
						<div class="ToolbarImg" id="1">
							<img src="'.base_url().'/assets/images/png/plus.png"/>
						</div>
				</div>
				<div class="HiddenMenu AddMenu" id="3">
					<div class="MenuButton">
                                            <div class="MenuImg"> <a href="http://localhost/CodeIgniter/index.php/newGroupController/">
							<img src="'.base_url().'/assets/images/png/plus.png" />
                                                    </a>
						</div>
					</div>
					<div class="MenuButton">
						<div class="MenuImg"><a href="http://localhost/CodeIgniter/index.php/groupPanelController/">
							<img src="'.base_url().'/assets/images/png/group.png" />
                                                    </a>
						</div>
					</div>
					<div class="MenuButton">
						<div class="MenuImg">
                                                    <a href="http://localhost/CodeIgniter/index.php/boardController/board/hidden">
							<img src="'.base_url().'/assets/images/png/hide.png" />
                                                    </a>
						</div>
					</div>
					<div class="MenuButton">
						<div class="MenuImg">
                                                    <a href="'.base_url().'index.php/LogoutController" >
							<img src="'.base_url().'/assets/images/png/logout.png" />
                                                    </a>
						</div>
					</div>
				</div>';
                           
                           /* admin button */
                           
                           if ($isAdmin == '1') {
                               echo '<div class="ToolButton AdminButton">
						<div class="ToolbarImg" id="6">
                                                    <a href="http://localhost/CodeIgniter/index.php/adminPanelController/">
							<img src="'.base_url().'/assets/images/png/settings.png" />
                                                    </a>
						</div>
				</div>';
                           }
                                echo '<div class="ToolButton ImportantButton">
						<div class="ToolbarImg" id="8">
                                                    <a href="http://localhost/CodeIgniter/index.php/boardController/board/important">
							<img src="'.base_url().'/assets/images/png/star.png" />
                                                    </a>
						</div>
				</div>
                                <div class="ToolButton GlobalButton">
						<div class="ToolbarImg" id="5">
                                                    <a href="http://localhost/CodeIgniter/index.php/boardController/board/global">
							<img src="'.base_url().'/assets/images/png/global.png" />
                                                    </a>
						</div>
				</div>
                                <div class="ToolButton User" onClick="">
                                    <div class="UserImg">
                                        <a href="http://localhost/CodeIgniter/index.php/editProfileController/editProfile">';
                                        $picture=$this->session->userdata('image');
                                                if($picture==""){
                                                    echo '<img src="'.base_url().'/assets/images/png/user.png" />'; 
                                                }else{
                                                    echo '<img src="'.base_url().'/assets/images/profilepictures/'.$picture.'" />';
                                                }
                                        echo '</a>
                                    </div>
                                    <div class="Text">';
                                            $nickname = $this->session->userdata('nickname');
                                            echo $nickname; 
                                    echo '</div>       
				</div>';
                                 
                                
                          
				echo '<div class="ToolButton NotifButton" onClick="loadNotifications()">
                                                <div class="NotificationCount" id="nc"></div>
						<div class="ToolbarImg" id="2">
							<img src="'.base_url().'assets/images/png/notification.png" />
						</div>
				</div>';	
                                echo '
				<div class="HiddenMenu NotifMenu" id="4">';
					/*<div class="NotifWrapper"> </div>
					<div class="NotifWrapper"> </div>
					<div class="NotifWrapper"> </div>	
					<div class="NotifWrapper"> </div>*/
                                echo
				'</div>
				<!-- End of Menu Buttons -->';
				
                                echo '
				<!-- Search bar -->
                                <div class="Searchbar">
                                    <div class="Flexsearch" id="search_id">
                                        <form class="Flexsearch--form" action="" method="post">
                                            <div class="Flexsearch--input-wrapper">
                                                <input id="group" class="Flexsearch--input" type="search" placeholder="Search..." onkeyup="groupsSearch()" oninput="groupsSearch()" autocomplete="off">
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
                        <!--	End of Toolbar		-->';
                        
                        ?>
