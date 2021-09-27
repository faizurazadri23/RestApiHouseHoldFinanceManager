<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Role_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	function getDataAll(){
        $query = $this->db->get('role');
        return $query->result_array();
    }

	public function insert($data){
		$insert = $this->db->insert('role', $data);
		return $insert;
	}


	public function update($data, $id_role){
		$this->db->where('id_role', $id_role);
		$update = $this->db->update('role', $data);
		return $update;
	}

	public function delete($id_role){
        $this->db->where('id_role', $id_role);
        $this->db->delete('role');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
}
