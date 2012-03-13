<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class Feedback_m extends MY_Model {

	public function __construct(){
	
		parent::__construct();
		
		$this->set_table_name('feedback');
	}
	
	
	/*
	* check for exists
	*
	*/
	
	public function exists($id,&$order) {
	
		$this->db->where('id =',$id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_name());
		
		if( $query->num_rows() > 0 )
		{
			$order = $query->row();
			return TRUE;
		}
		return FALSE;
	}
	
	public function count_all_where($params = array()){
	
		$this->filter($params);
		return $this->db->count_all_results($this->table_name());
	}
	/*
	*
	*	Fields filter. Fields name same as fields in the db table
	*	param array
	*
	*/

	public function get_many_by($params = array())
    {
		$this->filter($params);
		return $this->get_all();
    }
	
	public function get_all($limit = false, $offset = false){
	
		if( $limit && $offset ){
		
			$this->db->limit($limit,$offset);
		}else if($limit) {
		
			$this->db->limit($limit);
		}
		
		$this->db
			 ->select("
				feedback.*
			 ");
		$orders = parent::get_all();
		return $orders;
	}
	
	
	public function insert($post){
		
		parent::insert(array(
			'name'   => $post['f_name'],
			'email' => $post['f_email'],
			'phone' => $post['f_phone'],
			'message'	 => $post['f_message']
		));
	}

	
	public function get($id){
	
		$this->db->where('id =',$id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_name());
		if( $query->num_rows() > 0 ){
		
			return $query->row();
		}
		return NULL;
	}
}