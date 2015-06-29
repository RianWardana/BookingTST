<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('profile_model', 'profile_model', TRUE);
    }

	
	public function index() {
		if($this->session->userdata('login') == FALSE){
			redirect('login');
		}
		
		else {
		
			// UBAH PROFIL //
			if ($this->input->post('change-profile')) {
			
				// UBAH PROFIL BERHASIL -> REDIRECT DAN SET FLASH //
				if ($this->profile_model->change_profile()) {
					$this->session->set_flashdata('flash_profile', "
						<div class='ui page dimmer'>
							<div class='content'>
								<div class='center'>
									<h2 class='ui center aligned inverted icon header'><i class='massive checkmark box icon'></i>Profil Anda berhasil diperbarui</h2>
								</div>
							</div>
						</div>
						<script>
							$('.dimmer').dimmer('show');
							setTimeout(function(){ $('.dimmer').dimmer('hide'); },3000);
						</script>
					");
					redirect('profile');
				}
			}
			
			// UBAH PASSWORD //
			else if ($this->input->post('change-password')) {
				if ($this->profile_model->change_password()) {
					$this->session->set_flashdata('flash_profile', "
						<div class='ui page dimmer'>
							<div class='content'>
								<div class='center'>
									<h2 class='ui center aligned inverted icon header'><i class='massive checkmark box icon'></i>Password Anda berhasil diperbarui</h2>
								</div>
							</div>
						</div>
						<script>
							$('.dimmer').dimmer('show');
							setTimeout(function(){ $('.dimmer').dimmer('hide'); },3000);
						</script>
					");
					redirect('profile');
				} 
				
				else {
					$this->session->set_flashdata('error_password', "
						<div class='ui negative message'>Password Anda salah</div>
					");
					redirect('profile');
				}
			}
			
			// LOAD HALAMAN //
			else {
			$username = $this->session->userdata('username');
			$profile = $this->profile_model->get_profile($username);
			$this->data['profile'] = $profile;
			$this->data['this_page'] = 'profile';
			
			$this->load->view('navbar_view', $this->data);
			$this->load->view('profile_header_tpl', $this->data);
			$this->load->view('profile_view', $this->data);
			$this->load->view('footer_view');
			}
		}
	}
	
	
	// GANTI AVATAR //
	public function change_avatar() {
		$username = $this->session->userdata('username');
		$profile = $this->profile_model->get_profile($username);
		
		// USER ADALAH GURU -> BISA UPLOAD FOTO //
		if ($profile->kategori == 1) {
			$config['upload_path'] = './avatar/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $username;
			$config['max_size']	= '1024';
			$config['overwrite'] = 'TRUE';
			
			$this->load->library('upload', $config);
			
			// UPLOAD BERHASIL -> SET FLASH DAN REDIRECT //
			if ($this->upload->do_upload()) {
				$upload_data = $this->upload->data();
				$file_name = $upload_data['file_name'];
				$this->profile_model->change_avatar($username, $file_name);
				
				$this->session->set_flashdata('flash_avatar', "
					<div class='ui page dimmer'>
						<div class='content'>
							<div class='center'>
								<h2 class='ui center aligned inverted icon header'><i class='massive user icon'></i>Foto Anda berhasil tersimpan</h2>
							</div>
						</div>
					</div>
					<script>
						$('.dimmer').dimmer('show'); 
						setTimeout(function(){ $('.dimmer').dimmer('hide'); },3000);
					</script>
				");
				redirect('profile');
			}
			
			// UPLOAD GAGAL -> SET FLASH DAN REDIRECT //
			else {
				$this->session->set_flashdata('flash_avatar', "
					<div class='ui negative message'>Foto Anda gagal dikirim</div>
				");
				redirect('profile');
			}
		}
		
		// USER BUKAN GURU -> BISA PILIH 4 AVATAR //
		else {
			$gender = $this->input->post('gender');
			
			// PILIHAN FOTO BERHASIL //
			if ($gender) {
				$this->profile_model->select_avatar($username, $gender);
				
				$this->session->set_flashdata('flash_avatar', "
					<div class='ui page dimmer'>
						<div class='content'>
							<div class='center'>
								<h2 class='ui center aligned inverted icon header'><i class='massive user icon'></i>Pilihan foto Anda berhasil tersimpan</h2>
							</div>
						</div>
					</div>
					<script>
						$('.dimmer').dimmer('show'); 
						setTimeout(function(){ $('.dimmer').dimmer('hide'); },3000);
					</script>
				");
				redirect('profile');
			}
			
			// PILIHAN FOTO TIDAK VALID //
			else {
				$this->session->set_flashdata('flash_avatar', "
					<div class='ui negative message'>Pilihan foto Anda tidak valid</div>
				");
				redirect('profile'); 
			}
		}
		

	}
	
}