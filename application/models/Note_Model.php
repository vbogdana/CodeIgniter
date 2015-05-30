<?php

/**
 * Description of Note_Model
 *
 * @author Bogdana
 */
class Note_Model extends CI_Model {
    //put your code here
    function __construct() {
        $this->load->database();
        parent::__construct();
        //$this->load->model('Group_Model', 'group');
    }
    
    public function getNotes($group) {
        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
        mysqli_select_db($link, "mydb") or die(mysql_error());
              
        $idUser = $this->session->userdata('idUser');
        
        if ($group == "global") {
            $result = mysqli_query($link, "SELECT * "
                . "FROM note n "
                . "WHERE (n.idUser='$idUser' or exists (select * "
                . "from group_note gn "
                . "where gn.idNote = n.idNote and exists (select * "
                . "from ismember im "
                . "where im.id_Group = gn.id_Group AND im.id_User = '$idUser' and not exists (select * "
                . "from hidden_note hn "
                . "where hn.idNote = gn.idNote AND hn.idUser='$idUser')))) "
                . "ORDER BY last_Edited_On desc, idNote desc limit 11")
                or die(mysql_error());
        } else if ($group == "hidden") {
            
        } else if ($group == "important") {
            
        } else {
            $result = mysqli_query($link, "SELECT * "
                . "FROM note n WHERE exists (SELECT * FROM group_note gn WHERE gn.idNote = n.idNote and gn.id_Group='$group'"
                . "AND not exists (SELECT * FROM hidden_note hn WHERE hn.idNote=n.idNote AND hn.idUser='$idUser'))"
                . "ORDER BY last_Edited_On desc, idNote desc limit 1")
                or die(mysql_error());
        }
        
        return $result;   
    }
    
    public function loadMore($group, $last, $last_id) {
        
        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
        mysqli_select_db($link, "mydb") or die(mysql_error());
        $idUser = $this->session->userdata('idUser');
        
        if ($group == "global") {
            $result = mysqli_query($link, "SELECT * "
                . "FROM note n "
                . "WHERE (n.idUser='$idUser' or exists (select * "
                . "from group_note gn "
                . "where gn.idNote = n.idNote and exists (select * "
                . "from ismember im "
                . "where im.id_Group = gn.id_Group AND im.id_User = '$idUser' and not exists (select * "
                . "from hidden_note hn "
                . "where hn.idNote = gn.idNote AND hn.idUser='$idUser')))) "   // end
                . "AND not exists (SELECT * "                                     // kontrolise datum kreiranja
                . "FROM note e "
                . "WHERE e.idNote = n.idNote AND (e.last_Edited_On > '$last' OR (e.last_Edited_On = '$last' AND e.idNote >= '$last_id')))"
                . "ORDER BY last_Edited_On desc, idNote desc LIMIT 12")
                or die(mysql_error());
        } else if ($group == "hidden") {
            
        } else if ($group == "important") {
            
        } else {
            $result = mysqli_query($link, "SELECT * "
                . "FROM note n WHERE exists (SELECT * FROM group_note gn WHERE gn.idNote = n.idNote and gn.id_Group='$group'"
                . "AND not exists (SELECT * FROM hidden_note hn WHERE hn.idNote=n.idNote AND hn.idUser='$idUser'))"     // end
                . "AND not exists (SELECT * "                                     // kontrolise datum kreiranja
                . "FROM note e "
                . "WHERE e.idNote = n.idNote AND (e.last_Edited_On > '$last' OR (e.last_Edited_On = '$last' AND e.idNote >= '$last_id')))"
                . "ORDER BY last_Edited_On desc, idNote desc LIMIT 12")
                or die(mysql_error());
        }
        
        return $result;
    }
        
}
