<div class="row">
	<div class="col-lg-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Register New Employee</h3>
			</div>
			<div class="box-body">
				<form id="example-advanced-form" action="#" class="form-horizontal">
				    <h5>Personal Background</h5>
					<h5>Contact Information</h5>
					<h5>Professional Background</h5>
					<h5>Employment Details</h5>

				    <fieldset class="box-group" id="personal-background-accordion">
						<div class="panel box box-solid">
							<div class="box-header with-border">
								<h4 class="box-title"><a data-toggle="collapse" data-parent="#personal-background-accordion" href="#personal-information">Personal Information</a></h4>
							</div>
							<div id="personal-information" class="panel-collapse collapse in">
								<div class="box-body">
									<div class="form-group">
										<div class="col-md-3 col-md-offset-1">
											<label for="piFirstname">First name</label>
											<input id="piFirstname" name="first_name" type="text" class="form-control required" placeholder="First Name">
										</div>
										<div class="col-md-3">
											<label for="piMiddlename">Middle name</label>
											<input id="piMiddlename" name="middle_name" type="text" class="form-control required" placeholder="Middle Name">
										</div>
										<div class="col-md-3">
											<label for="piLastname">Last name</label>
											<input id="piLastname" name="last_name" type="text" class="form-control required" placeholder="Last Name">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-1 col-md-offset-1">Email</label>
										<div class="col-md-8">
											<input id="email" name="email" type="text" class="form-control required email" placeholder="Email Address">
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
											<select id="pi_birthmonth" class="form-control" name="birthmonth">
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
											  <input type="radio" name="gender" class="form-control flat-red"> Male
											</label>
											<label class="radio-inline">
											  <input type="radio" name="gender" class="form-control flat-red"> Female
											</label>
										</div>
										<label class="control-label col-md-2">Civil Status</label>
										<div class="col-md-3">
											<select class="form-control" name="birthdate">
												<option value="">-- Select Status --</option>
												<?php foreach ($civil_status as $status): ?>
												<option value="<?php echo $status['id']; ?>"><?php echo $status['status_name']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="panel box box-solid">
									<div class="box-header with-border">
										<h4 class="box-title"><a data-toggle="collapse" data-parent="#personal-background-accordion" href="#parents-information">Parents Information</a></h4>
									</div>
									<div id="parents-information" class="panel-collapse collapse">
										<div class="box-body">
											<!-- <button class="btn btn-primary" type="button" name="add_parent" data-toggle="modal" data-target="#add-parent">Add Parent</button>
											<div class="modal fade" id="add-parent">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h4>Add Parent form</h4>
														</div>
														<div class="modal-body">
															<div class="form-horizontal">
																<div class="form-group">
																	<label for="" class="control-label col-sm-3">First Name</label>
																	<div class="col-sm-6">
																		<input type="text" id="first_name" name="first_name" value="" class="form-control">
																	</div>
																</div>
																<div class="form-group">
																	<label for="" class="control-label col-sm-3">Middle Name</label>
																	<div class="col-sm-6">
																		<input type="text" id="middle_name" name="middle_name" value="" class="form-control">
																	</div>
																</div>
																<div class="form-group">
																	<label for="" class="control-label col-sm-3">Last Name</label>
																	<div class="col-sm-6">
																		<input type="text" id="last_name" name="last_name" value="" class="form-control">
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-primary" name="button" onclick="addParent();">Add</button>
															<button type="button" class="btn btn-default" name="button" data-dismiss="modal">Cancel</button>
														</div>
													</div>
												</div>
											</div> -->

											<table class="table table-bordered" id="parentTable">
												<tr>
													<th>First Name</th>
													<th>Middle Name</th>
													<th>Last Name</th>
												</tr>
												<tr>
													<th colspan="3">No parent</th>
												</tr>
											</table>

											<!-- <script type="text/javascript">
												function addParent() {
													var parent = {
														fist_name: $('#first_name').val(),
														middle_name: $('#middle_name').val(),
														last_name: $('#last_name').val(),
													};

													var table = document.getElementById("parentTable");
													var row = table.insertRow(1);
													var firstName = row.insertCell(0);
													var middleName = row.insertCell(1);
													var lastName = row.insertCell(2);

													firstName.innerHTML = parent.fist_name;
													middleName.innerHTML = parent.middle_name;
													lastName.innerHTML = parent.last_name;

													$('#add-parent').modal('hide');

													var parent = {
														fist_name: '',
														middle_name: '',
														last_name: '',
													};
												}
											</script> -->
											<!-- <div class="form-group">
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
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="panel box box-solid">
									<div class="box-header with-border">
										<h4 class="box-title"><a data-toggle="collapse" data-parent="#personal-background-accordion" href="#spouse-information">Spouse Information</a></h4>
									</div>
									<div id="spouse-information" class="panel-collapse collapse">
										<div class="box-body">
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

								</div>
							</div>
						</div>


				    </fieldset>

					<fieldset>
						<div class="row">
							<div class="col-lg-12">
								<legend>Contact Information</legend>
							</div>
						</div>
					</fieldset>

					<fieldset>
						<div class="row">
							<div class="col-lg-12">
								<legend>Professional Background</legend>
							</div>
						</div>
					</fieldset>

					<fieldset>
						<div class="row">
							<div class="col-lg-12">
								<legend>Employment Details</legend>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo site_url('assets/js/employee.js'); ?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-steps-custom.js'); ?>" charset="utf-8"></script>

<script type="text/javascript">
	/**
	 * Creates the list of possible expiry years
	 *
	 * @param
	 * @return
	 */
	var getBirthYears = function () {

		var expiryYears = [];
		var date = new Date();
		var currentYear = date.getFullYear();
		var maxYear     = currentYear - 60;
		for(var year = currentYear; year >= maxYear; year-- ){
			expiryYears.push(year);
		}

		return expiryYears;
	}

	function getNumberOfDays(year, month) {
		var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
		var days = [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		return days[month];
	}

	var years = getBirthYears();

	var selectYear = document.getElementById('pi_birthyear');

	for(var i = 0; i < years.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = years[i];
		opt.value = years[i];
		selectYear.appendChild(opt);
	}

	var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	var selectMonth = document.getElementById('pi_birthmonth');

	for(var m = 0; m < months.length; m++) {
		var opt1 = document.createElement('option');
		opt1.innerHTML = months[m];
		opt1.value = m + 1;
		selectMonth.appendChild(opt1);
	}

	var selectDate = document.getElementById('pi_birthdate');

	for (var d = 1; d <= 31; d++) {
		var opt2 = document.createElement('option');
		opt2.innerHTML = d;
		opt2.value = d;
		selectDate.appendChild(opt2);
	}

	window.onbeforeunload = function(){
		return 'Are you sure you want to leave?';
	};
</script>
