<div class="tab-pane fade" id="tab-positions">
    <table class="table table-striped">
		<tr>
			<th>&nbsp;</th>
			<th>Date Started</th>
			<th>Date Ended</th>
			<th>Position</th>
		</tr>
		<?php foreach ($employee_positions as $index => $position): ?>
		<tr>
			<!-- <td>
				<a href="<?php echo site_url('employees/confirmation/edit/'.$position['employee_id']); ?>">
					<i class="fa fa-pencil"></i> Edit
				</a>
			</td> -->
			<td>
				<a href="<?php echo site_url('employees/view_position_information/'.$position['employee_positions_id']); ?>" data-toggle="modal" data-target="#employee-position-view-more-<?php echo $index; ?>">View More</a>
			</td>
			<td><?php echo $position['date_started']; ?></td>
			<td><?php echo $position['date_ended']; ?></td>
			<td><?php echo $position['position']; ?></td>
		</tr>
		<div class="modal fade" id="employee-position-view-more-<?php echo $index; ?>">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
		<?php endforeach ?>
	</table>
</div>
