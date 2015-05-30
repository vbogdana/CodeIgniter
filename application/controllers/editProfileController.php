<?php

class editProfileController extends CI_Controller {
    
    
 
    public function editProfile() {
     $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'profile/editprofile')); 
    
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
            header('Refresh: 2; URL=boardcontroller');
            
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
 
    
}
