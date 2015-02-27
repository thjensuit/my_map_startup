<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller
{
	//Get request maps
	public function get_maps()
	{
		$filter = $this->input->get('filter');
		
		$this->load->model('service_model');
		$query = $this->service_model->get_maps($filter);
		
		header("Access-Control-Allow-Origin: *"); 
		header('Access-Control-Allow-Methods: GET, POST');
		echo json_encode($query);
	}
			
	//Get request list
	public function get_list()
	{
		$filter = $this->input->get('q');
		$category_id = $this->input->get('id');
		
		$this->load->model('service_model');
		$query = $this->service_model->get_list($category_id, $filter);
		
		header("Access-Control-Allow-Origin: *"); 
		header('Access-Control-Allow-Methods: GET, POST');		
		echo json_encode($query);
	}
	
	//Get request nearby
	public function get_nearby()
	{
		$lat = $this->input->get('lat');
		$long = $this->input->get('long');
		$option = $this->input->get('option');
		$top = $this->input->get('top');
		$range = $this->input->get('range');
		
		$this->load->model('service_model');
		$query = $this->service_model->get_nearby($lat, $long, $option,$top,$range);

		header("Access-Control-Allow-Origin: *"); 
		header('Access-Control-Allow-Methods: GET, POST');
		echo json_encode($query);
	}

	//Get request nearby search
	public function get_nearby_search()
	{
		$lat = $this->input->get('lat');
		$long = $this->input->get('long');
		$option = $this->input->get('option');
		$filter = $this->input->get('q');
		
		$this->load->model('service_model');
		$query = $this->service_model->get_nearby_search($lat,$long,$option,$filter);
		
		header("Access-Control-Allow-Origin: *"); 
		header('Access-Control-Allow-Methods: GET, POST');		
		echo json_encode($query);
	}

	//Get request category
	public function get_category()
	{		
		$this->load->model('service_model');
		
		$query = $this->service_model->get_category();

		header("Access-Control-Allow-Origin: *"); 
		header('Access-Control-Allow-Methods: GET, POST');		
		echo json_encode($query);
	}

	//Get request detail
	public function get_detail()
	{
		$filter = $this->input->get('id');
		
		$this->load->model('service_model');
		$query = $this->service_model->get_detail($filter);

		header("Access-Control-Allow-Origin: *"); 
		header('Access-Control-Allow-Methods: GET, POST');		
		echo json_encode($query);
	}

	//Get request images
	public function get_images()
	{
		$filter = $this->input->get('id');
		
		$this->load->model('service_model');
		$query = $this->service_model->get_images($filter);
		
		header("Access-Control-Allow-Origin: *"); 
		header('Access-Control-Allow-Methods: GET, POST');
		echo json_encode($query);
	}
	//
	public function get_list_friend()
	{
		$this->load->model('service_model');
		
		$query = $this->service_model->get_list_friend();

		header("Access-Control-Allow-Origin: *"); 
		header('Access-Control-Allow-Methods: GET, POST');		
		echo json_encode($query);
	}
	//
	public function get_victims()
	{
		$this->load->model("service_model");

		$query = $this->service_model->get_victims();

		header("Access-Control-Allow-Origin: *"); 
		header('Access-Control-Allow-Methods: GET, POST');		
		echo json_encode($query);
	}
	
	public function get_victim()
	{
		$id = $this->input->get('id');
		$this->load->model("service_model");

		$query = $this->service_model->get_victim($id);

		header("Access-Control-Allow-Origin: *"); 
		header('Access-Control-Allow-Methods: GET, POST');		
		echo json_encode($query);
	}
}

/* End of file service.php */
/* Location: ./application/controller/service.php */