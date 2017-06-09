<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('companies/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add New Company</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Companies</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-branches">
                    <thead>
                        <tr>
                            <th style="width: 350px;">&nbsp;</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Short Name</th>
                            <th class="text-left">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($companies)): ?>
                            <?php foreach ($companies as $company): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('companies/details/' . $company['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('companies/edit/' . $company['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo $company['name']; ?></td>
                                    <td class="text-center"><?php echo $company['short_name']; ?></td>
                                    <td class="text-left"><?php echo $company['description']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
