<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bj extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('bj_model');
	}
	
	public function index(){
		$data['bjs']$this->bj_model->rxpc_bj_list;
		$this->load->view("bj.html",$data);
	}

	public function get_bj_by_rxpcID(){
		$id = $this->input->get('rxpcID');
		$arrs = $this->bj_model->search_bj_by_rxpcID($id);
		$html = "<option value=\"\">选择班级</option>";
		foreach ($arrs as $a) {
			$html .= "<option value=\"".$a['Id']."\">".$a['Name']."</option>";			
		};
		file_put_contents("./Result1.txt",$html);

		echo $html;
	}


}