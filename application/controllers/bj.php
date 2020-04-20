<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bj extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('bj_model');
	}
	
	public function index(){
		$data['bjs'] = $this->bj_model->rxpc_bj_list();
		// file_put_contents("./Result1.txt",var_export($data,true));
		$this->load->view("bj.html",$data);
	}

	public function get_bj_by_rxpcID(){
		$id = $this->input->get('rxpcID');
		$arrs = $this->bj_model->search_bj_by_rxpcID($id);
		$html = "<option value=\"\">选择班级</option>";
		foreach ($arrs as $a) {
			$html .= "<option value=\"".$a['Id']."\">".$a['Name']."</option>";			
		};
		//file_put_contents("./Result1.txt",$html,FILE_APPEND);

		echo $html;
	}

	public function search(){
		// $data['name'] = $this->input->get('name');
		// $data['gzdw'] = $this->input->get('gzdw');
		// $data['rxpc'] = $this->input->get('rxpc');
		// $data['bj'] = $this->input->get('bj');
		// file_put_contents("./Result1.txt",var_export($data,true));
		// $arrs = $this->students_model->search_students($data);
		// foreach ($arrs as &$a) {
		// 	if(''!=$a['Birthday']){
		// 		$a['Birthday'] = strstr($a['Birthday'], ' ', true);	
		// 	}	
		// };
		// echo json_encode($arrs);

		$arr['rxpcName'] = $this->input->get('rxpcName');
		$arr['bjName'] = $this->input->get('bjName');
		$data = $this->bj_model->search_bj($arr);
		//file_put_contents("./Result1.txt",var_export($data,true));
		echo json_encode($data);
	}


}