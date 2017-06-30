<link rel="stylesheet" href="<?php echo site_url('assets/libs/iconate/css/iconate.css'); ?>">
<div ng-app="employeeApp">
	<div ng-controller="employeeController">
		<div class="row">
			<div class="col-xs-12">
				<ul class="nav nav-pills nav-justified thumbnail setup-panel">
					<li class="active">
						<a href="#step-1">
							<h4 class="list-group-item-heading">Step 1</h4>
							<p class="list-group-item-text"><i id="icon-step-1" class="fa fa-pencil fa-lg"></i> First step description</p>
						</a>
					</li>
					<li class="disabled">
						<a href="#step-2">
							<h4 class="list-group-item-heading">Step 2</h4>
							<p class="list-group-item-text"><i id="icon-step-2" class="fa fa-pencil fa-lg"></i> Second step description</p>
						</a>
					</li>
					<li class="disabled">
						<a href="#step-3">
							<h4 class="list-group-item-heading">Step 3</h4>
							<p class="list-group-item-text"><i id="icon-step-3" class="fa fa-pencil fa-lg"></i> Third step description</p>
						</a>
					</li>
					<li class="disabled">
						<a href="#step-4">
							<h4 class="list-group-item-heading">Step 4</h4>
							<p class="list-group-item-text"><i id="icon-step-4" class="fa fa-pencil fa-lg"></i> Second step description</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 setup-content" id="step-1">
				<div class="well text-center">
					<h1 class="text-center">STEP 1</h1>
					<button id="activate-step-2" class="btn btn-primary btn-md" ng-click="activateNextStep('2')">Activate Step 2</button>
				</div>
			</div>
			<div class="col-md-12 setup-content" id="step-2">
				<div class="well text-center">
					<h1 class="text-center">STEP 2</h1>
					<button id="activate-step-3" class="btn btn-primary btn-md" ng-click="activateNextStep('3')">Activate Step 3</button>
				</div>
			</div>
			<div class="col-md-12 setup-content" id="step-3">
				<div class="well text-center">
					<h1 class="text-center">STEP 3</h1>
					<button id="activate-step-4" class="btn btn-primary btn-md" ng-click="activateNextStep('4')">Activate Step 4</button>
				</div>
			</div>
			<div class="col-md-12 setup-content" id="step-4">
				<div class="well text-center">
					<h1 class="text-center"> STEP 4</h1>
					<button id="activate-step-4" class="btn btn-primary btn-md">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/employee-registration.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/libs/iconate/dist/iconate.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/libs/angularJS/1.6.4/angular.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/ng-employees.app.js'); ?>"></script>
<script>
	var navListItems = $('ul.setup-panel li a'),
	allWells = $('.setup-content');
	allWells.hide();

	navListItems.click(function(e) {
		e.preventDefault();
		var $target = $($(this).attr('href')),
		$item = $(this).closest('li');

		if ( ! $item.hasClass('disabled')) {
			navListItems.closest('li').removeClass('active');
			$item.addClass('active');
			allWells.hide();
			$target.show();
		}
	});
</script>
