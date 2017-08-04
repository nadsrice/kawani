<!-- <div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('cost_centers/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Cost Center</span>
            </a>
        </div>
    </div>
</div> -->
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Employees</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-employees_schedules">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th class="text-left">Employee Code</th>
                            <th class="text-left">Employee Name</th>
                            <th class="text-left">Company</th>
                            <th class="text-left">Shift Code</th>
                            <th class="text-left">Shift</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($employee_schedules)): ?>
                            <?php foreach ($employee_schedules as $employee_schedule): ?>
                            <tr>
                                <td>
                                    <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employee_schedules/details/' . $employee_schedule['employee_id']); ?>">
                                        <i class="fa fa-search"></i> View
                                    </a>
                                    <!-- <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_schedules/edit_confirmation/' . $employee_schedule['id']); ?>" data-toggle="modal" data-target="#update-employee_chedule-<?php echo md5($employee_schedule['id']); ?>">
                                        <i class="fa fa-pencil-square-o"></i> Edit
                                    </a> -->
                                     <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_schedules/update_status/' . $employee_schedule['id']); ?>" data-toggle="modal" data-target="#update-employee_chedule-status-<?php echo md5($employee_schedule['id']); ?>">
                                        <i class="fa fa-cog"></i> <?php echo $employee_schedule['status_label']; ?>
                                    </a>
                                </td>

                                <td class="text-right"><?php echo $employee_schedule['employee_code']; ?></td>
                                <td class="text-left"><?php echo $employee_schedule['full_name']; ?></td>
                                <td class="text-left"><?php echo $employee_schedule['company_name']; ?></td>
                                <td class="text-left"><?php echo $employee_schedule['shift_code']; ?></td>
                                <td class="text-left"><?php echo $employee_schedule['date']; ?></td>
                            </tr>
                            <div class="modal fade" id="view-ob-<?php echo md5($employee_schedule['id']); ?>" role="dialog">
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
