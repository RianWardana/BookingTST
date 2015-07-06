<!DOCTYPE HTML>
<html>
	<head>
	</head>
  

	<body>
		<?php /**********************************************************************************************************************************/ ?>
		<div id="booking-header">
			<div class="ui stackable grid">
		
				<div class="five wide column">
					<div class="ui basic segment">
						<img id="avatar" class="ui small circular image right floated" src="<?php echo $profile->avatar;?>">
					</div>
				</div>
				
				<div class="eleven wide column">
					<div class="ui basic segment">
						<div id="aux-segment" class="ui basic vertical segment"></div>
						
						<div id="profile-segment" class="ui basic vertical segment">
							<div class="ui huge header">
								<?php echo ($profile->kategori == 0 ? ucwords($profile->nama) : strtoupper($profile->username));?>
								<div class="sub header"><?php echo ucwords($profile->keterangan);?></div>
							</div>
						</div>
						
						<div id="aux-segment" class="ui basic vertical segment"></div>
					</div>
				</div>
				
			</div>
		</div>
		<?php /**********************************************************************************************************************************/ ?>
		<div id="tab">
			<div class="ui stackable grid" style="padding-bottom: 0px;">
				<div id="aux-column" class="three wide column"></div>
				<div class="ten wide column">
					<div class="ui tabular menu">
						<?php echo ($profile->kategori == 1 ? "<a href='". base_url('booking') ."' class='item'>Booking ke Saya</a>" : ""); ?>
						<a href="<?php echo base_url('message');?>" class="<?php echo ($this_page == 'message' || $this_page == 'msg_list' || $this_page == 'notification' ? 'active ' : '');?>item">Kiriman Pesan</a>
						<a href="<?php echo base_url('profile');?>" class="<?php echo ($this_page == 'profile' ? 'active ' : '');?>item">Profil Saya</a>
					</div>
				</div>
			</div>
		</div>
		<?php /**********************************************************************************************************************************/ ?>
		<?php include_once 'js_tpl.php' ?>
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
		</script>
	</body>
	
	
</html>