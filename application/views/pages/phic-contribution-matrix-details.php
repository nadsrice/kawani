<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Details</h3>
			</div>
			<div class="box-body box-profile">
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Year Effective</b> <a class="pull-right"><?php echo $phic_matrix['effectivity_date']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Description</b> <a class="pull-right"><?php echo $phic_matrix['description']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Status Label</b> <a class="pull-right"><?php echo $phic_matrix['status_label']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Created</b> <a class="pull-right"><?php echo date('F d, Y', strtotime($phic_matrix['created'])); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">PHIC Rates</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="datatables-tax-rates">
						<thead>
							<tr>
								<th>Action</th>
								<th>Minimum Monthly Salary</th>
								<th>Maximum Monthly Salary</th>
								<th>Employee Shares</th>
								<th>Employer Shares</th>
								<th>Total Monthly Premium</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! empty($phic_rates)): ?>
							<?php foreach ($phic_rates as $index => $phic_rate): ?>
							<tr>
								<td>
									<a href="<?php echo site_url('phic_rate/details/' . $phic_rate['phic_rate_id']); ?>" class="btn btn-link">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="<?php echo site_url('phic_rate/details/' . $phic_rate['phic_rate_id']); ?>" class="btn btn-link">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('phic_rate/' . $phic_rate['pr_status_url'] . '/' . $phic_rate['phic_rate_id']); ?>" class="btn btn-link">
										<i class="fa <?php echo $phic_rate['pr_status_icon']; ?>"></i> <?php echo $phic_rate['pr_status_action']; ?>
									</a>
								</td>
								<td><?php echo $phic_rate['pr_minimum_range']; ?></td>
								<td><?php echo $phic_rate['pr_maximum_range']; ?></td>
								<td><?php echo $phic_rate['pr_employee_share']; ?></td>
								<td><?php echo $phic_rate['pr_employer_share']; ?></td>
								<td><?php echo $phic_rate['pr_total_monthly_premium']; ?></td>
							</tr>
							<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


</div>