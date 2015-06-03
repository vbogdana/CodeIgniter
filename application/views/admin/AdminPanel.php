<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

autor Dusan 
-->
<script language="javascript">
function checkMe() {
    if (confirm("Are you sure you want to delete this user? ")) {
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
    if (confirm("Are you sure you want to delete this group? ")) {
      //  alert("Clicked Ok");
        return true;
    } else {
     //   alert("Clicked Cancel");
        return false;
    }
}
</script>



<div class="BoardAdminPanel">
    <?php $password = $this->session->userdata('password'); 
          $flag=$this->session->userdata('admin');
           if($flag==0) redirect('boardController/board/global');
    ?>

    <center><h2>Delete Users or Groups</h2></center>
    
 

    <div class='Optionsusers'>
        <div class="userrow">
        <ul>
            <li class="li0">&nbsp;&nbsp; </li>
            <li class="li1"><h3>Id </h3></li>
            <li class="li2"><h3>Username</h3></li>
            <li class="li3"><h3>E-mail</h3></li>
            <li class="li4"><center><h3>Admin</h3></center></li>
        <li class="li5"><h3>Password</h3></li>
       
        </ul>
            
                    
        </div>
        
         </br>             </br>
        <?php 
                   $broj=count($niz);
            
            
                   for($i=0;$i<$broj;$i++) {
                   $idUser    =$niz[$i]['idUser'];
                   $nickname  =$niz[$i]['nickname'];
                   $email     =$niz[$i]['email']; 
                   $is_Admin  =$niz[$i]['admin'];
                   $password  =$niz[$i]['password'];
                   
                   $flag=$this->session->userdata('nickname');
                   if($flag==$nickname)  continue;
                   
                   
                   if($is_Admin==0){ $is_Admin="NO";
                   }else {
                       $is_Admin="YES";
                   }
                   
                    echo '<div class="userrow">'. 
                           " <ul>"
                                .'<li class="li0">'.'<a onClick="return checkMe()" href="http://localhost/CodeIgniter/index.php/adminPanelController/delete/'.$idUser.'">'.'<img  src="'. base_url()."/assets/images/png/delete_black.png".'"'. 'width="20" height="20">'."</a></li>"
                                .'<li class="li1">'."$idUser</li>"
                                .'<li class="li2">'."$nickname</li>"
                                .'<li class="li3">'."$email</li>"
                                .'<li class="li4">'."<center>$is_Admin</center></li>"
                                .'<li class="li5">'."$password</li>
                             </ul>
                            </div>
                            ";
                    }
        
        ?>
    </div>
       
    
    
     <div class='Optionsgroups'>
        
          <div class="userrow">
        <ul>
            <li class="li0">&nbsp;&nbsp; </li>
            <li class="li6"><center><h3>Group Name</h3></center></li>
            

        </ul>
        </div>
        <?php 
                    
                   $n=count($groups);
            
                   
                   for($i=0;$i<$n;$i++) {                   
                   $NameGroup  =$groups[$i]['NameGroup'];
                   $idGroup    =$groups[$i]['IdGroup'];
                   
                 
                   
                    echo '<div class="userrow">'. 
                           " <ul>"
                                .'<li class="li0">'.'<a onClick="return checkMe1()" href="http://localhost/CodeIgniter/index.php/adminPanelController/deleteG/'.$idGroup.'">'.'<img  src="'. base_url()."/assets/images/png/delete_black.png".'"'. 'width="20" height="20">'."</a></li>"
                                .'<li class="li6">'."<center>$NameGroup</center></li>
                             </ul>
                            </div>
                            ";
                    }
        
        ?>
    </div>
        
</div>

    
