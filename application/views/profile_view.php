<!DOCTYPE HTML>
<html>
	<head>
		<title>Profil</title>
		<style>
			#save-1, #save-2 {
				margin-top: 0px;
				padding-top: 0px;
			}
			
			#avatar_button {
				position: relative;
			}
			
			#avatar_button input[type=file] {
				position: absolute;
				top: 0;
				right: 0;
				min-width: 100%;
				min-height: 100%;
				font-size: 100px;
				text-align: right;
				filter: alpha(opacity=0);
				opacity: 0;
				background: red;
				cursor: inherit;
				display: block;
			}
			

		</style>
	</head>
  

	<body>
		
	<?php
		$flash_profile = $this->session->flashdata('flash_profile');
		if(isset($flash_profile)){ echo $flash_profile; }
	?>
	
	
	<div id="content">
			<?php /***********************************************FOTO PROFIL********************************************************************/ ?>
			<div id="divider-content" class="ui stackable grid">
				<div id="aux-column" class="three wide column"></div>
				<form class="ten wide column" method="post" enctype="multipart/form-data" action="<?php echo base_url('profile/change_avatar');?>">
					<h4 class="ui horizontal divider">Foto Profil</h4>
					
					<?php
						$flash_avatar = $this->session->flashdata('flash_avatar');
						if(isset($flash_avatar)){ echo $flash_avatar; }
					?>
					
					<?php
						if ($profile->kategori == 1) { echo "
							<div class='ui message'>
								Foto harus berbentuk persegi dan besarnya kurang dari 1 MB
							</div>
							
							<div id='select_avatar' class='ui fluid left action input' style='margin-top: 0px; margin-bottom: 20px;'>
								<div id='avatar_button' class='ui blue button'>
									Pilih Foto
									<input type='file' name='userfile'>
								</div>
								<input type='text' readonly>
							</div>
							
							<div id='upload' class='ui center aligned basic segment'>
								<input type='submit' class='ui green submit button' value='Upload Foto'>
							</div>
						";}
						
						else { echo "
							<div class='ui fluid selection dropdown' style='margin-bottom: 20px;'>
								<input type='hidden' name='gender'>
								<div class='default text'>Pilih foto profil</div>
								<i class='dropdown icon'></i>
								<div class='menu'>
									<div class='item' data-value='1'>Laki-laki</div>
									<div class='item' data-value='2'>Laki-laki berkacamata</div>
									<div class='item' data-value='3'>Perempuan</div>
									<div class='item' data-value='4'>Perempuan berkacamata</div>
								</div>
							</div>
							
							<div class='ui center aligned basic segment'>
								<input type='submit' class='ui green submit button' value='Ganti Foto'>
							</div>
						";}
					?>
					
					
				</form>
			</div>
			<?php /******************************************************************************************************************************/ ?>
		
		
			<?php /**************************************************PROFIL**********************************************************************/ ?>
			<div class="ui stackable grid">
				<div id="aux-column" class="three wide column"></div>
				
				<div class="ten wide column">
					<h4 class="ui horizontal divider">Profil Anda</h4>

					<form method="post" class="ui form" id="change-profile">
						<div class="three fields">
							<div class=" field">
								<label>Username</label>
								<input type="text" value="<?php echo ($profile->kategori == 0 ? $profile->username : strtoupper($profile->username));?>" readonly>
							</div>
							
							<div class=" field">
								<label>Nama</label>
								<input type="text" maxlength="20" name="change_nama" value="<?php echo ucwords($profile->nama);?>" readonly>
							</div>
							
							<div class=" field">
								<label><?php echo ($profile->kategori == 0 ? 'Sekolah' : 'Mata Pelajaran');?></label>
								<input type="text" maxlength="25" name="change_keterangan" value="<?php echo ucwords($profile->keterangan);?>">
							</div>
						</div>
						<input type="hidden" name="change-profile" value="profile">
						<div id="save-1" class="ui center aligned basic segment">
							<input type="submit" class="ui green submit button" value="Perbarui Profil Saya">
						</div>
					</form>
				</div>
			</div>
			<?php /******************************************************************************************************************************/ ?>
			
			
			<?php /**************************************************PASSWORD********************************************************************/ ?>
			<div class="ui stackable grid">
				<div id="aux-column" class="three wide column"></div>
				
				<div class="ten wide column">
					<h4 class="ui horizontal divider">Ganti Password</h4>
					
					<?php
						$error_password = $this->session->flashdata('error_password');
						if(isset($error_password)){ echo $error_password; }
					?>
					
					<form method="post" class="ui form" id="change-password">
						<div class="three fields">
							<div class=" field">
								<label>Password sekarang</label>
								<input type="password" maxlength="16" name="password">
							</div>
							
							<div class=" field">
								<label>Password baru</label>
								<input type="password" maxlength="16" name="new_password">
							</div>
							
							<div class=" field">
								<label>Konfirmasi password baru</label>
								<input type="password" maxlength="16" name="new_password_repeat">
							</div>
						</div>
						<input type="hidden" name="change-password" value="password">
						<div id="save-2" class="ui center aligned basic segment">
							<input type="submit" class="ui green submit button" value="Ganti Password Saya">
						</div>
					</form>
				</div>
			</div>
			<?php /******************************************************************************************************************************/ ?>
		</div>
	
	
	
	
	
	
	
		
		<?php include_once 'js_tpl.php' ?>
		<script>
			$('#change-profile')
				.form({
					
					change_keterangan: {
						identifier: 'change_keterangan',
						rules: [ 
							{ type: 'empty', prompt: 'Tulis Mata Pelajaran Anda' }
						]
					}
					
				});
				
				
			$('#change-password')
				.form({
					password: {
						identifier: 'password',
						rules: [
							{ type: 'empty', prompt: 'Isi Password Anda' } 
						]
					},
					
					new_password: {
						identifier: 'new_password',
						rules: [ 
							{ type: 'empty', prompt: 'Isi Password Anda' }
						]
					},
					
					new_password_repeat: {
						identifier: 'new_password_repeat',
						rules: [ 
							{ type: 'match[new_password]', prompt: 'Konfirmasi Password Anda tidak sesuai' }
						]
					}
					
				}, { inline : false, on : 'submit' } );
				
				
				
				$(document).on('change', '#avatar_button :file', function() {
				  var input = $(this),
					  numFiles = 1,
					  label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				  input.trigger('fileselect', [numFiles, label]);
				});

				$(document).ready( function() {
					$('#avatar_button :file').on('fileselect', function(event, numFiles, label) {
						
						var input = $(this).parents('#select_avatar').find(':text'),
							log = label;
						
						if( input.length ) {
							input.val(log);
						} else {
							if( log ) alert(log);
						}
						
					});
				});
				
				$('.ui.dropdown')
				  .dropdown()
				;
		</script>
	</body>
</html>