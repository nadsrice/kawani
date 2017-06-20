<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('branches/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Branch</span>
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
                            <th style="width: 250px;">&nbsp;</th>
                            <th class="text-left">No.</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Company Name</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Status</th>
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
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('branches/edit_confirmation/' . $branch['id']); ?>" data-toggle="modal" data-target="#update-branch-<?php echo md5($branch['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('branches/update_status/' . $branch['id']); ?>" data-toggle="modal" data-target="#update-branch-status-<?php echo md5($branch['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $branch['status_label']; ?>
                                        </a>                                         
                                    </td>
                                    <td class="text-right"><?php echo $branch['id']; ?></td>
                                    <td class="text-left"><?php echo $branch['name']; ?></td>
                                    <td class="text-left"><?php echo $branch['company_name']; ?></td>
                                    <td class="text-left"><?php echo $branch['description']; ?></td>
                                    <td class="text-center"><?php echo $branch['active_status']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-branch-status-<?php echo md5($branch['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="update-branch-<?php echo md5($branch['id']); ?>" role="dialog">
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
