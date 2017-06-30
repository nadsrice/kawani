<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('attendance_official_businesses/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>File OB</span>
            </a>
        </div>
    </div>
</div>
<br>
<!-- <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Filed Official Businesses</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-official_businesses">
                    <thead>
                        <tr>
                            <th style="width: 250px;">&nbsp;</th>
                            <th class="text-left">No.</th>
                            <th class="text-left">Employee Name</th>
                            <th class="text-left">Account</th>
                            <th class="text-left">Contact Person</th>
                            <th class="text-left">Agenda</th>
                            <th class="text-left">Location</th>
                            <th class="text-left">OB Date</th>
                            <th class="text-left">OB Time</th>
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
                                    <td class="text-right"><?php echo $official_business['id']; ?></td>
                                    <td class="text-left"><?php echo $official_business['full_name']; ?></td>
                                    <td class="text-left"><?php echo $official_business['account_name']; ?></td>
                                    <td class="text-left"><?php echo $official_business['contact_person']; ?></td>
                                    <td class="text-left"><?php echo $official_business['agenda']; ?></td>
                                    <td class="text-left"><?php echo $official_business['location']; ?></td>
                                    <td class="text-right"><?php echo $official_business['date']; ?></td>
                                    <td class="text-right"><?php echo $official_business['ob_time']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 -->

<div class="row">  

	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Summary</h3>
					<div class="box-tools">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body no-padding">
					<ul class="nav nav-pills nav-stacked">
						<li>
							<a href="#">
								<i class="fa fa-clock-o"></i> Pending
								<span class="label pull-right pending_color">1,200</span>
							</a>
						</li>
						<li class="active">
							<a href="#">
								<i class="fa fa-thumbs-up"></i> Approved
								<span class="label pull-right approved_color">103</span>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-thumbs-down" ></i> Rejected
								<span class="label pull-right rejected_color">165</span>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-times-circle"></i> Cancelled
								<span class="label pull-right cancelled_color">65</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-list"></i> <h3 class="box-title">List of Filed Official Businesses</h3>
			</div>
			<br>
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#tab1" data-toggle="tab">My Official Business</a>
					</li>
					<li class="">
						<a href="#tab2" data-toggle="tab">Approvals</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="tab1">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover" id="datatables-myob">
							<thead>
								<tr>
									<th style="width: 250px;">&nbsp;</th>
									<th class="text-left">No.</th>
									<th class="text-left">Account</th>
									<th class="text-left">Contact Person</th>
									<th class="text-left">Agenda</th>
									<th class="text-left">Location</th>
									<th class="text-left">OB Date</th>
									<th class="text-left">OB Time</th>
								</tr>
							</thead>
							<tbody>
								<?php if ( ! empty($official_businesses)): ?>
								<?php foreach ($official_businesses as $official_business): ?>
								<tr>
									<td>
										<a class="<?php echo $btn_view; ?>" href="<?php echo site_url('official_businesses/view_ob/' . $official_business['id']); ?>">
										<i class="fa fa-search"></i> View
										</a>
										<!--  <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('official_businesses/edit/' . $official_business['id']); ?>">
										<i class="fa fa-pencil-square-o"></i> Edit
										</a> -->
									</td>
									<td class="text-right"><?php echo $official_business['id']; ?></td>
									<td class="text-left"><?php echo $official_business['account_name']; ?></td>
									<td class="text-left"><?php echo $official_business['contact_person']; ?></td>
									<td class="text-left"><?php echo $official_business['agenda']; ?></td>
									<td class="text-left"><?php echo $official_business['location']; ?></td>
									<td class="text-right"><?php echo $official_business['date']; ?></td>
									<td class="text-right"><?php echo $official_business['ob_time']; ?></td>
								</tr>
								<?php endforeach; ?>
							<?php endif; ?>
							</tbody>
						</table>
						</div>
					</div>
					<div class="tab-pane fade in" id="tab2">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover" id="datatables-obr">
							<thead>
								<tr>
									<th style="width: 350px;">&nbsp;</th>
									<th class="text-left">No.</th>
									<th class="text-left">Employee Name</th>
									<th class="text-left">Account</th>
									<th class="text-left">Contact Person</th>
									<th class="text-left">Agenda</th>
									<th class="text-left">Location</th>
									<th class="text-left">OB Date</th>
									<th class="text-left">OB Time</th>
								</tr>
							</thead>
							<tbody>
								<?php if ( ! empty($ob_requests)): ?>
								<?php foreach ($ob_requests as $ob_request): ?>
								<tr>
									<td>
										<a class="<?php echo $btn_view; ?>" href="<?php echo site_url('official_businesses/view_ob/' . $ob_request['id']); ?>" data-toggle="modal" data-target="#view-ob-<?php echo md5($ob_request['id']); ?>">
										<i class="fa fa-search"></i> View
										</a>
										<a class="<?php echo $btn_update; ?>" href="<?php echo site_url('official_businesses/edit/' . $ob_request['id']); ?>">
										<i class="fa fa-pencil-square-o"></i> Approve
										</a>
										<a class="<?php echo $btn_update; ?>" href="<?php echo site_url('official_businesses/edit/' . $ob_request['id']); ?>">
										<i class="fa fa-pencil-square-o"></i> Reject
										</a>
										<a class="<?php echo $btn_update; ?>" href="<?php echo site_url('official_businesses/edit/' . $ob_request['id']); ?>">
										<i class="fa fa-pencil-square-o"></i> Cancel
										</a>
									</td>

									<td class="text-right"><?php echo $ob_request['id']; ?></td>
									<td class="text-left"><?php echo $ob_request['full_name']; ?></td>
									<td class="text-left"><?php echo $ob_request['account_name']; ?></td>
									<td class="text-left"><?php echo $ob_request['contact_person']; ?></td>
									<td class="text-left"><?php echo $ob_request['agenda']; ?></td>
									<td class="text-left"><?php echo $ob_request['location']; ?></td>
									<td class="text-right"><?php echo $ob_request['date']; ?></td>
									<td class="text-right"><?php echo $ob_request['ob_time']; ?></td>
								</tr>
								<div class="modal fade" id="view-ob-<?php echo md5($ob_request['id']); ?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content"></div>
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
		</div>
	</div> 
</div>