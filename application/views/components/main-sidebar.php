<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			<li class="">
				<a href="<?php echo site_url('home');   ?>">
					<i class="fa fa-home"></i>
					<span>Home</span>
				</a>
			</li>
			<!-- <li class="treeview">
				<a href="javascript:void(0)">
					<i class="fa fa-microchip"></i>
					<span>System Settings</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="">
						<a href="<?php echo site_url('system_settings/list_modules'); ?>">
							<i class="fa fa-angle-double-right"></i>
							<span>System Modules</span>
						</a>
					</li>
					<li class="">
						<a href="<?php echo site_url('system_settings/list_functions');   ?>">
							<i class="fa fa-angle-double-right"></i>
							<span>System Functions</span>
						</a>
					</li>
					<li class="">
						<a href="<?php echo site_url('system_settings/list_permissions');   ?>">
							<i class="fa fa-angle-double-right"></i>
							<span>System Permissions</span>
						</a>
					</li>
				</ul>
			</li> -->
			<?php foreach ($navigation_menu as $nav_menu): ?>
			<?php $is_active = isset($active_menu) ? $active_menu : ''; ?>
				<li class="<?php echo ($is_active == $nav_menu['module_name']) ? 'active' : ''; ?> treeview">
					<a href="javascript:void(0)">
						<i class="<?php echo $nav_menu['module_icon']; ?>"></i>
							<span><?php echo $nav_menu['module_name']; ?></span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php foreach ($nav_menu['module_functions'] as $sub_module): ?>
						<li>
							<a href="<?php echo site_url($sub_module->s_function_link); ?>">
								<i class="<?php echo $sub_module->s_function_icon; ?>"></i>
								<span><?php echo $sub_module->s_function_name; ?></span>
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
				</li>
            <?php endforeach; ?>
        </ul>
    </section>
</aside>
