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
    
    public function getName($idGroup) {
        $this->db->select('name');
        $this->db->from('group');
        $this->db->where('idGroup', $idGroup);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->name;
            }
        }
    }
    
    public function existGroupByName($groupname) {
        $this->db->select('idGroup');
        $this->db->from('group');
        $this->db->where('name', $groupname);
        
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
            // dodaje i admina odmah
            $this->ismember->createEntry($creator, $idGroup, $name, '1', 'false');
        }

        return $idGroup;
    }

    public function get_autocomplete($search) {
        $idUser = $this->session->userdata('idUser');
        
        $this->db->select('name, idGroup');
        $this->db->like('name', $search);
        return $this->db->get('group', 8);
        
        /*
        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
        mysqli_select_db($link, "mydb") or die(mysql_error());
        
        $result = mysqli_query($link, "SELECT name, idGroup "
                . "FROM group g "
                . "WHERE exists (SELECT * FROM ismember im WHERE im.id_User='$idUser' and g.idGroup=im.id_Group) ")
                or die(mysql_error()); 
        
        return $result;
         * 
         */
    }
    
    
    public function allGroupsUser($IdUser){
        
         $this->db->from('group');
         $this->db->where('id_Creator', $IdUser);
         $query = $this->db->get();
         
         $data = array();
         $i = 0;
         
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
    
     public function deleteGroup($idGroup){
       
        $this->db->where('idGroup', $idGroup);
        $this->db->delete('group');

        return $this->db->affected_rows(); //vraca 0 kada se brise iz baze
        
    }

    public function isMemberGroup($IdUser){
        
         $this->db->from('ismember');
         $this->db->where('id_User', $IdUser);
         
         $query = $this->db->get();
         
         $data = array();
         $i = 0;
         
         foreach ($query->result() as $row) {

            $user_data = array(
            'IdGroup'      => $row->id_Group,
            'isAdmin'      => $row->is_Admin
             );
            $data[$i] = $user_data;
            $i++;
        }
        
        return $data;
        
        
    }
    
    public function takeGroupName($isMember){
        
         $data = array();
         $j = 0;
         
        $n=count($isMember);
  
        for($i=0;$i<$n;$i++) {
            
             $IdGroup=$isMember[$i]['IdGroup'];
             $this->db->from('group');
             $this->db->where('idGroup',$IdGroup);
            
              $query = $this->db->get();
              
              foreach ($query->result() as $row) {

                 $user_data = $row->name;
 
                 $data[$j] = $user_data;
                 $j++;
               }
        
             
        }
        
        return $data;
        
    }
    
    public function leaveGroup($idGroup,$IdUser){
        
         $this->db->where('id_User', $IdUser);
         $this->db->where('id_Group', $idGroup);
         $this->db->delete('ismember');

        return $this->db->affected_rows(); //vraca 0 kada se brise iz baze
        
    }
    
    
    public function Member($IdGroup){
        
          $this->db->from('ismember');
         $this->db->where('id_Group', $IdGroup);
         
         $query = $this->db->get();
         
         $data = array();
         $i = 0;
         
         foreach ($query->result() as $row) {

            $user_data = array(
            'id_User'      => $row->id_User,
            'isAdmin'      => $row->is_Admin
             );
            $data[$i] = $user_data;
            $i++;
        }
        
        return $data;
        
    }
    
    public  function nameMembers($allMembers){
        
         $data = array();
         $j = 0;
         
        $n=count($allMembers);
  
        for($i=0;$i<$n;$i++) {
            
             $IdUser=$allMembers[$i]['id_User'];
             $this->db->from('user');
             $this->db->where('idUser', $IdUser);
            
              $query = $this->db->get();
              
              foreach ($query->result() as $row) {

                 $user_data = $row->nickname;
 
                 $data[$j] = $user_data;
                 $j++;
               }
        
             
        }
        
        return $data;
        
    }
}
