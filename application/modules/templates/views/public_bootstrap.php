<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">
	<title>template</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="jumbotron.css">
</head>
<body>

<nav class="navbar navbar-inverse navbar">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand">name</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">

			<?php
			echo Modules::run('store_categories/_draw_top_nav');
			?>

			<form class="navbar-form navbar-right">
				<div class="form-group">
					<input type="text" placeholder="email" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" placeholder="password" class="form-control">
				</div>
				<button type="submit" class="btn btn-success">sign in</button>
			</form>
		</div>
	</div>
</nav>


<div class="container" style="height: 650px;">

<?php

if ($customer_id > 0) {
	include('customer_panel_top.php');
}

if (isset($page_content)) {
	echo  nl2br($page_content);

	if (!isset($page_url)) {
		$page_url = 'homepage';
	}

	if ($page_url == "") {
		require_once('homepage_content.php');
	} elseif ($page_url == "contactus") {
		echo Modules::run('contactus/_draw_form');
	}
	
} elseif (isset($view_file)) {
	$this->load->view($view_module.'/'.$view_file);
}
?>
</div>
<div class="container">
	<hr>


	<footer>
		<p>&copy; 2017</p>
	</footer>

</div>



<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
	</body>
</html>