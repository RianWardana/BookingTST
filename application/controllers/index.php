<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {

	public function __construct(){
		parent::__construct();
    }

	
	public function index() {
		$this->data['user'] = 'Rian Wardana';
		$this->data['this_page'] = 'index';
		
		$this->load->view('navbar_view', $this->data);	
		$this->load->view('home_view', $this->data);
		$this->load->view('footer_view');		
	}
	
}