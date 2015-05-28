<?php

class BoardController extends CI_Controller {

    public function index() {

        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
        mysqli_select_db($link, "mydb") or die(mysql_error());

        $result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = 1) or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = 1 and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=1))) UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = 1 ORDER BY created_On desc")
                or die(mysql_error());
        
               
         //  UKOLIKO KORISNIK NIJE LOGOVAN NE MOZE PRISTUPITI BORDU
         $logged_in = $this->session->userdata('logged_in');

        if($logged_in<>1){
              redirect('logoutController/firstlogin');
        }else{
              $this->load->view('templates/page', array('menu' => 'board/toolbar', 'container' => 'board/container', 'rezultat' => $result));
        }


        /* $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
          mysqli_select_db($link, "mydb") or die(mysql_error());

          $result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = 1) or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = 1))")
          or die(mysql_error());

          echo '<div class="BoardContainer">
          <div class="one-row">';
          while ($row = mysql_fetch_assoc($result))
          {


          $text=$row['text'];

          echo '<div class="one-note">
          <h1>'; echo $text; echo '</h1>
          </div>';

          }
          echo '</div>
          </div>'; */
    }

    //SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = 1
    //$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = 1) or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = 1 and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=1)))")
}

?>