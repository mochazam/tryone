<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" />  
	    <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" />

	    <style type="text/css">
	    #form_login{
	    	margin-top: 50px;
	    	padding: 20px;
	    	border: 1px solid #cccccc;
	    }
	    .form_text{
	    	text-align: center;
	    	font-weight: bold;
	    }
	    </style>
</head>
<body>

	
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">

				<?php echo form_open('user/login/auth', 'class="form-horisontal" id="form_login"'); ?>
				
				<div class="form-group">
					<div class="form_text">
						<h3>Sign In</h3>
					</div>

					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-user"></i>
						</div>
						
						<input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" data-mask="email" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-lg btn-block btn-login">
						<i class="entypo-login"></i>
						Login
					</button>
				</div>

				<?php
					$info = $this->session->flashdata('info'); //menampung informasi yang di lempar di mode
					if(!empty($info)) //jika info tidak kosong maka tampilkan warning
					{
						echo $info;//kita tes
					}
				?>	
				
			<?php echo form_close(); ?>

			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
			

</body>
</html>