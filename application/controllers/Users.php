<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Users extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        
        // Load the user model
        $this->load->model('User_model');
    }
    
    public function login_post() {
        // Get the post data
        $username = $this->post('username');
        $password = $this->post('password');
        
        // Validate the post data
        if(!empty($username) && !empty($password)){
            
            // Check if any user exists with the given credentials
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'username' => $username,
                'password' => md5($password),
                'status' => 1
            );

            $user = $this->User_model->getRows($con);
            
            if($user){
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Berhasil Login',
                    'data' => $user
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response("Username atau Password Salah.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            // Set the response and exit
            $this->response("Username atau Password tidak ditemukan", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function registration_post() {
        // Get the post data
        $nama_depan = strip_tags($this->post('nama_depan'));
        $nama_belakang = strip_tags($this->post('nama_belakang'));
		$username = strip_tags($this->post('username'));
        $email = strip_tags($this->post('email'));
        $password = strip_tags($this->post('password'));
		$alamat = strip_tags($this->post('alamat'));
		$pekerjaan = strip_tags($this->post('pekerjaan'));
		$jumlah_anak = strip_tags($this->post('jumlah_anak'));
		$id_role = strip_tags($this->post('id_role'));
        $telpn = strip_tags($this->post('telpn'));

		date_default_timezone_set('Asia/Jakarta');

        $created = date('Y-m-d H:i:s');

        
        // Validate the post data
        if(!empty($nama_depan) && !empty($nama_belakang) && !empty($username) && !empty($email) && !empty($password)&& !empty($alamat)&& !empty($pekerjaan)&& !empty($jumlah_anak)&& !empty($id_role)&& !empty($telpn)){
            
            // Check if the given email already exists
            $con['returnType'] = 'count';
            $con['conditions'] = array(
                'username' => $username,
            );
            $userCount = $this->User_model->getRows($con);
            
            if($userCount > 0){
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => '0',
                ], REST_Controller::HTTP_OK);
            }else{
                // Insert user data
                $userData = array(
                    'nama_depan' => $nama_depan,
                    'nama_belakang' => $nama_belakang,
					'username' => $username,
                    'email' => $email,
                    'password' => md5($password),
					'alamat'	=> $alamat,
					'pekerjaan'	=> $pekerjaan,
					'jumlah_anak'	=> $jumlah_anak,
					'id_role'	=> $id_role,
                    'telpn' => $telpn,
					'created'	=> $created
                );
                $insert = $this->User_model->insert($userData);
                
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => '1',
                        'data' => $insert
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => '0',
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        }else{
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Silahkan Lengkapi data yang diinputkan',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    

    public function index_get($id = 0) {
        
        $users = $this->User_model->getDataAll($id);
        
        
        if(!empty($users)){
            
            $this->response($users, REST_Controller::HTTP_OK);
        }else{
            
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function update_put() {
        $id = $this->put('id');
        
        
        $nama_depan = strip_tags($this->put('nama_depan'));
        $nama_belakang = strip_tags($this->put('nama_belakang'));
		$username = strip_tags($this->put('username'));
        $email = strip_tags($this->put('email'));
        $password = strip_tags($this->put('password'));
		$alamat = strip_tags($this->put('alamat'));
		$pekerjaan = strip_tags($this->put('pekerjaan'));
		$jumlah_anak = strip_tags($this->put('jumlah_anak'));
		$id_role = strip_tags($this->put('id_role'));
        $telpn = strip_tags($this->put('telpn'));

		date_default_timezone_set('Asia/Jakarta');

        $modified = date('Y-m-d H:i:s');

        
		if(!empty($nama_depan) && !empty($nama_belakang) && !empty($username) && !empty($email) && !empty($password)&& !empty($alamat)&& !empty($pekerjaan)&& !empty($jumlah_anak)&& !empty($id_role)&& !empty($telpn)){
            
            $userData = array();
            if(!empty($nama_depan)){
                $userData['nama_depan'] = $nama_depan;
            }
            if(!empty($nama_belakang)){
                $userData['nama_belakang'] = $nama_belakang;
            }
			if(!empty($username)){
                $userData['username'] = $username;
            }
            if(!empty($email)){
                $userData['email'] = $email;
            }
            if(!empty($password)){
                $userData['password'] = md5($password);
            }

			if(!empty($alamat)){
                $userData['alamat'] = $alamat;
            }

			if(!empty($pekerjaan)){
                $userData['pekerjaan'] = $pekerjaan;
            }

			if(!empty($jumlah_anak)){
                $userData['jumlah_anak'] = $jumlah_anak;
            }

			if(!empty($id_role)){
                $userData['id_role'] = $id_role;
            }
            if(!empty($telpn)){
                $userData['telpn'] = $telpn;
            }

			if(!empty($modified)){
                $userData['modified'] = $modified;
            }
            $update = $this->User_model->update($userData, $id);
            
            // Check if the user data is updated
            if($update){
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Berhasil Mengupdate Data'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Terjadi Beberapa kesalahan, silahkan coba lagi'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            // Set the response and exit
            $this->response("Silahkan masukkan data yang dibutuhkan", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function delete_post(){
        $id = $this->post('id');
        

        $del_user = $this->User_model->delete($id);

        if($del_user){
			$this->response([
				'status' => FALSE,
				'message' => 'Berhasil Menghapus User'
			], REST_Controller::HTTP_OK);

        }else{
			$this->response([
				'status' => FALSE,
				'message' => 'Gagal Menghapus User'
			], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
}

?>
