<!DOCTYPE HTML>
<html>
	<head>
		<title>Kiriman Pesan</title>
		<style>
			#aux-column { padding: 0px; }

			.msg_crop {
				max-width: 35vw;
				height: 20px;
				line-height: 20px;
				overflow: hidden;
				white-space: nowrap;
				text-overflow: ellipsis;
			}
			
			@media(max-width: 550px) {
				#aux-column { padding: 0px !important; }
				.msg_crop { max-width: 60vw; }
			}
			
			@media (min-width: 550px) and (max-width: 768px) {
				#aux-column { padding: 0px !important; }
				.msg_crop { max-width: 75vw; }
			}
			
			@media (min-width: 768px) and (max-width: 970px) {
				.msg_crop { max-width: 45vw; }
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
						
						<?php /*************************************MESSAGE**********************************************************************/ ?>
						<div id="msg_content" class="twelve wide column">
							<div class="ui fluid vertical menu">
								<?php							
									foreach($msg_list as $msg) {
										$url = base_url("message/{$msg->pengirim}");
										echo "
											<a class='item msg_list' href='$url'>
												<h3 class='ui header'>
													<img class='ui circular image' src='{$msg->avatar}'>
													<div class='content'>
														{$msg->nama}
														<div class='sub header msg_crop'>{$msg->pesan}</div>
													</div>
												</h3>
											</a>
										";
									}
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