<div class="tab-pane fade" id="tab-positions">
	<div class="row">
		<div class="col-lg-12">
			<div class="pull-right">
				<a href="<?php echo site_url('employees/change_designation/'.$employee_id); ?>" class="btn btn-primary" data-toggle="modal" data-target="#change-position">Change Position</a>
				<div class="modal fade" id="change-position">
					<div class="modal-dialog">
						<div class="modal-content"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
    <div class="row">
    	<div class="col-lg-12">
    		<table class="table table-striped">
				<tr>
					<th>&nbsp;</th>
					<th>Date Started</th>
					<th>Date Ended</th>
					<th>Position</th>
					<th>Status</th>
				</tr>
				<?php foreach ($employee_positions as $index => $position): ?>
				<tr>
					<td><a href="<?php echo site_url('employees/view_position_information/'.$position['employee_positions_id']); ?>" data-toggle="modal" data-target="#employee-position-view-more-<?php echo $index; ?>">View More</a></td>
					<td><?php echo $position['date_started']; ?></td>
					<td><?php echo $position['date_ended']; ?></td>
					<td><?php echo $position['position']; ?></td>
					<td><p class="label <?php echo ($position['active_status'] == 1) ? 'label-success' : 'label-danger'; ?>"><?php echo $position['status_label']; ?></p></td>
				</tr>
				<div class="modal fade" id="employee-position-view-more-<?php echo $index; ?>">
					<div class="modal-dialog">
						<div class="modal-content"></div>
					</div>
				</div>
				<?php endforeach ?>
			</table>
    	</div>
    </div>
</div>
