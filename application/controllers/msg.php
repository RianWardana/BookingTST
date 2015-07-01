<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msg extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('msg_model', 'msg_model', TRUE);
		$this->username = $this->session->userdata('username');
		$this->profile = $this->msg_model->get_profile($this->username);
    }
	
	
	public function index($rx = '') {
		
		if ($this->session->userdata('login') == FALSE) echo 'Situ kan belom login';
		
		// USER SUDAH LOGIN -> YUK MULAI //
		else {
			$check_rx = $this->msg_model->check_rx($rx, $this->profile);
			if ( ($rx == '') || !$check_rx ) echo 'Apa nih?';
			
			// RX ADA -> AYOK //
			else {
				
				if ($this->input->post('text_input')) { 
					$this->msg_model->send_msg($this->input->post('terkirim'));
				}
				
				else {
					$result = $this->msg_model->get_msg($this->profile, $rx);
					$data = '[ ';
					foreach($result as $msg) {
						if ($data != '[ ') $data .= ', ';
						$data .= '{ ';
						$data .= '"waktu" : ' . '"' . $msg->waktu . '", ';
						$data .= '"pengirim" : ' . '"' . $msg->pengirim . '", ';
						$data .= '"terkirim" : ' . '"' . $msg->terkirim . '", ';
						$data .= '"pesan" : ' . '"' . $msg->pesan . '"';
						$data .= ' }';
					}
					$data .= ' ]';
					echo $data;
				}
			}
		}
		
	}

	
}