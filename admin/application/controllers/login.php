<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('login_model');
		$this->load->helper(array('url','language'));
		
	}
	
	function index()
	{
		$this->lang->load('login');

		if($this->login_model->is_logged_in())
		{
		redirect('main');
		}
		else
		{
		$this->load->view('login');
		}
		
	}
		
	function login_check()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$login = $this->login_model->login_val($username,$password);
		if($login){ echo "success"; }else{ echo "failed"; }
		
	}
	
	function logout()
	{
		$this->login_model->logout();
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */