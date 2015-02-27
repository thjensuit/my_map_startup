<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('member');
	}

	public function index()
	{	

		
		$this->load->view('member');
	}
	
	public function get()
	{

		$result = $this->datatables->getData('member', array('member_phone','member_fname','member_lname',
			'member_birthday','member_status','member_update','member_avatar','member_longitude','member_latitude','member_verification',
			'member_token','member_activation','member_sos','member_level','member_savior',
			'member_id'), 'member_id');
		echo $result;
		
	}

	public function insert()
	{
	   $config['path']   = './upload/logo/';
	   $config['format'] =	array("jpg", "png", "gif", "bmp");
	   $config['size']   = '1024';
	   
	   $this->load->library('ajaxupload');
	   $this->ajaxupload->getUpload($config,"markers_logo");

		
		$query = $this->ajaxupload->query();
		
		$data_id = $this->input->post('markers_id');

		$data = array();	
		$data['markers_name']  = $this->input->post('markers_name');
		$data['markers_category_id']  = $this->input->post('markers_category_id');
		$data['markers_phone']  = $this->input->post('markers_phone');
		$data['markers_url']  = $this->input->post('markers_url');
		$data['markers_address']  = $this->input->post('markers_address');
		$data['markers_lat']  = $this->input->post('markers_lat');
		$data['markers_lng']  = $this->input->post('markers_lng');
		$data['markers_desc']  = $this->input->post('markers_desc');
		$data['markers_name']  = $this->input->post('markers_name');
		//$data['markers_logo'] = $query['file_name'];
		if($query['file_name'] != ''){
			$data['markers_logo'] = $query['file_name'];
		}	
		
		$this->load->model('location_list_model');
		$result = $this->location_list_model->insert($data,$data_id);
		
		if(!$data_id)
			if($result)
			if($result)
				echo "Data insert was successful!";
			else
				echo "Data insert not success!";
		else
			if($result)
				echo "Data update was successful!";
			else
				echo "Data update was successful!";
	}

	public function remove()
	{
		$data_id = $this->input->post('remove_member_id');
		
		$this->load->model('member_model');
		$result = $this->member_model->remove($data_id);
		
		if($result)
			echo "Data update was successful!";
		else
			echo "Data update was successful!";
		
	}
			
	
}

/* End of file list_location.php */
/* Location: ./application/controller/list_location.php */