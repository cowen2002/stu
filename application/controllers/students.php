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

}