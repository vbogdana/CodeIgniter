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
    
    public function existGroup($groupname, $id_Creator) {
        
        $this->db->select('idGroup');
        $this->db->from('group');
        $this->db->where('name', $groupname);
        $this->db->where('id_Creator', $id_Creator);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->idGroup;
            }
        } else if ($query->num_rows() > 1) {
            // postoji ih vise - greska
            return '-2';
        } else {
            // ne postoji nijedna
            return '-1';
        }
    }
    
    public function createEntry($name) {
        //srediti kad dule namesti login
        $creator='1';
        ///////////////////
        
        $exist = $this->existGroup($name, $creator);
        if ($exist != '-1') {
            // vec postoji
            echo "GRUPA VEC POSTOJI \n";
            return '-1';
        }
        
        $this->load->helper('date');

        $group = array(
            'name' => $name ,
            'id_Creator' => $creator ,
            'created_On' => date('Y-m-d H:i:s')
        );

        $this->db->insert('group', $group);
        $idGroup = $this->existGroup($name, $creator);
        
        if ($idGroup == '-1') {
            // neuspesno kreirana
            echo "NIJE KREIRANA GRESKA DO BAZE \n";
        } else {
            $this->ismember->createEntry($creator, $idGroup, '1');
        }
        
        return $idGroup;
    }
}
