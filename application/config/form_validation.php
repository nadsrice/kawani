<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'company_add' => array(
        array(
            'field' => 'registered_name',
            'label' => 'Company Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'code',
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
            'field' => 'registered_name',
            'label' => 'Company Name',
            'rules' => 'trim'
        ),
        array(
            'field' => 'code',
            'label' => 'Company Code',
            'rules' => 'trim'
        ),
        array(
            'field' => 'description',
            'label' => 'Company Description',
            'rules' => 'trim'
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
);
