<h1><?php echo $headline; ?></h1>
<?= validation_errors("<p style='color:red;'>", "</p>") ?>
<?php 
	if (isset($flash)) {
		echo $flash;
	}
?>

<?php
if (is_numeric($update_id)) {
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>item detail</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			
			<a href="<?= base_url() ?>store_accounts/update_pword/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Password</button></a>
			<a href="<?= base_url() ?>store_accounts/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Account</button></a>
		
		</div>
	</div>
</div>			
<?php } ?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Account detail</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php $form_location = base_url()."store_accounts/create/".$update_id; ?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for=""> Username </label>
							  <div class="controls">
								<input type="text" class="span6" name="username" value="<?php echo $username; ?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="">First Name </label>
							  <div class="controls">
								<input type="text" class="span6" name="firstname" value="<?php echo $firstname; ?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="">Last Name </label>
							  <div class="controls">
								<input type="text" class="span4" name="lastname" value="<?php echo $lastname; ?>">
							  </div>
							</div>   

							<div class="control-group">
							  <label class="control-label" for="">Company </label>
							  <div class="controls">
								<input type="text" class="span4" name="company" value="<?php echo $company; ?>">
							  </div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Address Line 1 </label>
							  <div class="controls">
								<textarea class="" id="" rows="3" name="address1"><?php echo $address1; ?></textarea>
							  </div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Address Line 2 </label>
							  <div class="controls">
								<textarea class="" id="" rows="3" name="address2"><?php echo $address2; ?></textarea>
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="">Town </label>
							  <div class="controls">
								<input type="text" class="span4" name="town" value="<?php echo $town; ?>">
							  </div>
							</div>   

							<div class="control-group">
							  <label class="control-label" for="">Country </label>
							  <div class="controls">
								<input type="text" class="span4" name="country" value="<?php echo $country; ?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="">Postcode </label>
							  <div class="controls">
								<input type="text" class="span4" name="postcode" value="<?php echo $postcode; ?>">
							  </div>
							</div>   

							<div class="control-group">
							  <label class="control-label" for="">Telephone Number </label>
							  <div class="controls">
								<input type="text" class="span4" name="telnum" value="<?php echo $telnum; ?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="">Email </label>
							  <div class="controls">
								<input type="text" class="span4" name="email" value="<?php echo $email; ?>">
							  </div>
							</div>							

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
							  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

