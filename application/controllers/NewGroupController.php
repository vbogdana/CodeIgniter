<?php


/**
 * Description of NewGroupController
 *
 * @author Bogdana
 */
class NewGroupController extends CI_Controller {
    //put your code here
    
    function __construct()
	{
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('Group_Model', 'group');
        $this->load->model('IsMember_Model', 'ismember');
        $this->load->model('User_Model', 'user');
    }

    public function index() {

        $this->form_validation->set_rules('groupname', 'Group name', 'required|max_length[30]');
        $this->form_validation->set_rules('member', 'Add a member', 'required|max_length[30]');
        $this->form_validation->set_error_delimiters('<br /> <span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { 
            // validation hasn't been passed
            $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'groups/newGroup'));
        } else { 
            // passed validation proceed to post success logic
            $groupname = $this->input->post('groupname');
            $member = $this->input->post('member');
            $this->createGroup($groupname, $member);
        }
    }
    
    public function createGroup() {
        $groupname = $this->input->post("groupname");
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
          
        $id_group = $this->group->createEntry($groupname); // provera da li postoji grupa
        if ($id_group == '-1') {
            echo "NEUSPESNO KREIRANO \n";
        } else {        // ubaci clana  
            if ($this->ismember->createEntry($id_member, $id_group, '0') == FALSE) {
                echo "ON je vec clan grupe \n";
            }
        } 

    }
    
    public function autocomplete()
    {
     
        $search = $this->input->post('member');
        $query = $this->user->get_autocomplete($search);

        foreach ($query->result() as $row):
            // za svaki predlog u padajucoj listi chooseMember radi ubacuje u listu clanova
            echo '<li onclick="chooseMember(\''.$row->nickname.'\')" >'. $row->nickname . '</li>';
        endforeach;
    }
    
    public function addMember() {
        
        $member = $this->input->post('member');
        echo '<li>'. $member .'</li>';
                
    }
    
}

?>
