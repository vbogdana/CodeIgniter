<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HiddenNote_Model
 *
 * @author Bogdana
 */
class HiddenNote_Model extends CI_Model {
    //put your code here
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Important_Model', 'important');
        //$this->load->model('Group_Model', 'group');
    }
    
    public function checkHidden($idNote) {
        $idUser = $this->session->userdata('idUser');
        
        //$this->db->select('idNote');
        $this->db->from('hidden_note');
        $this->db->where('idUser', $idUser);
        $this->db->where('idNote', $idNote);
        
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function canHide($idNote) {
        $idUser = $this->session->userdata('idUser');
        
        $this->db->from('note');
        $this->db->where('idUser', $idUser);
        $this->db->where('idNote', $idNote);
        
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            $this->db->from('group_note');
            $this->db->where('idNote', $idNote);
            $query1 = $this->db->get();
            
            if ($query1->num_rows() == 1) {
                return TRUE;
            } else {
                return FALSE;
            }          
        } else {
            return TRUE;
        }
    }
    
    public function hide($idNote) {
        $idUser = $this->session->userdata('idUser');
        
        if ($this->important->checkImportant($idNote) == TRUE) {
            $this->important->unsetImportant($idNote);
        }
        $array = array(
            'idNote' => $idNote,
            'idUser' => $idUser
        );
        
        $this->db->insert('hidden_note', $array);
        
    }
    
    public function unhide($idNote) {
        $idUser = $this->session->userdata('idUser');
        
        $this->db->where('idNote', $idNote);
        $this->db->where('idUser', $idUser);
        $this->db->delete('hidden_note');

    }
}
