<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('index_model', 'index_model', TRUE);
    }

	
	public function index() {
		$this->data['this_page'] = 'index';
		if ($this->data['have_login']) $this->data['kelas'] = $this->index_model->get_kelas($this->data['session_username']);
		
		$this->load->view('navbar_view', $this->data);	
		$this->load->view('home_view', $this->data);
		$this->load->view('footer_view');		
	}
	
	
	public function about() {
		$this->data['this_page'] = 'about';
		
		$this->load->view('navbar_view', $this->data);	
		$this->load->view('about_view', $this->data);
		$this->load->view('footer_view');
	}
	
}