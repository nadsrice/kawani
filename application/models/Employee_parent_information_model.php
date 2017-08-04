<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Employee_parent_information_model extends MY_Model
{
    protected $_table = 'employee_parents';
    protected $primary_key = 'id';
    protected $return_type = 'array';


    public function edit($employee_id, $posted_data)
    {
        $new_data = array();

        foreach ($posted_data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $relation_id => $parent_data) {
                    $new_data[$relation_id][$key] = $parent_data;
                }
            }
            else {
                dump($value);
            }
        }

        $result = array();
        foreach ($new_data as $data) {
            $data['modified'] = date('Y-m-d H:i:s');
            $result[] = $this->db->where(['relationship_id' => $data['relationship_id'], 'employee_id' => $data['employee_id']])->update($this->_table, $data);
        }

        $this->session->set_flashdata('success', lang('success_update_parent_data'));
        redirect('employees/informations/'.$employee_id);
    }
}
