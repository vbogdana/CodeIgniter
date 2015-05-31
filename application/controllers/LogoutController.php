<?php

// autor Dusan Spasojevic

class LogOutController extends CI_Controller {

	public function index() { 
              $this->session->sess_destroy();
               redirect('HomeController/index');
               
           
        }
        
        
}