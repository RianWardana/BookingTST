<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model {

	public function __construct(){
        parent::__construct();
	}
	
	
	public function get_profile() {
		if ($this->session->userdata('login')) {
			$user = $this->session->userdata('username');
			return $this->db->where('username', $user)->limit(1)->get('user')->row();
		}
		else {return FALSE;}
	}
	
	
	public function check_guru($guru) {
		$check_query = $this->db->where(array('username' => $guru, 'kategori' => 1))->limit(1)->get('user');
		if ($check_query->num_rows() > 0) { return $check_query->row(); }
		else { return FALSE; }
	}
	
	
	public function list_guru() {
		return $this->db->where('kategori', 1)->order_by('username', 'asc')->get('user')->result();
	}
	
	
	public function get_booking($guru, $tanggal) {
		return $this->db->query("SELECT *, 
									HOUR(`jam_mulai`) AS 'h_mulai', 
									MINUTE(`jam_mulai`) AS 'm_mulai', 
									HOUR(`jam_bubar`) AS 'h_bubar', 
									MINUTE(`jam_bubar`) AS 'm_bubar'  
									FROM `booking` 
									WHERE `terbooking` = '{$guru}' AND DATE(`jam_mulai`) = '{$tanggal}' 
									ORDER BY `jam_mulai` ASC
								")->result();
	}
	
	
	public function get_booking_qty($guru, $tanggal) {
		return $this->db->query("SELECT *  
									FROM `booking` 
									WHERE `terbooking` = '{$guru}' AND DATE(`jam_mulai`) = '{$tanggal}' 
								")->num_rows();
	}
	
	
	public function udah_booking($tanggal, $waktu_mulai, $waktu_bubar) {
		$pembooking = $this->get_profile($this->session->userdata('username'))->nama;

		$result = $this->db->query("
			SELECT * FROM `booking` WHERE `pembooking` = '$pembooking' AND date(`jam_mulai`) = '$tanggal' ORDER BY `jam_mulai` ASC
		")->result();
		
		foreach ($result as $booking) {
			if 	(	( ($waktu_mulai >= strtotime($booking->jam_mulai)) && ($waktu_mulai < strtotime($booking->jam_bubar)) ) ||
					( ($waktu_bubar > strtotime($booking->jam_mulai)) && ($waktu_bubar <= strtotime($booking->jam_bubar)) ) ||
					( ($waktu_mulai <= strtotime($booking->jam_mulai)) && ($waktu_bubar >= strtotime($booking->jam_bubar)) ) 
				) {
					$mulai = date("H:i", strtotime($booking->jam_mulai));
					$bubar = date("H:i", strtotime($booking->jam_bubar));
					return "
						<li>Anda telah mengirim booking untuk jam $mulai - $bubar kepada {$booking->terbooking}</li>
						<li>Cek semua booking yang telah Anda kirimkan di halaman <a href='". base_url('notification') ."'>Notification</a></li>
					";
					break; 
			}
		}
		return FALSE;
	}
	
	public function udah_lewat($waktu_mulai) {
		if ($waktu_mulai <= time())
		return TRUE;
		else
		return FALSE;
	}
	
	public function create_booking($guru, $tanggal) {
	
		$waktu_mulai = min(strtotime($tanggal . ' ' . $this->input->post('input_mulai')), strtotime($tanggal . ' ' . $this->input->post('input_bubar')));
		$waktu_bubar = max(strtotime($tanggal . ' ' . $this->input->post('input_mulai')), strtotime($tanggal . ' ' . $this->input->post('input_bubar')));
		
		if ($waktu_mulai == $waktu_bubar) return 'Anda mengirim booking dengan durasi kurang dari satu menit';
		else if ($this->udah_booking($tanggal, $waktu_mulai, $waktu_bubar)) return $this->udah_booking($tanggal, $waktu_mulai, $waktu_bubar);
		else if ($this->udah_lewat($waktu_mulai)) return 'Anda mengirim booking untuk waktu yang telah berlalu';
		
		else {
			$data = array(
				'pembooking' => $this->session->userdata('displayname'),
				'terbooking' => strtoupper($guru),
				'jam_mulai' => date("Y-m-d H:i:s", $waktu_mulai),
				'jam_bubar' => date("Y-m-d H:i:s", $waktu_bubar)
			);
			
			$this->db->insert('booking', $data); 
			return 'sukses';
		}
	}
	
	
	public function batal_booking($id) {
		$this->db->where('id', $id)->delete('booking');
		return TRUE;
	}
}