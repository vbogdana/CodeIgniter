<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Important_Model
 *
 * @author Bogdana
 */
class Important_Model extends CI_Model {
    //put your code here

    function __construct() {
        parent::__construct();
        $this->load->database();

        //$this->load->model('Group_Model', 'group');
    }

    public function checkImportant($idNote) {
        $idUser = $this->session->userdata('idUser');
        
        //$this->db->select('idNote');
        $this->db->from('important');
        $this->db->where('idUser', $idUser);
        $this->db->where('idNote', $idNote);
        
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function setImportant($idNote) {
        $idUser = $this->session->userdata('idUser');
        
        $array = array(
            'idNote' => $idNote,
            'idUser' => $idUser
        );
        
        $this->db->insert('important', $array);
        
    }
    
    public function unsetImportant($idNote) {
        $idUser = $this->session->userdata('idUser');
        
        $this->db->where('idNote', $idNote);
        $this->db->where('idUser', $idUser);
        $this->db->delete('important'); 
        
    }
}
