<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('booking_model', 'booking_model', TRUE);
    }

	
	public function index($guru = '', $tanggal = ''){
		$profile = $this->booking_model->get_profile();
		$check_guru = $this->booking_model->check_guru($guru);
		$this->data['user'] = $this->session->userdata('displayname');
		$this->data['this_page'] = 'booking';
		
		// CEK VALIDITAS TANGGAL -> KALKULASIKAN TANGGAL YANG VALID //
		$tanggal_sekarang = date("Y-m-d");
		$max_limit = strtotime($tanggal_sekarang) + 604800;
		$min_limit = strtotime($tanggal_sekarang);
		if ($tanggal == '') $tanggal = $tanggal_sekarang;
		else if (strtotime($tanggal) > $max_limit) $tanggal = date("Y-m-d", $max_limit);
		else if (strtotime($tanggal) < $min_limit) $tanggal = date("Y-m-d", $min_limit);
		if ( date("l", strtotime($tanggal)) == 'Sunday' ) $tanggal = date("Y-m-d", strtotime($tanggal) + 86400);
		
		
		// PARAMETER GURU KOSONG ATAU TIDAK VALID //
		if ( ($guru == '') || !$check_guru ) {
			
			// USER ADALAH GURU -> REDIRECT KE HALAMAN BOOKING USER //
			if ( ($profile) && ($profile->kategori == 1) ) { redirect("booking/$profile->username"); }
			
			// USER BUKAN GURU -> LOAD DAFTAR GURU //
			else {
				$this->data['list_guru'] = $this->booking_model->list_guru();
				$this->load->view('navbar_view', $this->data);
				$this->load->view('booking_list_view', $this->data);
			}
		}
		
		
		// PARAMETER GURU ADA DAN VALID //
		else {
			// USER KLIK KIRIM BOOKING //
			if ($this->input->post('booking_submit')) {
				
				// CEK APAKAH USER SUDAH LOGIN //
				if ($this->session->userdata('login')){
					
					// BOOKING BERHASIL -> REDIRECT DAN SET DIMMER //
					if ($this->booking_model->create_booking($guru, $tanggal) == 'sukses') {
						$this->session->set_flashdata('dimmer_booking', "
							<i class='massive book icon'></i>Booking Anda berhasil dikirim
						");
						redirect("booking/$guru/$tanggal");
					} 
					
					else {
						$this->session->set_flashdata('flash_booking', $this->booking_model->create_booking($guru, $tanggal));
						redirect("booking/$guru/$tanggal");
					}
				}
				
				// USER BELUM LOGIN -> REDIRECT KE LOGIN DAN SET FLASH //
				else {
					$this->session->set_flashdata('login_booking', true);
					redirect('login');
				}
			}
			
			
			// USER MEMBATALKAN BOOKING -> REFRESH DAN SET DIMMER //
			else if ($this->input->post('booking_batal')) {
				if ($this->booking_model->batal_booking($this->input->post('booking_batal'))) {
					$this->session->set_flashdata('dimmer_booking', "
						<i class='massive remove circle icon'></i>Booking berhasil dibatalkan
					");
					redirect("booking/$guru/$tanggal");
				}
			}
			
			// USER ADALAH GURU TAPI AKSES HLM BOOKING GURU LAIN -> REDIRECT KE HLM BOOKING USER //
			else if ( ($profile) && ($profile->kategori == 1) && ($guru != $profile->username) ) { redirect("booking/$profile->username"); }
			
			// USER BARU BUKA HALAMAN BOOKING //
			else {
				// SIAPKAN DATA YANG DIBUTUHKAN -> LOAD HALAMAN //
				$this->data['profile'] = $profile;
				$this->data['guru'] = $check_guru;
				$this->data['tanggal'] = $tanggal;
				$this->data['book_list'] = $this->booking_model->get_booking($guru, $tanggal);
				$this->data['book_qty'] = $this->booking_model->get_booking_qty($guru, $tanggal);
				$this->load->view('navbar_view', $this->data);
				$this->load->view('booking_view', $this->data);
				$this->load->view('footer_view');
			}
		}
	}
	
}