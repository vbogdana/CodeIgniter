<?php

class AdminPanel_Model extends CI_Model{
    
    public function getAllUsers(){
         $data = array();
          $i = 0;
        $this->db->from('user');
        $query = $this->db->get();
        
            
            foreach ($query->result() as $row) {
                
                 $user_data = array(
                    'idUser' => $row->idUser,
                    'nickname' => $row->nickname,
                    'email' => $row->email,
                    'admin' => $row->is_Admin,
                    'password' => $row->password
                     );
                 
                 
                 $data[$i] = $user_data;
                 $i++;
                 /*
                  $idUser    =$user_data['idUser'];
                  $nickname  =$user_data['nickname'];
                  $email     =$user_data['email']; 
                  $is_Admin  =$user_data['admin'];
                  $password  =$user_data['password'];
                  
                  $currentUser=$this->session->userdata('nickname'); 
                  if($nickname==$currentUser)                      continue;
                  
                  
                  echo " $idUser $nickname  $email   $is_Admin  $password </br>";
                  
                  */
                
            }
        
             return $data;
    }
    
}