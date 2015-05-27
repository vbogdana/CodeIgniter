<?php

/**
 * Description of MUser
 *
 * @author Bogdana
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
    
    public function login($nickname,$password) {
        $this->db->select('nickname,password');
        $this->db->from('user');
        $this->db->where('nickname',$nickname);
        $this->db->where('password',$password);
        
        $query=$this->db->get();
        
        if($query->num_rows() == 1) { 
            return true;
        } else {        
            return false;
        }
    }
}

?>
