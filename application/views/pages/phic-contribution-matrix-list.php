<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">PHIC Contribution Matrices</h3>
				<div class="box-tools pull-right">
					<a href="<?php echo site_url('phic_contribution_matrix/load_form'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-add-new-phic-matrix"><i class="fa fa-plus"></i> Add New PHIC Matrix</a>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="datatables-phic-matrix">
						<thead>
							<tr>
								<th>Action</th>
								<th>Year Effective</th>
								<th>Description</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! empty($phic_matrices)): ?>
							<?php foreach ($phic_matrices as $index => $phic_matrix): ?>
							<tr>
								<td>
									<a href="<?php echo site_url('phic_contribution_matrix/details/' . $phic_matrix['id']); ?>" class="btn btn-link">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="<?php echo site_url('phic_contribution_matrix/confirmation/edit/' . $phic_matrix['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('phic_contribution_matrix/confirmation/' . $phic_matrix['status_url'] . '/' . $phic_matrix['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa <?php echo $phic_matrix['status_icon']; ?>"></i> <?php echo $phic_matrix['status_action']; ?>
									</a>
								</td>
								<td><?php echo $phic_matrix['effectivity_date']; ?></td>
								<td><?php echo $phic_matrix['description']; ?></td>
								<td><?php echo $phic_matrix['status_label']; ?></td>
							</tr>

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
			
			<!-- MODALS -->
			<div class="modal fade" id="md-add-new-phic-matrix">
				<div class="modal-dialog">
					<div class="modal-content"></div>
				</div>
			</div>
			
			<?php if ($show_modal): ?>
				<div class="modal fade" id="modal-edit-phic-matrix">
					<div class="modal-dialog">
						<div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
					</div>
				</div>
				<script type="text/javascript">
					$(function() {
						$('#modal-edit-phic-matrix').modal({
							backdrop: false,
							keyboard: false
						});
					});
				</script>
			<?php endif ?>
			
		</div>
	</div>
</div>


