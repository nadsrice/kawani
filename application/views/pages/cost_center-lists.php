<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('companies/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Cost Center</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Cost Centers</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-companies">
                    <thead>
                        <tr>
                            <th style="width: 250px;">&nbsp;</th>
                            <th class="text-left">No.</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Short Name</th>
                            <th class="text-left">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($cost_centers)): ?>
                            <?php foreach ($cost_centers as $cost_center): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('companies/details/' . $cost_center['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('companies/edit_confirmation/' . $cost_center['id']); ?>" data-toggle="modal" data-target="#update-company-<?php echo md5($cost_center['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('companies/update_status/' . $cost_center['id']); ?>" data-toggle="modal" data-target="#update-company-status-<?php echo md5($cost_center['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $cost_center['status_label']; ?>
                                        </a>
                                    </td>
                                    <td class="text-right"><?php echo $cost_center['id']; ?></td>
                                    <td class="text-left"><?php echo $cost_center['name']; ?></td>
                                    <td class="text-left"><?php echo $cost_center['short_name']; ?></td>
                                    <td class="text-left"><?php echo $cost_center['description']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-company-status-<?php echo md5($cost_center['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-company-<?php echo md5($cost_center['id']); ?>" role="dialog">
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
