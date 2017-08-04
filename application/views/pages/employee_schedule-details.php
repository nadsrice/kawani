<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('employee_schedules/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Set Schedule<span>
            </a>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><?php echo $employee_schedule['fullname']; ?></h3>
                <p class="text-muted text-center">
                    <a href="<?php echo site_url('employee_schedules/details/' . $employee_schedule['id']); ?>">
                        <?php echo $employee_schedule['employee_code']; ?>
                    </a>
                </p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Company</b><br>
                        <?php echo $employee_schedule['company_name']; ?>
                    </li>
                </ul>
                <!-- <a href="<?php echo site_url('employee_schedules/edit/' . $employee_schedule['id']); ?>" class="<?php echo $btn_edit; ?> btn-block">Edit Details</a> -->
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="box box-primary" >
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">Calendar View</a>
                        </li>
                        <li class="">
                            <a href="#tab2" data-toggle="tab">List View</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade in" id="tab2">
                            <table class="table table-bordered table-striped table-hover" id="">
                                <thead>
                                    <tr>
                                        <th class="text-left">Header</th>
                                        <th class="text-left">Header</th>
                                        <th class="text-left">Header</th>
                                        <th class="text-left">Header</th>
                                        <th class="text-left">Header</th>
                                        <th class="text-left">Header</th>
                                        <th class="text-left">Header</th>
                                        <th class="text-left">Header</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-left">TAB 2 DATA</td>
                                        <td class="text-left">TAB 2 DATA</td>
                                        <td class="text-left">TAB 2 DATA</td>
                                        <td class="text-left">TAB 2 DATA</td>
                                        <td class="text-left">TAB 2 DATA</td>
                                        <td class="text-left">TAB 2 DATA</td>
                                        <td class="text-left">TAB 2 DATA</td>
                                        <td class="text-left">TAB 2 DATA</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
