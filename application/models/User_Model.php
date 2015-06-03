<?php

/**
 * Description of MUser
 *
 * @author Bogdana, Dusan Spasojevic
 */
class User_Model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getData() {
        //$this->db->like('nickname', $nickname, 'both');
        return $this->db->get('user')->result();
    }

    public function exist($nickname) {
        $this->db->select('idUser');
        $this->db->from('user');
        $this->db->where('nickname', $nickname);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->idUser;
            }
        } else {
            return '-1';
        }
    }

    public function login($nickname, $password) {
        //$this->db->select('nickname, password');
        $this->db->from('user');
        $this->db->where('nickname', $nickname);
        $this->db->where('password', $password);

        $query = $this->db->get();


        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {

                $session_data = array(
                    'idUser' => $row->idUser,
                    'nickname' => $row->nickname,
                    'email' => $row->email,
                      //dodao za admina
                    'admin' => $row->is_Admin,
                    'password' => $row->password,
                    //dodao za sliku
                    'image'=>"",
                    // treba meni
                    'last' => '-1',
                    'lastI' => '-1',
                    'last_Edited_On' => '-1',
                    'lastI_Edited_On' => '-1'
                );
            }
            $this->set_session($session_data);
            
            //PRILIKOM LOGOVANJA UZIMA POSLEDNJU SLIKU I STAVLJA U SESIJU TRBA OPTIMIZOVATI//
            $this->db->from('image');
            $this->db->where('title', $nickname);
            $query = $this->db->get();
            foreach ($query->result() as $row) { 
                $pic=$row->product_pic;
            $this->session->set_userdata('image', "$pic");  
    
            }
            

            return true;
        } else {
            return false;
        }
    }

    public function createEntry($nickname, $pass, $email) {
        $user = array(
            'nickname' => $nickname,
            'password' => $pass,
            'email' => $email,
            'note_color' => '1',
            'link_photo' => '',
            'is_Admin' => '0',
        );

        if ($this->db->insert('user', $user) == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function set_session($session_data) {

        $sess_data = array(
            'idUser' => $session_data['idUser'],
            'nickname' => $session_data['nickname'],
            'email' => $session_data['email'],
            'admin' => $session_data['admin'],
            'password' => $session_data['password'],
            'logged_in' => 1,
            // treba meni
            'last' => $session_data['last'],
            'lastI' => $session_data['lastI'],
            'last_Edited_On' => $session_data['last_Edited_On'],
            'lastI_Edited_On' => $session_data['lastI_Edited_On']
        );

        $this->load->library('session');

        $this->session->set_userdata($sess_data);
    }

    public function get_autocomplete($search) {
        $this->db->select('idUser, nickname');
        $this->db->like('nickname', $search);
        return $this->db->get('user', 8);
    }

}

?>
