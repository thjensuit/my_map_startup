<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('login_model');
		$this->load->helper(array('url','language'));
	}

	public function index()
	{	
	
		if(!$this->login_model->is_logged_in()){ redirect('login'); }	
		$get_logged_in_user_info = $this->login_model->get_logged_in_user_info();
		$data['user_info'] = $get_logged_in_user_info;
		$this->lang->load('template');
		$this->template->display('home');
		
	}
	

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */