<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Tax Details</h3>
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
							<tr>
								<td>
									<a href="<?php echo site_url('tax_rate/details/' . $tax_rate['tax_table_id']); ?>" class="btn btn-link">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="<?php echo site_url('tax_rate/details/' . $tax_rate['tax_table_id']); ?>" class="btn btn-link">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('tax_rate/' . $tax_rate['tr_status_url'] . '/' . $tax_rate['tax_table_id']); ?>" class="btn btn-link">
										<i class="fa <?php echo $tax_rate['tr_status_icon']; ?>"></i> <?php echo $tax_rate['tr_status_action']; ?>
									</a>
								</td>
								<td><?php echo $tax_rate['te_tax_status']; ?></td>
								<td><?php echo $tax_rate['tr_base_tax']; ?></td>
								<td><?php echo $tax_rate['tr_percentage_over']; ?></td>
								<td><?php echo $tax_rate['tr_minimum_monthly_salary']; ?></td>
								<td><?php echo $tax_rate['tr_maximum_monthly_salary']; ?></td>
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