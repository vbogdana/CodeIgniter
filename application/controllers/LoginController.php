<?php

// autor Dusan Spasojevic

class LoginController extends CI_Controller {
    	
	public function signin() {
		$this->load->view('home/signIn');
	}
	
        public function checkLogin(){
            $this->form_validation->set_rules('username','username','required');
            $this->form_validation->set_rules('password','password','required|callback_verifyUser');
            
            if($this->form_validation->run()== false){
                $this->load->view('home/signIn');
            }else{
                $is_admin= $this->session->userdata('admin'); 
                
               
                if(!$is_admin){
                redirect('BoardController/board/global');   
                }else{
                    redirect('adminPanelController');  
                    
                }
            }
        }   

        public function verifyUser() {
            $name=$this->input->post('username');
            $pass=$this->input->post('password');
            
            $this->load->model('User_Model', 'user');
            
            if($this->user->login($name,$pass)){
                return true;
            }else{
                $this->form_validation->set_message('verifyUser','Incorect password or username.');
                return false;
            }
        }
        
        public function firstLogin() {
		$this->load->view('home/firstLogin');
	}
        
         
}


