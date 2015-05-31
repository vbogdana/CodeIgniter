<?php

class EditProfile_Model extends CI_Model {
    
    
      public function createEditEntry($pass, $email) {
         
           if($pass=="") $pass=$this->session->userdata('password');
           if($email=="") $email=$this->session->userdata('email');
              
          $idUser=$this->session->userdata('idUser');
       
         $query = "UPDATE `user` SET `email`='$email', `password`='$pass' WHERE `iduser`='$idUser'";
         
            $this->db->query($query);
            return true;
        
    }
    
    

}