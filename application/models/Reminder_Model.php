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
    
    public function checkPersonal($idUser, $note) {
        $this->db->select('datetime');
        $this->db->from('reminder');
        $this->db->where('idNote', $note['idNote']);
        $this->db->where('idUser', $idUser);
        $this->db->where('personal', '1');
        $personal = $this->db->get();
        
        return $personal;
    }
    
    public function checkGroup($idUser, $note) {
        $this->db->select('datetime');
        $this->db->from('reminder');
        $this->db->where('idNote', $note['idNote']);
        $this->db->where('idUser', $idUser);
        $this->db->where('personal', '0');
        $this->db->where('mute', '0');
        $group = $this->db->get();
        
        return $group;
    }
    
    public function getReminders($notes) {
        $idUser = $this->session->userdata('idUser');
        $reminders = array();
        $i = 0;
        
        foreach ($notes as $note) {
            $personal = $this->checkPersonal($idUser, $note);
            if ($personal->num_rows() == 1) {
                foreach ($personal->result() as $p) {
                    $reminders[$i]['personal'] = $p->datetime;
                }
            } else {
                $reminders[$i]['personal'] = 0;
            }

            $group = $this->checkGroup($idUser, $note);
            if ($group->num_rows() == 1) {
                foreach ($group->result() as $g) {
                    $reminders[$i]['group'] = $g->datetime;
                }
            } else {
                $reminders[$i]['group'] = 0;
            }

            $i++;
        }

        return $reminders;
    }
}
