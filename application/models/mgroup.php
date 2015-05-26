<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mgroup
 *
 * @author Bogdana
 */
class MGroup extends CI_Model {
    
    function __construct() {
        $this->load->database();
        parent::__construct();
    }
    
    public function getEntries() {
        return $this->db->get('group')->result();
    }
    
    public function createEntry($name, $creator) {
        $this->load->helper('date');
        
        $format = 'DATE_RFC822';
        $time = time();
        
        $group = array(
            'name' => $name ,
            'id_Creator' => $creator ,
            'created_On' => standard_date($format, $time)
        );

        $this->db->insert('group', $group); 
    }
}
