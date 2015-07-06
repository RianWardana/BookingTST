<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Masuk</title>
		
		<style>		
			.ui.header { margin-top: 40px !important; }
		</style>
		
	</head>

	<body>
		
		<?php
			include_once 'js_tpl.php';
			$login_booking = $this->session->flashdata('login_booking');
			if(isset($login_booking) && $login_booking) echo "
				<div class='ui page dimmer'>
					<div class='content'>
						<div class='center'>
							<h2 class='ui center aligned inverted icon header'><i class='massive sign in icon'></i>Silakan Login terlebih dahulu</h2>
						</div>
					</div>
				</div>
				<script>
					$('.dimmer').dimmer('show');
					setTimeout(function(){ $('.dimmer').dimmer('hide'); },3000);
				</script>
			";
		?>
		
		<div class="ui two column top aligned stackable page grid">
			<div class="column">
				<h4 class="ui horizontal header divider">
					Masuk
				</h4>
				
				
				<?php
					$error_login = $this->session->flashdata('error_login');
					if(isset($error_login)){ echo $error_login; }
				?>
				
				<form method="post" id="login-form" class="ui form segment">
					
					<div class="field">
						<label>Username</label>
						<div class="ui left icon input">
							<input required="required" type="text" name="username" placeholder="Username">
							<i class="user icon"></i>
						</div>
					</div>
					
					<div class="field">
						<label>Password</label>
						<div class="ui left icon input">
							<input required="required" type="password" name="password">
							<i class="lock icon"></i>
						</div>
					</div>
					
					<div class="ui blue submit button">Masuk</div>
					<input type="hidden" name="login_hidden" value="login">
				</form>
			</div>

			
			<div class="column" style="margin-bottom: 50px !important;">
				<h4 class="ui horizontal header divider">
					Daftar
				</h4>
				
				<?php
					$error_daftar = $this->session->flashdata('error_daftar');
					if(isset($error_daftar)){ echo $error_daftar; }
				?>
				
				<form method="post" id="daftar-form" class="ui form segment">
					<div class="field">
						<label>Nama</label>
						<div class="ui input">
							<input type="text" name="new_nama" placeholder="Terdiri dari 4 - 20 karakter" maxlength="20" value="<?php echo set_value('new_nama'); ?>">
						</div>
					</div>
					
					<div class="field">
						<label>Username</label>
						<div class="ui left icon input">
							<input type="text" name="new_username" placeholder="Terdiri dari 4 - 16 karakter" maxlength="16">
							<i class="user icon"></i>
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
					
					<div class="ui blue submit button">Daftar</div>
					<input type="hidden" name="daftar_hidden" value="daftar">
				</form>
			</div>
		</div>
			
			
		
		<?php include_once 'js_tpl.php' ?>
		<script>
			$('#login-form')
				.form({
					username: {
						identifier: 'username',
						rules: [
							{ type: 'empty', prompt: 'Isi Username Anda' } 
						]
					},
					
					password: {
						identifier: 'password',
						rules: [ 
							{ type: 'empty', prompt: 'Isi Password Anda' }
						]
					}
					
				}, { inline : false, on : 'submit' } );

		
			$('#daftar-form')
				.form({
					new_nama: {
						identifier: 'new_nama',
						rules: [ 
							{ type: 'empty', prompt : 'Isi nama Anda' },
							{ type: 'length[4]', prompt: 'Nama Anda setidaknya terdiri dari 4 karakter' }
						]
					},
					
					new_username: {
						identifier: 'new_username',
						rules: [
							{ type: 'empty', prompt: 'Isi Username Anda' },
							{ type: 'length[4]', prompt: 'Username setidaknya terdiri dari 4 karakter' }
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
							{ type: 'match[new_password]', prompt: 'Konfirmasi Password Anda tidak sesuai' } 
						]
					}

				}, { inline : false, on : 'submit' } );
		</script>
		
	</body>
</html>