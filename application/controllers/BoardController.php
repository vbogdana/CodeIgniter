<?php

/*
  autor Bogdana Veselinovic
 */

class BoardController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Note_Model', 'note');
        $this->load->model('HiddenNote_Model', 'hidden_note');
        $this->load->model('Important_Model', 'important');
        $this->load->model('Group_Model', 'group');
        $this->load->model('GroupNote_Model', 'group_note');
        $this->load->model('IsMember_Model', 'ismember');
        $this->load->model('User_Model', 'user');
        $this->load->model('Reminder_Model', 'reminder');
        $this->load->model('Notification_Model', 'notification');
    }
    
    public function getNotifications($mode) {
        $idUser = $this->session->userdata('idUser');
        
        // sortiraj ih pomocu orderby
        $notifications = $this->notification->getNotifications($idUser);
        $alarms = $this->reminder->getAlarms($idUser);
        
        if ($mode == 'count') {
            $num = count($notifications) + count($alarms);
            echo $num;
        } else {
            foreach ($alarms as $a) {
                echo '<div class="NotifWrapper id="alarm'.$a['idNote'].'" onclick="seeAlarm(\''.$a['idNote'].'\',\''.$a['personal'].'\')">You have a reminder on '.$a['datetime'].'</div>';
            }
            foreach ($notifications as $n) {
                echo '<div class="NotifWrapper id="notification'.$n['idGroup'].'" onclick="seeNotification(\''.$n['idNotification'].'\',\''.$n['idGroup'].'\')">'.$n['content'].'</div>';
            }
            echo '<div class="NotifWrapper">No more notifications</div>';
        }

    }
    
    public function readNotification() {
        $idNotification = $_POST['idNotification'];
        
        $this->notification->deleteNotification($idNotification);
        echo 'success';
    }
    
    public function readAlarm($idNote, $personal) {
        $this->reminder->see($idNote, $personal);

        $result = $this->note->readNote($idNote);
        $reminders = $this->reminder->getReminders($result);
        $colors = $this->note->getColors($result);
        
        $this->load->view('templates/page', array('menu' => 'board/toolbar',
                'container' => 'board/boardContainer',
                'rezultat' => $result,
                'grupa' => 'global',
                'podsetnici' => $reminders,
                'boje' => $colors));

    }

    public function loadMore() {
        $iteration = $_POST['iteration'];
        $group = $_POST['group'];

        $result = $this->note->loadMore($group);

        if (count($result) == 0) {
            echo '<div class="load-more">
                    <div class=""> No more notes </div>
                  </div>';
            return;
        }
 
        $reminders = $this->reminder->getReminders($result);
        $colors = $this->note->getColors($result);
        
        $this->load->view('board/container', array('iteracija' => $iteration,
            'rezultat' => $result,
            'grupa' => $group,
            'podsetnici' => $reminders,
            'boje' => $colors));
        
    }

    public function board($group) {
        $logged_in = $this->session->userdata('logged_in');

        if ($logged_in <> 1) {
            redirect('loginController/firstlogin');
        } else {

            $result = $this->note->getNotes($group);          
            $reminders = $this->reminder->getReminders($result);
            $colors = $this->note->getColors($result);
            
            
            $this->load->view('templates/page', array('menu' => 'board/toolbar',
                'container' => 'board/boardContainer',
                'rezultat' => $result,
                'grupa' => $group,
                'podsetnici' => $reminders,
                'boje' => $colors));
   
        }
    }

    public function autocomplete() {
        $search = $this->input->post('group');
        $echoed = false;

        $this->load->model('Group_Model', 'group');
        $query = $this->group->get_autocomplete($search);

        foreach ($query->result() as $row):
            //if ($row->name != $this->session->userdata('currentGroup')) {
            echo '<li onclick="chooseGroup(\'' . $row->name . '\',' . $row->idGroup . ')" >' . $row->name . '</li>';
            $echoed = true;
            //   }     
        endforeach;

        if (!$echoed) {
            echo '';
        }
    }

    public function hide() {
        $idNote = $_POST['idNote'];
        $operation = $_POST['operation'];

        $hidden = $this->hidden_note->checkHidden($idNote);

        if ($operation == "hide" && !($hidden)) {
            $this->hidden_note->hide($idNote);
            echo "hide";
        } else if ($operation == "unhide" && $hidden) {
            $this->hidden_note->unhide($idNote);
            echo "unhide";
        }
    }

    public function important() {
        $idNote = $_POST['idNote'];
        //$operation = $_POST['operation'];

        $important = $this->important->checkImportant($idNote);

        if (!($important)) {
            $this->important->setImportant($idNote);
            echo "set";
        } else if ($important) {
            $this->important->unsetImportant($idNote);
            echo "unset";
        }
    }

    public function lock() {
        // treba group note i note
        $idNote = $_POST['idNote'];

        $locked = $this->group_note->checkLocked($idNote);

        if (!($locked)) {
            $this->group_note->lock($idNote);
            echo "lock";
        } else if ($locked) {
            $this->group_note->unlock($idNote);
            echo "unlock";
        }
    }
    
    public function mute() {
        $idNote = $_POST['idNote'];
        // da li moze kreator da ga muteuju ili samo izbrise?
        
        $result = $this->reminder->mute($idNote);
        
        echo $result;
    }

    public function delete() {
        $idNote = $_POST['idNote'];

        if ($this->note->canDelete($idNote)) {
            $this->note->delete($idNote);
            echo "delete";
        } else {
            echo "nodelete";
        }
    }
    
    public function addPersonal() {
        $idNote = $_POST['idNote'];
        $datetime = $_POST['pR'];
        
        $idUser = $this->session->userdata('idUser');
        
        $this->reminder->updatePersonal($idUser, $idNote, 'true', $datetime);
        
        echo $datetime;
    }

    public function importantImg() {
        $idNote = $_POST['idNote'];
        
        $important = $this->important->checkImportant($idNote);
        
        if (!$important) {
            echo '<img src="'. base_url()."assets/images/png/star.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$idNote.'\', \'set\',\'important\')" />';
        } else {
            echo '<img src="'. base_url()."assets/images/png/star_black.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$idNote.'\', \'set\',\'important\')" />';;
        }
    }
    
    public function lockImg() {
        $idNote = $_POST['idNote'];
        $idUser = $this->session->userdata('idUser');
        
        $locked = $this->group_note->checkLocked($idNote);
        if ($this->group_note->canLock($idNote)) {
            // ako uopste moze da zakljuca
            if (!($locked)) {
                echo '<img src="'. base_url()."assets/images/png/lock.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$idNote.'\', \'lock\',\'lock\')" />'; 
            } else if ($locked) {
                echo '<img src="'. base_url()."assets/images/png/lock_black.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$idNote.'\', \'lock\',\'lock\')" />';                 
            }
        } else {
            if (!$locked) {
                echo '<img src="'. base_url()."assets/images/png/lock_black.png".'" style="opacity: 0.3" />';            
            } else {
                echo '<img src="'. base_url()."assets/images/png/lock_black.png".'" />'; 
            }
        }
    }
    
    public function hideImg() {
        $idNote = $_POST['idNote'];
        
        if ($this->hidden_note->canHide($idNote)) {
            $hidden = $this->hidden_note->checkHidden($idNote);
        
            if (!$hidden) {
                echo '<img src="'. base_url()."assets/images/png/hide.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$idNote.'\', \'hide\',\'hide\')" />';
            } else {
                echo '<img src="'. base_url()."assets/images/png/hide_black.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$idNote.'\', \'unhide\',\'hide\')" />';
            }
        } else {
            echo '<img src="'. base_url()."assets/images/png/hide_black.png".'" style="opacity: 0.3" />';   
        }
    }
    
    public function deleteImg() {
        $idNote = $_POST['idNote'];

        if ($this->note->canDelete($idNote)) {
            echo '<img src="'. base_url()."assets/images/png/delete.png".'" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="change(\''.$idNote.'\', \'delete\',\'delete\')" />';
        } else {
            echo '<img src="' . base_url() . "assets/images/png/delete_black.png" . '" style="opacity: 0.3" />';
        }
    }

    public function editImg() {
        $idNote = $_POST['idNote'];
        $group = $_POST['group'];

        $locked = $this->group_note->checkLocked($idNote);

        if (!($locked)) {
            //echo '<img src="' . base_url() . "assets/images/png/edit_black.png" . '" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" />';
            echo '<img src="' . base_url() . "assets/images/png/edit_black.png" . '" onmouseover="changeIcon(this)" onmouseout="changeIcon(this)" onclick="editOnClick(\''.$idNote.'\',\''.$group.'\')" />';
        } else if ($locked) {
            echo '<img src="' . base_url() . "assets/images/png/edit_black.png" . '" style="opacity: 0.3" />';
        }   
        
    }

    public function creatorInfo() {
        $idNote = $_POST['idNote'];

        $creator = $this->note->getCreatorInfo($idNote);

        echo '<div class="creator_nickname">' . $creator['nickname'] . '</div>
              <div class="creator_img">
                <img src="'.$creator['picture'].'" />
              </div>';
        //echo '<div class="creator_nickname">'.$creator.'</div>';
    }

    public function createNote() {
        $group = $_POST['g'];
        $gC = $_POST['gC'];
        $pC = $_POST['pC'];
        $gR = $_POST['gR'];
        $pR = $_POST['pR'];
        $title = $_POST['t'];
        $content = $_POST['c'];
        
        $idUser = $this->session->userdata('idUser');
        
        $idNote = $this->note->createEntry($idUser, $group, $title, $content);
        if ($pC == 'true') {
            $this->reminder->createPersonal($idUser, $idNote, $pR);
        }

        if (($group != 'global') && ($group != 'important') && ($group != 'hidden')) {
            if ($gC == 'true') {
                $members = $this->reminder->createGroup($group, $idNote, $gR);
            }
        }     
        echo $idNote;
        
    }
    
    public function editNote() {
        $isGroup = $_POST['isGroup'];
        $idNote = $_POST['idNote'];
        $gC = $_POST['gC'];
        $pC = $_POST['pC'];
        $gR = $_POST['gR'];
        $pR = $_POST['pR'];
        $title = $_POST['t'];
        $content = $_POST['c'];
        
        $idUser = $this->session->userdata('idUser');
        
        // ovo bi mozda trebalo posle svega zbog vremena menjanja
        $this->note->updateNote($idUser, $idNote, $isGroup, $title, $content);
  
        $this->reminder->updatePersonal($idUser, $idNote, $pC, $pR);
        
        if ($isGroup == 'true') {
            $this->reminder->updateGroup($idNote, $gC, $gR);
        }
        
        echo $idNote;
    }
    
    public function checkGroupNote() {
        $idNote = $_POST['idNote'];
        
        $result = $this->group_note->isGroupNote($idNote);     
        echo $result;
    }

}
