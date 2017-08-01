<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */


 class Employee_schedules extends MY_Controller {

     private $active_menu = 'Administration';

     function __construct()
     {
         parent::__construct();
         $this->load->library('audit_trail');
         $this->load->model('employee_schedule_model');
     }

     public function index()
     {
         $employee_schedules = $this->employee_schedule_model->get_employee_schedule_all();

         $this->data = array(
            'page_header'        => 'Employee Schedule Management',
            'employee_schedules' => $employee_schedules,
            'active_menu'        => $this->active_menu
         );
         $this->load_view('pages/employee_schedule-lists');
     }

     public function add()
     {
        $user  = $this->ion_auth->user()->row();
        $where = [];

        $where['active_status'] = 1;

        if ($user->company_id != 0) {
            $where['id'] = $user->company_id;
        }

        $companies = $this->company_model->get_many_by($where);

        $this->data = array(
            'page_header' => 'Employee Schedule Mangement',
            'companies'   => $companies,
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('employee_schedule_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('employee_schedule_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key' 	  => 'add_employee_schedule',
            //     'old_data'	  => NULL,
            //     'new_data'    => $data
            // ]);

            $employee_schedule_id = $this->employee_schedule_model->insert($data);

            if ( ! $employee_schedule_id) {
                $this->session->set_flashdata('failed', 'Failed to add new employee_schedule.');
                redirect('employee_schedules');
            } else {
            $this->session->set_flashdata('success', 'Successfully added ' .$data['']);
                redirect('employee_schedules');
            }
        }

        $this->load_view('forms/employee_schedule-add');
    }

     function details($id)
     {
         $employee_schedule = $this->employee_schedule_model->get_employee_schedule_by(['attendance_employee_daily_schedules.id' => $id]);

         $this->data = array(
             'page_header'       => 'Employee Schedule Details',
             'employee_schedule' => $employee_schedule,
             'active_menu'       => $this->active_menu,
         );
         $this->load_view('pages/employee_schedule-detail');
     }

     public function edit($id)
     {
         // get specific employee_schedule based on the id
         $employee_schedule = $this->employee_schedule_model->get_employee_schedule_by(['attendance_employee_daily_schedules.id' => $id]);
        //  dump($employee_schedule);exit;
         // get all company records where status is equal to active
         $companies = $this->company_model->get_many_by(['active_status' => 1]);
        //  dump($this->db->last_query());exit;
         $this->data = array(
             'page_header'       => 'Employee Schedule Management',
             'employee_schedule' => $employee_schedule,
             'companies'	     => $companies,
             'active_menu'       => $this->active_menu,
         );

         $employee_schedules = $this->employee_schedule_model->get_employee_schedule_all();
         $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('employee_schedule_add'));

         $this->form_validation->set_data($data);

         if ($this->form_validation->run('employee_schedule_add') == TRUE)
         {
             $this->session->set_flashdata('log_parameters', [
                 'action_mode' => 1,
                 'perm_key'	  => 'edit_employee_schedule_type',
                 'old_data'	  => $employee_schedule,
                 'new_data'	  => $data
             ]);

             $employee_schedule_id = $this->employee_schedule_model->update($id, $data);

             if ( ! $employee_schedule_id) {
                 $this->session->set_flashdata('failed', 'Failed to update employee_schedule.');
                 redirect('employee_schedules');
             } else {
                 $this->session->set_flashdata('success', 'Employee Schedule successfully updated!');
                 redirect('employee_schedules');
             }
         }
         $this->load_view('forms/employee_schedule-edit');
     }

     public function edit_confirmation($id)
     {
         $edit_employee_schedule         = $this->employee_schedule_model->get_by(['id' => $id]);
         $data['edit_employee_schedule'] = $edit_employee_schedule;
         $this->load->view('modals/modal-update-employee_schedule', $data);
     }

     public function update_status($id)
     {
         $employee_schedule_data         = $this->employee_schedule_model->get_by(['id' => $id]);
         $data['employee_schedule_data'] = $employee_schedule_data;

         $post = $this->input->post();

         if (isset($post['mode']))
         {
             $result = FALSE;

             if ($post['mode'] == 'De-activate')
             {
                 dump('De-activating...');
                 $result = $this->employee_schedule_model->update($id, ['active_status' => 0]);
                 dump($this->db->last_query());
             }
             if ($post['mode'] == 'Activate')
             {
                 dump('Activating...');
                 $result = $this->employee_schedule_model->update($id, ['active_status' => 1]);
                 dump($this->db->last_query());
             }

             if ($result)
             {
                  $this->session->set_flashdata('message', $employee_schedule_data['code'].' successfully '.$post['mode'].'d!');
                  redirect('employee_schedules');
             }
             else
             {
                 $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$employee_schedule_data['code'].'!');
                 redirect('employee_schedules');
             }

         }
         else
         {
             $this->load->view('modals/modal-update-employee_schedule-status', $data);
         }
     }
 }
