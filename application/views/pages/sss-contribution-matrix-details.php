<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Details</h3>
			</div>
			<div class="box-body box-profile">
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Year Effective</b> <a class="pull-right"><?php echo $sss_matrix['year_effective']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Description</b> <a class="pull-right"><?php echo $sss_matrix['description']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Status Label</b> <a class="pull-right"><?php echo $sss_matrix['status_label']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Created</b> <a class="pull-right"><?php echo date('F d, Y', strtotime($sss_matrix['created'])); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">SSS Rates</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="datatables-sss-rates">
						<thead>
							<tr>
								<th>Action</th>
								<th>Minimum Range</th>
								<th>Maximum Range</th>
								<th>Monthly Salary Base</th>
								<th>Employer Share</th>
								<th>Employee Share</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! empty($sss_rates)): ?>
							<?php foreach ($sss_rates as $index => $sss_rate): ?>
							<tr>
								<td>
									<a href="<?php echo site_url('sss_rate/details/' . $sss_rate['sss_rate_id']); ?>" class="btn btn-link">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="<?php echo site_url('sss_rate/details/' . $sss_rate['sss_rate_id']); ?>" class="btn btn-link">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('sss_rate/' . $sss_rate['sr_status_url'] . '/' . $sss_rate['sss_rate_id']); ?>" class="btn btn-link">
										<i class="fa <?php echo $sss_rate['sr_status_icon']; ?>"></i> <?php echo $sss_rate['sr_status_action']; ?>
									</a>
								</td>
								<td><?php echo $sss_rate['sr_minimum_range']; ?></td>
								<td><?php echo $sss_rate['sr_maximum_range']; ?></td>
								<td><?php echo $sss_rate['sr_monthly_salary_base']; ?></td>
								<td><?php echo $sss_rate['sr_employer_share']; ?></td>
								<td><?php echo $sss_rate['sr_employee_share']; ?></td>
								<td><?php echo $sss_rate['sr_total']; ?></td>
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