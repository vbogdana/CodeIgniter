<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reminder_Model
 *
 * @author Bogdana
 */
class Reminder_Model extends CI_Model {
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('IsMember_Model', 'ismember');
    }
    
    public function createPersonal($idUser, $idNote, $datetime) {
        $array = array(
            'idUser' => $idUser,
            'idNote' => $idNote,
            'datetime' => $datetime,
            'personal' => '1',
            'mute' => '0'
        );
        
        $this->db->insert('reminder', $array);
    }
    
    public function createGroup($group, $idNote, $datetime) {
        $result = array();
        $i = 0;

        $members = $this->ismember->getMembers($group);
        
        foreach ($members->result() as $row) {
            $array = array(
                'idUser' => $row->id_User,
                'idNote' => $idNote,
                'datetime' => $datetime,
                'personal' => '0',
                'mute' => '0'
            );
            
            $this->db->insert('reminder', $array);
        }

        //return $members;
       
    }
}
