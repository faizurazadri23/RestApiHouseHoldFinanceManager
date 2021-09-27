<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jenis_pemasukanmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	
	function getDataAll(){
        $query = $this->db->get('jenis_pemasukan');
        return $query->result_array();
    }

	public function insert($data){
		$insert = $this->db->insert('jenis_pemasukan', $data);
		return $insert;
	}


	public function update($data, $id_jenis_pemasukan){
		$this->db->where('id_jenis_pemasukan', $id_jenis_pemasukan);
		$update = $this->db->update('jenis_pemasukan', $data);
		return $update;
	}

	public function delete($id_jenis_pemasukan){
        $this->db->where('id_jenis_pemasukan', $id_jenis_pemasukan);
        $this->db->delete('jenis_pemasukan');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
}
