<h1>Your <?= $folder_type ?></h1>
<?php 
	if (isset($flash)) {
		echo $flash;
	}
?>
<div class="form-actions1">
	<?php
	$create_msg_url = base_url()."yourmessages/create";
	?>
	<p style="margin-top:30px">
		<a href="<?php echo $create_msg_url; ?>"><button type="button" class="btn btn-primary">Compose Message</button></a>
	</p>
</div>


						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead style="backgroud-color: #666; color: #fff;">
							  <tr>
								  <th>#</th>
								  <th>Date Sent</th>
								  <th>Sent By</th>
								  <th>Subject</th>
								  <th>Actions</th>

							  </tr>
						  </thead>   
						  <tbody>
						  	<?php 
						  	$this->load->module('site_settings');
						  	$this->load->module('timedate');
						  	$this->load->module('store_accounts');
						  	$team_name = $this->site_settings->_get_support_team_name();

						  	foreach ($query->result() as $row) { 

						  		$view_url = base_url().'yourmessages/view/'.$row->code;

						  		$customer_data['firstname'] = $row->firstname;
						  		$customer_data['lastname'] = $row->lastname;
						  		$customer_data['company'] = $row->company;

						  		//$firstname = $row->firstname;
						  		//$lastname = $row->lastname;
						  		//$company = $row->company;
						  		$opened = $row->opened;

						  		if ($opened == 1) {
					  				$icon = '<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>';
					  			} else {
					  				$icon = '<span class="glyphicon glyphicon-envelope" aria-hidden="true" style="color: orange;"></span>';
					  			}

					  			$date_sent = $this->timedate->get_nice_date($row->date_created, 'mini');

					  			if ($row->sent_by == 0) {
					  				$sent_by = $team_name;		
					  			} else {
					  				$sent_by = $this->store_accounts->_get_customer_name($row->sent_by, $customer_data);
					  				//$sent_by = $firstname." ".$lastname
					  			}	
						  	?>
							<tr>
								<td class="span1"><?= $icon ?></td>
							  	<td><?= $date_sent ?></td>
							  	<td><?= $sent_by ?></td>
							  	<td><?= $row->subject ?></td>
							  	<td>
							  		<a class="btn btn-info" href="<?= $view_url ?>">
										<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View 
									</a>
							  	</td>
							</tr>
							<?php } ?>
						  </tbody>
					  </table>            
					