<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IsMember_Model
 *
 * @author Bogdana
 */
class IsMember_Model extends CI_Model {
    //put your code here
    function __construct() {
        $this->load->database();
        parent::__construct();
    }
    
    public function getEntries() {
        return $this->db->get('ismember')->result();
    }
    
    public function createEntry($id_User, $id_Group, $is_Admin) {
        $this->load->helper('date');
        
        //srediti kad aleksa sredi bazu
        $entry = array(
            'id_User' => $id_User,
            'id_Group' => $id_Group ,
            'is_Admin' => $is_Admin ,
            'joined_On' => date('Y-m-d H:i:s')
        );

        $this->db->insert('ismember', $entry); 
    }
}
