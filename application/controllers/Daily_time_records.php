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
            'daily_time_log_model',
            'employee_schedule_model',
            'employee_information_model',
            'shift_schedule_model',
            'employee_model',
            'official_business_model',
            'overtime_model',
            'undertime_model',
            'leave_model',
            'leave_type_model'
        ]);
    }

    public function index()
    {
        // todo: get all companies records from database order by name ascending
            // todo: load daily_time_record model
            // todo: load view & past the retrieved data from model

        $user               = $this->ion_auth->user()->row();
        $daily_time_records = $this->daily_time_record_model->get_details('get_many_by', ['attendance_daily_time_records.employee_id' => $user->employee_id]);

        $this->data = array(
            'page_header'        => 'Attendance  Management',
            'daily_time_records' => $daily_time_records,
            'employee_id'        => $user->employee_id,
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
        $user        = $this->ion_auth->user()->row();
        $employee_id = $user->employee_id;
        $company_id  = $user->company_id;
        $log_type    = 1; //time in

        $reports_to = $this->employee_information_model->get_details('get_by', ['employee_information.employee_id' => $employee_id]);

        $this->data = array(
            'page_header' => 'Attendance Management',
            'log_type'    => $log_type,
            'employee_id' => $employee_id,
            'company_id'  => $company_id,
            'reports_to'  => $reports_to,
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('daily_time_log_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('daily_time_log_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key'    => 'add_daily_time_record',
            //     'old_data'    => NULL,
            //     'new_data'    => $data
            // ]);

            $daily_time_record_id = $this->daily_time_record_model->insert($data);

            if ( ! $daily_time_record_id)
            {
                $this->session->set_flashdata('failed', 'Failed to Time In.');
                redirect('daily_time_records');
            }
            else
            {
                $leave_days_request = daterange($data['date_start'], $data['date_end']);
                $leave_data = $this->leave_model->get_employee_attendance_leave([
                    'attendance_leaves.id' => $leave_id
                ]);

                $requester_data  = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);
                $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

                $approver_data   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);
                $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

                $data = [
                    'requester_data'     => $requester_data,
                    'requester_email'    => $requester_email,
                    'approver_data'      => $approver_data,
                    'approver_email'     => $approver_email,
                    'leave_data'         => $leave_data,
                    'leave_days_request' => $leave_days_request
                ];

                $subject        = 'Leave Request';                 // TODO: let's make this dynamic
                $email_template = 'templates/email/leave.tpl.php'; // TODO: let's make this dynamic also
                $name           = $subject.' - '.$requester_data['full_name'];

                $message = $this->load->view($email_template, $data, TRUE);

                $this->email->from($requester_email, $name);
                $this->email->to($approver_email);
                // $this->email->to('cristhiansagun@gmail.com');
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();

                $this->session->set_flashdata('success', 'Successfully added new leave.');

                redirect('daily_time_records');
            }
            
            // if ( ! $daily_time_record_id) {
            //     $this->session->set_flashdata('failed', 'Failed to add new daily time record.');
            //     redirect('daily_time_records');
            // } else {
            //     $this->session->set_flashdata('success', 'Successfully added new daily time record.');
            //     redirect('daily_time_records');
            // }
        }
        $this->load_view('forms/daily_time_log-page');
    }

    public function time_out()
    {
        $this->data = array(
            'page_header' => 'Attendance Management',
            'active_menu' => $this->active_menu,
        );
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
            'page_header'       => 'Attendance Management',
            'daily_time_record' => $daily_time_record,
            'active_menu'       => $this->active_menu,
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
                $this->session->set_flashdata('failed', 'Failed to update daily time record.');
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

    // public function test()
    // {
    //     $test = timediff_minutes("2017-08-29 10:00");
    //     dump($test);
    // }
}
