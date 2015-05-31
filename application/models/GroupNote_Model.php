<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupNote_Model
 *
 * @author Bogdana
 */
class GroupNote_Model extends CI_Model{
    //put your code here
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        //$this->load->model('Group_Model', 'group');
    }
    
    public function canLock($idNote) {
        $idUser = $this->session->userdata('idUser');
        
        $this->db->from('note');
        $this->db->where('idUser', $idUser);
        $this->db->where('idNote', $idNote);
        
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $this->db->from('group_note');
                $this->db->where('idNote', $row->idNote);
                
                $query1 = $this->db->get();
                
                if ($query1->num_rows() == 1) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }            
        } else {
            return FALSE;
        }
    }
    
    public function checkLocked($idNote) {
        //$idUser = $this->session->userdata('idUser');
        $this->db->from('group_note');
        $this->db->where('idNote', $idNote);
        $this->db->where('is_Locked', '1');
        
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function lock($idNote) {
        $idUser = $this->session->userdata('idUser');
        
        $array = array(
               'is_Locked' => '1',
               'last_Editor' => $idUser
            );

        $this->db->where('idNote', $idNote);
        $this->db->update('group_note', $array);
        
        $array1 = array(
                'last_Edited_On' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('idNote', $idNote);
        $this->db->update('note', $array1);
        
    }
    
    public function unlock($idNote) {
        $idUser = $this->session->userdata('idUser');
        
        $array = array(
               'is_Locked' => '0',
               'last_Editor' => $idUser
            );
        
        $this->db->where('idNote', $idNote);
        $this->db->update('group_note', $array);
        
        $array1 = array(
                'last_Edited_On' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('idNote', $idNote);
        $this->db->update('note', $array1);
         
    }
}
