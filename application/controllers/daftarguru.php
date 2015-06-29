<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftarguru extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('daftarguru_model', 'daftarguru_model', TRUE);
    }

	public function index(){
	
		if($this->session->userdata('login') == TRUE){
			redirect('');
		}
		
		else {
			$this->data['this_page'] = 'daftarguru';
			
			if ($this->input->post('daftar_hidden')) {
				if($this->daftarguru_model->check_valid()) {
					if ($this->daftarguru_model->daftar()) {
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
				$this->load->view('daftarguru_view');
			}
		}
	}
	
}