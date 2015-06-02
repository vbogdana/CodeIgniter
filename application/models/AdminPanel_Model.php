<?php

class AdminPanel_Model extends CI_Model {

    public function getAllGroups() {
        $data = array();
        $i = 0;
        $this->db->from('group');
        $query = $this->db->get();


        foreach ($query->result() as $row) {

            $user_data = array(
                'IdGroup' => $row->idGroup,
                'NameGroup' => $row->name,
                'IdCreator' => $row->id_Creator,
            );


            $data[$i] = $user_data;
            $i++;
        }
        
        return $data;
    }

    public function getAllUsers() {
        $data = array();
        $i = 0;
        $this->db->from('user');
        $query = $this->db->get();


        foreach ($query->result() as $row) {

            $user_data = array(
                'idUser' => $row->idUser,
                'nickname' => $row->nickname,
                'email' => $row->email,
                'admin' => $row->is_Admin,
                'password' => $row->password
            );


            $data[$i] = $user_data;
            $i++;
            /*
              $idUser    =$user_data['idUser'];
              $nickname  =$user_data['nickname'];
              $email     =$user_data['email'];
              $is_Admin  =$user_data['admin'];
              $password  =$user_data['password'];

              $currentUser=$this->session->userdata('nickname');
              if($nickname==$currentUser)                      continue;


              echo " $idUser $nickname  $email   $is_Admin  $password </br>";

             */
        }

        return $data;
    }

    public function deleteUser($idUser) {
        $flag = $this->session->userdata('admin');
        if ($flag == 0)
            redirect('boardController/board/global');
        $this->db->where('idUser', $idUser);
        $this->db->delete('user');

        return $this->db->affected_rows(); //vraca 0 kada se brise iz baze
    }

    public function deleteGroup($idGroup){
        $flag = $this->session->userdata('admin');
        if ($flag == 0)
            redirect('boardController/board/global');
        $this->db->where('idGroup', $idGroup);
        $this->db->delete('group');

        return $this->db->affected_rows(); //vraca 0 kada se brise iz baze
        
    }
}
