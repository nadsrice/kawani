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
class Daily_time_records extends MY_Controller {

    private $active_menu = 'System';

    /**
     * Some description here
     *
     * @param   param
     * @return  return
     */

    function __construct()
    {
        parent::__construct();
        $this->load->library('audit_trail');
        $this->load->model([
            'daily_time_record_model',
            'employee_schedule_model',
            'shift_schedule_model',
            'employee_model'
        ]);
    }

    public function index()
    {
        // todo: get all companies records from database order by name ascending
            // todo: load daily_time_record model
            // todo: load view & past the retrieved data from model
        $user               = $this->ion_auth->user()->row();
        $daily_time_records = $this->daily_time_record_model->get_details('get_many_by', ['employee_id' => $user->employee_id]);

        $this->data = array(
            'page_header'        => 'Attendance  Management',
            'daily_time_records' => $daily_time_records,
            'active_menu'        => $this->active_menu,
        );

        $this->load_view('pages/daily_time_record-lists');
    }

    public function add()
    {
        $this->data = array(
            'page_header' => 'Attendance Management',
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('daily_time_record_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('daily_time_record_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key'    => 'add_daily_time_record',
            //     'old_data'    => NULL,
            //     'new_data'    => $data
            // ]);

            $daily_time_record_id = $this->daily_time_record_model->insert($data);

            if ( ! $daily_time_record_id) {
                $this->session->set_flashdata('failed', 'Failed to add new daily time record.');
                redirect('daily_time_records');
            } else {
                $this->session->set_flashdata('success', 'Successfully added new daily time record.');
                redirect('daily_time_records');
            }
        }
        $this->load_view('forms/daily_time_record-add');
    }

    public function time_in()
    {
        $this->data = array(
            'page_header' => 'Attendance Management',
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('daily_time_record_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('daily_time_record_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key'    => 'add_daily_time_record',
            //     'old_data'    => NULL,
            //     'new_data'    => $data
            // ]);

            $daily_time_record_id = $this->daily_time_record_model->insert($data);

            if ( ! $daily_time_record_id) {
                $this->session->set_flashdata('failed', 'Failed to Time In');
                redirect('daily_time_records');
            } else {
                $this->session->set_flashdata('success', 'Successfully Timed In');
                redirect('daily_time_records');
            }
        }
        $this->load_view('forms/daily_time_record-add');
    }

    public function edit($daily_time_record_id)
    {
        if ( ! $this->ion_auth_acl->has_permission('edit_daily_time_record'))
        {
            $this->session->set_flashdata('failed', 'You have no permission to access this module');
            redirect('/', 'refresh');
        }

        $daily_time_record = $this->daily_time_record_model->get_daily_time_record_by(['attendance_daily_time_records.id' => $daily_time_record_id]);

        $this->data = array(
            'page_header' => 'Attendance Management',
            'daily_time_record'     => $daily_time_record,
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('daily_time_record_edit'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('daily_time_record_edit') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 1,
            //     'perm_key'    => 'edit_daily_time_record',
            //     'old_data'    => $daily_time_record,
            //     'new_data'    => $data
            // ]);

            $daily_time_record_id = $this->daily_time_record_model->update($daily_time_record_id, $data);

            if ( ! $daily_time_record_id) {
                $this->session->set_flashdata('failed', 'Failed to update daily_time_record.');
                redirect('daily_time_records');
            } else {
                $this->session->set_flashdata('success', 'Attendance successfully updated!');
                redirect('daily_time_records');
            }
        }
        $this->load_view('forms/daily_time_record-edit');
    }

    public function details($id)
    {
        $daily_time_record = $this->daily_time_record_model->get_daily_time_record_by(['attendance_daily_time_records.id' => $id]);
        $employees         = $this->employee_model->get_many_employee_by(['daily_time_record_id' => $id]);


        $this->data = array(
            'page_header'       => 'Attendance Details',
            'daily_time_record' => $daily_time_record,
            'branches'          => $branches,
            'employees'         => $employees,
            'active_menu'       => $this->active_menu,
        );
        $this->load_view('pages/daily_time_record-details');
    }

    public function edit_confirmation($id)
    {
        $daily_time_record_data = $this->daily_time_record_model->get_by(['id' => $id]);
        $data['daily_time_record_data'] = $daily_time_record_data;

        $this->load->view('modals/modal-update-daily_time_record', $data);
    }

    public function update_status($id)
    {
        $daily_time_record_data         = $this->daily_time_record_model->get_by(['id' => $id]);
        $data['daily_time_record_data'] = $daily_time_record_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->daily_time_record_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->daily_time_record_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $daily_time_record_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('daily_time_records');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$daily_time_record_data['name'].'!');
                redirect('daily_time_records');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-daily_time_record-status', $data);
        }
    }
}
