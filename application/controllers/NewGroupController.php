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

        //  UKOLIKO KORISNIK NIJE LOGOVAN NE MOZE PRISTUPITI
        $logged_in = $this->session->userdata('logged_in');

        if ($logged_in <> 1) {
            redirect('loginController/firstlogin');
        } else {
            
            $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'groups/newGroup'));
            /*
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
            
             */
        }
    }

    public function createGroup() {
     
        $groupname = $this->input->post("groupname");
        $members = $this->input->post("members");
        $num = $this->input->post("num");
        
        $id_group = $this->group->createEntry($groupname); // provera da li postoji grupa
        if ($id_group == '-1') {
            echo "NEUSPESNO KREIRANO \n";
        } else {
            for ($i = 0; $i<$num; $i++) {
            $id_member = $this->user->exist($members[$i]);
            $this->ismember->createEntry($id_member, $id_group, '0');
            }
            
            $data  = $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'board/container'), TRUE);
            $this->output->set_output($data); 
        }

    }
    
    public function checkGroupName() {
        $groupname = $this->input->post('groupname');
        $idUser = $this->session->userdata('idUser');
        
        if ($this->group->existGroup($groupname, $idUser) == '-1') {
            echo "Name of the group is free.";
        } else {
            echo "Name of the group is taken.";
        };
    }
    
    public function autocomplete()
    {
        $search = $this->input->post('member');
        $members = $this->input->post('members');
        $num = $this->input->post('num');
        $echoed = false;
        
        $query = $this->user->get_autocomplete($search);

        foreach ($query->result() as $row):
            $isAlreadySelected = false;
            if ($row->nickname != $this->session->userdata('nickname')) {
                for ($i = 0; $i<$num; $i++) {
                    if ($members[$i] == $row->nickname) {
                        $isAlreadySelected = true;
                        break;
                    }
                }
                if (!$isAlreadySelected) {
                    echo '<li onclick="chooseMember(\''.$row->nickname.'\')" >'. $row->nickname . '</li>';
                    $echoed = true;
                }     
            }
        endforeach;
        
        if (!$echoed) {
            echo '';
        }
    }
    
    public function addMember() {
        // kreira novi div za izabranog clana
        $members = $this->input->post('members');
        $member = $this->input->post('member');
        $num = $this->input->post('num');
        echo '<input id="member'. $num .'" type="text" name="member" maxlength="30" value="' . $member .' " readonly />';
                
    } 
}

?>
