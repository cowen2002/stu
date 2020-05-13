<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Students_model extends CI_Model{

	// public function attribute_add($arr){
	// 	return $this->db->insert('ci_attribute', $arr);
	// }

	public function students_list(){
		// $sql = 'select StudentNo,Name,Birthday,Phone,GZDW,ZZY,BJ from student where IsDel!=1';
		$sql = 'select student.StudentNo,student.Name,student.Birthday,student.Phone,student.GZDW,student.ZZY,bj.Name as BJ,rxpc.Name as XQ from student,bj,rxpc where student.IsDel!=1 and bj.IsDel!=1 and rxpc.IsDel!=1 and bj.Id=student.BJ and rxpc.id=student.RXPC';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function search_students($data){
		// $sql = 'select StudentNo,Name,Birthday,Phone,GZDW,ZZY,BJ from student where IsDel!=1 and Name like \'%'.$name.'%\' ';
		$name = $data['name'];
		$gzdw = $data['gzdw'];
		$rxpc = $data['rxpc'];
		$bj = $data['bj'];
		// if($rxpc==0){
		// 	if($bj==0){
		// 		$sql = 'select student.StudentNo,student.Name,student.Birthday,student.Phone,student.GZDW,student.ZZY,bj.Name as BJ,rxpc.Name as XQ from student,bj,rxpc where student.IsDel!=1 and bj.IsDel!=1 and student.Name like \'%'.$name.'%\' and student.GZDW like \'%'.$gzdw.'%\' and bj.Id=student.BJ and rxpc.id=student.RXPC';		
		// 	}else{
		// 		$sql = 'select student.StudentNo,student.Name,student.Birthday,student.Phone,student.GZDW,student.ZZY,bj.Name as BJ,rxpc.Name as XQ from student,bj,rxpc where student.IsDel!=1 and bj.IsDel!=1 and student.Name like \'%'.$name.'%\' and student.GZDW like \'%'.$gzdw.'%\' and bj.Id=student.BJ and rxpc.id=student.RXPC and student.BJ='.$bj;	
		// 	}
			
		// }else{
		// 	if($bj==0){
		// 		$sql = 'select student.StudentNo,student.Name,student.Birthday,student.Phone,student.GZDW,student.ZZY,bj.Name as BJ,rxpc.Name as XQ from student,bj,rxpc where student.IsDel!=1 and bj.IsDel!=1 and student.Name like \'%'.$name.'%\' and student.GZDW like \'%'.$gzdw.'%\' and bj.Id=student.BJ and rxpc.id=student.RXPC and student.RXPC='.$rxpc;	
		// 	}else{
		// 		$sql = 'select student.StudentNo,student.Name,student.Birthday,student.Phone,student.GZDW,student.ZZY,bj.Name as BJ,rxpc.Name as XQ from student,bj,rxpc where student.IsDel!=1 and bj.IsDel!=1 and student.Name like \'%'.$name.'%\' and student.GZDW like \'%'.$gzdw.'%\' and bj.Id=student.BJ and rxpc.id=student.RXPC and student.BJ='.$bj.' and student.RXPC='.$rxpc;	
		// 	}

		// };		
		if($rxpc==0){
			if($bj==0){
				$sql = 'select student.StudentNo,student.Name,student.Birthday,student.Phone,student.GZDW,student.ZZY,bj.Name as BJ,rxpc.Name as XQ from student,bj,rxpc where student.IsDel!=1 and bj.IsDel!=1 and student.Name like \'%'.$name.'%\' and student.GZDW like \'%'.$gzdw.'%\' and bj.Id=student.BJ and rxpc.id=bj.RXPC';		
			}else{
				$sql = 'select student.StudentNo,student.Name,student.Birthday,student.Phone,student.GZDW,student.ZZY,bj.Name as BJ,rxpc.Name as XQ from student,bj,rxpc where student.IsDel!=1 and bj.IsDel!=1 and student.Name like \'%'.$name.'%\' and student.GZDW like \'%'.$gzdw.'%\' and bj.Id=student.BJ and rxpc.id=bj.RXPC and student.BJ='.$bj;	
			}
			
		}else{
			if($bj==0){
				$sql = 'select student.StudentNo,student.Name,student.Birthday,student.Phone,student.GZDW,student.ZZY,bj.Name as BJ,rxpc.Name as XQ from student,bj,rxpc where student.IsDel!=1 and bj.IsDel!=1 and student.Name like \'%'.$name.'%\' and student.GZDW like \'%'.$gzdw.'%\' and bj.Id=student.BJ and rxpc.id=bj.RXPC and bj.RXPC='.$rxpc;	
			}else{
				$sql = 'select student.StudentNo,student.Name,student.Birthday,student.Phone,student.GZDW,student.ZZY,bj.Name as BJ,rxpc.Name as XQ from student,bj,rxpc where student.IsDel!=1 and bj.IsDel!=1 and student.Name like \'%'.$name.'%\' and student.GZDW like \'%'.$gzdw.'%\' and bj.Id=student.BJ and rxpc.id=bj.RXPC and student.BJ='.$bj.' and bj.RXPC='.$rxpc;	
			}

		};
		// file_put_contents("./Result1.txt",$sql);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	// public function attribute_list_by_goods_type_id($goods_type_id){
	// 	// $this->db->where('goods_type_id', $goods_type_id);
	// 	// $query =  $this->db->get('ci_attribute');
	// 	//以上注释的语句也可以
	// 	$condition['goods_type_id'] = $goods_type_id;
	// 	$query = $this->db->where($condition)->get('ci_attribute');
	// 	return $query->result_array();
	// }

}