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
		
			<h1 class="ui horizontal divider">Pembukaan</h1>
			<div class="text_content">
				<p>
					Tutorial Service Time, atau TST, adalah salah satu layanan yang disediakan oleh Ganesha Operation untuk siswa yang membutuhkan 
					waktu tambahan untuk konsultasi mengenai materi pelajaran. Selama ini layanan TST telah berhasil membantu siswa yang kesulitan 
					pada mata pelajaran tertentu, untuk bangkit dan mentransformasikan materi-materi yang tadinya dirasa sulit menjadi semudah 
					membalikkan telapak tangan.
				</p>
				
				<p>
					Keberhasilan layanan TST diindikasikan dengan meningkatnya pengguna TST secara signifikan, terlebih menjelang pekan ujian. 
					Namun karenanya, tak sedikit siswa yang batal menggunakan layanan TST karena kesediaan pengajar dan waktu yang terbatas, 
					serta kurangnya koordinasi antara siswa dengan pengajar. 
					Oleh karenanya, fitur booking TST menjadi suatu kebutuhan yang esensial untuk kenyamanan dan kebutuhan siswa belajar.
				</p>
			</div>
			
			
			<h1 class="ui horizontal divider">Panduan</h1>
			<div class="text_content">
				<p>Login dan pendaftaran akun</p>
				<ul>
					<li>Booking TST dan fitur lainnya hanya dapat digunakan setelah login ke akun masing-masing di <a href="login">Halaman Login</a></li>
					<li>Guru dapat membuat akun di <a href="daftarguru">Halaman Daftar Guru</a></li>
					<li>Siswa dapat membuat akun di <a href="login">Halaman Login</a></li>
				</ul>
				
				<p>Booking TST</p>
				<ul>
					<li>Siswa dapat melakukan booking melalui <a href="booking">Halaman Booking</a></li>
					<li>Daftar guru yang terdaftar akan bertambah dengan sendirinya seiring dengan bertambahnya guru yang membuat akun</li>
					<li>Siswa dapat melakukan booking untuk tujuh hari ke depan</li>
					<li>Siswa tidak dapat melakukan booking untuk hari Minggu</li>
					<li>Siswa tidak dapat melakukan beberapa booking dengan waktu yang sama atau bertumpang tindih</li>
					<li>Siswa dapat memantau booking yang sudah dilakukan di <a href="notification">Halaman Notifikasi</a></li>
				</ul>
				
				<p>Mengirim pesan</p>
				<ul>
					<li>Siswa dan guru dapat saling mengirim pesan di <a href="message">Halaman Pesan</a></li>
				</ul>
				
				<p>Halaman Profil</p>
				<ul>
					<li>Siswa dan guru dapat melakukan perubahan detail profil di <a href="profile">Halaman Profil</a></li>
					<li>Siswa dapat memilih salah satu dari empat foto yang telah disediakan untuk dijadikan foto profil</li>
					<li>Guru dapat mengupload sebuah foto untuk dijadikan foto profil</li>
					<li>Foto yang diupload wajib berbentuk persegi dan berukuran kurang dari 1 MB</li>
					<li>Siswa dan guru dapat mengubah password bilamana perlu</li>
				</ul>
			</div>
		
	
		</div>
	
		
	</body>
</html>