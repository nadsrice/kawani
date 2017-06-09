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

    )
);
