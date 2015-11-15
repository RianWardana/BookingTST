<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {


	public function __construct() {
        parent::__construct();
	}

	
    public function load_rules($caller) {
		if ($caller == 'login') {
			$rules = array(
				array( 'field' => 'username', 'label' => 'Username', 'rules' => 'required' ),
				array( 'field' => 'password', 'label' => 'Password', 'rules' => 'required' )
			);
		}
		
		else if ($caller == 'daftar') {
			$rules = array(
				array( 'field' => 'new_nama', 'label' => 'Nama', 'rules' => 'required|max_length[20]' ),
				array( 'field' => 'new_username', 'label' => 'Username', 'rules' => 'required|max_length[16]' ),
				array( 'field' => 'new_password', 'label' => 'Password', 'rules' => 'required|max_length[16]|md5' ),
				array( 'field' => 'new_password_repeat', 'label' => 'Password', 'rules' => 'required|matches[new_password]|md5' )
			);
		}
		
        return $rules;
	}

	
	public function check_valid($caller) {
		$rules = $this->load_rules($caller);
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run()) { return TRUE; }
		else { return FALSE; }
	}

	
    public function check_login() {
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$where = array('username' => $username, 'password' => $password);
		$query = $this->db->where($where)->limit(1)->get('user');
		
		if($query->num_rows() == 1) {
			$data = array(
				'username' => $query->row()->username,
				'kategori' => $query->row()->kategori,
				'kelas' => $query->row()->kelas,
				'displayname' => $query->row()->nama, 
				'login' => TRUE
			);
            $this->session->set_userdata($data);
			return TRUE;
		}
		
		else { return FALSE; }
	}
	
	
	public function daftar() {
		$check_username = $this->db->where('username', $this->input->post('new_username'))->limit(1)->get('user');
		$check_displayname = $this->db->where('nama', $this->input->post('new_nama'))->limit(1)->get('user');
		
		if ( ($check_username->num_rows() > 0) || ($check_displayname->num_rows() > 0) )  { return FALSE; }
	
		else {
			$data = array(
			   'username' => $this->input->post('new_username'),
			   'password' => $this->input->post('new_password'),
			   'kategori' => 0,
			   'nama' => $this->input->post('new_nama')
			);

			$this->db->insert('user', $data);
			$data = array('username' => $this->input->post('new_username'), 'displayname' => $this->input->post('new_nama'), 'login' => TRUE);
            $this->session->set_userdata($data);
			return TRUE;
		}
	}
	
	
	public function logout() {
		$this->session->unset_userdata(array('username' => '', 'login' => FALSE));
		$this->session->sess_destroy();
	}
	
}