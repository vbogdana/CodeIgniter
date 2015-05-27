<?php


/**
 * Description of NewGroupController
 *
 * @author Bogdana
 */
class NewGroupController extends CI_Controller {
    //put your code here
    
    public function index() {
        $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'groups/newGroup'));
    }
    
    public function createGroup() {
        
        //$form_data = $this->input->post();
        $groupname = $this->input->post("groupName");
        $member = $this->input->post("member");
        
        if ($member == '') {
            echo "Unesite clana.";
            return;
        } else {
            $this->load->model('User_Model', 'user');
            $id_member = $this->user->exist($member);
            echo $id_member;
                if ($id_member == '-1') {
                    echo "Ne postoji clan.";
                    return;
                }
        }
        
        
        $this->load->model('Group_Model', 'group');
        $this->load->model('IsMember_Model', 'ismember');
        $id_group = $this->group->createEntry($groupname, 7);
        $this->ismember->createEntry($id_member, $id_group, '0');
    }
}

?>
