<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rxpc_model extends CI_Model{

	public function rxpc_list(){
		// $sql = 'select StudentNo,Name,Birthday,Phone,GZDW,ZZY,BJ from student where IsDel!=1';
		$sql = 'select rxpc.id,rxpc.Name
			from rxpc 
			where rxpc.IsDel!=1
			order by Name DESC';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function insert($rxpcName){
		// $sql = 'select StudentNo,Name,Birthday,Phone,GZDW,ZZY,BJ from student where IsDel!=1';
		$this->db->where('Name', $rxpcName);
		$query = $this->db->get('rxpc');
		if(count($query->result())>0){
			return 2;
		}
		$data = array(
					'Name'=>$rxpcName
				);
		return $this->db->insert('rxpc', $data);
	}

}