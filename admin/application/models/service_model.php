<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_maps($filter)
	{
		if($filter != 'undefined'){
			$this->db->like('markers_name', $filter);
		}
		$this->db->select('*');
        $this->db->from('markers');
		$this->db->join('category', 'markers.markers_category_id =  category.category_id','right');
		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}
	
		
	function get_list($category_id, $filter)
	{
		
		if($category_id != 'undefined'){
			$this->db->where('markers_category_id', $category_id);
		}
		
		if($filter != 'undefined'){
			$this->db->like('markers_name', $filter);
		}
		
		$query = $this->db->get('markers');
		$result = $query->result_array();
		
		return $result;
	}

	function get_nearby_search($lat, $long, $option, $filter)
	{
		if($option == "km")
			$this->db->select("*, ROUND(((acos(sin((".$lat." * pi()/180)) * sin((markers_lat*pi()/180))+cos((".$lat." * pi()/180)) * cos((markers_lat*pi()/180)) * cos(((".$long." - markers_lng) *pi()/180))))*180/pi())*60*1.1515*1.609344) as distance");
		else
			$this->db->select("*, ROUND(((acos(sin((".$lat." * pi()/180)) * sin((markers_lat*pi()/180))+cos((".$lat." * pi()/180)) * cos((markers_lat*pi()/180)) * cos(((".$long." - markers_lng)* pi()/180))))*180/pi())*60*1.1515) as distance");
				
		if($filter != 'undefined'){
			$this->db->like('markers_name', $filter);
		}
		// $this->db->having('distance <=16');
        $this->db->from('markers');
        $this->db->order_by('distance', 'asc');
				
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}


	function get_nearby($lat, $long, $option, $top, $range)
	{

		if($option == "km")
			$this->db->select("*, ROUND(((acos(sin((".$lat." * pi()/180)) * sin((markers_lat*pi()/180))+cos((".$lat." * pi()/180)) * cos((markers_lat*pi()/180)) * cos(((".$long." - markers_lng) *pi()/180))))*180/pi())*60*1.1515*1.609344) as distance");
		else
			$this->db->select("*, ROUND(((acos(sin((".$lat." * pi()/180)) * sin((markers_lat*pi()/180))+cos((".$lat." * pi()/180)) * cos((markers_lat*pi()/180)) * cos(((".$long." - markers_lng)* pi()/180))))*180/pi())*60*1.1515) as distance");
					
        $this->db->from('markers');
        $test =20;
        $this->db->having('distance <=' .$range);
        $this->db->order_by('distance', 'asc');
		 $this->db->limit($top);
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}

	
	function get_category()
	{
		$this->db->select('category.category_id, category.category_name,category.category_name_vn, category.category_icon, COUNT(markers_category_id) AS count');
        $this->db->from('category');
        $this->db->order_by('count', 'desc');

		$this->db->join('markers', 'category.category_id = markers.markers_category_id','left');
        $this->db->group_by('category.category_name');
		 
		$query = $this->db->get();
		
		$result = $query->result_array();
		
		return $result;
	}


	function get_detail($filter)
	{
		if($filter != 'undefined'){
			$this->db->where('markers_id', $filter);
		}

		$this->db->select('*');
        $this->db->from('markers');
		$this->db->join('category', 'markers.markers_category_id =  category.category_id','left');
		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}
	
	function get_images($filter)
	{

		$this->db->where('images_markers_id', $filter);
		
		$query = $this->db->get('images');
		$result = $query->result_array();
		
		return $result;
	}

	function get_list_friend()
	{
		$this->db->select('member_id,member_phone,member_fname,member_lname,member_birthday,member_avatar,member_status,
			member_longitude,member_latitude,member_sos,member_level,member_savior');
		$this->db->from('member');

		$query=$this->db->get();
		$result=$query->result_array();

		return $result;
	}

	function get_victims()
	{
		$sos = array('1','2','3');
		$this->db->where_in('member_sos',$sos);

		$query = $this->db->get('member');
		$result = $query->result_array();

		return $result;
	}

	function get_victim($id)
	{
		$this->db->where('member_id',$id);

		$query = $this->db->get('member');
		$result = $query->result_array();

		return $result;
	}
}