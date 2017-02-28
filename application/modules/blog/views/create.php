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
			<?php
			if ($picture == "") { ?>
				<a href="<?= base_url() ?>blog/upload_image/<?= $update_id ?>"><button type="button" class="btn btn-primary">Upload Image</button></a>
			<?php } else { ?>
				<a href="<?= base_url() ?>blog/delete_image/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Image</button></a>
			<?php } ?>
			<a href="<?= base_url() ?>blog/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Blog</button></a>
			<a href="<?= base_url().$page_url ?>"><button type="button" class="btn btn-default">View Blog</button></a>
		</div>
	</div>
</div>			
<?php } ?>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Blog detail</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php $form_location = base_url()."blog/create/".$update_id; ?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="">Blog Title </label>
							  <div class="controls">
								<input type="text" class="span6" name="page_title" value="<?php echo $page_title; ?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="">Date Published </label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" name="date_published" value="<?php echo $date_published; ?>">
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

							<div class="control-group">
							  <label class="control-label" for="">Author </label>
							  <div class="controls">
								<input type="text" class="span6" name="author" value="<?php echo $author; ?>">
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

<?php
if ($picture != "") { ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Blog Image</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<img src="<?= base_url() ?>blog_pics/<?= $picture ?>">
		</div>
	</div><!--/span-->

</div><!--/row-->			
<?php } ?>			