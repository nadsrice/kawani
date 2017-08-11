<div class="tab-pane fade" id="tab-salary">
    <table class="table table-striped">
		<tr>
			<th>&nbsp;</th>
			<th>Salary Matrix Effective Date</th>
			<th>Salary Grade Code</th>
			<th>Monthly Salary</th>
			<th>Status</th>
		</tr>
		<?php foreach ($employee_salaries as $index => $salary): ?>
		<tr>
			<!-- <td>
				<a href="<?php echo site_url('employees/confirmation/edit/'.$salary['employee_id']); ?>">
					<i class="fa fa-pencil"></i> Edit
				</a>
			</td> -->
			<td class="text-center">
				<a href="<?php echo site_url('employees/view_salary_information/'.$salary['employee_salaries_id']); ?>" data-toggle="modal" data-target="#employee-salary-view-more<?php echo $index; ?>">View More</a>
			</td>
			<td><?php echo $salary['salary_matrix_effectivity_date']; ?></td>
			<td><?php echo $salary['salary_grade_code']; ?></td>
			<td><?php echo $salary['employee_monthly_salary']; ?></td>
			<td><?php echo $salary['status_label']; ?></td>
		</tr>
		<div class="modal fade" id="employee-salary-view-more<?php echo $index; ?>">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
		<?php endforeach ?>
	</table>
</div>
