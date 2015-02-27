<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	

	/*
	Action insert or update
	*/
	function insert($data,$data_id)
	{
		if ($data_id == '')
		{
			$result = $this->db->insert('category',$data);
			
			return $result;
			
		}else{
		
			$this->db->where('category_id', $data_id);
			$result = $this->db->update('category',$data);
		
			return $result;
			
			}	
		}
		
	
	/*
	Remove 
	*/
	function remove($data_id)
	{
		
	 	return $this->db->delete('category', array('category_id' => $data_id));
				
	}
	
	
	
}