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
    
    public function see($idNote, $personal) {
        $idUser = $this->session->userdata('idUser');
        $array = array(
            'seen' => '1',
        );
        
        $this->db->where('idUser', $idUser);
        $this->db->where('idNote', $idNote);
        $this->db->where('personal', $personal);
        $this->db->update('reminder', $array);
    }
    
    public function existPersonal($idUser, $idNote) {
        $this->db->from('reminder');
        $this->db->where('idNote', $idNote);
        $this->db->where('idUser', $idUser);
        $this->db->where('personal', '1');
        $result = $this->db->get();
  
    }
    
    public function updatePersonal($idUser, $idNote, $pC, $datetime) {
        // check exist personal
        $this->db->from('reminder');
        $this->db->where('idNote', $idNote);
        $this->db->where('idUser', $idUser);
        $this->db->where('personal', '1');
        $result = $this->db->get();
        
        if ($result->num_rows() == 1) {
            // postoji personalni
            if ($pC == 'true') {
                // updateuj ga
                $array = array(
                    'datetime' => $datetime
                );
                
                $this->db->where('idNote', $idNote);
                $this->db->where('idUser', $idUser);
                $this->db->where('personal', '1');
                $this->db->update('reminder', $array);    
            } else {
                // obrisi ga
                $this->db->where('idNote', $idNote);
                $this->db->where('idUser', $idUser);
                $this->db->where('personal', '1');
                $this->db->delete('reminder');
            }
        } else {
            // ne postoji personalni
            if ($pC == 'true') {
                // napravi novi
                $this->createPersonal($idUser, $idNote, $datetime);
            }
        }
    }
    
    public function updateGroup($idNote, $gC, $datetime) {
        // check exist group reminder
        $this->db->from('reminder');
        $this->db->where('idNote', $idNote);
        $this->db->where('personal', '0');
        $result = $this->db->get();
        
        if ($result->num_rows() > 0) {
            // postoji grupni
            if ($gC == 'true') {
                // updateuj ga
                $array = array(
                    'datetime' => $datetime
                );
                
                $this->db->where('idNote', $idNote);
                $this->db->where('personal', '0');
                $this->db->update('reminder', $array);    
            } else {
                // obrisi ga
                $this->db->where('idNote', $idNote);
                $this->db->where('personal', '0');
                $this->db->delete('reminder');
            }
        } else {
            // ne postoji grupni
            if ($gC == 'true') {
                // napravi novi
                $this->db->select('id_Group');
                $this->db->from('group_note');
                $this->db->where('idNote', $idNote);
                $query = $this->db->get();
                
                if ($query->num_rows() == 1) {
                    foreach ($query->result() as $row) {
                        $group = $row->id_Group;
                    }
                }
                $this->createGroup($group, $idNote, $datetime);
            }
        }
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
        $this->db->select('datetime, mute');
        $this->db->from('reminder');
        $this->db->where('idNote', $note['idNote']);
        $this->db->where('idUser', $idUser);
        $this->db->where('personal', '0');
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
                $reminders[$i]['personal'] = 'no personal reminder';
            }

            $group = $this->checkGroup($idUser, $note);
            if ($group->num_rows() == 1) {
                foreach ($group->result() as $g) {
                    if ($g->mute == '0') {
                       $reminders[$i]['group'] = $g->datetime; 
                    } else  {
                        $reminders[$i]['group'] = 'group reminder muted';
                    }
                    
                }
            } else {
                $reminders[$i]['group'] = 'no group reminder';
            }

            $i++;
        }

        return $reminders;
    }
    
    public function mute($idNote) {
        $idUser = $this->session->userdata('idUser');

        $this->db->select('mute, datetime');
        $this->db->from('reminder');
        $this->db->where('idNote', $idNote);
        $this->db->where('idUser', $idUser);
        $this->db->where('personal', '0');
        $reminder = $this->db->get();
        

        if ($reminder->num_rows() == 1) {
            foreach ($reminder->result() as $r) {
                if ($r->mute == '1') {
                    $array = array(
                        'mute'=> '0'
                    );
                } else {
                    $array = array(
                        'mute'=>'1'
                    );
                }
                
                $wasmuted = $r->mute;

                $this->db->where('idNote', $idNote);
                $this->db->where('idUser', $idUser);
                $this->db->where('personal', '0');
                $this->db->update('reminder', $array);
                if ($wasmuted == '1') {
                    return $r->datetime;
                } else {
                    return $wasmuted;
                }
            }
        }
    }
    
    public function getAlarms($idUser) {
        $current_time = date('Y-m-d H:i:s');
        $alarms = array();
        
        $this->db->from('reminder');
        $this->db->where('idUser', $idUser);
        $this->db->where('mute', '0');
        $this->db->where('seen', '0');
        $this->db->where('datetime <=', $current_time);
        $this->db->order_by('datetime', 'desc'); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach($query->result() as $row) {
                $alarms[$i]['idNote'] = $row->idNote;
                $alarms[$i]['datetime'] = $row->datetime;
                $alarms[$i]['personal'] = $row->personal;
                $i++;
            }  
        }
        
        return $alarms;
    }
}
