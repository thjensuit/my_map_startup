<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_list_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	Get category
	*/
	function category()
	{

		$query = $this->db->get("category");
		$result = $query->result_array();
		
		return $result;
	}
	
	/*
	Action insert or update
	*/
	function insert($data,$data_id)
	{
		if ($data_id == '')
		{
			$result = $this->db->insert('markers',$data);
			
			return $result;
			
		}else{
		
			$this->db->where('markers_id', $data_id);
			$result = $this->db->update('markers',$data);
		
			return $result;
			
			}	
		}
		
	
	/*
	Remove 
	*/
	function remove($data_id)
	{
		
	 	return $this->db->delete('markers', array('markers_id' => $data_id));
				
	}
	
	
	
}