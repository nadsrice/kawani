<div class="tab-pane fade" id="tab-benefits">
	<table class="table table-striped">
		<tr>
			<th>&nbsp;</th>
			<th>Benefit</th>
			<th>Amount</th>
			<th>Status</th>
		</tr>
		<?php foreach ($employee_benefits as $index => $benefit): ?>
		<tr>
			<!-- <td>
				<a href="<?php echo site_url('employees/confirmation/edit/'.$benefit['employee_id']); ?>">
					<i class="fa fa-pencil"></i> Edit
				</a>
			</td> -->
			<td class="text-center">
				<a href="<?php echo site_url('employees/view_benefit_information/'.$benefit['employee_benefits_id']); ?>" data-toggle="modal" data-target="#employee-benefit-view-more<?php echo $index; ?>">View More</a>
			</td>
			<td><?php echo $benefit['benefit_name']; ?></td>
			<td><?php echo $benefit['employee_benefit_amount']; ?></td>
			<td><?php echo $benefit['status_label']; ?></td>
		</tr>
		<div class="modal fade" id="employee-benefit-view-more<?php echo $index; ?>">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
		<?php endforeach ?>
	</table>
</div>
