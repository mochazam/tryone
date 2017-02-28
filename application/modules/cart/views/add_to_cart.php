<div style="background-color: #ddd; border-radius: 7px; margin-top: 24px; padding: 7px;">

	<table>
		<tr>
			<td>Item ID: </td>
			<td><?= $item_id ?></td>
		</tr>
		<?php if ($num_colours > 0) { ?>
		<tr>
			<td>Colour: </td>
			<td>
				<?php
				$additional_dd_code = 'class="form-control"';
				echo form_dropdown('color', $colour_options, $submitted_colour, $additional_dd_code);
				?>
			</td>
		</tr>
		<?php } ?>
		<?php if ($num_sizes > 0) { ?>
		<tr>
			<td>Size: </td>
			<td>
				<?php
				$additional_dd_code = 'class="form-control"';
				echo form_dropdown('size', $size_options, $submitted_size, $additional_dd_code);
				?>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td>Qty: </td>
			<td>
				<div class="col-sm-5" style="padding-left: 0px;">
					<input type="number" class="form-control" min="1" max="10" range="1">
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<button class="btn btn-primary" type="submit">
					<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
					Add To Cart
				</button>
			</td>
		</tr>
	</table>

</div>