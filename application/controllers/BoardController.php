 <?php
 
 /*
    autori Dusan Spasojevic, Bogdana Veselinovic
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
                . "WHERE exists (select * "
                . "from personal_note pn "
                . "where pn.idNote = n.idNote AND pn.idUser = '$idUser') or exists (select * "
                . "from group_note gn "
                . "where gn.idNote = n.idNote and exists (select * "
                . "from ismember im "
                . "where im.id_Group = gn.id_Group AND im.id_User = 4 and not exists (select * "
                . "from changed_note cn where cn.idNote = gn.idNote AND cn.idUser='$idUser'))) "
                . "UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title "
                . "from Note n, changed_note cn, group_note gn "
                . "where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = '$idUser' "
                . "ORDER BY created_On desc, idNote desc limit 11")
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
                . "WHERE (exists (SELECT * "                                    // begin izdvajanja svih belezaka korisnika
                . "FROM personal_note pn "                                              // begin personalnih
                . "WHERE pn.idNote = n.idNote AND pn.idUser = '$idUser') OR exists (SELECT * "  // begin grupnih
                . "FROM group_note gn "
                . "WHERE gn.idNote = n.idNote AND exists (SELECT * "
                . "FROM ismember im "   // i dodati uslov da nije hideovana
                . "WHERE im.id_Group = gn.id_Group AND im.id_User = '$idUser' AND not exists (SELECT * "
                . "FROM changed_note cn "
                . "WHERE cn.idNote = gn.idNote AND cn.idUser='$idUser')))) "    // end
                . "AND not exists (SELECT * "                                     // kontrolise datum kreiranja
                . "FROM note e "
                . "WHERE e.idNote = n.idNote AND (e.created_On > '$last' OR (e.created_On = '$last' AND e.idNote >= '$last_id')))"
                //. "UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title "
                //. "from Note n, changed_note cn, group_note gn "
                //. "where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = '$idUser' "
                . "ORDER BY created_On desc, idNote desc LIMIT 12")
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
