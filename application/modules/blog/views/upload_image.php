<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Upload Image </h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			if (isset($error)) {

				foreach ($error as $value) {
					echo $value;
				}
			}
			?>

			<?php
			$attributes = array('class' => 'form-horizontal');
			echo form_open_multipart('blog/do_upload/'.$update_id, $attributes);
			?>
			<fieldset>
				<div class="control-group" style="height: 200px;">
					<label class="control-label" for="">File Input</label>
					<div class="controls">
						<input type="file" class="input-file uniform_on" id="fileInput" name="userfile">
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Upload</button>
					<button type="submit" class="btn btn-default" name="submit" value="Cancel">Cancel</button>
				</div>
			</fieldset>
			<?php echo form_close(); ?>


		</div>
	</div>
</div>	