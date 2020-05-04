<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bj_model extends CI_Model{
	public function search_bj_by_rxpcID($id){
		// $sql = 'select StudentNo,Name,Birthday,Phone,GZDW,ZZY,BJ from student where IsDel!=1';
		$sql = "select bj.Id,bj.Name
			from bj 
			where bj.IsDel!=1 and bj.RXPC=".$id.
			" order by Name DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function rxpc_bj_list(){
		$sql = "select bj.Id as bjId,bj.Name as bjName,rxpc.id as rxpcId,rxpc.Name as rxpcName
				from bj, rxpc
				where bj.IsDel!=1 and rxpc.IsDel!=1 and rxpc.id=bj.RXPC
				order by rxpc.Name Desc,bj.Name Desc";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}

	public function search_bj($data){
		$rxpcName = $data['rxpcName'];
		$bjName = $data['bjName'];
		$sql = "select bj.Id as bjId,bj.Name as bjName,rxpc.id as rxpcId,rxpc.Name as rxpcName
				from bj, rxpc
				where bj.IsDel!=1 and rxpc.IsDel!=1 and rxpc.Name like '%".$rxpcName."%' and bj.Name like '%".$bjName."%' and rxpc.id=bj.RXPC
				order by rxpc.Name Desc,bj.Name Desc";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}

	public function insert($arr){
		// $sql = 'select StudentNo,Name,Birthday,Phone,GZDW,ZZY,BJ from student where IsDel!=1';
		$this->db->where($arr);
		$query = $this->db->get('bj');
		// file_put_contents("./Result1.txt",var_export($query->result(),true));
		if(count($query->result())>0){
			return 2;
		}
		return $this->db->insert('bj', $arr);
	}

	public function get_bj_by_id($id){
		$sql = "select bj.Id as bjId,bj.Name as bjName,bj.RXPC as rxpcId,rxpc.Name as rxpcName
				from bj, rxpc
				where bj.IsDel!=1 and rxpc.IsDel!=1 and bj.Id=".$id." and rxpc.id=bj.RXPC";
		$query = $this->db->query($sql);
		return $query->row();
	}



}