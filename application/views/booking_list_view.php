<!DOCTYPE HTML>
<html>
	<head>
		<title>Booking TST</title>
		<style>
			@media (max-width: 768px) {
				.ui.basic.segment h2 { margin-bottom: 28px; }
				.ui.four.column.stackable.grid .column { padding-top: 0px !important; }
			}
		</style>
	</head>
  

	<body>
		
		
		
	<div id="booking-header">
		<div class="ui stackable page grid">
			<div class="column" style="">
				<div class="ui basic segment">
					<h2>Guru Terdaftar</h2>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="ui four column stackable page grid">
		<?php
			foreach($list_guru as $guru) { 
			$nama = strtoupper($guru->username);
			$pelajaran = ucwords($guru->keterangan);
			$url = base_url("booking/$nama");
			echo "
				<div class='column'>
					<a href='$url'>
						<div class='ui segment'>
							<h2 class='ui header'>
								<img class='ui circular image' src='$guru->avatar'>
								<div class='content'>
								$nama
								<div class='sub header'>$pelajaran</div>
								</div>
							</h2>
						</div>
					</a>
				</div>
			";}
		?>
	</div>
	
	<?php include_once 'js_tpl.php' ?>
	</body>
</html>      