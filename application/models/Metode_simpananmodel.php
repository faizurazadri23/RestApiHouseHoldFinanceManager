<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Metode_simpananmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	
	function getDataAll(){
        $query = $this->db->get('metode_simpanan');
        return $query->result_array();
    }

	public function insert($data){
		$insert = $this->db->insert('metode_simpanan', $data);
		return $insert;
	}


	public function update($data, $id_metode_simpanan){
		$this->db->where('id_metode_simpanan', $id_metode_simpanan);
		$update = $this->db->update('metode_simpanan', $data);
		return $update;
	}

	public function delete($id_metode_simpanan){
        $this->db->where('id_metode_simpanan', $id_metode_simpanan);
        $this->db->delete('metode_simpanan');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
}
