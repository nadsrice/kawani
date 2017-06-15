<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('official_businesses/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>File OB</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Filed Official Businesses</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-official_businesses">
                    <thead>
                        <tr>
                            <th style="width: 350px;">&nbsp;</th>
                            <th class="text-center">OB No.</th>
                            <th class="text-center">Employee Name</th>
                            <th class="text-center">Account</th>
                            <th class="text-center">Contact Person</th>
                            <th class="text-left">Agenda</th>
                            <th class="text-left">Location</th>
                            <th class="text-center">OB Date</th>
                            <th class="text-center">OB Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($official_businesses)): ?>
                            <?php foreach ($official_businesses as $official_business): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('official_businesses/details/' . $official_business['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('official_businesses/edit/' . $official_business['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo $official_business['id']; ?></td>
                                    <td class="text-center"><?php echo $official_business['full_name']; ?></td>
                                    <td class="text-left"><?php echo $official_business['account_name']; ?></td>
                                    <td class="text-left"><?php echo $official_business['contact_person']; ?></td>
                                    <td class="text-left"><?php echo $official_business['agenda']; ?></td>
                                    <td class="text-center"><?php echo $official_business['location']; ?></td>
                                    <td class="text-center"><?php echo $official_business['date']; ?></td>
                                    <td class="text-center"><?php echo $official_business['ob_time']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
