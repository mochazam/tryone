<h1>Content Management System</h1>
<?php 
	if (isset($flash)) {
		echo $flash;
	}
?>
<div class="form-actions1">
	<?php
	$create_pages_url = base_url()."webpages/create";
	?>
	<p style="margin-top:30px">
		<a href="<?php echo base_url();?>webpages/create"><button type="button" class="btn btn-primary">Create New Webpage</button></a>
	</p>
</div>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white file"></i><span class="break"></span>Custom Webpages </h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>Page URL</th>
								<!--  <th>Headline</th>	-->
								  <th>Page Title</th>
								  <th class="span2">Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  	<?php foreach ($query->result() as $row) { 
						  		$edit_page_url = base_url()."webpages/create/".$row->id;
						  		$view_page_url = base_url().$row->page_url;
						  		
						  	?>
							<tr>
								<td><?= $view_page_url ?></td>
							<!--	<td class="center"><?= $row->page_headline ?></td>	-->
								<td class="center"><?= $row->page_title ?></td>
								<td class="center">
									<a class="btn btn-success" href="<?= $view_page_url ?>">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="<?= $edit_page_url ?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									
								</td>
							</tr>
							<?php } ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->