<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('roles/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add New Role</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Roles</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-branches">
                    <thead>
                        <tr>
                            <th style="width: 350px;">&nbsp;</th>
                            <th class="text-center">Branch No.</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Company Name</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Site</th>
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
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('branches/edit/' . $branch['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo $branch['id']; ?></td>
                                    <td class="text-center"><?php echo $branch['name']; ?></td>
                                    <td class="text-left"><?php echo $branch['company_name']; ?></td>
                                    <td class="text-left"><?php echo $branch['description']; ?></td>
                                    <td class="text-center"><?php echo $branch['active_status']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
