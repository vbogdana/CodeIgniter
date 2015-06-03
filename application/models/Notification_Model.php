<?php

/**
 * Description of Notification_Model
 *
 * @author Bogdana
 */
class Notification_Model extends CI_Model {
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getNotifications($idUser) {
        $notifications = array();
        $this->db->from('notification');
        $this->db->where('idUser', $idUser);
        $this->db->order_by('created_On', 'desc');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach($query->result() as $row) {
                $notifications[$i]['idNotification'] = $row->idNotification;
                $notifications[$i]['idGroup'] = $row->idGroup;
                $notifications[$i]['content'] = $row->content;
                $notifications[$i]['created_On'] = $row->created_On;
                $i++;
            }  
        }
        
        return $notifications;
    }
    
    public function deleteNotifications($idUser) {
        $this->db->where('idUser', $idUser);
        $this->db->delete('notification');
    }
    
    public function deleteNotification($idNotification) {
        $this->db->where('idNotification', $idNotification);
        $this->db->delete('notification');
    }
}
