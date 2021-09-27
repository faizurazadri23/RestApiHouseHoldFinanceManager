<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

class Pemasukan extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('Pemasukan_model');
    }

	public function index_get() {

		$id_user = $this->get('id_user');

        $data = $this->Pemasukan_model->getDataAll($id_user);
        
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

	function totalpemasukan_get(){
        $id_user = $this->get('id_user');

        $datadb = $this->Pemasukan_model->getTotalPemasukan($id_user);

        $this->response([
                    'status' => TRUE,
                    'data' => $datadb
                ], REST_Controller::HTTP_OK);
    }

	public function index_post(){

		$data = array(
            'id' 					=>$this->post('id'),
			'id_jenis_pemasukan' 	=>$this->post('id_jenis_pemasukan'),
			'id_metode_simpanan' 	=>$this->post('id_metode_simpanan'),
			'tanggal_pemasukan' 	=>$this->post('tanggal_pemasukan'),
			'catatan' 				=>$this->post('catatan'),
			'nominal_pemasukan' 	=>$this->post('nominal_pemasukan')
        );

		$insert_data = $this->Pemasukan_model->insert($data);

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

		$id_pemasukan = $this->put('id_pemasukan');

		$data = array(
			'id' 					=>$this->put('id'),
            'id_jenis_pemasukan' 	=>$this->put('id_jenis_pemasukan'),
			'id_metode_simpanan' 	=>$this->put('id_metode_simpanan'),
			'tanggal_pemasukan' 	=>$this->put('tanggal_pemasukan'),
			'catatan' 				=>$this->put('catatan'),
			'nominal_pemasukan' 	=>$this->put('nominal_pemasukan')
        );

		$update_data = $this->Pemasukan_model->update($data, $id_pemasukan);

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
		$id_pemasukan = $this->post('id_pemasukan');

		$delete_data = $this->Pemasukan_model->delete($id_pemasukan);

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
