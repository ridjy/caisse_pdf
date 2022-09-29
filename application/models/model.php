<?php if ( ! defined('BASEPATH')) exit('No direct script access
allowed');

class Model extends CI_Model
{
protected $table = 'numero';
public function __construct()
{
	// Obligatoire
	parent::__construct();
	$this->load->database();	
}

public function numeroauto()
{
	$this->db->select('id');
	$this->db->from('numero');
	$this->db->limit(1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
	$row = $query->row_array();
	return $row['id'] ; } 
	else { return FALSE ; }
}

public function incrementer()
{
	$this->db->select('id');
	$this->db->from('numero');
	$this->db->limit(1);
	$query = $this->db->get();
	$row = $query->row_array();
	$this->db->set('id',$row['id']+1);
	return $this->db->update($this->table);
}

}