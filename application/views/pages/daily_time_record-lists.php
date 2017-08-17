<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('daily_time_records/time_in'); ?>" class="btn btn-primary">
                <i class="fa fa-clock-o"></i>
                <span>Time In</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">Daily Time Records</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-daily_time_records">
                    <thead>
                        <tr>
                            <th style="width: 250px;">&nbsp;</th>
                            <th class="text-left">Shift Code</th>
                            <th class="text-left">Date</th>
                            <th class="text-left">Time In</th>
                            <th class="text-left">Time Out</th>
                            <th class="text-left">Hours Rendered</th>
                            <th class="text-left">Tardiness</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($daily_time_records)): ?>
                            <?php foreach ($daily_time_records as $daily_time_record): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('daily_time_records/details/' . $daily_time_record['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('daily_time_records/edit_confirmation/' . $daily_time_record['id']); ?>" data-toggle="modal" data-target="#update-daily_time_record-<?php echo md5($daily_time_record['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                        <!-- <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('daily_time_records/update_status/' . $daily_time_record['id']); ?>" data-toggle="modal" data-target="#update-daily_time_record-status-<?php echo md5($daily_time_record['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $daily_time_record['status_label']; ?>
                                        </a> -->
                                    </td>
                                    <td class="text-left"><?php echo $daily_time_record['shift_code']; ?></td>
                                    <td class="text-right"><?php echo date('Y M d', strtotime($daily_time_record['time_in'])); ?></td>
                                    <td class="text-right"><?php echo date('h:i A', strtotime($daily_time_record['time_in'])); ?></td>
                                    <td class="text-right"><?php echo date('h:i A', strtotime($daily_time_record['time_out'])); ?></td>
                                    <td class="text-right"><?php echo $daily_time_record['number_of_hours']; ?></td>
                                    <td class="text-right"><?php echo $daily_time_record['minutes_tardy']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-daily_time_record-status-<?php echo md5($daily_time_record['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-daily_time_record-<?php echo md5($daily_time_record['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
