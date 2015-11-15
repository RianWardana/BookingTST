<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Index_model extends CI_Model {

	public function __construct(){
        parent::__construct();
	}
	
	
	public function get_kelas($username) {
		$query = "SELECT `kelas` FROM `user` WHERE `username` = '{$username}'";
		return $this->db->query($query)->row()->kelas;
	}
}