<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
		$this->userTbl = 'users';
    }

    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->userTbl);
        
        //Mengambil data berdasarkan kondisi
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            //Mengatur awal dan batas
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();    
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->row_array():false;
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }

        //Mengembalikan data yang diambil
        return $result;
    }

	function getDataAll(){
        $query = $this->db->get('users');
        return $query->result_array();
    }

	public function insert($data){
		$insert = $this->db->insert('users', $data);
		return $insert;
	}


	public function update($data, $id){
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);
		return $update;
	}

	public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('users');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
}
