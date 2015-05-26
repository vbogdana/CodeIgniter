<?php

/**
 * Description of MUser
 *
 * @author Bogdana
 */
class MUser extends CI_Model {
    //put your code here
    function __construct() {
        $this->load->database();
        parent::__construct();
    }
    
    public function getData() {
        //$this->db->like('nickname', $nickname, 'both');
        return $this->db->get('user')->result();
    }
}

?>
