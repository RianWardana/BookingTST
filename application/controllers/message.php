<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('msg_model', 'msg_model', TRUE);
		$this->username = $this->session->userdata('username');
		$this->displayname = $this->session->userdata('displayname');
		$this->profile = $this->msg_model->get_profile($this->username);
		$this->data['profile'] = $this->profile;
    }
	
	
	public function index($rx = '') {
		if($this->session->userdata('login') == FALSE) redirect('login');
		
		else {
			$check_rx = $this->msg_model->check_rx($rx, $this->profile);
			
			// TUJUAN KOSONG ATAU TIDAK VALID -> LOAD DAFTAR CHAT //
			if ( ($rx == '') || !$check_rx ) {
				$this->data['this_page'] = 'message';
				$this->data['msg_list'] = $this->msg_model->get_msg_list($this->username);
				
				$this->load->view('navbar_view', $this->data);
				$this->load->view('profile_header_tpl', $this->data);	
				$this->load->view('msg_view', $this->data);
				$this->load->view('footer_view');
			}
			
			// TUJUAN ADA -> YUK CHATTING //
			else {		
				$this->data['this_page'] = 'chat';
				$this->data['rx_data'] = $this->msg_model->get_profile($rx);
				
				$this->load->view('msg_chat_view', $this->data);
			}
			
		}
	}
	
	
	public function msg_list() {
		if ($this->session->userdata('login') == FALSE) redirect('login');
		
		else {
			$this->data['this_page'] = 'msg_list';
			$this->data['list_guru'] = $this->msg_model->list_guru();
			$this->load->view('navbar_view', $this->data);
			$this->load->view('profile_header_tpl', $this->data);
			$this->load->view('msg_list_view', $this->data);
			$this->load->view('footer_view');
		}
	}
	
}