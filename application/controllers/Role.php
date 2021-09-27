<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

class Role extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('Role_model');
    }

	public function index_get() {
        $data = $this->Role_model->getDataAll();
        
        if(!empty($data)){

			$this->response([
				'status' 	=> TRUE,
				'message' 	=> 'Data Ditemukan',
				'data'		=> $data
			], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Data Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

	public function index_post(){

		$data = array(
            'role' =>$this->post('role')
        );

		$insert_data = $this->Role_model->insert($data);

		if($insert_data){
			$this->response([
                'status' => TRUE,
                'message' => 'Berhasil Menambah Data'
            ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                'status' => FALSE,
                'message' => 'Tidak Berhasil Menambah Data'
            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_put(){

		$id = $this->put('id_role');


		$data = array(
            'role' =>$this->put('role')
        );

		$update_data = $this->Role_model->update($data, $id);

		if($update_data){
			$this->response([
                'status' => TRUE,
                'message' => 'Berhasil Mengubah Data'
            ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                'status' => FALSE,
                'message' => 'Tidak Berhasil Mengubah Data'
            ], REST_Controller::HTTP_NOT_FOUND);
		}

	}

	public function delete_post(){
		$id = $this->post('id_role');

		$delete_data = $this->Role_model->delete($id);

		if($delete_data){
			$this->response([
                'status' => TRUE,
                'message' => 'Berhasil Menghapus Data'
            ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                'status' => FALSE,
                'message' => 'Tidak Berhasil Menghapus Data'
            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
