<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	function getDataAll($id_user){
        $this->db->select('*');
		$this->db->from('pengeluaran a');
		$this->db->join('jenis_pengeluaran b', 'b.id_jenis_pengeluaran=a.id_jenis_pengeluaran', 'left');
		$this->db->join('metode_simpanan c', 'c.id_metode_simpanan=a.id_metode_simpanan', 'left');
		$this->db->where('a.id', $id_user);
		$query = $this->db->get();

		if($query->num_rows() != 0){
			return $query->result_array();
		}else{
			return false;
		}  
    }

	function getTotalPengeluaran($id_user){
		$query = $this->db->query("SELECT SUM(IF(id=$id_user,nominal_pengeluaran,0)) as total_pengeluaran from pengeluaran");
        $hasil = $query->row();
        return $hasil->total_pengeluaran;
	}

	public function insert($data){
		$insert = $this->db->insert('pengeluaran', $data);
		return $insert;
	}


	public function update($data, $id_pengeluaran){
		$this->db->where('id_pengeluaran', $id_pengeluaran);
		$update = $this->db->update('pengeluaran', $data);
		return $update;
	}

	public function delete($id_pengeluaran){
        $this->db->where('id_pengeluaran', $id_pengeluaran);
        $this->db->delete('pengeluaran');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
}
