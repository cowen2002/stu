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
		$re = $this->rxpc_model->insert($rxpcName);
		// file_put_contents("./Result1.txt",$re);
		switch($re){
			case 1:
				echo "新建学期".$rxpcName."成功!";
				break;
			case 2:
				echo "亲！换个名字，重名了。";
				break;
			default:
			    echo "不知道啥原因，就是没成功，再试试。";
			    break;
		}
	}


}