<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<title>Kiriman Pesan</title>
		<link rel="icon" href="<?php echo base_url("favicon.ico")?>">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.2/semantic.min.css">
		<!--<link rel="stylesheet" href="<?php echo base_url("assets/semantic.min.css");?>">-->
		<link rel="stylesheet" href="<?php echo base_url("assets/default.css");?>">
		<link rel="stylesheet" href="<?php echo base_url("assets/default.date.css");?>">
		<link rel="stylesheet" href="<?php echo base_url("assets/wardana.css");?>">
		
		<style>
			#chat_header {
				padding: 0%;
				background-color: #f7f7f7;
			}
			
			#header_menu {
				margin-bottom: 0px;
				border-radius: 0px;
			}
			
			#back_button {
				color: white;
				background-color: #e67e22;
			}
			
			#chat_container {
				overflow-x: hidden;
				overflow-y: auto;
				padding: 3%;
			}
			
			#chat_unit { padding: 0px; }
			
			.ui.right.floated.compact.segment { margin: 0px; }
			
			.chat_date { 
				margin-top: -10px;
				margin-bottom: 20px;
				color: #95a5a6;
			}
			
			.chat_date.right { text-align: right; }
			
			#input_area { padding: 0px 1% 0px; }
			
			#text_input {
				width: 80%;
				display: inline;
				resize: none;
				border: 1px solid #ccc;
				border-radius: 4px;
			}
			
			@media (max-width: 400px) {
				#send_button { padding: 0px; }
			}
		</style>
		
		
	</head>
  

	<body>

		<div style="padding: 0px 0% 0px;">
			
			
			<div id="header_menu" class="ui large borderless orange inverted menu">
				<div class="fitted item">
					<a href="<?php echo base_url('message');?>" class="ui orange button"><i class='arrow left icon'></i></a>
				</div>
				<div class="text item"><?php echo ($rx_data->kategori == 0 ? ucwords($rx_data->nama) : strtoupper($rx_data->username) ) ;?></div>
			</div>
			
			<div id="chat_container">
			</div>
			
			<form method="post" id="input_area">
				<textarea id="text_input" name="text_input" maxlength="320" autofocus></textarea>
				<input id="send_button" name="send_msg" type="button" class="ui blue button" style="width: 18%; float: right;" value="Kirim">
			</form>
			
		</div>

		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.2/semantic.min.js"></script>
		<!--<script type="text/javascript" src="<?php echo base_url("assets/jquery.min.js");?>"></script>-->
		<!--<script type="text/javascript" src="<?php echo base_url("assets/semantic.min.js");?>"></script>-->
		<script type="text/javascript" src="<?php echo base_url("assets/picker.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/picker.date.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/jquery.knob.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/wardana.js");?>"></script>
		
		<script>
			function scroll_bawah() {
				var objDiv = document.getElementById('chat_container');
				objDiv.scrollTop = objDiv.scrollHeight;
			}
			
			function resize_semuanya() {
				input_part = 0.1;
				chat_part = 1 - input_part;
				
				usable_height = window.innerHeight - document.getElementById('header_menu').clientHeight;
				chat_height = chat_part * usable_height;
				input_height = input_part * usable_height;
				input_padding = 0.1 * input_height;
				
				if (input_height < 45) {
					input_part = 45 / usable_height;
					chat_part = 1 - input_part;
					chat_height = chat_part * usable_height;
					input_height = input_part * usable_height;
					input_padding = 0.1 * input_height;
				}
				
				document.getElementById('chat_container').style.height = chat_height + 'px';
				document.getElementById('input_area').style.height = input_height + 'px';
				document.getElementById('input_area').style.paddingTop = input_padding + 'px';
				document.getElementById('text_input').style.height = input_height - 2*input_padding + 'px';
				document.getElementById('send_button').style.height = input_height - 2*input_padding + 'px';
			}
			
			var prev = ''
			function get_log() {
				var html = '';
				var epoch, waktu, waktu_string, sender;
				var user = '<?php echo $this->username; ?>';
				var avatar = '<?php echo $rx_data->avatar;?>';
				var bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des', ];
				
				setTimeout(function(){
				$.ajax({
					url: '<?php echo base_url('msg/' . $rx_data->username);?>',
					type: 'GET',
					success: function(string) {
						msgs = JSON.parse(string);
						$.each(msgs, function(i, msg){
							sender = msg.pengirim;
							waktu_string = msg.waktu.split('-').join('/');
							epoch = new Date(waktu_string);
							waktu = bulan[epoch.getMonth()] + (epoch.getDate() < 10 ? ' 0' : ' ') + epoch.getDate() + ', ' + (epoch.getHours() < 10 ? '0' : '') + epoch.getHours() + ':' + (epoch.getMinutes() < 10 ? '0' : '') + epoch.getMinutes();
							html += "<div id='chat_unit' class='ui basic segment'>" +
									"<div class='ui" + (sender == user ? ' right floated ' : ' orange inverted ') + "compact segment'>" +
									(sender == user ? "" : "<img class='ui avatar image' src='" + avatar + "'>") + msg.pesan +
									"</div></div>" + "<p class='chat_date" + (sender == user ? ' right' : '') + "'>"+ waktu + "</p>";
						});
						$('#chat_container').html(html);
						if (html != prev) scroll_bawah();
						prev = html;
						get_log();
					}
				});
				}, 500);
			}
			
			
			$(document).ready(function(){
				resize_semuanya();
				get_log();
			});
			
			
			$(window).resize(function() {
				resize_semuanya();
			});
			
			
			$('#send_button').on('click', function(){
				if ($('#text_input').val() != '') {
					var data = {
						terkirim: '<?php echo $rx_data->username;?>',
						text_input: $('#text_input').val()
					};
				
					$.ajax({
						url: '<?php echo base_url('msg/' . $rx_data->username);?>',
						type: 'POST',
						data: data,
						success: function(string){
							$('#text_input').val('');
						}
					});
				}
			});
			
		</script>
		
	</body>
</html>