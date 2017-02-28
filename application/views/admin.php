<!DOCTYPE html>
<html>
<head>
	<title>admin</title>

	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" />  
	<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" />

	<style type="text/css">
	.page_menu ul li{
		display: inline-block;
	}
	</style>
</head>
<body>

	<div class="container">
		<div class="row">

			<div class="page_menu">
				<ul>
					<li><a href="#"><i class="fa fa-user"></i> admin</a></li>
					<li><?php echo anchor('user/login/logout', 'logout'); ?></li>
					<li><?php echo anchor('user/admin/matakuliah', 'matakuliah'); ?></li>
				</ul>
			</div>

		</div>
	</div>

<h1>this is admin page</h1>
<br>
<br>
<h3>Welcome ! <?php echo $this->session->userdata('name'); ?></h3>
<br>
<br>


</body>
</html>