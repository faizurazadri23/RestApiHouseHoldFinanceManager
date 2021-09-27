<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jenis_pengeluaranmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	
	function getDataAll(){
        $query = $this->db->get('jenis_pengeluaran');
        return $query->result_array();
    }

	public function insert($data){
		$insert = $this->db->insert('jenis_pengeluaran', $data);
		return $insert;
	}


	public function update($data, $id_jenis_pengeluaran){
		$this->db->where('id_jenis_pengeluaran', $id_jenis_pengeluaran);
		$update = $this->db->update('jenis_pengeluaran', $data);
		return $update;
	}

	public function delete($id_jenis_pengeluaran){
        $this->db->where('id_jenis_pengeluaran', $id_jenis_pengeluaran);
        $this->db->delete('jenis_pengeluaran');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
}
