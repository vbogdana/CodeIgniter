<?php

/**
 * Description of MUser
 *
 * @author Bogdana, Dusan Spasojevic
 */

class User_Model extends CI_Model {
    //put your code here
    function __construct() {
        $this->load->database();
        parent::__construct();
    }
    
    public function getData() {
        //$this->db->like('nickname', $nickname, 'both');
        return $this->db->get('user')->result();
    }
    
    public function exist($nickname) {
        $this->db->select('idUser');
        $this->db->from('user');
        $this->db->where('nickname',$nickname);
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){    
            foreach ($query->result() as $row) {
                return $row->idUser;
            }
        } else {     
            return '-1';
        }
    }
    
    public function login($nickname, $password) {
        //$this->db->select('nickname, password');
        $this->db->from('user');
        $this->db->where('nickname', $nickname);
        $this->db->where('password', $password);
        
        $query = $this->db->get();

        
        if($query->num_rows() == 1){    
            foreach ($query->result() as $row) {
                
               $session_data=array(
                   'idUser'=>$row->idUser,
                   'nickname'=>$row->nickname,
                   'email'=>$row->email,
                   'password'=>$row->password,
                   'currentGroup'=>'-1'     // globalna ce biti oznacena sa -1
               );
            }
            $this->set_session($session_data);
            
            return true;
            
        } else {        
            return false;
        }
    }
    
    public function createEntry($nickname, $pass, $email) {
        $user = array(
            'nickname' => $nickname,
            'password' => $pass,
            'email' => $email,
            'note_color' => '1',
            'link_photo' => '',
            'is_Admin' => '',
        );
        
        if ($this->db->insert('user', $user) == TRUE) {
            return true;
        } else {
            return false;
        }
        
    }
    
     public function  set_session($session_data){
       
        $sess_data=array(
                   'idUser'     =>$session_data['idUser'],
                   'nickname'   =>$session_data['nickname'],
                   'email'      =>$session_data['email'], 
                   'password'   =>$session_data['password'],
                   'currentGroup'=>$session_data['currentGroup'],// globalna ce biti oznacena sa -1
                   'logged_in' => 1
               );
        
        $this->load->library('session');
        
        $this->session->set_userdata($sess_data);
    }
    
     public function get_autocomplete($search)
    {
        $this->db->select('nickname');
        $this->db->like('nickname', $search);
        return $this->db->get('user', 8);
    }
}

?>
