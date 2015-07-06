<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<?php include('css_tpl.php'); ?>
	</head>
 
 
	<body>
		<?php /**************************************************MOBILE MENU*********************************************************************/ ?>
		<div id="mobile-sidebar" class="ui left vertical labeled icon sidebar menu active">
			<a href="<?php echo base_url('');?>" class="item <?php if ($this_page == 'index') echo "active";?>">
				<i class="home icon"></i> Home
			</a>
			
			<a href="<?php echo base_url('booking');?>" class="item <?php if ($this_page == 'booking') echo "active";?>">
				<i class="book icon"></i> Booking
			</a>
			
			<?php
				if ($have_login) echo "
					<a class='item" . ($this_page == 'message' || $this_page == 'msg_list' ? " active" : "") . "' href='". base_url('message') ."'>
						<i class='mail icon'></i> Message
					</a>
					
					<div class='item'>
						<a href='" . base_url('profile') . "' class='ui blue button'>Profil Saya</a>
					</div>
				";
			?>
		</div>
		<?php /**********************************************************************************************************************************/ ?>
		
		<div id="full-menu" class="ui menu">
			<a href="<?php echo base_url('');?>" class="item <?php if ($this_page == 'index') echo "active";?>">
				<i class="home icon"></i> Home
			</a>
			
			<a href="<?php echo base_url('booking');?>" class="item <?php if ($this_page == 'booking') echo "active";?>">
				<i class="book icon"></i> Booking
			</a>
			
			<?php
				if ($have_login) echo "
					<a class='item" . ($this_page == 'message' || $this_page == 'msg_list' ? " active" : "") . "' href='" . base_url('message') . "'>
						<i class='mail icon'></i> Message
					</a>
				";
			?>
			
			<div class="right menu">

				<?php
					if ($have_login) echo "
						<div class='item'>
							<a href='" . base_url('profile') . "' class='ui blue button'>Profil Saya</a>
						</div>
					";
				?>
			
				<div class="item">
					<?php
						if ($have_login) echo "<a href='" . base_url("logout") ."' class='ui red button'>Keluar</a>";
						if (!$have_login) echo "<a href='" . base_url("login") ."' class='ui green button'>Masuk</a>";
					?>
				</div>
			</div>
		</div>
		
		
		
		<div id="mobile-menu" class="ui large menu">
			<div id="mobile-menu-button" class="item">
				<i class="list layout icon"></i> Menu
			</div>
			
			<div class="right menu">
				<div class="item">
					<?php
						if ($have_login) echo "<a href='" . base_url("logout") ."' class='ui red button'>Keluar</a>";
						if (!$have_login) echo "<a href='" . base_url("login") ."' class='ui green button'>Masuk</a>";
					?>
				</div>
			</div>
		</div>
		
	
	</body>
</html>      