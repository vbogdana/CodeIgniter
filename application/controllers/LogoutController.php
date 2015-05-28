<?php


class LogOutController extends CI_Controller {
    
      
	
	public function index() { 
              $this->session->sess_destroy();
               redirect('HomeController/index');
               
           
        }
        public function firstLogin() {
		$this->load->view('home/firstLogin');
	}
        
}