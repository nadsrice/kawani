<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Details</h3>
			</div>
			<div class="box-body box-profile">
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Year Effective</b> <a class="pull-right"><?php echo $tax_matrix['year_effective']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Description</b> <a class="pull-right"><?php echo $tax_matrix['description']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Status Label</b> <a class="pull-right"><?php echo $tax_matrix['status_label']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Created</b> <a class="pull-right"><?php echo date('F d, Y', strtotime($tax_matrix['created'])); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Tax Rates</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="datatables-tax-rates">
						<thead>
							<tr>
								<th>Action</th>
								<th>Tax Excemption Status</th>
								<th>Base Tax</th>
								<th>Percentage Over</th>
								<th>Minimum Monthly Salary</th>
								<th>Maximum Monthly Salary</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! empty($tax_rates)): ?>
							<?php foreach ($tax_rates as $index => $tax_rate): ?>
							<?php //dump($tax_rate); ?>
							<tr>
								<td>
									<a href="<?php echo site_url('tax_rates/details/' . $tax_rate['tax_rate_id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-tax-rate-detail-<?php echo $index; ?>">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="javascript:alert(1);" class="btn btn-link">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('tax_rates/' . $tax_rate['tr_status_url'] . '/' . $tax_rate['tax_rate_id']); ?>" class="btn btn-link">
										<i class="fa <?php echo $tax_rate['tr_status_icon']; ?>"></i> <?php echo $tax_rate['tr_status_action']; ?>
									</a>
								</td>
								<td><?php echo $tax_rate['te_tax_status']; ?></td>
								<td><?php echo $tax_rate['tr_base_tax']; ?></td>
								<td><?php echo $tax_rate['tr_percentage_over']; ?></td>
								<td><?php echo $tax_rate['tr_minimum_monthly_salary']; ?></td>
								<td><?php echo $tax_rate['tr_maximum_monthly_salary']; ?></td>
							</tr>

							<div class="modal fade" id="modal-tax-rate-detail-<?php echo $index; ?>">
								<div class="modal-dialog">
									<div class="modal-content"></div>
								</div>
							</div>

							<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>