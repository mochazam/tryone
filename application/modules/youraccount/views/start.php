<?php
	$form_location = base_url().'youraccount/start';
?>

<h1>Create Account</h1>

<?php
	echo validation_errors("<p style='color: red;'>", "</p>");
?>

<form class="form-horizontal" action="<?= $form_location ?>" method="post">
	<fieldset>
		<legend>Please submit your detail using the form below</legend>

		<div class="form-group">
			<label class="col-md-4 control-label">Username</label>
			<div class="col-md-4">
				<input type="text" name="username" id="" value="<?= $username ?>" placeholder="Username" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">Email</label>
			<div class="col-md-4">
				<input type="email" name="email" id="" value="<?= $email ?>" placeholder="Email" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">Password</label>
			<div class="col-md-4">
				<input type="password" name="pword" id="" value="<?= $pword ?>" placeholder="Password" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">Repeat Password</label>
			<div class="col-md-4">
				<input type="password" name="repeat_pword" id="" value="<?= $repeat_pword ?>" placeholder="Password" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">Create Account?</label>
			<div class="col-md-4">
				<button id="" name="submit" value="Submit" class="btn btn-primary"></button>
			</div>
		</div>

	</fieldset>
</form>