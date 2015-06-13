<?php
class Blog_model extends CI_Model
{
	function getAllTopics()
	{
		$topics = $this->db->get('entries');
		return $topics;
	}
	function getAllComments($id) 
	{
		$this->db->where('entry_id', $id);
		$data = $this->db->get("comments");
		$result = array();
		if($data->num_rows() > 0)
			$result = $data->result();

		return $result;
	}
	function postComment($parameters)
	{
		$this->db->insert("comments", $parameters);
	}
	function postTopic($parameters) 
	{
		$this->db->insert('entries',$parameters);
	}
	function getTopic($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('entries');
		$result = array();
		if($data->num_rows() > 0)
			$result = $data->result();

		$result = reset($result);

		return $result;
	}

}
?>