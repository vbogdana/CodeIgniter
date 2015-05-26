<?php

class BoardController extends CI_Controller {
	
	public function index() {
		
            $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/container'));
	}
        
       /* public function search() {
            $this->load->model('MUser');
            $result = $this->MUser->getData();
        }
        */
}
?>