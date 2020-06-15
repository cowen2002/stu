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
		$data['s'] = $this->students_model->get_student_by_id($id);
		//$data['rxpc'] = $this->rxpc_model->rxpc_list();
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
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		$this->load->view("student_delete.html", $data);
	}

	public function do_delete(){
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		$id = (int)($this->input->get('id'));

		$this->students_model->delete_student_by_id($id);
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
	}

	
	public function batInput(){
		$result = ['error_code'=> 0, 'error_msg'=>'success', 'data'=> []];
		if (!file_exists('upload/test.xlsx')){
			$result['error_code'] = 1;
			$result['error_msg'] = '文件不存在';
			return;
		}
		klog("my log test.", __FILE__, __LINE__);
		$this->load->library("PHPExcel"); //加载类
		$objPHPExcel = PHPExcel_IOFactory::load('upload/test.xlsx');
		$s = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 1)->getValue();
		klog($s,__FILE__, __LINE__);


		// $objReader = IOFactory::createReader('Excel2007');
		// $objPHPExcel = $objReader->load('upload/test.xlsx');
		// $sheet = $objPHPExcel->getSheet(0); // 读取第一个工作表
		// $highestRow = $sheet->getHighestRow(); //获取行数
		// $highestColumn = $sheet->getHighestColumn(); //获取列数 
		// $tmp = "highestRow:".$highestRow.";highestColumn:".$highestColumn;
	}

}