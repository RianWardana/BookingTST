<!DOCTYPE HTML>
<html>
	<head>
		<style>
			#sidebar-fluid { display: none;}
			
			@media(max-width: 970px) {
				#sidebar-full { display: none; }
				#sidebar-fluid { display: inline-block; }
			}
		</style>
	</head>
  

	<body>
		<?php /************************************************************************************************************************************/ ?>
		<div id="sidebar-full" class="four wide column">
			<div class="ui fluid vertical pointing menu">
				<a href="<?php echo base_url('notification');?>" class="<?php echo ($this_page == 'notification' ? 'active ' : '');?>item"><i class="alarm icon"></i> Notification</a>
				<a href="<?php echo base_url('message/list');?>" class="<?php echo ($this_page == 'msg_list' ? 'active ' : '');?>item"><i class="users icon"></i> List</a>
				<a href="<?php echo base_url('message');?>" class="<?php echo ($this_page == 'message' ? 'active ' : '');?>item"><i class="mail icon"></i> Message</a>
			</div>
		</div>
		<?php /************************************************************************************************************************************/ ?>						
		<div id="sidebar-fluid" class="sixteen wide column">
			<div class="ui fluid three item labeled icon pointing menu">
				<a href="<?php echo base_url('notification');?>" class="<?php echo ($this_page == 'notification' ? 'active ' : '');?>item"><i class="alarm icon"></i>Notification</a>
				<a href="<?php echo base_url('message/list');?>" class="<?php echo ($this_page == 'msg_list' ? 'active ' : '');?>item"><i class="users icon"></i>List</a>
				<a href="<?php echo base_url('message');?>" class="<?php echo ($this_page == 'message' ? 'active ' : '');?>item"><i class="mail icon"></i>Message</a>
			</div>
		</div>
		<?php /************************************************************************************************************************************/ ?>
	</body>
	
	
</html>