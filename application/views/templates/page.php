<?php
$this->load->view('templates/header', array('username'=>'vbogdana'));
$this->load->view($menu);
$this->load->view($container);
$this->load->view('templates/footer');
