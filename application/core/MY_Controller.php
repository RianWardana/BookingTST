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
        }
		
		else{
			$this->data['have_login'] = FALSE;
		}
    }   
}