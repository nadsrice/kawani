<div class="row">
	<div class="col-md-6">&nbsp;</div>
	<div class="col-md-6">
		<div class="pull-right">
			<a href="<?php echo site_url('users/add'); ?>" class="btn btn-primary">
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
				<i class="fa fa-list"></i> <h3 class="box-title">List of Users</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-striped table-hover" id="datatables-users">
					<thead>
						<tr>
							<th style="width: 350px;">&nbsp;</th>
							<th class="text-center">#</th>
							<th class="text-center">Full Name</th>
							<th class="text-center">Company Name</th>
							<th class="text-left">Phone</th>
							<th class="text-left">Email</th>
							<th class="text-center">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( ! empty($users)): ?>
						<?php foreach ($users as $user): ?>
						<tr>
							<td>
								<a class="<?php echo $btn_view; ?>" href="<?php echo site_url('users/details/' . $user['id']); ?>">
									<i class="fa fa-search"></i> View
								</a>
								<a class="<?php echo $btn_update; ?>" href="<?php echo site_url('users/edit/' . $user['id']); ?>">
									<i class="fa fa-pencil-square-o"></i> Edit
								</a>
							</td>
							<td class="text-center"><?php echo $user['id']; ?></td>
							<td class="text-center"><?php echo $user['full_name']; ?></td>
							<td class="text-left"><?php echo $user['company']; ?></td>
							<td class="text-left"><?php echo $user['phone']; ?></td>
							<td class="text-left"><?php echo $user['email']; ?></td>
							<td class="text-center"><?php echo $user['active']; ?></td>
						</tr>
						<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
