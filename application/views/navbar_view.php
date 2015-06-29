<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<link rel="icon" href="<?php echo base_url("favicon.ico")?>">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.2/semantic.min.css">
		<!--<link rel="stylesheet" href="<?php echo base_url("assets/semantic.min.css");?>">-->
		<link rel="stylesheet" href="<?php echo base_url("assets/default.css");?>">
		<link rel="stylesheet" href="<?php echo base_url("assets/default.date.css");?>">
		<link rel="stylesheet" href="<?php echo base_url("assets/wardana.css");?>">
	</head>
 
 
	<body>
		<!------------------------------------------------------ MOBILE MENU ----------------------------------------------------------------------->
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
		<!------------------------------------------------------------------------------------------------------------------------------------------>
		
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
		
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!--<script type="text/javascript" src="<?php echo base_url("assets/jquery.min.js");?>"></script>-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.2/semantic.min.js"></script>
		<!--<script type="text/javascript" src="<?php echo base_url("assets/semantic.min.js");?>"></script>-->
		<script type="text/javascript" src="<?php echo base_url("assets/picker.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/picker.date.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/jquery.knob.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/wardana.js");?>"></script>
	</body>
</html>      