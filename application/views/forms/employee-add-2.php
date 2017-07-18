<!-- <div ng-app="employeeApp">
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
</div> -->
<div class="row">
	<div class="col-lg-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Register New Employee</h3>
			</div>
			<div class="box-body">
				<form class="form-inline wizard clearfix">
					<div class="form-group">
						<select class="form-control select2" name="candidate">
							<option value="">-- Select Candidate --</option>
							<option value="">Sagun, Cristhian Kevin D.</option>
							<option value="">Aguilar, Ramon V.</option>
							<option value="">Aquino, Dean Joe</option>
							<option value="">Gono, Josh</option>
							<option value="">Palay, Ronald</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Select</button>
				</form>
				<br>
				<form id="example-advanced-form" action="#" class="form-horizontal">
				    <h5>Personal Background</h5>
					<h5>Contact Information</h5>
					<h5>Professional Background</h5>
					<h5>Employment Details</h5>

				    <fieldset>
						<div class="row">
							<div class="col-lg-12">
								<legend>Personal Information</legend>

								<div class="form-group">
									<div class="col-md-3 col-md-offset-1">
										<label for="piFirstname">First name</label>
										<input id="piFirstname" name="first_name" type="text" class="form-control required" placeholder="First">
									</div>
									<div class="col-md-3">
										<label for="piMiddlename">Middle name</label>
										<input id="piMiddlename" name="middle_name" type="text" class="form-control required" placeholder="Last">
									</div>
									<div class="col-md-3">
										<label for="piLastname">Last name</label>
										<input id="piLastname" name="last_name" type="text" class="form-control required" placeholder="Last">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-1 col-md-offset-1">Birthdate</label>
									<div class="col-md-2">
										<select id="pi_birthyear" class="form-control" name="birthyear">
											<option value="">-- Select Year --</option>
										</select>
									</div>
									<div class="col-md-3">
										<select id="pi_bithdate" class="form-control" name="birthmonth">
											<option value="">-- Select Month --</option>
										</select>
									</div>
									<div class="col-md-3">
										<select id="pi_birthdate" class="form-control" name="birthdate">
											<option value="">-- Select Date --</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-1 col-md-offset-1">Gender</label>
									<div class="col-md-3">
										<label class="radio-inline">
						                  <input type="radio" name="gender" class="form-control flat-red">
										  Male
						                </label>
						                <label class="radio-inline">
						                  <input type="radio" name="gender" class="form-control flat-red">
										  Female
						                </label>
									</div>
									<label class="control-label col-md-2">Civil Status</label>
									<div class="col-md-3">
										<select class="form-control" name="birthdate">
											<option value="">-- Select Date --</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<legend>Spouse Information</legend>
								<div class="form-group">
									<div class="col-md-3 col-md-offset-1">
										<label>First name</label>
										<input type="text" class="form-control" placeholder="First">
									</div>
									<div class="col-md-3">
										<label>Middle name</label>
										<input type="text" class="form-control" placeholder="Last">
									</div>
									<div class="col-md-3">
										<label>Last name</label>
										<input type="text" class="form-control" placeholder="Last">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-1 col-md-offset-1">Birthdate</label>
									<div class="col-md-2">
										<select class="form-control" name="birthyear">
											<option value="">-- Select Year --</option>
										</select>
									</div>
									<div class="col-md-3">
										<select class="form-control" name="birthmonth">
											<option value="">-- Select Month --</option>
										</select>
									</div>
									<div class="col-md-3">
										<select class="form-control" name="birthdate">
											<option value="">-- Select Date --</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-1 col-md-offset-1">Gender</label>
									<div class="col-md-3">
										<label class="radio-inline">
										  <input type="radio" name="gender" class="form-control flat-red">
										  Male
										</label>
										<label class="radio-inline">
										  <input type="radio" name="gender" class="form-control flat-red">
										  Female
										</label>
									</div>
									<label class="control-label col-md-2">Civil Status</label>
									<div class="col-md-3">
										<select class="form-control" name="birthdate">
											<option value="">-- Select Date --</option>
										</select>
									</div>
								</div>
					        </div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<legend>Spouse Information</legend>
								<div class="form-group">
									<div class="col-md-3 col-md-offset-1">
										<label>First name</label>
										<input type="text" class="form-control" placeholder="First">
									</div>
									<div class="col-md-3">
										<label>Middle name</label>
										<input type="text" class="form-control" placeholder="Last">
									</div>
									<div class="col-md-3">
										<label>Last name</label>
										<input type="text" class="form-control" placeholder="Last">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-1 col-md-offset-1">Birthdate</label>
									<div class="col-md-2">
										<select class="form-control" name="birthyear">
											<option value="">-- Select Year --</option>
										</select>
									</div>
									<div class="col-md-3">
										<select class="form-control" name="birthmonth">
											<option value="">-- Select Month --</option>
										</select>
									</div>
									<div class="col-md-3">
										<select class="form-control" name="birthdate">
											<option value="">-- Select Date --</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-1 col-md-offset-1">Gender</label>
									<div class="col-md-3">
										<label class="radio-inline">
										  <input type="radio" name="gender" class="form-control flat-red">
										  Male
										</label>
										<label class="radio-inline">
										  <input type="radio" name="gender" class="form-control flat-red">
										  Female
										</label>
									</div>
									<label class="control-label col-md-2">Civil Status</label>
									<div class="col-md-3">
										<select class="form-control" name="birthdate">
											<option value="">-- Select Date --</option>
										</select>
									</div>
								</div>
					        </div>
						</div>
				    </fieldset>


				    <fieldset>
				        <legend>Profile Information</legend>

				        <label for="name-2">First name *</label>
				        <input id="name-2" name="name" type="text" class="required">
				        <label for="surname-2">Last name *</label>
				        <input id="surname-2" name="surname" type="text" class="required">
				        <label for="email-2">Email *</label>
				        <input id="email-2" name="email" type="text" class="required email">
				        <label for="address-2">Address</label>
				        <input id="address-2" name="address" type="text">
				        <label for="age-2">Age (The warning step will show up if age is less than 18) *</label>
				        <input id="age-2" name="age" type="text" class="required number">
				        <p>(*) Mandatory</p>
				    </fieldset>


				    <fieldset>
				        <legend>You are to young</legend>

				        <p>Please go away ;-)</p>
				    </fieldset>


				    <fieldset>
				        <legend>Terms and Conditions</legend>
				        <input id="acceptTerms-2" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
				    </fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="<?php echo site_url('assets/libs/jquery-steps/1.1.0/jquery.steps.css'); ?>">
<script type="text/javascript" src="<?php echo site_url('assets/libs/jquery-validation/1.16.0/dist/jquery.validate.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/libs/jquery-steps/1.1.0/jquery.steps.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/employees.js'); ?>" charset="utf-8"></script>
