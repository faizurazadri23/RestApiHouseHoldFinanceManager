<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

class Metode_simpanan extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('Metode_simpananmodel');
    }

	public function index_get() {
        $data = $this->Metode_simpananmodel->getDataAll();
        
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
            'nama_metode_simpanan' =>$this->post('nama_metode_simpanan')
        );

		$insert_data = $this->Metode_simpananmodel->insert($data);

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

		$id = $this->put('id_metode_simpanan');


		$data = array(
            'nama_metode_simpanan' =>$this->put('nama_metode_simpanan')
        );

		$update_data = $this->Metode_simpananmodel->update($data, $id);

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
		$id = $this->post('id_metode_simpanan');

		$delete_data = $this->Metode_simpananmodel->delete($id);

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
