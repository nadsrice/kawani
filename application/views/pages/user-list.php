
<div class="row">
	<div class="col-md-6">&nbsp;</div>
	<div class="col-md-6">
		<div class="pull-right">
			<a href="<?php echo site_url('auth/create_user'); ?>" class="btn btn-primary">
				<i class="fa fa-plus"></i>
				<span>Add New User</span>
			</a>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-list"></i> <h3 class="box-title"><?php echo lang('index_subheading');?></h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-striped table-hover" id="datatables-users">
					<tr>
						<th><?php echo lang('index_action_th');?></th>
						<th><?php echo lang('index_fname_th');?></th>
						<th><?php echo lang('index_lname_th');?></th>
						<th><?php echo lang('index_email_th');?></th>
						<th><?php echo lang('index_default_role_th');?></th>
					</tr>
					<?php foreach ($users as $user): ?>
						<?php if ($user->id != 1): ?>
							<tr>
								<td>
									<a class="<?php echo $btn_update ?>" href="<?php echo site_url('auth/edit_user/'.$user->id); ?>">
										<i class="fa fa-pencil-square-o"></i> Edit
									</a>
									<a class="<?php echo $btn_update ?>" href="<?php echo site_url('users/confirmation/'.$user->id); ?>" data-toggle="modal" data-target="#update-user-status-<?php echo md5($user->id); ?>">
										<i class="fa fa-cog"></i> <?php echo ($user->active) ? 'De-activate' : 'Activate'; ?>
									</a>
								</td>
					            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
					            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
					            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
								<td>
									<form action="<?php echo site_url('users/update_default_role/'); ?>" method="post" name="userRoleForm">
										<div class="input-group">
											<select class="form-control" name="user_role_id" onchange="this.form.submit()">
												<?php foreach ($user->groups as $group): ?>
												<option value="<?php echo $group->id; ?>" <?php echo ($group->default_status == 1) ? 'selected class="text-red"':''; ?>>
													<strong><?php echo strtoupper(htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')); ?></strong>
												</option>
												<?php endforeach?>
											</select>
											<span class="input-group-btn">
												<a href="#" onclick="loadModal()" class="btn btn-link" data-toggle="tooltip" data-placement="left" title="Add new role for this user">
													<i class="fa fa-plus"></i>
												</a>
											</span>
										</div>
										<input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
									</form>
								</td>
							</tr>
							<div class="modal fade" id="update-user-status-<?php echo md5($user->id); ?>">
								<div class="modal-dialog">
									<div class="modal-content"></div>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach;?>
				</table>
				<div class="modal fade" id="test">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4>Add New Role</h4>
							</div>
							<div class="modal-body">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function loadModal()
	{
		$('#test').modal();
	}

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
