<!DOCTYPE HTML>
<html>
	<head>
		<title>Kiriman Pesan</title>
		<style>
			#aux-column { padding: 0px; }
			
			@media(max-width: 970px) {
				#aux-column { padding: 0px !important; }
			}
		</style>
	</head>
  

	<body>
		
		<?php
			$flash_msg = $this->session->flashdata('flash_msg');
			if(isset($flash_msg)){ echo $flash_msg; }
		?>

		
		<div id="content" style="padding: 30px 0px 50px;">
			<div class="ui stackable grid">
				<div id="aux-column" class="three wide column"></div>
				<div class="ten wide column" style="">
					<div class="ui grid">
					
						<?php include('msg_sidebar_tpl.php'); ?>
						
						<?php  /************************************MESSAGE**********************************************************************/ ?>
						<div id="msg_content" class="twelve wide column">
							<div class="ui fluid vertical menu">
								<?php
									foreach($list_guru as $guru) {
									$username = $guru->username;
									$nama = ( $profile->kategori == 0 ? strtoupper($guru->username) : ucwords($guru->nama) );
									$pelajaran = ucwords($guru->keterangan);
									$url = base_url("message/$username");
									echo "
										<a class='item' href='$url'>
											<h3 class='ui header'>
												<img class='ui circular image' src='$guru->avatar'>
												<div class='content'>
													$nama
													<div class='sub header'>$pelajaran</div>
												</div>
											</h3>
										</a>
									";}
								?>
							</div>
						</div>
						<?php /******************************************************************************************************************/ ?>
						
					</div>
				</div>
			</div>
		</div>
		
		
		<?php include_once 'js_tpl.php' ?>
		<script>
			if (window.innerWidth < 970) document.getElementById('msg_content').className = "sixteen wide column";
			else document.getElementById('msg_content').className = "twelve wide column";
			
			$(window).resize(function() {
				if (window.innerWidth < 970) document.getElementById('msg_content').className = "sixteen wide column";
				else document.getElementById('msg_content').className = "twelve wide column";
			});
		</script>
	</body>
</html>