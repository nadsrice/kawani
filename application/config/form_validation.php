<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'company_add' => array(
		array('field' => 'name', 'label' => 'Company Name', 'rules' => 'trim|required'),
		array('field' => 'short_name', 'label' => 'Company Code', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Company Description', 'rules' => 'trim|required')
	),

	'company_edit' => array(
		array('field' => 'name', 'label' => 'Company Name', 'rules' => 'trim|required'),
		array('field' => 'short_name', 'label' => 'Company Code', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Company Description', 'rules' => 'trim|required')
	),

	'branch_add' => array(
		array('field' => 'name', 'label' => 'Branch Name', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim')
	),

	'branch_edit' => array(
		array('field' => 'name', 'label' => 'Branch Name', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim')
	),

	'department_add' => array(
		array('field' => 'name', 'label' => 'Department Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim'),
		array('field' => 'site_id', 'label' => 'Site', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim')
	),

	'department_edit' => array(
		array('field' => 'name', 'label' => 'Branch Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'employment_type_add' => array(
		array('field' => 'type_name', 'label' => 'Type Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'employment_type_add' => array(
		array('field' => 'type_name', 'label' => 'Type Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'site_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim|required'),
		array('field' => 'name', 'label' => 'Site Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'Location Id', 'rules' => 'trim')
	),

	'site_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim|required'),
		array('field' => 'name', 'label' => 'Site Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'Location Id', 'rules' => 'trim')
	),

	'ob_add' => array(
		array('field' => 'account_id', 'label' => 'Account', 'rules' => 'trim|required'),
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'contact_person_id', 'label' => 'Client', 'rules' => 'trim|required'),
		array('field' => 'agenda', 'label' => 'Agenda', 'rules' => 'trim'),
		array('field' => 'location', 'label' => 'Location', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'OB Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required')
	),

	'ob_edit' => array(
		array('field' => 'account_id', 'label' => 'Account', 'rules' => 'trim|required'),
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'contact_person_id', 'label' => 'Client', 'rules' => 'trim|required'),
		array('field' => 'agenda', 'label' => 'Agenda', 'rules' => 'trim'),
		array('field' => 'location', 'label' => 'Location', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'OB Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required')
	),

	'add_module' => array(
		array('field' => 'name','label' => 'Module Name', 'rules' => 'trim|required|alpha'),
		array('field' => 'description','label' => 'Description', 'rules' => 'trim'),
		array('field' => 'link','label' => 'Link', 'rules' => 'trim')
	),

	'edit_module' => array(
		array('field' => 'name','label' => 'Module Name', 'rules' => 'trim|required|alpha'),
		array('field' => 'description','label' => 'Description', 'rules' => 'trim'),
		array('field' => 'link','label' => 'Link', 'rules' => 'trim')
	),

	'add_employee' => array(
		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required|alpha'),
		array('field' => 'middle_name', 'label' => 'Middle Name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required|alpha'),
		array('field' => 'email', 'label' => 'Email Address', 'rules' => 'trim|required|valid_email|is_unique[users.email]'),

	),

	'leave_type_add' => array(
		array('field' => 'name', 'label' => 'Leave Type', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'leave_type_edit' => array(
		array('field' => 'name', 'label' => 'Leave Type', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'leave_add' => array(
		array('field' => 'attendance_leave_type_id', 'label' => 'Leave Type', 'rules' => 'trim|required'),
		array('field' => 'date_start', 'label' => 'Date Start', 'rules' => 'trim|required'),
		array('field' => 'date_end', 'label' => 'Date End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim'),
		array('field' => 'payment_status', 'label' => 'Payment Status', 'rules' => 'trim|required'),
	),

	'leave_edit' => array(
		array('field' => 'attendance_leave_type_id', 'label' => 'Leave Type', 'rules' => 'trim|required'),
		array('field' => 'date_start', 'label' => 'Date Start', 'rules' => 'trim|required'),
		array('field' => 'date_end', 'label' => 'Date End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim')
	),

	'overtime_add' => array(
		array('field' => 'employee_id', 'label' => 'Leave Type', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Overtime Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim')
	),

	'overtime_edit' => array(
		array('field' => 'employee_id', 'label' => 'Leave Type', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Overtime Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim')
	),

	'undertime_add' => array(
		array('field' => 'employee_id', 'label' => 'Leave Type', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Undertime Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim')
	),

	'undertime_edit' => array(
		array('field' => 'employee_id', 'label' => 'Leave Type', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Undertime Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim')
	),

	'cost_center_add' => array(
		array('field' => 'name', 'label' => 'Cost Center Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim|required'),
		array('field' => 'department_id', 'label' => 'Department', 'rules' => 'trim|required'),
		array('field' => 'team_id', 'label' => 'Team', 'rules' => 'trim')
	),

	'cost_center_edit' => array(
		array('field' => 'name', 'label' => 'Cost Center Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim|required'),
		array('field' => 'department_id', 'label' => 'Department', 'rules' => 'trim|required'),
		array('field' => 'team_id', 'label' => 'Team', 'rules' => 'trim')
	),

	'bank_add' => array(
		array('field' => 'name', 'label' => 'Bank', 'rules' => 'trim|required'),
		array('field' => 'address', 'label' => 'Address', 'rules' => 'trim'),
		array('field' => 'contact_person', 'label' => 'Contact Person', 'rules' => 'trim'),
		array('field' => 'contact_number', 'label' => 'Contact Number', 'rules' => 'trim'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'bank_edit' => array(
		array('field' => 'name', 'label' => 'Bank', 'rules' => 'trim|required'),
		array('field' => 'address', 'label' => 'Address', 'rules' => 'trim'),
		array('field' => 'contact_person', 'label' => 'Contact Person', 'rules' => 'trim'),
		array('field' => 'contact_number', 'label' => 'Contact Number', 'rules' => 'trim'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'holiday_type_add' => array(
		array('field' => 'name', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required')
	),

	'holiday_type_edit' => array(
		array('field' => 'name', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required')
	),

	'holiday_add' => array(
		array('field' => 'attendance_holiday_type_id', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'holiday_date', 'label' => 'Holiday Date', 'rules' => 'trim|required'),
		array('field' => 'name', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim'),
		array('field' => 'site_id', 'label' => 'Site', 'rules' => 'trim')
	),

	'holiday_edit' => array(
		array('field' => 'attendance_holiday_type_id', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'holiday_date', 'label' => 'Holiday Date', 'rules' => 'trim|required'),
		array('field' => 'name', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim'),
		array('field' => 'site_id', 'label' => 'Site', 'rules' => 'trim')
	),

	'shift_schedule_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'code', 'label' => 'Shift Code', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'type', 'label' => 'Type', 'rules' => 'trim'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim'),
		array('field' => 'grace_period', 'label' => 'Grace Period', 'rules' => 'trim'),
		array('field' => 'no_of_hours', 'label' => 'Number of Hours', 'rules' => 'trim')
	),

	'shift_schedule_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'code', 'label' => 'Shift Code', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'type', 'label' => 'Type', 'rules' => 'trim'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim'),
		array('field' => 'grace_period', 'label' => 'Grace Period', 'rules' => 'trim'),
		array('field' => 'no_of_hours', 'label' => 'Number of Hours', 'rules' => 'trim')
	),

	'employee_schedule_add' => array(
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Date', 'rules' => 'trim'),
		array('field' => 'shift_id', 'label' => 'Shift Code', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim')
	),

	'employee_schedule_edit' => array(
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim|required'),
		array('field' => 'date', 'label' => 'Date', 'rules' => 'trim|required'),
		array('field' => 'shift_id', 'label' => 'Shift Code', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim')
	),

	'employee_personal_information' => array(
		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
		array('field' => 'middle_name', 'label' => 'Middle Name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim'),
		array('field' => 'birthdate', 'label' => 'Birthdate', 'rules' => 'trim'),
		array('field' => 'birthplace', 'label' => 'Birthplace', 'rules' => 'trim'),
		array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim'),
		array('field' => 'civil_status_id', 'label' => 'Civil Status', 'rules' => 'trim')
	),

	'employee_parents_information' => array(
		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
		array('field' => 'middle_name', 'label' => 'Middle Name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim'),
		array('field' => 'birthdate', 'label' => 'Birthdate', 'rules' => 'trim'),
		array('field' => 'birthplace', 'label' => 'Birthplace', 'rules' => 'trim'),
		array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim'),
		array('field' => 'occupation', 'label' => 'Occupation', 'rules' => 'trim'),
		array('field' => 'relationship_id', 'label' => 'Relationship', 'rules' => 'trim'),
		array('field' => 'type', 'label' => 'Type', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Type', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'build_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim')
	),

	'employee_spouse_information' => array(
		array('field' => 'first_name', 'label' => 'first_name', 'rules' => 'trim|required'),
		array('field' => 'middle_name', 'label' => 'middle_name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'last_name', 'rules' => 'trim|required'),
		array('field' => 'birthdate', 'label' => 'birthdate', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'block_number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'lot_number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'floor_number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'building_number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'building_name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'street', 'rules' => 'trim'),
		array('field' => 'barangay', 'label' => 'barangay', 'rules' => 'trim')
	),

	'employee_benefits' => array(
		array('field' => 'employee_id', 'label' => 'employee_id', 'rules' => 'trim'),
		array('field' => 'benefit_id', 'label' => 'benefit_id', 'rules' => 'trim'),
		array('field' => 'amount', 'label' => 'amount', 'rules' => 'trim')
	),

	'add_employee_dependants' => array(
		array('field' => 'employee_id', 'label' => 'employee', 'rules' => 'trim'),
		array('field' => 'name_prefix', 'label' => 'name_prefix', 'rules' => 'trim'),
		array('field' => 'first_name', 'label' => 'first_name', 'rules' => 'trim'),
		array('field' => 'middle_name', 'label' => 'middle_name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'last_name', 'rules' => 'trim'),
		array('field' => 'name_suffix', 'label' => 'name_suffix', 'rules' => 'trim'),
		array('field' => 'relationship_id', 'label' => 'relationship_id', 'rules' => 'trim'),
		array('field' => 'birthdate', 'label' => 'birthdate', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'block_number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'lot_number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'floor_number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'building_number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'building_name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'location_id', 'rules' => 'trim'),
		array('field' => 'remarks', 'label' => 'remarks', 'rules' => 'trim'),
		array('field' => 'birth_certificate', 'label' => 'birth_certificate', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'company_id', 'rules' => 'trim'),
	),

	'edit_employee_dependants' => array(
		array('field' => 'employee_id', 'label' => 'employee', 'rules' => 'trim'),
		array('field' => 'name_prefix', 'label' => 'name_prefix', 'rules' => 'trim'),
		array('field' => 'first_name', 'label' => 'first_name', 'rules' => 'trim'),
		array('field' => 'middle_name', 'label' => 'middle_name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'last_name', 'rules' => 'trim'),
		array('field' => 'name_suffix', 'label' => 'name_suffix', 'rules' => 'trim'),
		array('field' => 'relationship_id', 'label' => 'relationship_id', 'rules' => 'trim'),
		array('field' => 'birthdate', 'label' => 'birthdate', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'block_number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'lot_number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'floor_number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'building_number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'building_name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'location_id', 'rules' => 'trim'),
		array('field' => 'remarks', 'label' => 'remarks', 'rules' => 'trim'),
		array('field' => 'birth_certificate', 'label' => 'birth_certificate', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'company_id', 'rules' => 'trim'),
	),


    'employee_spouse_information' => array(
        array('field' => 'first_name', 'label' => 'first_name', 'rules' => 'trim|required'),
        array('field' => 'middle_name', 'label' => 'middle_name', 'rules' => 'trim'),
        array('field' => 'last_name', 'label' => 'last_name', 'rules' => 'trim|required'),
        array('field' => 'birthdate', 'label' => 'birthdate', 'rules' => 'trim'),
        array('field' => 'block_number', 'label' => 'block_number', 'rules' => 'trim'),
        array('field' => 'lot_number', 'label' => 'lot_number', 'rules' => 'trim'),
        array('field' => 'floor_number', 'label' => 'floor_number', 'rules' => 'trim'),
        array('field' => 'building_number', 'label' => 'building_number', 'rules' => 'trim'),
        array('field' => 'building_name', 'label' => 'building_name', 'rules' => 'trim'),
        array('field' => 'street', 'label' => 'street', 'rules' => 'trim'),
        array('field' => 'barangay', 'label' => 'barangay', 'rules' => 'trim')
    ),

    'daily_time_record_add' => array(
        array('field' => 'employee_id',       'label' => 'Employee',         'rules' => 'trim|required'),
        array('field' => 'shift_schedule_id', 'label' => 'Shift Schedule',   'rules' => 'trim|required'),
        array('field' => 'time_in',           'label' => 'Time In',          'rules' => 'trim|required'),
        array('field' => 'time_out',          'label' => 'Time Out',         'rules' => 'trim|required'),
        array('field' => 'number_of_hours',   'label' => 'Number of Hours',  'rules' => 'trim'),
        array('field' => 'minutes_tardy',     'label' => 'Minutes of Tardy', 'rules' => 'trim'),
        array('field' => 'minutes_undertime', 'label' => 'Minutes Undertime','rules' => 'trim'),
        array('field' => 'company_id',        'label' => 'Company',          'rules' => 'trim')
    ),

    'daily_time_record_edit' => array(
        array('field' => 'employee_id',       'label' => 'Employee',         'rules' => 'trim|required'),
        array('field' => 'shift_schedule_id', 'label' => 'Shift Schedule',   'rules' => 'trim|required'),
        array('field' => 'time_in',           'label' => 'Time In',          'rules' => 'trim|required'),
        array('field' => 'time_out',          'label' => 'Time Out',         'rules' => 'trim|required'),
        array('field' => 'number_of_hours',   'label' => 'Number of Hours',  'rules' => 'trim'),
        array('field' => 'minutes_tardy',     'label' => 'Minutes of Tardy', 'rules' => 'trim'),
        array('field' => 'minutes_undertime', 'label' => 'Minutes Undertime','rules' => 'trim'),
        array('field' => 'company_id',        'label' => 'Company',          'rules' => 'trim')
    ),

    'daily_time_log_add' => array(
        array('field' => 'employee_id', 'label' => 'Employee',    'rules' => 'trim|required'),
        array('field' => 'date_time',   'label' => 'Date & Time', 'rules' => 'trim|required'),
        array('field' => 'log_type',    'label' => 'Log Type',    'rules' => 'trim'),
        array('field' => 'device_id',   'label' => 'Device',      'rules' => 'trim'),
        array('field' => 'company_id',  'label' => 'Company',     'rules' => 'trim'),
        array('field' => 'latitude',    'label' => 'Latitude',    'rules' => 'trim'),
        array('field' => 'longitude',   'label' => 'Longitude',   'rules' => 'trim')
    ),

    'daily_time_log_edit' => array(
        array('field' => 'employee_id', 'label' => 'Employee',    'rules' => 'trim|required'),
        array('field' => 'date_time',   'label' => 'Date & Time', 'rules' => 'trim|required'),
        array('field' => 'log_type',    'label' => 'Log Type',    'rules' => 'trim|required'),
        array('field' => 'device_id',   'label' => 'Device',      'rules' => 'trim|required'),
        array('field' => 'company_id',  'label' => 'Company',     'rules' => 'trim'),
        array('field' => 'latitude',    'label' => 'Latitude',    'rules' => 'trim'),
        array('field' => 'longitude',   'label' => 'Longitude',   'rules' => 'trim')
    ),

	'add_employee_address' => array(
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim|required'),
		array('field' => 'type', 'label' => 'Type', 'rules' => 'trim|required'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'Location', 'rules' => 'trim'),
		array('field' => 'country_id', 'label' => 'Country', 'rules' => 'trim')
	),

	'device_add' => array(
		array('field' => 'name', 		'label' => 'Name', 		  'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'ip_address',  'label' => 'IP Address',  'rules' => 'trim'),
		array('field' => 'company_id',  'label' => 'Company', 	  'rules' => 'trim'),
		array('field' => 'site_id',     'label' => 'Site', 		  'rules' => 'trim')
	),

	'device_edit' => array(
		array('field' => 'name', 		'label' => 'Name', 		  'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'ip_address',  'label' => 'IP Address',  'rules' => 'trim'),
		array('field' => 'company_id',  'label' => 'Company', 	  'rules' => 'trim'),
		array('field' => 'site_id',     'label' => 'Site', 		  'rules' => 'trim')
	),

	'attachment_type_add' => array(
		array('field' => 'name', 		'label' => 'Name', 		  'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required')
	),

	'attachment_type_edit' => array(
		array('field' => 'name', 		'label' => 'Name', 		  'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required')
	)

);
