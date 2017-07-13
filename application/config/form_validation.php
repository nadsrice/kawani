<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'company_add' => array(
        array(
            'field' => 'name',
            'label' => 'Company Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'short_name',
            'label' => 'Company Code',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'description',
            'label' => 'Company Description',
            'rules' => 'trim|required'
        )
    ),

    'company_edit' => array(
        array(
            'field' => 'name',
            'label' => 'Company Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'short_name',
            'label' => 'Company Code',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'description',
            'label' => 'Company Description',
            'rules' => 'trim|required'
        )
    ),

    'branch_add' => array(
        array(
            'field' => 'name',
            'label' => 'Branch Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'company_id',
            'label' => 'Company',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim'
        ),
        array(
            'field' => 'block_number',
            'label' => 'Block Number',
            'rules' => 'trim'
        ),
        array(
            'field' => 'lot_number',
            'label' => 'Lot Number',
            'rules' => 'trim'
        ),
        array(
            'field' => 'floor_number',
            'label' => 'Floor Number',
            'rules' => 'trim'
        ),
        array(
            'field' => 'building_number',
            'label' => 'Building Number',
            'rules' => 'trim'
        ),
        array(
            'field' => 'building_name',
            'label' => 'Building Name',
            'rules' => 'trim'
        ),
        array(
            'field' => 'street',
            'label' => 'Street',
            'rules' => 'trim'
        )
    ),

    'branch_edit' => array(
        array(
            'field' => 'name',
            'label' => 'Branch Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'company_id',
            'label' => 'Company',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim'
        ),
        array(
            'field' => 'block_number',
            'label' => 'Block Number',
            'rules' => 'trim'
        ),
        array(
            'field' => 'lot_number',
            'label' => 'Lot Number',
            'rules' => 'trim'
        ),
        array(
            'field' => 'floor_number',
            'label' => 'Floor Number',
            'rules' => 'trim'
        ),
        array(
            'field' => 'building_number',
            'label' => 'Building Number',
            'rules' => 'trim'
        ),
        array(
            'field' => 'building_name',
            'label' => 'Building Name',
            'rules' => 'trim'
        ),
        array(
            'field' => 'street',
            'label' => 'Street',
            'rules' => 'trim'
        )
    ),

    'department_add' => array(
        array(
            'field' => 'name',
            'label' => 'Department Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim'
        ),
        array(
            'field' => 'company_id',
            'label' => 'Company',
            'rules' => 'trim'
        ),
        array(
            'field' => 'branch_id',
            'label' => 'Branch',
            'rules' => 'trim'
        ),
        array(
            'field' => 'site_id',
            'label' => 'Site',
            'rules' => 'trim'
        ),
        array(
            'field' => 'floor_number',
            'label' => 'Floor Number',
            'rules' => 'trim'
        )
    ),

    'department_edit' => array(
        array(
            'field' => 'name',
            'label' => 'Branch Name',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim'
        )

    ),

    'employment_type_add' => array(
        array(
            'field' => 'type_name',
            'label' => 'Type Name',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim'
        )

    ),

    'employment_type_add' => array(
        array(
            'field' => 'type_name',
            'label' => 'Type Name',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim'
        )

    ),

    'site_add' => array(
        array(
            'field' => 'company_id',
            'label' => 'Company',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'branch_id',
            'label' => 'Branch',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'name',
            'label' => 'Site Name',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim'
       ),
        array(
            'field' => 'block_number',
            'label' => 'Block Number',
            'rules' => 'trim'
       ),
        array(
            'field' => 'lot_number',
            'label' => 'Lot Number',
            'rules' => 'trim'
       ),
        array(
            'field' => 'floor_number',
            'label' => 'Floor Number',
            'rules' => 'trim'
       ),
        array(
            'field' => 'building_number',
            'label' => 'Building Number',
            'rules' => 'trim'
       ),
        array(
            'field' => 'building_name',
            'label' => 'Building Name',
            'rules' => 'trim'
       ),
        array(
            'field' => 'street',
            'label' => 'Street',
            'rules' => 'trim'
       ),
        array(
            'field' => 'location_id',
            'label' => 'Location Id',
            'rules' => 'trim'
       )

    ),

    'site_edit' => array(
        array(
            'field' => 'company_id',
            'label' => 'Company',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'branch_id',
            'label' => 'Branch',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'name',
            'label' => 'Site Name',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'block_number',
            'label' => 'Block Number',
            'rules' => 'trim'
       ),
        array(
            'field' => 'lot_number',
            'label' => 'Lot Number',
            'rules' => 'trim'
       ),
        array(
            'field' => 'floor_number',
            'label' => 'Floor Number',
            'rules' => 'trim'
       ),
        array(
            'field' => 'building_number',
            'label' => 'Building Number',
            'rules' => 'trim'
       ),
        array(
            'field' => 'building_name',
            'label' => 'Building Name',
            'rules' => 'trim'
       ),
        array(
            'field' => 'street',
            'label' => 'Street',
            'rules' => 'trim'
       ),
        array(
            'field' => 'location_id',
            'label' => 'Location Id',
            'rules' => 'trim'
       )

    ),

    'ob_add' => array(
        array(
            'field' => 'account_id',
            'label' => 'Account',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'employee_id',
            'label' => 'Employee',
            'rules' => 'trim'
        ),
        array(
            'field' => 'contact_person_id',
            'label' => 'Client',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'agenda',
            'label' => 'Agenda',
            'rules' => 'trim'
       ),
        array(
            'field' => 'location',
            'label' => 'Location',
            'rules' => 'trim'
       ),
        array(
            'field' => 'date',
            'label' => 'OB Date',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'time_start',
            'label' => 'Time Start',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'time_end',
            'label' => 'Time End',
            'rules' => 'trim|required'
       )

    ),

    'ob_edit' => array(
        array(
            'field' => 'account_id',
            'label' => 'Account',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'employee_id',
            'label' => 'Employee',
            'rules' => 'trim'
        ),
        array(
            'field' => 'contact_person_id',
            'label' => 'Client',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'agenda',
            'label' => 'Agenda',
            'rules' => 'trim'
       ),
        array(
            'field' => 'location',
            'label' => 'Location',
            'rules' => 'trim'
       ),
        array(
            'field' => 'date',
            'label' => 'OB Date',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'time_start',
            'label' => 'Time Start',
            'rules' => 'trim|required'
       ),
        array(
            'field' => 'time_end',
            'label' => 'Time End',
            'rules' => 'trim|required'
       )

    ),

	'add_module' => array(
		array(
			'field' => 'name',
			'label' => 'Module Name',
			'rules' => 'trim|required|alpha'
		),
		array(
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'trim'
		),
		array(
			'field' => 'link',
			'label' => 'Link',
			'rules' => 'trim'
		)
	),

	'edit_module' => array(
		array(
			'field' => 'name',
			'label' => 'Module Name',
			'rules' => 'trim|required|alpha'
		),
		array(
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'trim'
		),
		array(
			'field' => 'link',
			'label' => 'Link',
			'rules' => 'trim'
		)

	),

    'add_employee' => array(
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'ruels' => 'trim|required|alpha',        ),
        array(
            'field' => 'middle_name',
            'label' => 'Middle Name',
            'ruels' => 'trim',
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'ruels' => 'trim|required|alpha',
        ),
        array(
            'field' => 'email',
            'label' => 'Email Address',
            'ruels' => 'trim|required|valid_email|is_unique[users.email]',
        ),

	),

    'leave_type_add' => array(
        array(
            'field' => 'name',
            'label' => 'Leave Type',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim'
        )
    ),

    'leave_type_edit' => array(
        array(
            'field' => 'name',
            'label' => 'Leave Type',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim'
        )

    ),

    'leave_add' => array(
        array(
            'field' => 'attendance_leave_type_id',
            'label' => 'Leave Type',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'date_start',
            'label' => 'Date Start',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'date_end',
            'label' => 'Date End',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'reason',
            'label' => 'Reason',
            'rules' => 'trim'
        ),
        array(
            'field' => 'payment_status',
            'label' => 'Payment Status',
            'rules' => 'trim|required'
        ),
    ),

    'leave_edit' => array(
        array(
            'field' => 'attendance_leave_type_id',
            'label' => 'Leave Type',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'date_start',
            'label' => 'Date Start',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'date_end',
            'label' => 'Date End',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'reason',
            'label' => 'Reason',
            'rules' => 'trim'
        )
    ),

    'overtime_add' => array(
        array(
            'field' => 'employee_id',
            'label' => 'Leave Type',
            'rules' => 'trim'
        ),
        array(
            'field' => 'date',
            'label' => 'Overtime Date',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'time_start',
            'label' => 'Time Start',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'time_end',
            'label' => 'Time End',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'reason',
            'label' => 'Reason',
            'rules' => 'trim'
        )
    ),

    'overtime_edit' => array(
        array(
            'field' => 'employee_id',
            'label' => 'Leave Type',
            'rules' => 'trim'
        ),
        array(
            'field' => 'date',
            'label' => 'Overtime Date',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'time_start',
            'label' => 'Time Start',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'time_end',
            'label' => 'Time End',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'reason',
            'label' => 'Reason',
            'rules' => 'trim'
        )
    ),

    'undertime_add' => array(
        array(
            'field' => 'employee_id',
            'label' => 'Leave Type',
            'rules' => 'trim'
        ),
        array(
            'field' => 'date',
            'label' => 'Undertime Date',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'time_start',
            'label' => 'Time Start',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'time_end',
            'label' => 'Time End',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'reason',
            'label' => 'Reason',
            'rules' => 'trim'
        )
    ),

    'undertime_edit' => array(
        array(
            'field' => 'employee_id',
            'label' => 'Leave Type',
            'rules' => 'trim'
        ),
        array(
            'field' => 'date',
            'label' => 'Undertime Date',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'time_start',
            'label' => 'Time Start',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'time_end',
            'label' => 'Time End',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'reason',
            'label' => 'Reason',
            'rules' => 'trim'
        )
    )

);
