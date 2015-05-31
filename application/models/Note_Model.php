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
        $data = array();
        
        $idUser = $this->session->userdata('idUser');
        
        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
        mysqli_select_db($link, "mydb") or die(mysql_error());
  
        if ($group == "global") {
            // ok
            $data = $this->getGlobal($idUser, $group, $link); 
        } else if ($group == "hidden") {
            // ok
            $data = $this->getHidden($idUser, $link);
        } else if ($group == "important") {
            // ok
            $data = $this->getAllImportant($idUser, $link); 
        } else {
            // ne prikazuje prvo important
            /*
            $result = mysqli_query($link, "SELECT * "
                . "FROM note n WHERE exists (SELECT * FROM group_note gn WHERE gn.idNote = n.idNote and gn.id_Group='$group' "
                . "AND not exists (SELECT * FROM hidden_note hn WHERE hn.idNote=n.idNote AND hn.idUser='$idUser'))"
                . "ORDER BY last_Edited_On desc, idNote desc limit 11")
                or die(mysql_error());
             * 
             */
            // ok
            $data = $this->getFromGroup($idUser, $group, $link);
        }
        
        return $data;   
    }
    
    //public function loadMore($group, $last, $lastI, $last_id, $lastI_id) {
    public function loadMore($group) {
        $data = array();

        $last = $this->session->userdata('last_Edited_On');
        $lastI = $this->session->userdata('lastI_Edited_On');
        $last_id = $this->session->userdata('last');
        $lastI_id = $this->session->userdata('lastI');
        
        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
        mysqli_select_db($link, "mydb") or die(mysql_error());
        $idUser = $this->session->userdata('idUser');
        
        if ($group == "global") {
            // ok
            $data = $this->loadGlobal($idUser, $group, $last, $lastI, $last_id, $lastI_id, $link);
        } else if ($group == "hidden") {
            // ok
            $data = $this->loadHidden($idUser, $last, $last_id, $link);
        } else if ($group == "important") {
            // ok
            $data = $this->loadAllImportant($idUser, $lastI, $lastI_id, $link);
        } else {
             // ne prikazuje prvo important
            /*
            $result = mysqli_query($link, "SELECT * "
                . "FROM note n WHERE exists (SELECT * FROM group_note gn WHERE gn.idNote = n.idNote and gn.id_Group='$group'"
                . "AND not exists (SELECT * FROM hidden_note hn WHERE hn.idNote=n.idNote AND hn.idUser='$idUser')) "     // end
                . "AND not exists (SELECT * "                                     // kontrolise datum kreiranja
                . "FROM note e "
                . "WHERE e.idNote = n.idNote AND (e.last_Edited_On > '$last' OR (e.last_Edited_On = '$last' AND e.idNote >= '$last_id')))"
                . "ORDER BY last_Edited_On desc, idNote desc LIMIT 12")
                or die(mysql_error());
             * 
             */
            // ok
            $data = $this->loadFromGroup($idUser, $group, $last, $lastI, $last_id, $lastI_id, $link);
        }
        
        return $data;
    }
    
    public function getImportant($idUser, $group, $link) {
        if ($group == "global") {
            $result = mysqli_query($link, "SELECT * "
                . "FROM note n "
                . "WHERE exists(SELECT * FROM important iin WHERE n.idNote=iin.idNote AND iin.idUser='$idUser')"
                . "ORDER BY last_Edited_On desc, idNote desc limit 11")
                or die(mysql_error()); 
            
        } else {
           $result = mysqli_query($link, "SELECT * "
                . "FROM note n "
                . "WHERE exists (SELECT * FROM group_note gn WHERE gn.idNote=n.idNote AND gn.id_Group='$group' AND exists("
                . "SELECT * FROM important iin WHERE gn.idNote=iin.idNote AND iin.idUser='$idUser'))"
                . "ORDER BY last_Edited_On desc, idNote desc limit 11")
                or die(mysql_error()); 
        }
        
        return $result;
    }
    
    public function loadImportant($idUser, $group, $lastI, $lastI_id, $link) {
        if ($group == "global") {
            $result = mysqli_query($link, "SELECT * "
                . "FROM note n "
                . "WHERE exists(SELECT * FROM important iin WHERE n.idNote=iin.idNote AND iin.idUser='$idUser') "
                . "AND not exists (SELECT * "                                     // kontrolise datum kreiranja
                . "FROM note e "
                . "WHERE e.idNote = n.idNote AND (e.last_Edited_On > '$lastI' OR (e.last_Edited_On = '$lastI' AND e.idNote >= '$lastI_id'))) "
                . "ORDER BY last_Edited_On desc, idNote desc limit 12")
                or die(mysql_error()); 
        } else {
           $result = mysqli_query($link, "SELECT * "
                . "FROM note n "
                . "WHERE exists (SELECT * FROM group_note gn WHERE gn.idNote=n.idNote AND gn.id_Group='$group' AND exists("
                . "SELECT * FROM important iin WHERE gn.idNote=iin.idNote AND iin.idUser='$idUser')) "
                . "AND not exists (SELECT * "                                     // kontrolise datum kreiranja
                . "FROM note e "
                . "WHERE e.idNote = n.idNote AND (e.last_Edited_On > '$lastI' OR (e.last_Edited_On = '$lastI' AND e.idNote >= '$lastI_id')))"
                . "ORDER BY last_Edited_On desc, idNote desc limit 12")
                or die(mysql_error()); 
        }
        
        return $result;
    }
    
    public function getHidden($idUser, $link) {
        $data = array();
        $i = 0;
        
        $result = mysqli_query($link, "SELECT * "
                . "FROM note n "
                . "WHERE exists (SELECT * FROM hidden_note hn WHERE n.idNote=hn.idNote AND hn.idUser='$idUser')"
                . "ORDER BY last_Edited_On desc, idNote desc limit 11")
                or die(mysql_error());
        
        while ( $row = $result->fetch_assoc() ) {
                    $data[$i] = $row;
                    $i++;
                }
                
                if ($i > 0) {
                    $this->session->set_userdata('last', $data[$i-1]['idNote']);
                    $this->session->set_userdata('last_Edited_On', $data[$i-1]['last_Edited_On'] );
                } else {
                    $this->session->set_userdata('last', '-1');
                    $this->session->set_userdata('last_Edited_On', '-1' );
                }
        
        return $data;
    }
    
    public function loadHidden($idUser, $last, $last_id, $link) {
        $data = array();
        $i = 0;

        $result = mysqli_query($link, "SELECT * "
                . "FROM note n "
                . "WHERE exists (SELECT * FROM hidden_note hn WHERE n.idNote=hn.idNote AND hn.idUser='$idUser')"
                . "AND not exists (SELECT * "                                     // kontrolise datum kreiranja
                . "FROM note e "
                . "WHERE e.idNote = n.idNote AND (e.last_Edited_On > '$last' OR (e.last_Edited_On = '$last' AND e.idNote >= '$last_id')))"
                . "ORDER BY last_Edited_On desc, idNote desc limit 12")
                or die(mysql_error());

        while ($row = $result->fetch_assoc()) {
            $data[$i] = $row;
            $i++;
        }

        if ($i > 0) {
            $this->session->set_userdata('last', $data[$i - 1]['idNote']);
            $this->session->set_userdata('last_Edited_On', $data[$i - 1]['last_Edited_On']);
        } else {
            $this->session->set_userdata('last', '-1');
            $this->session->set_userdata('last_Edited_On', '-1');
        }

        return $data;
    }

    public function getAllImportant($idUser, $link) {
        $data = array();
        $i = 0;

        $result = mysqli_query($link, "SELECT * "
                . "FROM note n "
                . "WHERE exists (SELECT * FROM important iin WHERE n.idNote=iin.idNote AND iin.idUser='$idUser')"
                . "ORDER BY last_Edited_On desc, idNote desc limit 11")
                or die(mysql_error());

        while ($row = $result->fetch_assoc()) {
            $data[$i] = $row;
            $i++;
        }

        if ($i > 0) {
            $this->session->set_userdata('lastI', $data[$i - 1]['idNote']);
            $this->session->set_userdata('lastI_Edited_On', $data[$i - 1]['last_Edited_On']);
        } else {
            $this->session->set_userdata('lastI', '-1');
            $this->session->set_userdata('lastI_Edited_On', '-1');
        }

        return $data;
    }
    
    public function loadAllImportant($idUser, $lastI, $lastI_id, $link) {
        $data = array();
        $i = 0;

        $result = mysqli_query($link, "SELECT * "
                . "FROM note n "
                . "WHERE exists (SELECT * FROM important iin WHERE n.idNote=iin.idNote AND iin.idUser='$idUser') "
                . "AND not exists (SELECT * "                                     // kontrolise datum kreiranja
                . "FROM note e "
                . "WHERE e.idNote = n.idNote AND (e.last_Edited_On > '$lastI' OR (e.last_Edited_On = '$lastI' AND e.idNote >= '$lastI_id')))"
                . "ORDER BY last_Edited_On desc, idNote desc limit 12")
                or die(mysql_error());

        while ($row = $result->fetch_assoc()) {
            $data[$i] = $row;
            $i++;
        }

        if ($i > 0) {
            $this->session->set_userdata('lastI', $data[$i - 1]['idNote']);
            $this->session->set_userdata('lastI_Edited_On', $data[$i - 1]['last_Edited_On']);
        } else {
            $this->session->set_userdata('lastI', '-1');
            $this->session->set_userdata('lastI_Edited_On', '-1');
        }

        return $data;
    }
    
    public function getFromGroup($idUser, $group, $link) {
        $data = array();
        $i = 0;
        
        $result = $this->getImportant($idUser, $group, $link);
            $important = mysqli_num_rows($result);
            while ( $row = $result->fetch_assoc() ) {
                $data[$i] = $row;
                $i++;
            }
            
            if ($i > 0) {
                    $this->session->set_userdata('lastI', $data[$i-1]['idNote']);
                    $this->session->set_userdata('lastI_Edited_On', $data[$i-1]['last_Edited_On'] );
                } else {
                    $this->session->set_userdata('lastI', '-1');
                    $this->session->set_userdata('lastI_Edited_On', '-1' );
                }
            
            if ( $important < 11) {
                $left = 11 - $important;
                
                $result1 = mysqli_query($link, "SELECT * "
                    . "FROM note n "
                    . "WHERE exists (SELECT * FROM group_note gn WHERE gn.idNote=n.idNote and gn.id_Group='$group' "
                    . "AND not exists (SELECT * FROM hidden_note hn WHERE hn.idNote=gn.idNote AND hn.idUser='$idUser') "
                    . "AND not exists (SELECT * FROM important im WHERE im.idNote=gn.idNote AND im.idUser='$idUser')) "
                    . " ORDER BY last_Edited_On desc, idNote desc limit $left")
                or die(mysql_error());
                
                while ( $row = $result1->fetch_assoc() ) {
                    $data[$i] = $row;
                    $i++;
                }
                
                if ($i > 0) {
                    $this->session->set_userdata('last', $data[$i-1]['idNote']);
                    $this->session->set_userdata('last_Edited_On', $data[$i-1]['last_Edited_On'] );
                } else {
                    $this->session->set_userdata('last', '-1');
                    $this->session->set_userdata('last_Edited_On', '-1' );
                }
            }
        
        return $data;
    }
    
    public function loadFromGroup($idUser, $group, $last, $lastI, $last_id, $lastI_id, $link) {
        $data = array();
        $i = 0;
        
        $result = $this->loadImportant($idUser, $group, $lastI, $lastI_id, $link);
            $important = mysqli_num_rows($result);
            while ( $row = $result->fetch_assoc() ) {
                $data[$i] = $row;
                $i++;
            }
            
            if ($i > 0) {
                    $this->session->set_userdata('lastI', $data[$i-1]['idNote']);
                    $this->session->set_userdata('lastI_Edited_On', $data[$i-1]['last_Edited_On'] );
                } else {
                    $this->session->set_userdata('lastI', '-1');
                    $this->session->set_userdata('lastI_Edited_On', '-1' );
                }
            
            if ( $important < 12) {
                $left = 12 - $important;
                
                $result1 = mysqli_query($link, "SELECT * "
                    . "FROM note n "
                    . "WHERE exists (SELECT * FROM group_note gn WHERE gn.idNote=n.idNote and gn.id_Group='$group' "
                    . "AND not exists (SELECT * FROM hidden_note hn WHERE hn.idNote=gn.idNote AND hn.idUser='$idUser') "
                    . "AND not exists (SELECT * FROM important im WHERE im.idNote=gn.idNote AND im.idUser='$idUser')) "
                    . "AND not exists (SELECT * FROM note e "           // kontrolise datum kreiranja
                    . "WHERE e.idNote = n.idNote AND "
                    . "(e.last_Edited_On > '$last' OR (e.last_Edited_On = '$last' AND e.idNote >= '$last_id')))"
                    . " ORDER BY last_Edited_On desc, idNote desc limit $left")
                or die(mysql_error());
                
                while ( $row = $result1->fetch_assoc() ) {
                    $data[$i] = $row;
                    $i++;
                }
                
                if ($i > 0) {
                    $this->session->set_userdata('last', $data[$i-1]['idNote']);
                    $this->session->set_userdata('last_Edited_On', $data[$i-1]['last_Edited_On'] );
                } else {
                    $this->session->set_userdata('last', '-1');
                    $this->session->set_userdata('last_Edited_On', '-1' );
                }
            }
        
        return $data;
        
    }
    
    public function getGlobal($idUser, $group, $link) {
        $data = array();
        $i = 0;
        
        $result = $this->getImportant($idUser, $group, $link);
        $important = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc()) {
            $data[$i] = $row;
            $i++;
        }

        if ($i > 0) {
            $this->session->set_userdata('lastI', $data[$i - 1]['idNote']);
            $this->session->set_userdata('lastI_Edited_On', $data[$i - 1]['last_Edited_On']);
        } else {
            $this->session->set_userdata('lastI', '-1');
            $this->session->set_userdata('lastI_Edited_On', '-1');
        }

        if ($important < 11) {
            $left = 11 - $important;
            $result1 = mysqli_query($link, "SELECT * "
                    . "FROM note n "
                    . "WHERE (n.idUser='$idUser' or exists (select * "
                    . "from group_note gn "
                    . "where gn.idNote = n.idNote and exists (select * "
                    . "from ismember im "
                    . "where im.id_Group = gn.id_Group AND im.id_User = '$idUser' and not exists (select * "
                    . "from hidden_note hn "
                    . "where hn.idNote = gn.idNote AND hn.idUser='$idUser')))) "
                    . "AND not exists (SELECT * FROM important im WHERE im.idNote=n.idNote AND im.idUser='$idUser') "
                    . "ORDER BY last_Edited_On desc, idNote desc limit $left")
                    or die(mysql_error());

            while ($row = $result1->fetch_assoc()) {
                $data[$i] = $row;
                $i++;
            }
            if ($i > 0) {
                $this->session->set_userdata('last', $data[$i - 1]['idNote']);
                $this->session->set_userdata('last_Edited_On', $data[$i - 1]['last_Edited_On']);
            } else {
                $this->session->set_userdata('last', '-1');
                $this->session->set_userdata('last_Edited_On', '-1');
            }
        }

        return $data;
    }
    
    public function loadGlobal($idUser, $group, $last, $lastI, $last_id, $lastI_id, $link) {
        $data = array();
        $i = 0;
        
        $result = $this->loadImportant($idUser, $group, $lastI, $lastI_id, $link);
        $important = mysqli_num_rows($result);
        while ($row = $result->fetch_assoc()) {
            $data[$i] = $row;
            $i++;
        }

        if ($i > 0) {
            $this->session->set_userdata('lastI', $data[$i - 1]['idNote']);
            $this->session->set_userdata('lastI_Edited_On', $data[$i - 1]['last_Edited_On']);
        } else {
            $this->session->set_userdata('lastI', '-1');
            $this->session->set_userdata('lastI_Edited_On', '-1');
        }

        if ($important < 12) {
            $left = 12 - $important;
            $result1 = mysqli_query($link, "SELECT * "
                    . "FROM note n "
                    . "WHERE (n.idUser='$idUser' or exists (select * "
                    . "from group_note gn "
                    . "where gn.idNote = n.idNote and exists (select * "
                    . "from ismember im "
                    . "where im.id_Group = gn.id_Group AND im.id_User = '$idUser' and not exists (select * "
                    . "from hidden_note hn "
                    . "where hn.idNote = gn.idNote AND hn.idUser='$idUser')))) "
                    . "AND not exists (SELECT * FROM important im WHERE im.idNote=n.idNote AND im.idUser='$idUser') "
                    . "AND not exists (SELECT * "                                     // kontrolise datum kreiranja
                    . "FROM note e "
                    . "WHERE e.idNote = n.idNote AND (e.last_Edited_On > '$last' OR (e.last_Edited_On = '$last' AND e.idNote >= '$last_id')))"
                    . "ORDER BY last_Edited_On desc, idNote desc LIMIT $left")
                    or die(mysql_error());

            while ($row = $result1->fetch_assoc()) {
                $data[$i] = $row;
                $i++;
            }
            if ($i > 0) {
                $this->session->set_userdata('last', $data[$i - 1]['idNote']);
                $this->session->set_userdata('last_Edited_On', $data[$i - 1]['last_Edited_On']);
            } else {
                $this->session->set_userdata('last', '-1');
                $this->session->set_userdata('last_Edited_On', '-1');
            }
        }
        
        return $data;
    }
    

}