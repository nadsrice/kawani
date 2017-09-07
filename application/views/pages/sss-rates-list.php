<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Tax Matrices</h3>
				<div class="box-tools">
					<a href="<?php echo site_url('sss_contribution_rates/load_form'); ?>" class="btn btn-box-tool" data-toggle="modal" data-target="#md-add-sss-rate">
						<i class="fa fa-plus"></i> <span class="text-blue">Add New SSS Rate</span>
					</a>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="datatables-tax-matrix">
						<thead>
							<tr>
								<th>Action</th>
								<th>minimum_range</th>
								<th>maximum_range</th>
								<th>monthly_salary_base</th>
								<th>employer_share</th>
								<th>employee_share</th>
								<th>total</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! empty($sss_rates)): ?>
							<?php foreach ($sss_rates as $index => $sss_rate): ?>
							<tr>
								<td>
									<a href="<?php echo site_url('sss_contribution_rates/details/' . $sss_rate['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-details-<?php echo $index; ?>">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="<?php echo site_url('sss_contribution_rates/confirmation/edit/' . $sss_rate['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('sss_contribution_rates/confirmation/' . $sss_rate['sr_status_url'] . '/' . $sss_rate['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa <?php echo $sss_rate['sr_status_icon']; ?>"></i> <?php echo $sss_rate['sr_status_action']; ?>
									</a>
								</td>
								<td><?php echo $sss_rate['minimum_range']; ?></td>
								<td><?php echo $sss_rate['maximum_range']; ?></td>
								<td><?php echo $sss_rate['monthly_salary_base']; ?></td>
								<td><?php echo $sss_rate['employer_share']; ?></td>
								<td><?php echo $sss_rate['employee_share']; ?></td>
								<td><?php echo $sss_rate['total']; ?></td>
								<td><?php echo $sss_rate['sr_status_label']; ?></td>
							</tr>

							<div class="modal fade" id="modal-details-<?php echo $index; ?>">
								<div class="modal-dialog">
									<div class="modal-content"></div>
								</div>
							</div>

							<div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
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
		<div class="modal fade" id="md-add-sss-rate">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
	</div>
</div>