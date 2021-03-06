<form id="addTaxRateForm" class="form-horizontal" action="<?php echo site_url('tax_rates/add'); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-4 control-label">Tax Excemption Status</label>
			<div class="col-lg-7">
				<select name="tax_exemption_status_id" id="tax_exemption_status_id" class="form-control" required="true">
					<option value="">-- Select Status --</option>
					<?php foreach ($tax_exemption_status as $index => $tax_exemption): ?>
					<option value="<?php echo $tax_exemption['id']; ?>"><?php echo $tax_exemption['tax_status']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-4 control-label">Base Tax</label>
			<div class="col-lg-7">
				<input type="text" class="form-control" name="base_tax" id="base_tax">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-4 control-label">Percentage Over</label>
			<div class="col-lg-7">
				<input type="text" class="form-control" name="percentage_over" id="percentage_over">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-4 control-label">Maximum Monthly Salary</label>
			<div class="col-lg-7">
				<input type="text" class="form-control" name="maximum_monthly_salary" id="maximum_monthly_salary">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="tax_matrix_id" value="<?php echo $tax_matrix_id; ?>">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>

