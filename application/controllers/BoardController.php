 <?php
 
 /*
    autor Bogdana Veselinovic
        */

class BoardController extends CI_Controller {
    
    function __construct()
	{
        parent::__construct();
        $this->load->model('Note_Model', 'note');
        $this->load->model('HiddenNote_Model', 'hidden_note');
        $this->load->model('Important_Model', 'important');
        $this->load->model('Group_Model', 'group');
        $this->load->model('GroupNote_Model', 'group_note');
        $this->load->model('IsMember_Model', 'ismember');
        $this->load->model('User_Model', 'user');
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
        
        $this->load->view('board/container', array('iteracija' => $iteration, 
                                                   'rezultat' => $result,
                                                   'grupa' => $group));
    }
    
    public function board($group) {
        $logged_in = $this->session->userdata('logged_in');

        if ($logged_in<>1) {
              redirect('loginController/firstlogin');
        } else {
            
            $result = $this->note->getNotes($group);       
            $this->load->view('templates/page', array('menu' => 'board/toolbar',
                                                      'container' => 'board/boardContainer', 
                                                      'rezultat' => $result, 
                                                      'grupa' => $group));
            
        }
    }
    
    public function autocomplete()
    {
        $search = $this->input->post('group');
        $echoed = false;
        
        $this->load->model('Group_Model', 'group');
        $query = $this->group->get_autocomplete($search);

        foreach ($query->result() as $row):
            //if ($row->name != $this->session->userdata('currentGroup')) {
                    echo '<li onclick="chooseGroup(\''.$row->name.'\','.$row->idGroup.')" >'. $row->name . '</li>';
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

        if ($this->group_note->canLock($idNote)) {
            $locked = $this->group_note->checkLocked($idNote);

            if (!($locked)) {
                $this->group_note->lock($idNote);
                echo "lock";
            } else if ($locked) {
                $this->group_note->unlock($idNote);
                echo "unlock";
            }
        }
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
    
   
    
 }        
