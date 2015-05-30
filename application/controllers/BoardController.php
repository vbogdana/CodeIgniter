 <?php
 
 /*
    autor Bogdana Veselinovic
        */

class BoardController extends CI_Controller {
    
    function __construct()
	{
        parent::__construct();
        $this->load->model('Note_Model', 'note');
        $this->load->model('Group_Model', 'group');
        $this->load->model('IsMember_Model', 'ismember');
        $this->load->model('User_Model', 'user');
    }
    
    public function loadMore() {
        $iteration = $_POST['iteration'];
        $last = $_POST['last'];
        $last_id = $_POST['last_id'];
        $group = $_POST['group'];
        
        $result = $this->note->loadMore($group, $last, $last_id);
        
        if (mysqli_num_rows($result) == 0) {
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
    
   
    
 }        
