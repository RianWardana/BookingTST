<!DOCTYPE HTML>
<html>
	<head>
		<title>Kiriman Pesan</title>
		<style>
			#aux-column { padding: 0px; }
			
			@media(max-width: 550px) {
				#aux-column { padding: 0px !important; }
			}
			
			@media (min-width: 550px) and (max-width: 768px) {
				#aux-column { padding: 0px !important; }
			}
			
		</style>
	</head>
  

	<body>
		
		
		<div id="content" style="padding: 30px 0px 50px;">
			
			<div class="ui stackable grid">
				<div id="aux-column" class="three wide column"></div>
				<div class="ten wide column" style="">
					<div class="ui grid">
						
						<?php include('msg_sidebar_tpl.php'); ?>
						
						<?php /******************************************************************************************************************/ ?>
						<div id="msg_content" class="twelve wide column">
							<div class="ui selection list">
								
								<?php
									setlocale(LC_ALL, 'IND', 'id_ID');
									foreach($booking_list as $booking) {
										$mulai_unix = strtotime($booking->jam_mulai);
										$mulai_tanggal = strftime('%A %d %B', $mulai_unix);
										$mulai_tanggal_link = date('Y-m-d', $mulai_unix);
										$mulai_jam = date('H.i', $mulai_unix);
										$bubar_unix = strtotime($booking->jam_bubar);
										$bubar_jam = date('H.i', $bubar_unix);
										$url = base_url("booking/". strtolower($booking->terbooking) ."/$mulai_tanggal_link");
										echo "
											<a href='$url' class='item'>
												<img class='ui avatar image' src='{$booking->avatar}'>
												<div class='content'>
													<div class='header'>
														Booking ". ($profile->kategori == 0 ? "ke {$booking->terbooking}" : "dari {$booking->pembooking}") ."
													</div>
													<div class='description'>$mulai_tanggal, $mulai_jam - $bubar_jam</div>
												</div>
											</a>
										";
									}
									
									if (empty($booking_list)) echo "
										<div class='ui message'>
											<p class='header'>Notifikasi Anda kosong</p>" . 
											
											($profile->kategori == 0 ? 
											"<ul class='list'>Booking yang Anda lakukan di <a href='booking'>Halaman Booking</a> akan ditampilkan di sini</ul>" : 
											"<ul class='list'>Daftar siswa yang mengirim booking kepada Anda akan ditampilkan di sini</ul>") . 
											
										"</div>"
									;
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