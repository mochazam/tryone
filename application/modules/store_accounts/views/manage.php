<h1>Manage Accounts</h1>
<?php 
	if (isset($flash)) {
		echo $flash;
	}
?>
<div class="form-actions1">
	<?php
	$create_account_url = base_url()."store_accounts/create";
	?>
	<p style="margin-top:30px">
		<a href="<?php echo base_url();?>store_accounts/create"><button type="button" class="btn btn-primary">Add New Account</button></a>
	</p>
</div>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Customer Accounts </h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>Username</th>
								  <th>First Name</th>
								  <th>Last Name</th>
								  <th>Company</th>
								  <th>Date Created</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  	<?php 
						  	$this->load->module('timedate');
						  	foreach ($query->result() as $row) { 
						  		$edit_account_url = base_url()."store_accounts/create/".$row->id;
						  		$view_accounts_url = base_url()."store_accounts/view/".$row->id;
						  		$date_created = $this->timedate->get_nice_date($row->date_made, 'cool');
						  	?>
							<tr>
								<td><?= $row->username ?></td>
								<td><?= $row->firstname ?></td>
								<td class="center"><?= $row->lastname ?></td>
								<td class="center"><?= $row->company ?></td>
								<td class="center"><?= $date_created ?></td>
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="<?= $edit_account_url ?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<?php } ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->