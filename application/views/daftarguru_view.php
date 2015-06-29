<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Daftar sebagai Guru</title>
		
		<style>		
			.ui.header { margin-top: 40px !important; }
		</style>
		
	</head>

	<body>
		
		<?php
			$login_booking = $this->session->flashdata('login_booking');
			if(isset($login_booking)){ echo $login_booking; }
		?>
		
		<div class="ui two column center aligned stackable page grid">

			
			<div class="left aligned column" style="margin-bottom: 50px !important;">
				<h4 class="ui horizontal header divider">
					Daftar Guru
				</h4>
				
				<?php
					$error_daftar = $this->session->flashdata('error_daftar');
					if(isset($error_daftar)){ echo $error_daftar; }
				?>
				
				<form method="post" id="daftar-form" class="ui form segment">
					
					<div class="field">
						<label>Username</label>
						<div class="ui left icon input">
							<input type="text" name="new_username" placeholder="Terdiri dari 2 - 3 karakter" maxlength="3">
							<i class="user icon"></i>
						</div>
					</div>
					
					<div class="field">
						<label>Mata Pelajaran</label>
						<div class="ui left icon input">
							<input type="text" name="new_keterangan" placeholder="Terdiri dari 4 - 25 karakter" maxlength="25">
							<i class="student icon"></i>
						</div>
					</div>
					
					<div class="field">
						<label>Password</label>
						<div class="ui left icon input">
							<input type="password" name="new_password" maxlength="16" placeholder="Maksimal 16 karakter">
							<i class="lock icon"></i>
						</div>
					</div>
					
					<div class="field">
						<label>Konfirmasi Password</label>
						<div class="ui left icon input">
							<input type="password" name="new_password_repeat" maxlength="16" placeholder="Ulangi Password">
							<i class="lock icon"></i>
						</div>
					</div>
					
					 <div class="ui error message"></div>
					<div class="ui blue submit button">Daftar</div>
					<input type="hidden" name="daftar_hidden" value="daftar">
				</form>
			</div>
			
			
		</div>
			
			
		
		<script>
			
			$('#daftar-form')
				.form({
					
					new_username: {
						identifier: 'new_username',
						rules: [
							{ type: 'empty', prompt: 'Isi Username Anda' },
							{ type: 'length[2]', prompt: 'Username setidaknya terdiri dari 2 karakter' }
						]
					},
					
					new_keterangan: {
						identifier: 'new_keterangan',
						rules: [
							{ type: 'empty', prompt: 'Isi Mata Pelajaran Anda' },
							{ type: 'length[4]', prompt: 'Tuliskan nama Mata Pelajaran secara lengkap' }
						]
					},
					
					new_password: {
						identifier  : 'new_password',
						rules: [ 
							{ type: 'empty', prompt: 'Isi Password Anda' }
						]
					},
					
					new_password_repeat: {
						identifier  : 'new_password_repeat',
						rules: [ 
							{ type: 'empty', prompt: 'Ulangi password Anda' },
							{ type: 'match[new_password]', prompt: 'Konfirmasi Password Anda tidak sesuai' } 
						]
					}

				}, { inline : false, on : 'submit' } );
		</script>
		
	</body>
</html>