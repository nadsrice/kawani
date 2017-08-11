<!-- <div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('employee_schedules/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Set Schedule<span>
            </a>
        </div>
    </div>
</div> -->
<br>

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><?php echo $employee_details['full_name']; ?></h3>
                <p class="text-muted text-center">
                    <a href="<?php echo site_url('employee_schedules/details/' . $employee_details['id']); ?>">
                        <?php echo $employee_details['employee_code']; ?>
                    </a>
                </p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Company</b><br>
                        <?php echo $employee_details['company_name']; ?>
                    </li>
                </ul>
                <!-- <a href="<?php echo site_url('employee_schedules/edit/' . $employee_details['id']); ?>" class="<?php echo $btn_edit; ?> btn-block">Edit Details</a> -->
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
                        <div class="tab-pane fade in" id="tab1">
                            <div class="row">
                                
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade in" id="tab2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('employee_schedules/add/' . $employee_details['id']); ?>" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                            <span>Set Schedule<span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered table-striped table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th class="text-left">Date</th>
                                            <th class="text-left">Shift Code</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php if ( ! empty($employee_schedules)): ?>
                                        <?php foreach ($employee_schedules as $employee_schedule): ?>
                                            <?php dump($employee_schedule); ?>
                                        <tr>
                                            <td>
                                                <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_schedules/edit_confirmation/' . $employee_schedule['id']); ?>" data-toggle="modal" data-target="#update-employee_schedule-<?php echo md5($employee_schedule['id']); ?>">
                                                    <i class="fa fa-pencil-square-o"></i> Edit
                                                </a>
                                            </td>

                                            <td class="text-right"><?php echo date('d F Y', strtotime($employee_schedule['date'])); ?></td>
                                            <td class="text-left"><?php echo $employee_schedule['shift_code']; ?></td>
                                            <!-- <td class="text-left"><?php echo $employee_schedule['shift_code']; ?></td> -->
                                            <!-- <td class="text-left"><?php echo date('d F Y', strtotime($employee_schedule['date'])); ?></td> -->
                                        </tr>
                                        <div class="modal fade" id="update-employee_schedule-<?php echo md5($employee_schedule['id']); ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content"></div>
                                            </div>
                                        </div>
                                        <!-- <?php foreach ($employee_schedule['action_menus'] as $action_menu): ?>
                                            <div class="modal fade" id="<?php echo $action_menu['modal_id']; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content"></div>
                                                </div>
                                            </div>
                                        <?php endforeach ?> -->
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
