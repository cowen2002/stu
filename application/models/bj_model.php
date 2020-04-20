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

}