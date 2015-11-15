<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model {

	public function __construct(){
        parent::__construct();
	}
	
	
	public function get_profile($username) {
		return $this->db->where('username', $username)->limit(1)->get('user')->row();
	}
	
	
	public function change_avatar($username, $file_name) {
		$this->db->where('username', $username)->update('user', array('avatar' => base_url("/avatar/$file_name")) );
	}
	
	
	public function select_avatar($username, $gender_id) {
		$path = array(
			'',
			'http://semantic-ui.com/images/avatar/large/chris.jpg',
			'http://semantic-ui.com/images/avatar/large/elliot.jpg',
			'http://semantic-ui.com/images/avatar/large/helen.jpg',
			'http://semantic-ui.com/images/avatar/large/stevie.jpg'
		);
		
		$this->db->where('username', $username)->update('user', array('avatar' => $path[(int)$gender_id]) );
	}
	
	
	public function change_profile() {
		$username = $this->session->userdata('username');
		
		if ($this->get_profile($username)->kategori == 3) //ga da yg bs gnt nama
			$data = array(
			   'nama' => $this->input->post('change_nama'),
			   'keterangan' => $this->input->post('change_keterangan')
			);
		
		else
			$data = array(
			   'keterangan' => $this->input->post('change_keterangan'),
			   'kelas' => $this->input->post('kelas')
			);
		
		$this->db->where('username', $username)->update('user', $data);
		$this->session->set_userdata(array( 'kelas' => $this->input->post('kelas') ));
		return TRUE;
	}
	
	
	public function change_password() {
		$username = $this->session->userdata('username');
		$password_db = $this->db->where('username', $username)->get('user')->row()->password;
		$password_input = md5($this->input->post('password'));
		
		if ($password_input == $password_db) {
			$this->db->where('username', "$username")->update('user', array('password' => md5($this->input->post('new_password'))));
			return TRUE;
		} else { return FALSE; }
	}
}