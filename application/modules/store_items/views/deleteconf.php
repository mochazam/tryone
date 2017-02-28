<h1><?= $headline ?></h1>
<?php
if (isset($flash)) {
	echo $flash;
}
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Confirm Delete</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<p>Are you sure that you want to delete the item?</p>

			<?php
			$attributes = array('class' => 'form-horizontal');
			echo form_open('store_items/delete/'.$update_id, $attributes);
			?>
			<fieldset>
				<div class="control-group" style="">
					<button type="submit" class="btn btn-danger" name="submit" value="Delete">Delete Item</button>
					<button type="submit" class="btn btn-default" name="submit" value="Cancel">Cancel</button>
				</div>
			</fieldset>

		</div>
	</div>
</div>	