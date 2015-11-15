<!DOCTYPE HTML>
<html>
	<head>
	</head>
  

	<body>
		<h1 class="ui horizontal divider">Jadwal</h1>
		<div class="text_content">
			<table class="ui celled unstackable table">
				<thead>
					<tr>
						<th id="header" class="center aligned" colspan="3">Memuat jadwal...</th>
					</tr>
					<tr>
						<th>Hari</th>
						<th>Tanggal</th>
						<th>Pelajaran</th>
					</tr>
				</thead>
				<tbody id="jadwal">
				</tbody>
			</table>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$.ajax({
					url: 'http://jadwal.bookingtst.com/api/kelas/' + <?php echo $kelas; ?>,
					success: function(string) {
						row = JSON.parse(string);
						$.each(row, function(i, kelas){
							header = 'Kelas ' + kelas.kelas + ', ' + 'Ruang ' + kelas.ruang
						});
						$('#header').html(header);
					}
				})

				$.ajax({
					url: 'http://jadwal.bookingtst.com/api/cari/' + <?php echo $kelas; ?>,
					success: function(string) {
						row = JSON.parse(string);
						var html = '';
						$.each(row, function(i, jadwal){
							html += "<tr>" +
										"<td>" + jadwal.hari + "</td>" +
										"<td>" + jadwal.tanggal + "</td>" +
										"<td>" + jadwal.p1 + "</br>" + jadwal.p2 + "</td>" +
									"</tr>" 
							;
						});
						$('#jadwal').html(html);
					}
				})
			});
		</script>
	</body>
</html>