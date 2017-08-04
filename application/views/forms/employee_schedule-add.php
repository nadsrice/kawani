<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Set Employee Schedule</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('employee_schedules/add'); ?>" method="post">
                <div class="form-group">
                    <label class="control-label col-md-3">Company</label>
                    <div class="col-md-6">
                        <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="company_id" id="company">

                            <?php if (count($companies) > 1): ?>
                                <option value="">-- Select Company --</option>
                                <?php foreach ($companies as $company): ?>
                                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="<?php echo $companies[0]['id']; ?>"><?php echo $companies[0]['name']; ?></option>
                            <?php endif; ?>
                        </select>
                        <div class="validation_error"><?php echo form_error('company_id'); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Shift Code</label>
                    <div class="col-md-6">
                        <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="shift_id" id="shift">

                            <?php if (count($shift_schedules) > 1): ?>
                                <option value="">-- Select Shift --</option>
                                <?php foreach ($shift_schedules as $shift_schedule): ?>
                                <option value="<?php echo $shift_schedule['id']; ?>"><?php echo $shift_schedule['name']; ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="<?php echo $shift_schedules['id']; ?>"><?php echo $shift_schedules['name']; ?></option>
                            <?php endif; ?>
                        </select>
                        <div class="validation_error"><?php echo form_error('shift_id'); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Date</label>
                    <div class="col-md-6">
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                <input type="text" name="time_end" class="form-control pull-right timepicker">
                            </div>
                            <div class="validation_error"><?php echo form_error('time_end'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-6">
                        <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
