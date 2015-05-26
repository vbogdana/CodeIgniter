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
}
