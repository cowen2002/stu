<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model{
	
	public function check_login($username, $password){
		return $result = $this->db->query('select * from administrator where name="'.$username.'"  and AdminPsd="'.$password.'"')->num_rows();		
	}

}