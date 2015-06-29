<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo strtoupper($guru->username) . ' - ' . ucwords($guru->keterangan); ?></title>
		<style>
			form .ui.basic.vertical.segment.ascend {
				margin-bottom: -50px !important;
			}
			
			@media (max-width: 767px) {
				form .content .ui.two.column.stackable.grid { padding-bottom: 50px; }
			}
		</style>
	</head>
  

	<body>
		
		
		
		<div id="booking-header">
			<div class="ui stackable grid">
		
				<div class="five wide column" style="">
					<div class="ui basic segment">
						<img id="avatar" class="ui small circular image right floated" src="<?php echo $guru->avatar; ?>">
					</div>
				</div>
				
				<div class="eleven wide column" style="">
					<div class="ui basic segment">
						<div id="aux-segment" class="ui basic vertical segment"></div>
						
						<div id="profile-segment" class="ui basic vertical segment">
							<div class="ui huge header">
								<?php echo strtoupper($guru->username);?>
								<div class="sub header"><?php echo ucwords($guru->keterangan);?></div>
							</div>
						</div>
						
						<div id="aux-segment" class="ui basic vertical segment"></div>
					</div>
				</div>
				
			</div>
		</div>
		
		<div id="tab">
			<div class="ui stackable grid" style="padding-bottom: 0px;">
				<div id="aux-column" class="three wide column"></div>
				<div class="ten wide column">
					<div class="ui tabular menu">
						<?php
							if ($have_login) {
								echo ($profile->username == $guru->username ? "
										<a class='active item' href='". base_url('booking') ."'>Booking ke Saya</a>
										<a class='item' href='". base_url('message') ."'>Kiriman Pesan</a>
										<a class='item' href='". base_url('profile') ."'>Profil Saya</a>
									" : "
										<a href='". base_url('booking') ."' class='active item'>Booking TST</a>
										<a href='". base_url("message/{$guru->username}") ."' class='item'>Kirim Pesan</a>
								");
							}
							
							else { echo "
									<a href='". base_url('booking') ."' class='active item'>Booking TST</a>
									<a href='". base_url("message/{$guru->username}") ."'class='item'>Kirim Pesan</a>
							";}
						?>
					</div>
				</div>
			</div>
		</div>
		
		<div id="content">
		
			<div id="divider-content" class="ui stackable grid">
				<div id="aux-column" class="three wide column"></div>
				<div class="ten wide column">
					<h4 class="ui horizontal divider">Pilih tanggal</h4>
					<div class="ui basic center aligned segment">
						Anda dapat memilih tanggal dalam rentang waktu satu minggu ke depan.
					</div>
				</div>
			</div>
		
			<center>
				<div class="ui big input" style="margin-top: 10px;">
					<input type="date" class="datepicker" data-value="<?php echo $tanggal; ?>" style="text-align:center;">
				</div>	
			</center>
			
			<div id="divider-content" class="ui stackable grid">
				<div id="aux-column" class="three wide column"></div>
				<div class="ten wide column">
					<h4 class="ui horizontal divider">Pilih waktu</h4>
					
					<?php
						$flash_booking = $this->session->flashdata('flash_booking');
						if(isset($flash_booking)){ echo $flash_booking; }
					?>
					
					<div class="ui basic center aligned segment">
						<?php
							if ($profile)
							echo ($profile->kategori == 1 ? 
								'Klik pada lingkaran tengah pada jam yang telah terbooking untuk membatalkan booking tersebut.' :
								'Klik pada lingkaran tengah pada jam yang kosong untuk memilih jam mulai dan jam selesai.'
							);
							else echo 'Klik pada lingkaran tengah pada jam yang kosong untuk memilih jam mulai dan jam selesai.';
						?>
					</div>
				</div>
			</div>
			
			<center>
				<canvas id="myCanvas"></canvas>
			</center>
		</div>
		
		
		<!--------------------------------------------------------------MODAL BOOKING---------------------------------------------------------------->
		<form method="post" class="ui modal modal-booking">
			<input type="hidden" name="booking_submit" value="booking">
			<div class="header">
				Booking TST
			</div>
			
			<div class="content">
				<div class="ui two column stackable grid">
					
					<div class="center aligned column ">
						<h4 class="ui horizontal divider">Jam mulai</h4>
						
						<div class="ui basic vertical segment">
							<div class="ui big input">
								<input id="input_mulai" type="text" name="input_mulai" readonly="true" style="text-align: center;">
							</div>
						</div>
						
						<div class="ui basic vertical segment ascend">
							<input type="text" id="dial_mulai" class="dial" data-cursor="true" >
						</div>
					</div>
					
					<div class="center aligned column">
						<h4 class="ui horizontal divider">Jam selesai</h4>
						
						<div class="ui basic vertical segment">
							<div class="ui big input">
								<input id="input_bubar" type="text" name="input_bubar" readonly="true" style="text-align: center;">
							</div>
						</div>
						
						<div class="ui basic vertical segment ascend">
							<input type="text" id="dial_bubar" class="dial" data-cursor="true" >
						</div>
					</div>
					
				</div>
			</div>
			
			<div class="actions form">
				<div class="ui negative button">Batal</div>
				<input class="ui positive submit button" type="submit" value="Kirim Booking">
			</div>
		</form>
		<!------------------------------------------------------------------------------------------------------------------------------------------>
		
		
		<!--------------------------------------------------------------MODAL BATAL----------------------------------------------------------------->
		<form method="post" class="ui small modal modal-batal">
			<input type="hidden" id="booking_batalkan" name="booking_batal" value="id">
			<div class="header">
				Pembatalan Booking TST
			</div>
			
			<div class="content">
				<p>Batalkan Booking ini?</p>
			</div>
			
			<div class="actions form">
				<div class="ui positive button">Tidak</div>
				<!--<div type="submit" class="ui positive submit button">Kirim Booking</div>-->
				<input class="ui negative submit button" type="submit" value="Batalkan">
			</div>
		</form>
		<!------------------------------------------------------------------------------------------------------------------------------------------>
		
		
		<script>
		
			$('#avatar').removeClass('right');
			$('#avatar').removeClass('floated');
			$('#avatar').addClass('centered');
			$(window).resize(function() {
				if (window.innerWidth < 768) {
					$('#avatar').removeClass('right');
					$('#avatar').removeClass('floated');
					$('#avatar').addClass('centered');
				}
			});
			
			
			$(document).ready(function(){
				$( '.datepicker' ).pickadate({
					format: 'dddd, dd mmm yyyy',
					formatSubmit: 'yyyy-mm-dd',
					monthsFull: [ 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember' ],
					monthsShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Agu', 'Sep', 'Oct', 'Nov', 'Dec' ],
					weekdaysFull: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
					weekdaysShort: [ 'Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab' ],
					today: 'Hari ini',
					clear: false,
					close: 'Tutup',
					firstDay: '1',
					disable: [7],
					min: true,
					max: 7,
					onClose: function(context) {
						var set = document.getElementsByName("_submit")[0].value;
						var redirect = '<?php echo base_url("booking/$guru->username"); ?>' + '/' + String(set);
						console.log(redirect);
						window.location.replace(redirect);
					}
				});
				
				
				var dial_rounded, dial_hour, dial_minute, dial_hour_str;
				$("#dial_mulai").knob({
					'displayInput': false,
					'step': 10,
					'angleArc': 250,
					'angleOffset': -125,
					'width': 200,
					'thickness': 0.3,
					'change': 	function(v) {
									dial_rounded = Math.round(v/10) * 10;
									dial_hour = Math.floor(dial_rounded/60);
									dial_minute = Math.round((dial_rounded/60 - dial_hour) * 60);
									dial_hour_str = String((dial_hour < 10) ? '0' + dial_hour : dial_hour);
									dial_minute_str = String((dial_minute < 10) ? '0' + dial_minute : dial_minute);
									document.getElementById("input_mulai").value = dial_hour_str + ':' +  dial_minute_str;
								},
					'release': 	function(v) {
									dial_rounded = Math.round(v/10) * 10;
									dial_hour = Math.floor(dial_rounded/60);
									dial_minute = Math.round((dial_rounded/60 - dial_hour) * 60);
									dial_hour_str = String((dial_hour < 10) ? '0' + dial_hour : dial_hour);
									dial_minute_str = String((dial_minute < 10) ? '0' + dial_minute : dial_minute);
									document.getElementById("input_mulai").value = dial_hour_str + ':' +  dial_minute_str;
								}
				});
				$("#dial_bubar").knob({
					'displayInput': false,
					'step': 10,
					'angleArc': 250,
					'angleOffset': -125,
					'width': 200,
					'thickness': 0.3,
					'change': 	function(v) {
									dial_rounded = Math.round(v/10) * 10;
									dial_hour = Math.floor(dial_rounded/60);
									dial_minute = Math.round((dial_rounded/60 - dial_hour) * 60);
									dial_hour_str = String((dial_hour < 10) ? '0' + dial_hour : dial_hour);
									dial_minute_str = String((dial_minute < 10) ? '0' + dial_minute : dial_minute);
									document.getElementById("input_bubar").value = dial_hour_str + ':' +  dial_minute_str;
								},
					'release': 	function(v) {
									dial_rounded = Math.round(v/10) * 10;
									dial_hour = Math.floor(dial_rounded/60);
									dial_minute = Math.round((dial_rounded/60 - dial_hour) * 60);
									dial_hour_str = String((dial_hour < 10) ? '0' + dial_hour : dial_hour);
									dial_minute_str = String((dial_minute < 10) ? '0' + dial_minute : dial_minute);
									document.getElementById("input_bubar").value = dial_hour_str + ':' +  dial_minute_str;
								}
				});
			});
			
			
			
			var canvas = document.getElementById('myCanvas');
			$('#myCanvas').click(handleClick);
			var context = canvas.getContext('2d');
			canvas.width = Math.min(window.innerWidth, window.innerHeight, 450);
			canvas.height = Math.min(window.innerWidth, window.innerHeight, 450);
			var x = canvas.width / 2;
			var y = canvas.height / 2;
			var lineWidth = canvas.width / 10;
			var lineWidthHalf = lineWidth / 2;
			var text_height = lineWidthHalf;
			var text_height_str = String(text_height);
			var radius = Math.min(canvas.width - 2*text_height, canvas.height - 2*text_height) / 2 - lineWidth;
			var counterClockwise = false;
			var offset_angle = -Math.PI;
			var partition_width = 0.02;
			
			var id_booking = [];
			var pembooking = [];
			var jam_mulai = []; jam_mulai[<?php echo $book_qty + 1;?>] = '21:00'
			var jam_bubar = []; jam_bubar[0] = '09:00';
			var jam_mulai_des = [];
			var jam_bubar_des = [];
			var radian_mulai = []; radian_mulai[<?php echo $book_qty + 1;?>] = Math.PI
			var radian_bubar = []; radian_bubar[0] = -Math.PI;
			var warna = [];
			var jam_mulai_kosong = [];
			var jam_bubar_kosong = [];
			var radian_mulai_kosong = [];
			var radian_bubar_kosong = []
			
			<?php
				/*************************************************GAMBAR SEGMEN TERBOOKING**********************************************************/
				$r = 1;
				foreach($book_list as $booking) {
					$jam_mulai_unix[$r] = strtotime("$booking->jam_mulai");
					$jam_bubar_unix[$r] = strtotime("$booking->jam_bubar");
					$jam_mulai[$r] = date("H:i", $jam_mulai_unix[$r]);
					$jam_bubar[$r] = date("H:i", $jam_bubar_unix[$r]);
					
					echo "
						id_booking[$r] = $booking->id;
						pembooking[$r] = '$booking->pembooking';
						jam_mulai[$r] = '$jam_mulai[$r]';
						jam_bubar[$r] = '$jam_bubar[$r]';
						jam_mulai_des[$r] = $booking->h_mulai + $booking->m_mulai / 60;
						jam_bubar_des[$r] = $booking->h_bubar + $booking->m_bubar / 60;
						radian_mulai[$r] = ((jam_mulai_des[$r] / 6) - (3 / 2)) * Math.PI + offset_angle;
						radian_bubar[$r] = ((jam_bubar_des[$r] / 6) - (3 / 2)) * Math.PI + offset_angle;
						context.beginPath();
						context.arc(x, y, radius, radian_mulai[$r] + partition_width, radian_bubar[$r] - partition_width, counterClockwise);
						context.lineWidth = lineWidth;
					";
					
					if ($user == $booking->pembooking) echo "	warna[$r] = '#3498db';"; //#2ecc71
					//else if ($booking->terbooking == $booking->pembooking) echo "	warna[$r] = '#e74c3c';"; #e74c3c//
					else echo "	warna[$r] = '#e74c3c';"; //#3498db
					
					echo "
						context.strokeStyle = warna[$r];
						context.stroke();
					";
					
					$r++;
				}
				/***********************************************************************************************************************************/
				
				
				/**************************************************GAMBAR SEGMEN KOSONG*************************************************************/
				$qty = $book_qty + 1;
				$jam_bubar_unix[0] = strtotime($tanggal) + 32400;
				$jam_mulai_unix[$qty] = strtotime($tanggal) + 75600;
				
				$kosong = 0;
				for($i = 1; $i <= $qty; $i++) {
					$h = $i - 1;
					
					if ($jam_mulai_unix[$i] - $jam_bubar_unix[$h] > 0) {
						$kosong++;
						echo "
							jam_mulai_kosong[$kosong] = jam_bubar[$h];
							jam_bubar_kosong[$kosong] = jam_mulai[$i];
							radian_mulai_kosong[$kosong] = radian_bubar[$h];
							radian_bubar_kosong[$kosong] = radian_mulai[$i];
							context.beginPath();
							context.arc(x, y, radius, radian_mulai_kosong[$kosong] + partition_width, radian_bubar_kosong[$kosong] - partition_width, counterClockwise);
							context.lineWidth = lineWidth;
							context.strokeStyle = '#2ecc71'; //#95a5a6
							context.stroke();
						";
					}
				}
				/***********************************************************************************************************************************/
			
			?>
	
	
			/*********************************************************INDIKATOR JAM*****************************************************************/
			context.font = text_height_str + "px Helvetica";
			context.textAlign = "center";
			context.textBaseline = 'middle';
			context.fillStyle = '#666';
			context.fillText("9", x - radius - lineWidth, y);
			context.fillText("12", x, y - radius - lineWidth);
			context.fillText("18", x, y + radius + lineWidth);
			context.fillText("15", x + radius + lineWidth, y);
			context.fillText("19", x - (radius + lineWidth)/2,  y + Math.sqrt(3)*(radius + lineWidth)/2);
			context.fillText("20", x - Math.sqrt(3)*(radius + lineWidth)/2, y + (radius + lineWidth)/2);
			
			context.beginPath();
			context.arc(x, y, radius - lineWidth, 0, 2*Math.PI);
			context.closePath();
			context.fillStyle = '#eee';
			context.fill();
			/***************************************************************************************************************************************/
			
			
			function handleClick(clickEvent) {
				var mouseX = clickEvent.pageX - this.offsetLeft;
				var mouseY = clickEvent.pageY - this.offsetTop;
				var xFromCentre = mouseX - x;
				var yFromCentre = mouseY - y;
				var distanceFromCentre = Math.sqrt(Math.pow(Math.abs(xFromCentre), 2) + Math.pow(Math.abs(yFromCentre), 2));
				var clickAngle = Math.atan2(yFromCentre, xFromCentre) - offset_angle;
				if (clickAngle < 0) clickAngle = 2 * Math.PI + clickAngle;
				
				if ((distanceFromCentre <= radius + lineWidthHalf) && (distanceFromCentre >= radius - lineWidthHalf)) {		
					
					/*****************************************SAAT USER KLIK SEGMEN TERBOOKING******************************************************/
					var qty = <?php echo $book_qty; ?>;
					for(i = 1; i <= qty; i++) {
						if ((clickAngle >= radian_mulai[i] - offset_angle) && (clickAngle <= radian_bubar[i] - offset_angle)) {
							click_kosong = false;
							
							context.beginPath();
							context.arc(x, y, radius - lineWidthHalf, 0, 2*Math.PI);
							context.closePath();
							context.fillStyle = '#fff';
							context.fill();
							
							context.beginPath();
							context.arc(x, y, radius - 3/2 * lineWidthHalf, radian_mulai[i] + partition_width, radian_bubar[i] - partition_width);
							context.lineWidth = lineWidthHalf / 2;
							context.strokeStyle = warna[i];
							click_booking = (pembooking[i] == '<?php echo $user; ?>' ? true : false);
							click_booking = <?php if ($profile) echo ($profile->kategori == 1 ? 'true;' : 'click_booking;'); else echo 'click_booking;'?>
							clicked_booking = id_booking[i];
							context.stroke();
							
							context.beginPath();
							context.arc(x, y, radius - lineWidth, 0, 2*Math.PI);
							context.closePath();
							context.fillStyle = '#eee';
							context.fill();
							
							context.font = text_height_str + "px Helvetica";
							context.textAlign = "center";
							context.textBaseline = 'middle';
							context.fillStyle = '#666';
							context.fillText(pembooking[i], x, y - 0.75 * lineWidthHalf); 
							context.fillText(jam_mulai[i] + ' - ' + jam_bubar[i], x, y + 0.75 * lineWidthHalf);
						}
					}
					/*******************************************************************************************************************************/
					
					
					/*****************************************SAAT USER KLIK SEGMEN KOSONG**********************************************************/
					var kosong = <?php echo $kosong; ?>;
					for(i = 1; i <= kosong; i++) {
						if ((clickAngle >= radian_mulai_kosong[i] - offset_angle) && (clickAngle <= radian_bubar_kosong[i] - offset_angle)) {
							click_kosong = true;
							click_booking = false;
							clicked_kosong = i;
							
							context.beginPath();
							context.arc(x, y, radius - lineWidthHalf, 0, 2*Math.PI);
							context.closePath();
							context.fillStyle = '#fff';
							context.fill();
							
							context.beginPath();
							context.arc(x, y, radius - 3/2*lineWidthHalf, radian_mulai_kosong[i] + partition_width, radian_bubar_kosong[i] - partition_width);
							context.lineWidth = lineWidthHalf / 2;
							context.strokeStyle = '#2ecc71';
							context.stroke();
							
							context.beginPath();
							context.arc(x, y, radius - lineWidth, 0, 2*Math.PI);
							context.closePath();
							context.fillStyle = '#eee';
							context.fill();
							
							context.font = text_height_str + "px Helvetica";
							context.textAlign = "center";
							context.textBaseline = 'middle';
							context.fillStyle = '#666';
							context.fillText("Kosong", x, y - 0.75 * lineWidthHalf);
							context.fillText(jam_mulai_kosong[i] + ' - ' + jam_bubar_kosong[i], x, y + 0.75 * lineWidthHalf);
						}
					}
					/*******************************************************************************************************************************/
					
				}
				
				else if (distanceFromCentre <= radius - lineWidth) {
					if (click_kosong) {
						$('.modal-booking')
							.modal('setting', 'transition', 'fade up')
							.modal('show')
						;
						
						document.getElementById("input_mulai").value = jam_mulai_kosong[clicked_kosong];
						document.getElementById("input_bubar").value = jam_bubar_kosong[clicked_kosong];
						
						dial_hour_min = Number(jam_mulai_kosong[clicked_kosong].split(':')[0]) * 60;
						dial_hour_max = Number(jam_bubar_kosong[clicked_kosong].split(':')[0]) * 60;
						dial_minute_min = Number(jam_mulai_kosong[clicked_kosong].split(':')[1]);
						dial_minute_max = Number(jam_bubar_kosong[clicked_kosong].split(':')[1]);
						
						$('.dial').trigger(
							'configure', {
								'min': dial_hour_min + dial_minute_min,
								'max': dial_hour_max + dial_minute_max
							}
						);
					}
					
					else if (click_booking) {
						$('.modal-batal')
							.modal('setting', 'transition', 'fade up')
							.modal('show')
						;
						document.getElementById("booking_batalkan").value = clicked_booking;
					}
				}
			}
		</script>
	</body>
</html>      