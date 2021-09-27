<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pemasukan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	function getDataAll($id_user){

		$this->db->select('*');
		$this->db->from('pemasukan a');
		$this->db->join('jenis_pemasukan b', 'b.id_jenis_pemasukan=a.id_jenis_pemasukan', 'left');
		$this->db->join('metode_simpanan c', 'c.id_metode_simpanan=a.id_metode_simpanan', 'left');
		$this->db->where('a.id', $id_user);
		$query = $this->db->get();

		if($query->num_rows() != 0){
			return $query->result_array();
		}else{
			return false;
		}        
    }

	function getTotalPemasukan($id_user){
		$query = $this->db->query("SELECT SUM(IF(id=$id_user,nominal_pemasukan,0)) as total_pemasukan from pemasukan");
        $hasil = $query->row();
        return $hasil->total_pemasukan;
	}

	public function insert($data){
		$insert = $this->db->insert('pemasukan', $data);
		return $insert;
	}


	public function update($data, $id_pemasukan){
		$this->db->where('id_pemasukan', $id_pemasukan);
		$update = $this->db->update('pemasukan', $data);
		return $update;
	}

	public function delete($id_pemasukan){
        $this->db->where('id_pemasukan', $id_pemasukan);
        $this->db->delete('pemasukan');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
}
