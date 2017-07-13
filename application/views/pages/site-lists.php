<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('sites/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Site</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Sites</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-sites">
                    <thead>
                        <tr>
                            <th style="width: 250px;">&nbsp;</th>
                            <th class="text-left">No.</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Company Name</th>
                            <th class="text-left">Branch Name</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Address</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($sites)): ?>
                            <?php foreach ($sites as $site): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('sites/details/' . $site['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('sites/edit_confirmation/' . $site['id']); ?>" data-toggle="modal" data-target="#update-site-<?php echo md5($site['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                       <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('sites/update_status/' . $site['id']); ?>" data-toggle="modal" data-target="#update-site-status-<?php echo md5($site['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $site['status_label']; ?>
                                        </a>
                                    </td>
                                    <td class="text-right"><?php echo $site['id']; ?></td>
                                    <td class="text-left"><?php echo $site['name']; ?></td>
                                    <td class="text-left"><?php echo $site['company_name']; ?></td>
                                    <td class="text-left"><?php echo $site['branch_name']; ?></td>
                                    <td class="text-left"><?php echo $site['description']; ?></td>
                                    <td class="text-left"><?php echo $site['site_address']; ?></td>
                                    <td class="text-center"><?php echo $site['active_status']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-site-status-<?php echo md5($site['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="update-site-<?php echo md5($site['id']); ?>" role="dialog">
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
