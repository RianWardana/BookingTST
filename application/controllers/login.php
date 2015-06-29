<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('login_model', 'login_model', TRUE);
    }

	public function index(){
	
		if($this->session->userdata('login') == TRUE){
			redirect('');
		}
		
		else {
			$this->data['this_page'] = 'login';
			
			
			// USER INGIN LOGIN //
			if ($this->input->post('login_hidden')) {
				
				// INPUT VALID //
				if($this->login_model->check_valid('login')) {
					
					// LOGIN BERHASIL //
					if($this->login_model->check_login()) { redirect(''); }
					
					// KOMBINASI USERNAME DAN PASSWORD TIDAK DITEMUKAN //
					else {
						$this->session->set_flashdata('error_login', "
							<div class='ui negative message'>
								<p>Kombinasi Username dan Password Anda tidak valid</p>
							</div>
						");
						redirect('login'); 
					}
				}
				
				// INPUT TIDAK MEMENUHI KRITERIA //
				else { redirect('login'); }
			}
			
			
			// USER INGIN DAFTAR //
			else if ($this->input->post('daftar_hidden')) {
				if($this->login_model->check_valid('daftar')) {
					if ($this->login_model->daftar()) {
						redirect('');
					}
					
					else {
						$this->session->set_flashdata('error_daftar', "
							<div class='ui negative message'>
								<p>Nama atau Username Anda sudah ada yang punya</p>
							</div>
						");
						redirect('login');
					}
				}
				
				else { redirect('login'); }
			}
			
			
			else {
				$this->load->view('navbar_view', $this->data);
				$this->load->view('login_view');
			}
		}
	}
	
	public function logout(){
		$this->login_model->logout();
		redirect('login');
	}
	
}