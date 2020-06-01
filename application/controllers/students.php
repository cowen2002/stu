<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Students extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('students_model');
		$this->load->model('rxpc_model');
		date_default_timezone_set("PRC");//设置时区
	}

	public function index(){
		$stu = $this->students_model->students_list();
		$rxpc = $this->rxpc_model->rxpc_list();
		foreach ($stu as &$a) {
			if(''!=$a['Birthday']){
				$a['Birthday'] = strstr($a['Birthday'], ' ', true);	
			}			
		};
		$data['students'] = $stu;
		$data['rxpc'] = $rxpc;
		$this->load->view('students_list.html', $data);

	}

	public function search(){
		$data['name'] = $this->input->get('name');
		$data['gzdw'] = $this->input->get('gzdw');
		$data['rxpc'] = $this->input->get('rxpc');
		$data['bj'] = $this->input->get('bj');
		file_put_contents("./Result1.txt",var_export($data,true));
		$arrs = $this->students_model->search_students($data);
		foreach ($arrs as &$a) {
			if(''!=$a['Birthday']){
				$a['Birthday'] = strstr($a['Birthday'], ' ', true);	
			}	
		};
		echo json_encode($arrs);
	}



	public function update(){
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		$StudentNo = $this->input->get("StudentNo");
		file_put_contents("./Result1.txt", $StudentNo);
		//$data['bj'] = $this->bj_model->get_bj_by_id($bjId);
		 // file_put_contents("./Result1.txt",var_export($data['bj'],true));
		//$data['rxpc'] = $this->rxpc_model->rxpc_list();
		 // file_put_contents("./Result1.txt",var_export($data['bjId'],true), FILE_APPEND);
		$this->load->view("student_update.html");
	}
}