<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

autor Dusan 
-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>


<script language="javascript">
function checkMe() {
    if (confirm("Are you sure you want to delete this group? ")) {
      //  alert("Clicked Ok");
        return true;
    } else {
     //   alert("Clicked Cancel");
        return false;
    }
}
</script>

<script language="javascript">
function checkMe1() {
    if (confirm("Are you sure you want to leave this group? ")) {
      //  alert("Clicked Ok");
        return true;
    } else {
     //   alert("Clicked Cancel");
        return false;
    }
}
</script>

<script language="javascript">

    $(document).ready(function(){
      $("button#mybutton").click(function(){
          $("#addUser").slideToggle(150);
      });  
      
      getNotifications(); 
        
    });    
        
        
            
</script>


<div class="BoardGroupPanel">

    <div class='GroupPanel'>
        <h2> My Groups:  </h2>

        <?php 
                   $broj=count($niz);
            
            
                   for($i=0;$i<$broj;$i++) {
                   $NameGroup    =$niz[$i]['NameGroup'];
                   $idGroup    =$niz[$i]['IdGroup'];

                    echo '<div class="userrow1">'. 
                           " <ul>"
                                .'<li class="lli0">'.'<a onClick="return checkMe()" href="http://localhost/CodeIgniter/index.php/GroupPanelController/deleteGro/'.$idGroup.'">'.'<img  src="'. base_url()."/assets/images/png/delete_black.png".'"'. 'width="20" height="20">'."</a></li>"
                                .'<li class="lli2">'.'<a  href="http://localhost/CodeIgniter/index.php/GroupPanelController/viewMember/'.$idGroup.'">'."<center>"."$NameGroup</center></a></li>   
                            </div> ";
                    }
        
        ?>
    </div>
       
    
    
     <div class='leavegroup'>
        
      
          <center><h3>I am a member of a group:</h3></center></li>
     <div id="addUser" > 
         <input id="addmember" placeholder="add new member" type='text' style="width: 200px; margin: 0px; position: relative; float: left;" onkeyup="addMembersSearch()" oninput="addMembersSearch()" autocomplete="off"></input>
         <div id="suggestions" >
          <div id="autoSuggestionsList" style="top: 40px; width: 72%; z-index: 30">  </div>
        </div>
         <button id="DODATI"  onclick="checkMember()" style=" background-color: transparent ; margin-left: 8px; cursor: pointer;border: 0px; width:40px; height: 40px; padding-left:8px; padding-top: 8px;">
             <img  src="<?php echo base_url()."/assets/images/png/adduser.png"; ?>" width="25px" height="25px">
         </button>
     </div>
      
  <?php 
                    
                   $n=count($nazivigrupa);
            
                   
                   for($i=0;$i<$n;$i++) {                   
                   $NameGroup = $nazivigrupa[$i];
                   $idGroup=$IdGrupa[$i]['IdGroup'];
                   $isAdmin=$IdGrupa[$i]['isAdmin'];
                   
                   if($isAdmin==0){
                   
                    echo '<div class="userrow">'. 
                           " <ul>"
                                .'<li class="lli1">'.'<button id="mybutton" style=" background-color: transparent ; border: 0px; cursor:pointer; width:25px; height: 25px; padding: 0px; ">'.'<img  src="'. base_url().'/assets/images/png/plusbl.png" onclick="setGroupsetGroup(\''.$idGroup.'\',\''.$NameGroup.'\')" width="25px" height="25px"></button></li>'
                                .'<li class="lli6">'."<center>$NameGroup</center></li>"
                                .'<li class="lli0">'.'<a onClick="return checkMe1()" href="http://localhost/CodeIgniter/index.php/GroupPanelController/leave/'.$idGroup.'"> <img  src="'. base_url().'/assets/images/png/leavegroup.png" width="20" height="20"></a></li>
                             </ul>
                            </div>
                            ';
                    
                   }else{
                       
                         echo '<div class="userrow">'. 
                           " <ul>"
                                .'<li class="lli1">'.'<button id="mybutton" style=" background-color: transparent ; border: 0px; cursor:pointer; width:25px; height: 25px; padding: 0px; ">'.'<img  src="'. base_url().'/assets/images/png/plusbl.png" onclick="setGroup(\''.$idGroup.'\',\''.$NameGroup.'\')" width="25px" height="25px"></button></li>'
                                .'<li class="lli6">'."<center>$NameGroup</center></li> </ul>
                            </div>
                            ";
                       
                       
                   }
                    }
        
        ?>
    </div>
    
    
   

    <div class='membergroup'>
        <h3> Members of my group:   </h3>

        <?php 
                   
                    $k=count($clanoviGrupa);
            
                   for($i=0;$i<$k;$i++) {
                       
                     if ( $clanoviGrupa==0) break;
                     
                     $ime=$this->session->userdata('nickname');
                     
                      $imeClana    =$clanoviGrupa[$i];
                        
                        $uri = $_SERVER['REQUEST_URI'];
                        $grupa = filter_var($uri, FILTER_SANITIZE_NUMBER_INT);
             
                   
                     if($ime==$imeClana)                         continue;

                    echo '<div class="userrow1">'. 
                           " <ul>"
                                .'<li class="lli0">'.'<a onClick="return checkMe()" href="http://localhost/CodeIgniter/index.php/GroupPanelController/deleteUserFromGroup/'.$imeClana.'/'.$grupa.'">'.'<img  src="'. base_url()."/assets/images/png/deleteUsers.png".'"'. 'width="20" height="20">'."</a></li>"
                                .'<li class="lli2">'."<center>$imeClana</center></li>   
                            </div> ";
                    }
        
        ?>
    </div>
   
</div>

    
