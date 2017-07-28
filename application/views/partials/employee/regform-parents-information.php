<div class="panel box box-primary">
    <div class="box-header">
        <h4 class="box-title">
            <a href="#collapse-parents-information" data-toggle="collapse" data-parent="#accordion-personal-background">Parents Infomation</a>
        </h4>
    </div>
    <div class="panel-collapse collapse" id="collapse-parents-information">
        <?php if (is_array($personal_background['parents_information'])): ?>
            <?php foreach ($personal_background['parents_information'] as $key => $parent_information): ?>
            <div class="box-body">
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $parent_information['first_name']; ?>">
                        <div class="validation_error"><?php echo form_error('first_name'); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $parent_information['middle_name']; ?>">
                        <div class="validation_error"><?php echo form_error('middle_name'); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $parent_information['last_name']; ?>">
                        <div class="validation_error"><?php echo form_error('last_name'); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <?php $male   = ($parent_information['gender'] == 1) ? 'checked':''; ?>
                    <?php $female = ($parent_information['gender'] == 0) ? 'checked':''; ?>
                    <div class="col-md-3">
                        <label>Birthdate</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" name="birthdate" class="form-control datepicker" value="<?php echo $parent_information['birthdate']; ?>">
                        </div>
                        <div class="validation_error"><?php echo form_error('birthdate'); ?></div>
                    </div>
                    <div class="col-md-3">
                        <label>Birthplace</label>
                        <input type="text" name="birthplace" class="form-control" value="<?php echo $parent_information['birthplace']; ?>">
                        <div class="validation_error"><?php echo form_error('birthplace'); ?></div>
                    </div>
                    <!-- <div class="col-md-3">
                        <label>Civil Status</label>
                        <select class="form-control" name="civil_status_id">
                            <option value="<?php echo $current_civil_status['id']; ?>"><?php echo $current_civil_status['status_name']; ?></option>
                            <option value="">--</option>
                            <?php foreach ($civil_status as $cs): ?>
                            <option value="<?php echo $cs['id']; ?>"><?php echo $cs['status_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="validation_error"><?php echo form_error('civil_status'); ?></div>
                    </div> -->
                    <!-- <div class="col-md-3">
                        <label>Gender</label>
                        <div class="form-group">
                            <input type="radio" name="gender" class="flat-red" <?php echo $male; ?>>
                            <label>Male</label>
                            <input type="radio" name="gender" class="flat-red" <?php echo $female; ?>>
                            <label>Female</label>
                        </div>
                        <div class="validation_error"><?php echo form_error('civil_status'); ?></div>
                    </div> -->
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
