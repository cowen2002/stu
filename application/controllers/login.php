<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
    
    public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index(){
		$this->load->view('login.html');
	}
    
    public function signin(){
        $userName = $this->input->post('username', true);
        $passWord = $this->input->post('password', true);
        if($this->login_model->check_login($userName, $passWord)){
            $this->session->set_userdata('userName', $userName);
            redirect(base_url('main_frame/index'));
        }else{
            $data = array(
                        'url' => base_url('login/index'),
                        'message' => '用户名密码错误',
                        'wait' => 3
                        );
                        $this->load->view('message.html',$data);
        }
    }


}
