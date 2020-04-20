<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rxpc extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('rxpc_model');
	}
	
	public function add(){
		// file_put_contents("./Result1.txt",var_export($data,true));
		$this->load->view("rxpc_add.html");
	}

	public function addRxpc(){
		// file_put_contents("./Result1.txt",var_export($data,true));
		$rxpcName = $this->input->get('rxpcName');
		file_put_contents("./Result1.txt",$rxpcName);
		echo "hello";
		
	}


}