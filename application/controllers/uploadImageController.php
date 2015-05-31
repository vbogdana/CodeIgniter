
<?php

class uploadImageController extends CI_Controller {
    public function index(){       
         $this->load->view('editProfile.php');
    }
    
        
    public function upload_file(){
        
       $filename='product_pic';
       
                $config['upload_path']='assets\images\profilepictures';
                $config['allowed_types']='gif|png|jpg';
                $config['max_size']=1024*8;
                $config['encrypt_name']=true;
                
                $this->load->library('upload',$config);
                
                $this->upload->do_upload($filename);
                
                $this->load->model('image_model');
                
                $title= $this->session->userdata('nickname');
                
                $data=  $this->upload->data();
                
                $aaa=$data['file_name'];
                
                If($aaa!=0){
                
                $file_id= $this->image_model->insert_file($data['file_name'],$title);
                if($file_id){
                    //$aaa=$this->session->userdata('image');
                   // echo "$aaa";
                   redirect('editProfileController/editProfile');   
                }
                }else  redirect('editProfileController/editProfile');   
    }
 
    
}