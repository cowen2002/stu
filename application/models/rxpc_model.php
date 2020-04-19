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

}