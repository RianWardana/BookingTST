<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Daftarguru_model extends CI_Model {


	public function __construct() {
        parent::__construct();
	}

	
    public function load_rules() {	
		$rules = array(
			array( 'field' => 'new_username', 'label' => 'Username', 'rules' => 'required|max_length[3]|min_length[2]' ),
			array( 'field' => 'new_keterangan', 'label' => 'Mata Pelajaran', 'rules' => 'required|max_length[25]|min_length[4]' ),
			array( 'field' => 'new_password', 'label' => 'Password', 'rules' => 'required|max_length[16]|md5' ),
			array( 'field' => 'new_password_repeat', 'label' => 'Password', 'rules' => 'required|matches[new_password]|md5' )
		);
		
        return $rules;
	}

	
	public function check_valid() {
		$rules = $this->load_rules();
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run()) { return TRUE; }
		else { return FALSE; }
	}
	
	
	public function daftar() {
		$check_username = $this->db->where('username', $this->input->post('new_username'))->limit(1)->get('user');
		
		if ($check_username->num_rows() > 0)  { return FALSE; }
	
		else {
			$data = array(
			   'username' => $this->input->post('new_username'),
			   'password' => $this->input->post('new_password'),
			   'kategori' => 1,
			   'nama' => strtoupper($this->input->post('new_username')),
			   'keterangan' => $this->input->post('new_keterangan')
			);

			$this->db->insert('user', $data);
			$login_data = array('username' => $this->input->post('new_username'), 'login' => TRUE);
            $this->session->set_userdata($login_data);
			return TRUE;
		}
	}
	
	
}