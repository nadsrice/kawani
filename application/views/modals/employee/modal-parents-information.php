<div class="modal-header">
    <h4 class="modal-title">Modal Parent Info</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label class="control-label col-md-4">First Name</label>
        <div class="col-md-4">
            <input type="text" name="parents_information[first_name][]" class="form-control" placeholder="First Name" value="<?php echo $parents_information['first_name']; ?>">
            <div class="validation_error"><?php echo form_error('first_name'); ?></div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <a href="<?php site_url('employees/cancel_edit'); ?>" name="button" class="btn btn-default">Cancel</a>
    <button name="button" class="btn btn-primary">Submit</button>
</div>
