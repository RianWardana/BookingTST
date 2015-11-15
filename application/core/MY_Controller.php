<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        session_start();
        
        if ($this->session->userdata('login') == TRUE){
            $this->data['have_login'] = TRUE;
            $this->data['session_username'] = $this->session->userdata('username');
            $this->data['session_kategori'] = $this->session->userdata('kategori');
            $this->data['session_kelas'] = $this->session->userdata('kelas');
            $this->data['session_displayname'] = $this->session->userdata('displayname'); // ini bikin error kalo nama bisa diganti
        }
		
		else{
			$this->data['have_login'] = FALSE;
		}
    }   
}