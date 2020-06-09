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
		$id = $this->input->get("id");
		// file_put_contents("./Result1.txt", $StudentNo);
		$data['s'] = $this->students_model->get_student_by_id($id);
		//file_put_contents("./Result1.txt",var_export($data['s'],true));
		//$data['rxpc'] = $this->rxpc_model->rxpc_list();
		 // file_put_contents("./Result1.txt",var_export($data['bjId'],true), FILE_APPEND);
		$this->load->view("student_update.html", $data);
	}
	
	public function modify(){
		$arr['StudentNo']  = $this->input->get('StudentNo');
		$arr['Name']       = $this->input->get('Name');
		$arr['Birthday']   = $this->input->get('Birthday');
		$arr['Sex']        = $this->input->get('Sex');
		$arr['ZZMM']       = $this->input->get('ZZMM');
		$arr['JG']         = $this->input->get('JG');
		$arr['SZCS']       = $this->input->get('SZCS');
		$arr['IdCard']     = $this->input->get('IdCard');
		$arr['Phone']      = $this->input->get('Phone');
		$arr['Tel']        = $this->input->get('Tel');
		$arr['GZDW']       = $this->input->get('GZDW');
		$arr['ZZY']        = $this->input->get('ZZY');
		$arr['Remark1']    = $this->input->get('Remark1');
		$arr['Remark2']    = $this->input->get('Remark2');
		$id                = $this->input->get('id');
		$this->students_model->update_student_by_id($id, $arr);
	}
	

	public function delete(){
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		$data['id'] = $this->input->get("id");
		// file_put_contents("./Result1.txt", $bjId);
		 // file_put_contents("./Result1.txt",var_export($data['bj'],true));
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		 // file_put_contents("./Result1.txt",var_export($data['bjId'],true), FILE_APPEND);
		$this->load->view("student_delete.html", $data);
	}

	public function do_delete(){
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		$id = (int)($this->input->get('id'));

		$this->students_model->delete_student_by_id($id);
		 // file_put_contents("./Result1.txt",var_export($data['bj'],true));
		// file_put_contents("./Result1.txt",$id);
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		 // file_put_contents("./Result1.txt",var_export($data['bjId'],true), FILE_APPEND);
	}

	
	public function batInput(){
		file_put_contents("./Result1.txt",'hello world');
		
	}
	
}