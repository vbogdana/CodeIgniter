<?php


class GroupPanelController extends CI_Controller{
    
    
     public function index(){
            
            $this->load->model('Group_Model','GroupPanel');
          //  $allUsers=$this->adminPanel->getAllUsers();
            
            $IdUser        =$this->session->userdata('idUser');
            $allGroups     =$this->GroupPanel->allGroupsUser($IdUser);
            
            $isMember      =$this->GroupPanel->isMemberGroup($IdUser);
            $nameOfGroup   =$this->GroupPanel->takeGroupName($isMember);
           
            $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'groups/groupPanel','niz' => $allGroups,'nazivigrupa'=>$nameOfGroup,'IdGrupa'=>$isMember));
          
     }
     
      public function deleteGro($idGroup) {  
          
          $this->load->model('Group_Model','GroupModel');

          $this->GroupModel->deleteGroup($idGroup);
          redirect('GroupPanelController');
          
      }
      
      public function leave($idGroup){
          
          $this->load->model('Group_Model','GroupModel');
          $IdUser=$this->session->userdata('idUser');
          $this->GroupModel->leaveGroup($idGroup,$IdUser);
          redirect('GroupPanelController');        
      }
}