<h1>Manage <?php echo $headline; ?></h1>
<?php 
	if (isset($flash)) {
		echo $flash;
	}
?>
<div class="form-actions1">
	<?php
	$create_item_url = base_url()."homepage_blocks/create";
	?>
	<p style="margin-top:30px">
		<a href="<?php echo base_url();?>homepage_blocks/create"><button type="button" class="btn btn-primary">Add New Homepage Offers</button></a>
	</p>
</div>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white icon-align-justify"></i><span class="break"></span>Existing Homepage Offers </h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						
						<?php
							echo Modules::run('homepage_blocks/_draw_sortable_list');
						?>
						
					</div>
				</div><!--/span-->
			
			</div><!--/row-->