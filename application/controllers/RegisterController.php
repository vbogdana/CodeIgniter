<?php

class RegisterController extends CI_Controller {
    
  public function signup() {
            
            $this->load->view('home/signUp');
        }
        
  public function index(){
      
      $this->load->helper('security');
      
      //validacija
      $rules=array(
            "username"=>array(
                "field"=>"username",
                "label"=>"username",
                "rules"=>"required|max_length[16]|min_length[4]" // | callback_username_is_taken
            ),
          
           "password"=>array(
                "field"=>"password",
                "label"=>"password",
                "rules"=>"required|max_length[16]|min_length[6] "
            ),
          
            "email"=>array(
                "field"=>"email",
                "label"=>"email",
                "rules"=>"required| valid_email"// | callback_email_is_taken
            ),
          
           "re-password"=>array(
                "field"=>"re-password",
                "label"=>"re-password",
                "rules"=>"required|matches[password] "
            )
          
                 
     );
      
      $this->form_validation->set_rules($rules);
      $this->form_validation->set_message('required','The %s field is empty');
      $this->form_validation->set_rules('email', 'email', 'required|valid_email');
      $this->form_validation->set_rules('email', 'email', 'required|callback_email_is_taken');
      $this->form_validation->set_rules('username', 'username', 'required|callback_username_is_taken');
      
      //Provera da li je forma submitovana
      if($this->form_validation->run()!=true){
          
          $this->load->view("home/signUp");
      }else{
          $form=array();
          $form['username']=$this->input->post("username");
          $form['password']=$this->input->post("password");
          $form['email']=$this->input->post("email");
          
          if(self::createUser($form['username'],$form['password'],$form['email'])==true) {
              
              //KORISNIK JE USPESNO DODAT U BAZU  
              $data['username']=$form['username'];
              $this->load->view("home/success_signUp",$data);
              
          }else {
              echo "Izninjavamo se trenutno ne mozemo obraditi vas zahtev,pokusajte ponovo";
          }
                  
      }
  }
  
  
  public function username_is_taken($input){
      
      $query="SELECT * FROM `user` WHERE `nickname`= ?";
      $arg=array($input);
      $exec= $this->db->query($query,$arg) or die(mysql_error());
      
      If($exec->num_rows()>0){
          
          $this->form_validation->set_message('username_is_taken','Sorry username <i>'. $input.' </i> is taken');
          return FALSE;
      } else {
          return TRUE;
      }
      
  }
      
  
   public function email_is_taken($input){
      
      $query="SELECT * FROM `user` WHERE `email`= ?";
      $arg=array($input);
      $exec= $this->db->query($query,$arg) or die(mysql_error());
      
      If($exec->num_rows()>0){
          
          $this->form_validation->set_message('email_is_taken','Sorry email <i> '.$input.' </i> is taken');
          return FALSE;
      } else {
          return TRUE;
      }
      
  }
  
  public function createUser ($user, $pass, $email){
      
      $this->load->model('User_Model', 'user');
      if ($this->user->createEntry($user, $pass, $email) == TRUE) {
            return true;
        } else {
            return false;
        };
  }
 
  
        
}