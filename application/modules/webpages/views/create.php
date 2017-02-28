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
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Additional option</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<a href="<?= base_url() ?>webpage/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Page</button></a>
			<a href="<?= base_url().$page_url ?>"><button type="button" class="btn btn-default">View Page</button></a>
		</div>
	</div>
</div>			
<?php } ?>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Page detail</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php $form_location = base_url()."webpages/create/".$update_id; ?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="">Page Title </label>
							  <div class="controls">
								<input type="text" class="span6" name="page_title" value="<?php echo $page_title; ?>">
							  </div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label">Page Keyword </label>
							  <div class="controls">
								<textarea class="span6" rows="3" name="page_keyword"><?php echo $page_keyword; ?></textarea>
							  </div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label">Page Description </label>
							  <div class="controls">
								<textarea class="span6" rows="3" name="page_description"><?php echo $page_description; ?></textarea>
							  </div>
							</div>
<!--
							<div class="control-group">
							  <label class="control-label" for="">Page Headline </label>
							  <div class="controls">
								<input type="text" class="span6" name="page_headline" value="<?php echo $page_headline; ?>">
							  </div>
							</div>
-->							
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Page Content </label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="page_content"><?php echo $page_content; ?></textarea>
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
