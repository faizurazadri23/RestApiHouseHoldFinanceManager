<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

class Pengeluaran extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('Pengeluaran_model');
    }

	public function index_get() {

		$id_user = $this->get('id_user');
        $data = $this->Pengeluaran_model->getDataAll($id_user);
        
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


	function totalpengeluaran_get(){
        $id_user = $this->get('id_user');

        $datadb = $this->Pengeluaran_model->getTotalPengeluaran($id_user);

        $this->response([
                    'status' => TRUE,
                    'data' => $datadb
                ], REST_Controller::HTTP_OK);
    }

	public function index_post(){

		$data = array(
            'id' 					=>$this->post('id'),
			'id_jenis_pengeluaran' 	=>$this->post('id_jenis_pengeluaran'),
			'id_metode_simpanan' 	=>$this->post('id_metode_simpanan'),
			'tanggal_pengeluaran' 	=>$this->post('tanggal_pengeluaran'),
			'catatan' 				=>$this->post('catatan'),
			'nominal_pengeluaran' 	=>$this->post('nominal_pengeluaran')
        );

		$insert_data = $this->Pengeluaran_model->insert($data);

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

		$id_pengeluaran = $this->put('id_pengeluaran');

		$data = array(
			'id' 					=>$this->put('id'),
			'id_jenis_pengeluaran' 	=>$this->put('id_jenis_pengeluaran'),
			'id_metode_simpanan' 	=>$this->put('id_metode_simpanan'),
			'tanggal_pengeluaran' 	=>$this->put('tanggal_pengeluaran'),
			'catatan' 				=>$this->put('catatan'),
			'nominal_pengeluaran' 	=>$this->put('nominal_pengeluaran')
        );

		$update_data = $this->Pengeluaran_model->update($data, $id_pengeluaran);

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
		$id_pengeluaran = $this->post('id_pengeluaran');

		$delete_data = $this->Pengeluaran_model->delete($id_pengeluaran);

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
