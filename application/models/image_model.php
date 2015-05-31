<?php

class image_model extends CI_Model{
    
    function  _construct(){
        parent::__construct();
    }


    
    public function insert_file($filename,$title){
        $data=array(
                 'product_pic' =>$filename,
                 'title'       =>$title
                );
        $aaa=$this->session->userdata('image');
        if($filename!=aaa){ 
        $this->session->set_userdata('image', "$filename");
        $this->db->insert('image',$data);
        return $this->db->insert_id(); 
        }
    }
   
    
                
               

}
    
    