<div class="row">
	<div class="col-md-6">&nbsp;</div>
	<div class="col-md-6">
		<div class="pull-right">
			<a href="<?php echo site_url('employees/add'); ?>" class="btn btn-primary" data-toggle="modal" data-target="#add-employee">
				<i class="fa fa-plus"></i>
				<span>Add Employee</span>
			</a>
			<div class="modal fade" id="add-employee">
				<div class="modal-dialog">
					<div class="modal-content"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-list"></i> <h3 class="box-title">List of Employees</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-striped table-hover" id="datatables-employees">
					<thead>
						<tr>
							<th style="width: 350px;">&nbsp;</th>
							<th class="text-center">Employee Code</th>
							<th class="text-left">Full Name</th>
							<th class="text-left">Company Name</th>
							<th class="text-center">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( ! empty($employees)): ?>
						<?php foreach ($employees as $employee): ?>
						<tr>
							<td>
								<a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employees/informations/' . $employee['employee_id']); ?>">
									<i class="fa fa-search"></i> View
								</a>
								<a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employees/edit/' . $employee['employee_id']); ?>">
									<i class="fa fa-pencil-square-o"></i> Edit
								</a>
							</td>
							<td class="text-center"><?php echo $employee['employee_code']; ?></td>
							<td class="text-left"><?php echo $employee['full_name']; ?></td>
							<td class="text-left"><?php echo $employee['company_name']; ?></td>
							<td class="text-center"><?php echo $employee['active_status']; ?></td>
						</tr>
						<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
