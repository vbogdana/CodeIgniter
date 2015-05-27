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
class Group_Model extends CI_Model {
    
    function __construct() {
        $this->load->database();
        $this->load->model('IsMember_Model', 'ismember');
        parent::__construct();
    }
    
    public function getEntries() {
        return $this->db->get('group')->result();
    }
    
    public function getGroupID($groupname, $id_Creator) {
        $this->db->select('');
    }
    
    public function createEntry($name, $idGroup) {
        $this->load->helper('date');

        //srediti kad dule namesti login
        $creator='1';
        ///////////////////
        $group = array(
            'name' => $name ,
            'id_Creator' => $creator ,
            'created_On' => date('Y-m-d H:i:s')
        );
        
        //$this->db->set('time', 'NOW()', FALSE);
        //$this->db->insert('group', $group);

        $this->db->insert('group', $group);
        $this->ismember->createEntry($creator, $idGroup, '1');
        
        
        return $idGroup;
    }
}
