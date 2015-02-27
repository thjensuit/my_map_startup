<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('home');
	}

	public function index()
	{
			$this->load->view('home');
	}

	public function get_marker()
	{
		$category = $this->input->get('category');
		
		$this->load->model('home_model');
		$marker = $this->home_model->get($category);
		
		echo json_encode($marker);
	}

	public function get_category()
	{
		$this->load->model('home_model');
		$category = $this->home_model->category();
		
		echo json_encode($category);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */