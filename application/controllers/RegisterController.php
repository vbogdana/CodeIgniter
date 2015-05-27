<?php

class RegisterController extends CI_Controller {
    
  public function signup() {
            
            $this->load->view('home/signUp');
        }
        
  public function index(){
      
      //validacija
      $rules=array(
            "username"=>array(
                "field"=>"username",
                "label"=>"username",
                "rules"=>"required|max_length[16]|min_length[4] | callback_username_is_taken"
            ),
          
           "password"=>array(
                "field"=>"password",
                "label"=>"password",
                "rules"=>"password|max_length[16]|min_length[6] "
            ),
          
           "re-password"=>array(
                "field"=>"re-password",
                "label"=>"re-password",
                "rules"=>"required|matches[password] "
            ),
          
           "e-mail"=>array(
                "field"=>"e-mail",
                "label"=>"e-mail",
                "rules"=>"required|valid_email | callback_email_is_taken "
            )
        
            
              
     );
      
      $this->form_validation->set_rules($rules);
      $this->form_validation->set_message('required','The %s field is empty');
      
      //Provera da li je forma submitovana
      if($this->form_validation->run()!=true){
          
          $this->load->view("RegisterController");
      }else{
          echo "kurac";
          
      }
  }
        
        
}