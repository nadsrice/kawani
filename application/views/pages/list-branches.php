<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('branches/add_branch'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add New Branch</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Branches</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-branches">
                    <thead>
                        <tr>
                            <th style="width: 350px;">&nbsp;</th>
                            <th class="text-center">Branch No.</th>
                            <th class="text-center">Name</th>
                            <th class="text-left">Building</th>
                            <th class="text-left">Site</th>
                            <th class="text-center">branch Type</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($branches)): ?>
                            <?php foreach ($branches as $branch): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('branches/details/' . $branch['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('branches/update_branch/' . $branch['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Update
                                        </a>
                                        <a class="<?php echo $btn_activate; ?>" href="<?php echo site_url('branches/' . $active_status['mode'] . '/' . $branch['id']); ?>" <?php echo ($active_status['modal'] == TRUE) ? 'data-toggle="modal" data-target="#modalConfirmation' . $branch['id'] . '"' : ''; ?>>
                                            <i class="<?php echo $active_status['icon']; ?>" style="color: <?php echo $active_status['color']; ?>"></i>
                                            <span><?php echo $active_status['label']; ?></span>
                                        </a>
                                        <div class="modal fade" id="modalConfirmation<?php echo $branch['id']; ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo $branch['branch_no']; ?></td>
                                    <td class="text-center"><?php echo $branch['room_name']; ?></td>
                                    <td class="text-left"><?php echo $branch['building_name']; ?></td>
                                    <td class="text-left"><?php echo $branch['site_name']; ?></td>
                                    <td class="text-center"><?php echo ($branch['branch_type_id'] == 0) ? 'Regular' : 'Extra'; ?></td>
                                    <td class="text-center">
                                        <span style="color:<?php echo $availability_status['color']; ?>;">
                                            <?php echo $availability_status['label']; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
