<!DOCTYPE html>
<html>
<head>
	<title>teacher</title>
</head>
<body>

<h1>this is teacher page</h1>
<br>
<br>
<h3>Welcome !. </h3><?php echo $this->session->userdata('name'); ?>
<br>
<br>
<?php echo anchor('user/login/logout', 'logout'); ?>


</body>
</html>

