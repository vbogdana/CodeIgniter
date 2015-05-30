 <?php
 
 /*
    autor Bogdana Veselinovic
        */

class BoardController extends CI_Controller {

    public function index() {

         $logged_in = $this->session->userdata('logged_in');

        if ($logged_in<>1) {
              redirect('loginController/firstlogin');
        } else {
            $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
            mysqli_select_db($link, "mydb") or die(mysql_error());
              
            $idUser = $this->session->userdata('idUser');
            
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
                
            $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'board/boardContainer', 'rezultat' => $result));   
        }
    }
    
    public function loadMore() {
        $iteration = $_POST['iteration'];
        $last = $_POST['last'];
        $last_id = $_POST['last_id'];
        
        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
        mysqli_select_db($link, "mydb") or die(mysql_error());
        $idUser = $this->session->userdata('idUser');
        
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
        
        if (mysqli_num_rows($result) == 0) {
            echo '<div class="load-more">
                    <div class=""> No more notes </div>
                  </div>';
            return;
        }
        
        $this->load->view('board/container', array('iteracija' => $iteration, 'rezultat' => $result));
    }
    
    public function autocomplete()
    {
        $search = $this->input->post('group');
        $echoed = false;
        
        $this->load->model('Group_Model', 'group');
        $query = $this->group->get_autocomplete($search);

        foreach ($query->result() as $row):
            //if ($row->name != $this->session->userdata('currentGroup')) {
                    echo '<li onclick="chooseGroup(\''.$row->name.'\')" >'. $row->name . '</li>';
                    $echoed = true;
             //   }     
        endforeach;
        
        if (!$echoed) {
            echo '';
        }
    }
    
   
    
 }        
