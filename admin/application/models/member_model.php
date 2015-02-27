<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	Get member
	*/
	function member()
	{

		$query = $this->db->get("member");
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
			$result = $this->db->insert('member',$data);
			
			return $result;
			
		}else{
		
			$this->db->where('member_id', $data_id);
			$result = $this->db->update('member',$data);
		
			return $result;
			
			}	
		}
		
	
	/*
	Remove 
	*/
	function remove($data_id)
	{
		
	 	return $this->db->delete('member', array('member_id' => $data_id));
				
	}
	
	
	
}