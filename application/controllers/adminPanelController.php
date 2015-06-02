<?php
class adminPanelController extends CI_Controller{
    
     public function adminPanel() {
     $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'admin/adminpanel')); 
    
    }
    
     public function index(){
            
            $this->load->model('AdminPanel_Model','adminPanel');
            $allUsers=$this->adminPanel->getAllUsers();
            $allGroups=$this->adminPanel->getAllGroups();
            $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'admin/adminpanel','niz' => $allUsers,'groups' => $allGroups));
          
          
     }
    
      public function delete($idUser) {  
          
          $this->load->model('AdminPanel_model','AdminPanel');
          $this->AdminPanel->deleteUser($idUser);
          redirect('adminPanelController');
          
      }
      
      public function deleteG($idGroup) {  
          
          $this->load->model('AdminPanel_model','AdminPanel');
          $this->AdminPanel->deleteGroup($idGroup);
          redirect('adminPanelController');
          
      }
      
      
      
    
}