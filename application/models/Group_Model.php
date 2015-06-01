<?php

/**
 * Description of mgroup
 *
 * @author Bogdana
 */
class Group_Model extends CI_Model {
    
    function __construct() {        
        parent::__construct();
        $this->load->database();
        $this->load->model('IsMember_Model', 'ismember');
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
        $creator =  $this->session->userdata('idUser');
        
        $this->load->helper('date');

        $group = array(
            'name' => $name ,
            'id_Creator' => $creator ,
            'created_On' => date('Y-m-d H:i:s')
        );
        
        // probaj sa $idGroup = $this->db->insert_id('group', $group);
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

    public function get_autocomplete($search) {
        $idUser = $this->session->userdata('idUser');
        $this->db->select('name, idGroup');
        $this->db->like('name', $search);
        $this->db->where('id_Creator', $idUser);
        return $this->db->get('group', 8);
    }

}
