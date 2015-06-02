<?php

/**
 * Description of IsMember_Model
 *
 * @author Bogdana
 */

class IsMember_Model extends CI_Model {
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();  
    }
    
    public function getEntries() {
        return $this->db->get('ismember')->result();
    }
    
    function getMembers($group) {
        $members = array();
        
        $this->db->select('id_User');
        $this->db->from('ismember');
        $this->db->where('id_Group', $group);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query;
        }
        return FALSE;
    }
    
    public function isAdmin($id_User, $id_Group) {
        //$this->db->select();
        $this->db->from('ismember');
        $this->db->where('id_User', $id_User);
        $this->db->where('id_Group', $id_Group);
        $this->db->where('is_Admin ==', '1');
        
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return TRUE;
        } else if ($query->num_rows() > 1) {
            return FALSE;
        }
    }
    
    public function isMember($id_User, $id_Group) {
        //$this->db->select('*');
        $this->db->from('ismember');
        $this->db->where('id_User', $id_User);
        $this->db->where('id_Group', $id_Group);
        
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return TRUE;
        } else if ($query->num_rows() > 1) {
            return FALSE;
        }
    }
    
    public function createEntry($id_User, $id_Group, $is_Admin) {
        if ($this->isMember($id_User, $id_Group) == TRUE) {
            return FALSE;
        }
        
        $this->load->helper('date');
        
        $entry = array(
            'id_User' => $id_User,
            'id_Group' => $id_Group ,
            'is_Admin' => $is_Admin ,
            'joined_On' => date('Y-m-d H:i:s')
        );

        $this->db->insert('ismember', $entry);
        return TRUE;
        
    }
}
