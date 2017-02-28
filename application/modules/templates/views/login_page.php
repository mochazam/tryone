<?php
$first_bit = $this->uri->segment(1);
$form_location = base_url().$first_bit.'/submit_login';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link id="bootstrap-style" href="<?php echo base_url(); ?>adminfiles/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">

    <!-- MetisMenu CSS 
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts 
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
-->
<style type="text/css">
h3.panel-title{text-align: center;font-weight: bold;text-transform: uppercase;}
</style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                
                        
                        <form role="form" method="POST" action="<?php echo $form_location;?>">
                            <h2 class="">Please Sign In</h2>
                            <fieldset>
                                <div class="form-group">
                                    <label for="inputEmail">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" value="<?= $username ?>" placeholder="username">
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" class="form-control" name="pword" id="password" placeholder="Password">
                                </div>                          
                                <div class="checkbox">
                                    <?php
                                    if ($first_bit == "youraccount") {
                                    ?>
                                    <label>
                                        <input name="remember" type="checkbox" value="remember-me">Remember Me
                                    </label>
                                    <?php }
                                    ?>
                                </div>
                                <button type="submit" name="submit" value="Submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                                <!-- warning akan muncul disini -->
								<?php
									$info = $this->session->flashdata('info'); //menampung informasi yang di lempar di mode
									if(!empty($info)) //jika info tidak kosong maka tampilkan warning
									{
										echo $info;//kita tes
									}
								?>	
                            </fieldset>
                        </form>
                   
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>adminfiles/js/jquery-1.9.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url(); ?>adminfiles/js/bootstrap.min.js"></script>

</body>

</html>
