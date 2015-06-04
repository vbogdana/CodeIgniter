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
    
    public function color($idColor){
        $idUser=  $this->session->userdata('idUser');
        
        if ($idColor==1){
           $query = "UPDATE `user` SET `note_Color`='E3FFDA' WHERE `iduser`='$idUser'";
            $this->db->query($query);  
          return 1;  
        }
        if ($idColor==2){
            $query = "UPDATE `user` SET `note_Color`='FFFAF0' WHERE `iduser`='$idUser'";
            $this->db->query($query);    
            return 2;    
        }
        
        if ($idColor==3){
            $query = "UPDATE `user` SET `note_Color`='FFFFFF' WHERE `iduser`='$idUser'";
            $this->db->query($query);    
            return 3;   
        }
        
      
        if ($idColor==4){
            $query = "UPDATE `user` SET `note_Color`='FFFFD1' WHERE `iduser`='$idUser'";
            $this->db->query($query);    
            return 4;     
        }
        if ($idColor==5){
            $query = "UPDATE `user` SET `note_Color`='E9FFFF' WHERE `iduser`='$idUser'";
            $this->db->query($query);   
            return 5;   
        }
          return 0;
    }
    
             // E3FFDA, FFFAF0, FFFFFF, FFFFD1, E9FFFF
   
        public function dohvatiBoju($idUser){
        
         $this->db->select('note_Color');
         $this->db->from('user');
         $this->db->where('idUser', $idUser);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->note_Color;
            }
        } else {
            return '-1';
        }
        
    }
}