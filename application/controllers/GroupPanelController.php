<?php

class GroupPanelController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('User_Model', 'user');
        $this->load->model('IsMember_Model', 'ismember');
    }

    public function index() {

        $this->load->model('Group_Model', 'GroupPanel');
        //  $allUsers=$this->adminPanel->getAllUsers();

        $IdUser = $this->session->userdata('idUser');
        $allGroups = $this->GroupPanel->allGroupsUser($IdUser);

        $isMember = $this->GroupPanel->isMemberGroup($IdUser);
        $nameOfGroup = $this->GroupPanel->takeGroupName($isMember);
        
        $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'groups/groupPanel', 'niz' => $allGroups, 'nazivigrupa' => $nameOfGroup, 'IdGrupa' => $isMember,'clanoviGrupa'=>0));
    }

    public function deleteGro($idGroup) {

        $this->load->model('Group_Model', 'GroupModel');
        $this->GroupModel->deleteGroup($idGroup);
        redirect('GroupPanelController');
    }

    public function leave($idGroup) {

        $this->load->model('Group_Model', 'GroupModel');
        $IdUser = $this->session->userdata('idUser');
        $this->GroupModel->leaveGroup($idGroup, $IdUser);
        redirect('GroupPanelController');
    }
    
      public function viewMember($IdGroup){
        
        $this->load->model('Group_Model', 'GroupPanel');
        $allMembers = $this->GroupPanel->Member($IdGroup);
        $names=$this->GroupPanel->nameMembers($allMembers);
            
        $IdUser = $this->session->userdata('idUser');
        $allGroups = $this->GroupPanel->allGroupsUser($IdUser);

        $isMember = $this->GroupPanel->isMemberGroup($IdUser);
        $nameOfGroup = $this->GroupPanel->takeGroupName($isMember);

        $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'groups/groupPanel', 'niz' => $allGroups, 'nazivigrupa' => $nameOfGroup, 'IdGrupa' => $isMember,'clanoviGrupa'=>$names));
        
    }
    
    
    public function deleteUserFromGroup($username,$idGroup){
        $this->load->model('Group_Model', 'GroupPanel');
        $this->load->model('User_Model', 'UserModel');
        
        $idUser=$this->UserModel->exist($username);
        
       
      //  $this->GroupPanel->leaveGroup($idGroup,$idUser);
        $aaa= $this->GroupPanel->deleteUsersNote($idUser,$idGroup);
        
        
        print_r($aaa);
       // redirect('GroupPanelController/viewMember/'."$idGroup");
    }


    

    public function autocomplete() {
        $search = $_POST['member'];
        $idGroup = $_POST['idGroup'];
        $echoed = false;
        $nickname = $this->session->userdata('nickname');

        $query = $this->user->get_autocomplete($search);

        foreach ($query->result() as $row):
            if (($row->nickname != $nickname) && !($this->ismember->isMember($row->idUser, $idGroup))) {
                echo '<li onclick="setInput(\'' . $row->nickname . '\')" >' . $row->nickname . '</li>';
                $echoed = true;
            }
        endforeach;

        if (!$echoed) {
            echo '';
        }
    }
    
    public function addmember() {
        $member = $_POST['member'];
        $idGroup = $_POST['idGroup'];
        $groupname = $_POST['groupname'];
        
        $idUser = $this->user->exist($member);
        
        if ($idUser == '-1') {
            // ne postoji
            echo 'This member does not exist';
        } else {
            $inGroup = $this->ismember->isMember($idUser, $idGroup);
            
            if ($inGroup) {
                echo 'This member is already in this group.';
            } else {
                $this->ismember->addmember($idUser, $idGroup, $groupname);
                echo 'Member is successfully added.';
            }
        }
    }

    
  
    
}
