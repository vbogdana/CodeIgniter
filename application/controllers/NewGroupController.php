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
        $this->load->model('Group_Model', 'group');
        $this->load->model('IsMember_Model', 'ismember');
        $this->load->model('User_Model', 'user');
        
        //$form_data = $this->input->post();
        $groupname = $this->input->post("groupName");
        $member = $this->input->post("member");
        
        if ($groupname == '') {
            echo "Unesite ime grupe. \n";
            return;
        }
        if ($member == '') {
            echo "Unesite clana. \n";
            return;
        } else { 
            $id_member = $this->user->exist($member);
            echo $id_member;
            if ($id_member == '-1') {
                echo "Ne postoji clan. \n";
                return;
            } 
        }
          
        $id_group = $this->group->createEntry($groupname);
        // provera da li postoji grupa
        if ($id_group == '-1') {
            echo "NEUSPESNO KREIRANO \n";
        } else {
            // ubaci clana
            if ($this->ismember->createEntry($id_member, $id_group, '0') == FALSE) {
                echo "ON je vec clan grupe \n";
            }
        }    
    }
    
}

?>
