<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

class Jenis_pengeluaran extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('Jenis_pengeluaranmodel');
    }

	public function index_get() {
        $data = $this->Jenis_pengeluaranmodel->getDataAll();
        
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
            'jenis_pengeluaran' =>$this->post('jenis_pengeluaran')
        );

		$insert_data = $this->Jenis_pengeluaranmodel->insert($data);

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

		$id = $this->put('id_jenis_pengeluaran');

		$data = array(
            'jenis_pengeluaran' =>$this->put('jenis_pengeluaran')
        );

		$update_data = $this->Jenis_pengeluaranmodel->update($data, $id);

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
		$id = $this->post('id_jenis_pengeluaran');

		$delete_data = $this->Jenis_pengeluaranmodel->delete($id);

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
