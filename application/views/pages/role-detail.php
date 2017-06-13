<div class="row">
    <div class="col-md-4">
		<div class="box box-widget widget-user-2">
			<div class="widget-user-header bg-blue">
				<h3 class="widget-user-username"><?php echo ucwords($role_data['name']); ?></h3>
				<h5 class="widget-user-desc"><?php echo $role_data['description']; ?></h5>
			</div>
			<div class="box-footer no-padding">
				<ul class="nav nav-stacked">
					<li>
						<a href="javascript:void(0);">Employees <span class="pull-right badge bg-green">15</span></a>
						<a href="javascript:void(0);">Modules <span class="pull-right badge bg-blue">6</span></a>
						<a href="javascript:void(0);">Functions <span class="pull-right badge bg-purple">44</span></a>
						<a href="javascript:void(0);">Permissions <span class="pull-right badge bg-red">164</span></a>
					</li>
				</ul>
			</div>
		</div>
    </div>
    <div class="col-md-8">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
				<li class="dropdown active">
					<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
						Role Permissions <span class="caret"></span>
					</a>
					<ul class="dropdown-menu multi-level" role="menu" arialabelledby="dropdownMenu">
						<?php foreach ($modules as $module): ?>
						<li class="dropdown-submenu" id="function-menu">
							<a tabindex="-1" href="javascript:void(0);">
								<?php echo $module->name; ?>
							</a>
							<ul class="dropdown-menu" id="tabtest">
								<?php foreach ($functions as $function): ?>
								<?php if ($module->id == $function->system_module_id): ?>
								<li class="">
									<a data-toggle="tab" href="#role-permission-<?php echo md5($function->name); ?>">
										<?php echo $function->name; ?>
									</a>
								</li>
								<?php endif ?>
								<?php endforeach ?>
							</ul>
						</li>
						<?php endforeach ?>
					</ul>
				</li>
                <li class="">
                    <a href="#employees" data-toggle="tab">Employees</a>
                </li>
            </ul>
            <div class="tab-content">
				<?php foreach ($functions as $function): ?>
				<div class="tab-pane fade in <?php echo ($function->id == 1) ? 'active' : ''; ?>" id="role-permission-<?php echo md5($function->name); ?>">
					<h3><?php echo $function->name; ?></h3>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Have Access?</th>
								<th class="text-left">Name</th>
							</tr>
						</thead>
						<tbody>
						<?php $checker = FALSE; ?>
						<?php foreach ($role_permissions as $role_permission): ?>
						<?php if ($role_permission['system_function_id'] == $function->id): ?>
							<?php $checker = TRUE; ?>
							<tr>
								<td class="text-center"><?php echo $role_permission['id']; ?></td>
								<td class="text-center">
									<a href="<?php echo site_url('role_permissions/update_status/'.$role_permission['id']); ?>" data-toggle="modal" data-target="#update-role-permission-<?php echo md5($role_permission['id']); ?>">
										<?php echo $role_permission['status']; ?>
									</a>
								</td>
								<td class="text-left"><?php echo $role_permission['system_permission_name']; ?></td>
								<div class="modal fade" id="update-role-permission-<?php echo md5($role_permission['id']); ?>" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content"></div>
									</div>
								</div>
							</tr>
						<?php endif ?>			
						<?php endforeach ?>
						<?php if (!$checker): ?>
							<tr>
								<td colspan="3" class="text-center">No record match found!</td>
							</tr>
						<?php endif ?>
						</tbody>
					</table>
				</div>
				<?php endforeach ?>

                <div class="tab-pane fade in" id="employees">
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

                <div class="tab-pane fade in" id="test1">
                    <h3>test1</h3>
                </div>
                <div class="tab-pane fade in" id="test2">
                    <h3>test2</h3>
                </div>
                <div class="tab-pane fade in" id="test3">
                    <h3>test3</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
	.dropdown-submenu {
		position: relative;
	}

	.dropdown-submenu>.dropdown-menu {
		top: 0;
		left: 100%;
		margin-top: -6px;
		margin-left: -1px;
		-webkit-border-radius: 0 6px 6px 6px;
		-moz-border-radius: 0 6px 6px;
		border-radius: 0 6px 6px 6px;
	}

	.dropdown-submenu:hover>.dropdown-menu {
		display: block;
	}

	.dropdown-submenu>a:after {
		display: block;
		content: " ";
		float: right;
		width: 0;
		height: 0;
		border-color: transparent;
		border-style: solid;
		border-width: 5px 0 5px 5px;
		border-left-color: #ccc;
		margin-top: 5px;
		margin-right: -10px;
	}

	.dropdown-submenu:hover>a:after {
		border-left-color: #fff;
	}

	.dropdown-submenu.pull-left {
		float: none;
	}

	.dropdown-submenu.pull-left>.dropdown-menu {
		left: -100%;
		margin-left: 10px;
		-webkit-border-radius: 6px 0 6px 6px;
		-moz-border-radius: 6px 0 6px 6px;
		border-radius: 6px 0 6px 6px;
	}
</style>
<script>			
	$('#function-menu > ul.dropdown-menu li').on('click', function (evt) {

		evt.preventDefault();

		// $('#function-menu > ul.dropdown-menu li').removeClass('active');
		// $(this).addClass('active');
	});
</script>