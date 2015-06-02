<?php

class adminPanelController extends CI_Controller{
    
     public function adminPanel() {
     $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'admin/adminpanel')); 
    
    }
    
     public function index(){
           // $allUsers = array(); 
            $this->load->model('AdminPanel_Model','adminPanel');
            $allUsers=$this->adminPanel->getAllUsers();
            
           print_r(array_values($allUsers));
            
          //$this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'admin/adminpanel'));
          
          
     }
    
    
}
