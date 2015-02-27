<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_list extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('locali');
	}

	public function index()
	{	

		
		$this->load->view('location_list');
	}
	
	public function get()
	{

		$result = $this->datatables->getData('markers', array('markers_name','markers_name_vn','category_name','markers_phone',
			'markers_url','markers_address','markers_logo','markers_lat','markers_lng','markers_desc','markers_desc_vn','markers_id',
			'markers_category_id'), 'markers_id',array('category','markers.markers_category_id = category.category_id','inner'));
		echo $result;
		
	}
	
	public function get_category()
	{
		$this->load->model('location_list_model');
		$category = $this->location_list_model->category();
		
		echo json_encode($category);
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
		$data['markers_name_vn']  = $this->input->post('markers_name_vn');
		$data['markers_category_id']  = $this->input->post('markers_category_id');
		$data['markers_phone']  = $this->input->post('markers_phone');
		$data['markers_url']  = $this->input->post('markers_url');
		$data['markers_address']  = $this->input->post('markers_address');
		$data['markers_lat']  = $this->input->post('markers_lat');
		$data['markers_lng']  = $this->input->post('markers_lng');
		$data['markers_desc']  = $this->input->post('markers_desc');
		$data['markers_desc_vn']  = $this->input->post('markers_desc_vn');
		$data['markers_name']  = $this->input->post('markers_name');
		//$data['markers_logo'] = $query['file_name'];
		if($query['file_name'] != ''){
			$data['markers_logo'] = $query['file_name'];
		}	
		
		$this->load->model('location_list_model');
		$result = $this->location_list_model->insert($data,$data_id);
		
		if(!$data_id)
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
		$data_id = $this->input->post('remove_location_list_id');
		
		$this->load->model('location_list_model');
		$result = $this->location_list_model->remove($data_id);
		
		if($result)
			echo "Data update was successful!";
		else
			echo "Data update was successful!";
		
	}
			
	
}

/* End of file list_location.php */
/* Location: ./application/controller/list_location.php */