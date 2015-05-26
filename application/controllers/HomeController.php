<?php

class HomeController extends CI_Controller {
	
	public function index() {
		$this->load->view('home/index');
	}
	
	public function signIn() {
		$this->load->view('home/signIn');
	}
	
	public function signUp() {
		$this->load->view('home/signUp');
	}
}

?>