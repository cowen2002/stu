<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bj extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('bj_model');
		$this->load->model('rxpc_model');
	}
	
	public function index(){
		$data['bjs'] = $this->bj_model->rxpc_bj_list();
		$this->load->view("bj.html",$data);
	}

	public function get_bj_by_rxpcID(){
		$id = $this->input->get('rxpcID');
		$arrs = $this->bj_model->search_bj_by_rxpcID($id);
		$html = "<option value=\"\">选择班级</option>";
		foreach ($arrs as $a) {
			$html .= "<option value=\"".$a['Id']."\">".$a['Name']."</option>";			
		};
		echo $html;
	}

	public function search(){
		$arr['rxpcName'] = $this->input->get('rxpcName');
		$arr['bjName'] = $this->input->get('bjName');
		$data = $this->bj_model->search_bj($arr);
		echo json_encode($data);
	}

	public function add(){
		$data['rxpc'] = $this->rxpc_model->rxpc_list();
		$this->load->view("bj_add.html", $data);
	}

	public function addBj(){
		$arr['RXPC'] = $this->input->get('rxpcId');
		$arr['Name'] = $this->input->get('bjName');
		if($arr['RXPC']==''){
			echo "请选择学期！";
			return;
		}
		if($arr['Name']==''){
			echo "请输入班级名称！";
			return;
		}
		$re = $this->bj_model->insert($arr);
		switch($re){
			case 1:
				echo "新建班级".$arr['Name']."成功！";
				break;
			case 2:
				echo "本学期中，班级已存在，请换个名字。";
				break;
			default:
				echo "新建班级失败，请重试！";
				break;
		}
	}

	public function update(){
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		$bjId = $this->input->get("bjId");
		$data['bj'] = $this->bj_model->get_bj_by_id($bjId);
		$data['rxpc'] = $this->rxpc_model->rxpc_list();
		$this->load->view("bj_update.html", $data);
	}

	public function modify(){
		$arr['rxpcId'] = (int)($this->input->get('rxpcId'));
		$arr['bjNewName'] = $this->input->get('bjNewName');
		$arr['bjId'] = (int)($this->input->get('bjId'));
		$this->bj_model->update_bj_by_id($arr);
		// $this->index();

	}

	public function delete(){
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		$bjId = $this->input->get("bjId");
		$data['bj'] = $this->bj_model->get_bj_by_id($bjId);
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		$this->load->view("bj_delete.html", $data);
	}

	public function do_delete(){
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
		$arr['bjId'] = (int)($this->input->get('bjId'));
		$data['bj'] = $this->bj_model->delete_bj_by_id($arr);
		// $data['rxpc'] = $this->rxpc_model->rxpc_list();
	}



}