<?php

class editProfileController extends CI_Controller {
    
    
 
    public function editProfile() {
        $idUser=$this->session->userdata('idUser');
         $this->load->model('EditProfile_Model','EditProfileModel');
        $boja=  $this->EditProfileModel->dohvatiBoju($idUser);
        $flag=0;
       
       if($boja=="E3FFDA") {$flag=1;}
        $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'profile/editprofile','boja'=>$flag)); 
        if($boja=="FFFAF0") {$flag=2;}
        $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'profile/editprofile','boja'=>$flag));
        if($boja=="FFFFFF"){$flag=3;}
        $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'profile/editprofile','boja'=>$flag));
        if($boja=="FFFFD1"){$flag=4;}
        $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'profile/editprofile','boja'=>$flag));
        if($boja=="E9FFFF") {$flag=5;}
        $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'profile/editprofile','boja'=>$flag));
    }
    

    public function index(){
            
         $form=array();
         $form['password']=$this->input->post("password");
         $form['email']=$this->input->post("email");
         $form['oldpassword']=$this->input->post("oldpassword");
         
         $oldpassword=$form['oldpassword'];
         $password=$this->session->userdata('password');
         
         if(($form['oldpassword']==" " ) && ($form['password']<>" " )){
             echo "You tried to change the password without old password!";
             header('Refresh: 2; URL=editProfileController/editprofile');
         }else{
         if(self::editUser($form['password'],$form['email'])==TRUE){
             echo "vase informacije su uspesno promenjene";  
            header('Refresh: 1; URL=editProfileController/editProfile');
            
          }    
        }
    }
     public function editUser($pass,$email){
      
      $this->load->model('Editprofile_Model', 'user');
      if ($this->user->createEditEntry($pass, $email) == TRUE) {
            return true;
        } else {
            return false;
        }
    }
 
    
    public function selectColor($idColor){
        
        $this->load->model('EditProfile_Model','EditProfileModel');
        $aaa=$this->EditProfileModel->color($idColor);
        $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'profile/editprofile','boja'=>$aaa));
        
        
    }
    
}


