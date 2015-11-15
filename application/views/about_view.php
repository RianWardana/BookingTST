<!DOCTYPE HTML>
<html>
	<head>
		<title>TST</title>
		<style>
			#home_banner {
				margin-top: -13px !important;
				background-color: #E2802B;
				padding-bottom: 0px;
				overflow: hidden;
			}
			
			#home_content {
				margin-top: 0px;
				padding: 0px 10% 100px;
				background-color: white;
				border-top: 1px solid #d4d4d5;
				border-bottom: 1px solid #d4d4d5;
				margin-bottom: 0px;
			}
			
			.ui.horizontal.divider { margin-top: 50px; }
			
			.text_content { padding: 0px 2% 0px; }
			.text_content ul { margin-top: -10px; margin-bottom: 30px; }
			
			
			@media(max-width: 450px) {
				#home_content {
					padding: 40px 1% 100px;
				}
			}
		</style>
	</head>
  

	<body>
		<div id="home_banner">
			<img src="<?php echo base_url('assets/header.png');?>" style="margin-bottom: -4px;">
		</div>
		
		
		<div id="home_content">
		
		
			<h1 class="ui horizontal divider">Tentang BookingTST</h1>
			<div class="text_content">
				<p>
					Saya adalah alumni bimbingan belajar Ganesha Operation di Jalan Sungai Sambas, Blok M, Jakarta Selatan. Sehingga ide pembuatan 
					aplikasi ini berangkat dari permasalahan saya sendiri sewaktu menimba ilmu di GO, yaitu sulitnya menyesuaikan waktu TST dengan 
					jam tersedia dari pengajar yang dituju.
				</p>
			</div>
			
			
			<h1 class="ui horizontal divider">Perubahan</h1>
			<div class="text_content">
				<p>Version 0.1 (06/06/15)</p>
				<ul>
					<li>Booking TST untuk jam 09.00 sampai jam 21.00</li>
					<li>Booking TST untuk tujuh hari ke depan, kecuali hari Minggu</li>
					<li>Mengirim pesan dari siswa ke guru dan sebaliknya</li>
				</ul>
				
				<p>Version 0.2 (07/06/15)</p>
				<ul>
					<li>Memperbaiki bug yang memungkinkan siswa untuk booking pada hari Minggu</li>
					<li>Menampilkan waktu pengiriman di setiap pesan</li>
				</ul>
				
				<p>Version 1.0 (08/06/15)</p>
				<ul>
					<li>Menampilkan semua booking TST yang dilakukan, di halaman Notification</li>
					<li>Memperbaiki bug yang memungkinkan siswa mengirim pesan sebagai guru dan sebaliknya</li>
					<li>Siswa tidak diperkenankan melakukan dua booking pada waktu yang bersamaan</li>
				</ul>
				
				<p>Version 1.1 (27/06/15)</p>
				<ul>
					<li>Memperbaiki bug yang menyebabkan banyak gambar gagal ditampilkan oleh browser</li>
					<li>Memperbaiki bug yang menyebabkan Halaman Notifikasi dapat diakses tanpa melakukan login</li>
				</ul>
				
				<p>Version 1.2 (03/07/15)</p>
				<ul>
					<li>Penggunaan AJAX pada Halaman Pesan, memungkinkan pengiriman dan penerimaan pesan tanpa reload browser</li>
					<li>Siswa tidak diperkenankan melakukan booking untuk waktu yang telah berlalu</li>
					<li>Memperbaiki bug yang memungkinkan siswa melakukan beberapa booking pada waktu yang bersamaan</li>
				</ul>
				
				<p>Version 1.3 (07/07/15)</p>
				<ul>
					<li>Memperbaiki bug yang memungkinkan <em>cross-site scripting</em> pada Halaman Pesan</li>
				</ul>

				<p>Version 1.4 (15/11/15)</p>
				<ul>
					<li>Penambahan fitur jadwal pada halaman Home bagi siswa terdaftar</li>
				</ul>
			</div>
	
	
		</div>
		
		
	</body>
</html>