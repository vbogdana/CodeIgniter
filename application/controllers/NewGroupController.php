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
        
        $form_data = $this->input->post();
        $groupname = $this->input->post("groupName");
        
        
        $this->load->model('Group_Model');
        $this->Group_Model->createEntry($groupname, 5);
    }
}
