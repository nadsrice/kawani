<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><?php echo $company['name']; ?></h3>
                <p class="text-muted text-center">
                    <a href="<?php echo site_url('companies/details/' . $company['id']); ?>">
                        <?php echo $company['name']; ?>
                    </a>
                </p>
               <a href="<?php echo site_url('companies/edit/' . $company['id']); ?>" class="<?php echo $btn_edit; ?> btn-block">Edit Details</a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">Branches</a>
                </li>
                <li class="">
                    <a href="#tab2" data-toggle="tab">TAB 2</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                            <tr>
                                <th class="text-left">Branch ID</th>
                                <th class="text-left">Name</th>
                                <th class="text-left">Description</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($branches)): ?>
                                <?php foreach ($branches as $branch): ?>
                                    <tr>
                                        <td class="text-right"><?php echo $branch['id']; ?></td>
                                        <td class="text-left">
                                            <a href="<?php echo site_url('branches/details/' . $branch['id']); ?>">
                                                <?php echo $branch['name']; ?>
                                            </a>
                                        </td>
                                        <td class="text-left"><?php echo $branch['description']; ?></td>
                                        <td class="text-center"><?php echo ($branch['active_status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="3">No Records Found!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
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
