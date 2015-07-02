<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Msg_model extends CI_Model {

	public function __construct(){
        parent::__construct();
	}
	
	
	public function get_profile($username) {
		return $this->db->where('username', $username)->limit(1)->get('user')->row();
	}
	
	
	public function get_booking($username) {
		$user_data = $this->get_profile($username);
		$nama = $user_data->nama;
		$user = ($user_data->kategori == 0 ? 'pembooking' : 'terbooking');
		$target = ($user_data->kategori == 0 ? 'terbooking' : 'pembooking');
		
		return $this->db->query("
			SELECT booking.id, booking.pembooking, booking.terbooking, booking.jam_mulai, booking.jam_bubar, user.avatar FROM `booking` 
			LEFT JOIN `user` ON booking.$target = user.nama 
			WHERE unix_timestamp(booking.jam_bubar) > unix_timestamp() AND booking.$user = '$nama' ORDER BY booking.jam_mulai ASC
		")->result();
	}
	
	
	public function list_guru() {
		$kategori = ($this->get_profile($this->session->userdata('username'))->kategori == 0 ? 1 : 0);
		return $this->db->where('kategori', $kategori)->order_by('username', 'asc')->get('user')->result();
	}
	
	
	public function check_rx($rx, $profile) {
		if ($profile->kategori == 0) $check_query = $this->db->where(array('username' => $rx, 'kategori' => 1))->limit(1)->get('user');
		else $check_query = $this->db->where(array('username' => $rx, 'kategori' => 0))->limit(1)->get('user');
		if ($check_query->num_rows() > 0) { return $check_query->row(); }
		else { return FALSE; }
	}
	
	
	public function get_msg_list($username) {
		return $this->db->query("
			SELECT waktu, pengirim, terkirim, pesan, user.avatar, user.nama FROM (
			SELECT * FROM (SELECT * FROM (SELECT * FROM `message` WHERE `terkirim` = '$username' ORDER BY `waktu` DESC) AS satu GROUP BY `pengirim`) AS dua ORDER BY `waktu` DESC
			) AS tiga LEFT JOIN `user` ON pengirim = user.username
		")->result();
	}
	
	
	public function get_msg($profile, $target) {
		$us = $profile->username;
		return $this->db->query("
			SELECT * FROM `message` WHERE '$us' IN(`pengirim`, `terkirim`) 
			AND 
			'$target' IN(`pengirim`, `terkirim`) ORDER BY `waktu` ASC
		")->result();
	}
	
	
	public function send_msg($rx) {
		$data = array(
			'waktu' => date("Y-m-d H:i:s", time()),
			'pengirim' => $this->session->userdata('username'),
			'terkirim' => $rx,
			'pesan' => $this->input->post('text_input')
		);
		$this->db->insert('message', $data);
	}
	
	
}