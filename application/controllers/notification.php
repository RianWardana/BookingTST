<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('msg_model', 'msg_model', TRUE);
		$this->username = $this->session->userdata('username');
		$this->displayname = $this->session->userdata('displayname');
		$this->profile = $this->msg_model->get_profile($this->username);
		$this->data['profile'] = $this->profile;
    }
	
	
	public function index() {
	
		if($this->session->userdata('login') == FALSE){
			redirect('login');
		}
		
		else {
			$this->data['this_page'] = 'notification';
			$this->data['booking_list'] = $this->msg_model->get_booking($this->username);
			
			$this->load->view('navbar_view', $this->data);
			$this->load->view('profile_header_tpl', $this->data);	
			$this->load->view('msg_notif_view', $this->data);
			$this->load->view('footer_view');
		}
	}
	
	
}