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
class Leaves extends MY_Controller {

    private $active_menu = 'Administration';
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
            'leave_model',
            'leave_type_model',
            'user_model'
        ]);
    }

    public function index()
    {
        // todo: get all leaves records from database order by name ascending
            // todo: load leave model
            // todo: load view & past the retrieved data from model

        $status = $this->uri->segment(3);
        $user            = $this->ion_auth->user()->row();

        if ( ! isset($status)) {
            $selected = '';
            $status = '';
        }

        $total_rejected  = $this->leave_model->count_by(['approval_status' => 0, 'employee_id' => $user->employee_id]); 
        $total_approved  = $this->leave_model->count_by(['approval_status' => 1, 'employee_id' => $user->employee_id]]); 
        $total_pending   = $this->leave_model->count_by(['approval_status' => 2, 'employee_id' => $user->employee_id]]); 
        $total_cancelled = $this->leave_model->count_by(['status' => 0, 'employee_id' => $user->employee_id]]);          

        $leaves          = $this->leave_model->get_leave_all();
        $leave_requests  = $this->leave_model->get_leave_requests(['attendance_leaves.approver_id' => $user->employee_id]);
        $my_leaves       = $this->leave_model->get_leave_requests(['attendance_leaves.employee_id' => $user->employee_id]);
        $leave_balances  = $this->employee_leave_credit_model->get_leave_credits_by(['
            employee_leave_credits.employee_id' => $user->employee_id]);

        // dump($this->db->last_query());
        // dump($leave_balances);exit;

        //$employee_info = $this->employee_model->get_employee_data('employee_contacts', ['employee_id' => 3]);

        $this->data = array(
            'page_header'     => 'Leave Management',
            'leave_requests'  => $leave_requests,
            'my_leaves'       => $my_leaves,
            'leave_balances'  => $leave_balances,
            'total_rejected'  => $total_rejected,
            'total_approved'  => $total_approved,
            'total_pending'   => $total_pending,
            'total_cancelled' => $total_cancelled,
            'active_menu'     => $this->active_menu,
        );

        $this->load_view('pages/attendance_leave-lists');
    }

    public function add()
    {
        $employee_id = $this->ion_auth->user()->row()->employee_id;
        $leave_types = $this->employee_model->get_employee_leave_credit([
            'employee_leave_credits.employee_id' => $employee_id
        ]);

        $employee_information = $this->employee_model->get_employee_information(['employee_id' => $employee_id]);
        $employee_data        = $this->employee_model->get_by(['id' => $employee_id]);

        $without_pay = FALSE;

        if (count($leave_types) < 1) {
            $leave_types = $this->leave_type_model->get_all();
            $without_pay = TRUE;
        }

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('leave_add'));

        if (isset($data['date_start']) && isset($data['date_end'])) {

            $data['date_start'] = date('Y-m-d', strtotime($data['date_start']));
            $data['date_end']   = date('Y-m-d', strtotime($data['date_end']));
        }

        if (isset($data['attendance_leave_type_id']))
        {
            $data['employee_id'] = $employee_id;
            $data['approver_id'] = $employee_information[0]['reports_to'];
        }

        $isset_radio = FALSE;

        if (isset($data['payment_status']) && $data['payment_status'] == 1) {
            $isset_radio = TRUE;
        }

        $this->data = array(
            'page_header' => 'Leave Management',
            'leave_types' => $leave_types,
            'without_pay' => $without_pay,
            'isset_radio' => $isset_radio,
            'active_menu' => $this->active_menu,
        );

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('leave_add') == TRUE)
        {
            $this->session->set_flashdata('log_parameters', [
                'action_mode' => 0,
                'perm_key'    => 'file_leave',
                'old_data'    => NULL,
                'new_data'    => $data
            ]);

            $leave_id = $this->leave_model->insert($data);

            if ( ! $leave_id)
            {
                $this->session->set_flashdata('failed', 'Failed to add new leave.');
                redirect('attendance_leaves');
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

                $subject        = 'Leave Request'; // TODO: let's make this dynamic
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

                redirect('attendance_leaves');
            }
        }

        $this->load_view('forms/attendance_leave-add');
    }

    public function approve($attendance_leave_id)
    {
        $attendance_leave = $this->leave_model->get_by(['id' => $attendance_leave_id]);
        $withpay          = $attendance_leave['payment_status'];

        $leave_types = $this->employee_model->get_employee_leave_credit([
            'employee_leave_credits.employee_id' => $attendance_leave['employee_id'],
            'position_leave_credits.attendance_leave_type_id' => $attendance_leave['attendance_leave_type_id']
        ]);

        $leave_balance   = $leave_types[0]['elc_balance'];
        $updated_balance = 0;

        $total_days_filed = daterange($attendance_leave['date_start'], $attendance_leave['date_end']);

        //Calculate days filed of Leave...
        $updated_balance  = calculate_leave_balance($leave_balance, $total_days_filed);


       if ($updated_balance != 0) {

            $employee_leave_credits_id = $leave_types[0]['elc_id'];

            $this->session->set_flashdata('old_data', $attendance_leave);

            $update_leave_credit    = $this->employee_leave_credit_model->update($employee_leave_credits_id, ['balance' => $updated_balance]);
            $update_approval_status = $this->leave_model->update($attendance_leave_id, ['approval_status' => 1]);

            $leave_data = $this->leave_model->get_employee_attendance_leave([
                'attendance_leaves.id' => $attendance_leave_id
            ]);

            $approver_data   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);
            // dump($approver_data);
            $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

            $requester_data  = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);
            $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

            $data = [
                'approver_data'   => $approver_data,
                'approver_email'  => $approver_email,
                'requester_data'  => $requester_data,
                'requester_email' => $requester_email,
                'leave_data'      => $leave_data
            ];

            $subject = 'Leave Request'; // TODO: let's make this dynamic
            $email_template = 'templates/email/leave_confirmation.php'; // TODO: let's make this dynamic also
            $name = $subject.' - '.$requester_data['full_name'];

            $message = $this->load->view($email_template, $data, TRUE);

            // $this->email->from('cristhiansagun@gmail.com');
            $this->email->to($approver_email);
            $this->email->to($requester_email, $name);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();

            $this->load->library('email');

            $this->session->set_flashdata('success', 'You have successfully approved the filed leave.');
            redirect('attendance_leaves');

        } else {

            $update_approval_status = $this->leave_model->update($attendance_leave_id, ['payment_status' => 0]);

            if ($update_approval_status) {

                $leave_data = $this->leave_model->get_employee_attendance_leave([
                    'attendance_leaves.id' => $attendance_leave_id
                ]);

                $approver_data   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);
                $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

                $requester_data  = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);
                $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

                $data = [
                    'approver_data'   => $approver_data,
                    'approver_email'  => $approver_email,
                    'requester_data'  => $requester_data,
                    'requester_email' => $requester_email,
                    'leave_data'      => $leave_data
                ];

                $subject = 'Leave Request'; // TODO: let's make this dynamic
                $email_template = 'templates/email/leave_confirmation.php'; // TODO: let's make this dynamic also
                $name = $subject.' - '.$requester_data['full_name'];

                $message = $this->load->view($email_template, $data, TRUE);

                $this->email->from('cristhiansagun@gmail.com');
                // $this->email->to($approver_email);
                $this->email->to($requester_email, $name);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();

                $this->load->library('email');

                // $message = $this->load->view('templates/email/leave_approve.tpl.php', [], true);

                // $this->email->from('joseph.gono@systemantech.com', 'OBR - Josh Gono');
                // $this->email->to('gono.josh@gmail.com');

                // $this->email->subject('Leave Request - Approved');
                // $this->email->message($message);

                // $this->email->send();

                // //an email notificaton will be sent to user that filed an OB

                // $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
                // $this->email->to('joseph.gono@systemantech.com');

                // $this->email->subject('Leave Request');
                // $this->email->message('Approval notification has been successfully sent to Josh Gono');

                // $this->email->send();

            } else {

            }
        }
    }

    public function disapprove($leave_id)
    {
         dump($leave_id);
        // $this->load->model('leave_model');
        // $update = $this->leave_model->update($leave_id, ['approval_status' => 0]);

        // if ($update) {

        //     $this->load->library('email');

        //     $message = $this->load->view('templates/email/leave_disapprove.tpl.php', [], true);

        //     $this->email->from('joseph.gono@systemantech.com', 'OBR - Josh Gono');
        //     $this->email->to('gono.josh@gmail.com');

        //     $this->email->subject('Leave Request - Disapproved');
        //     $this->email->message($message);

        //     $this->email->send();

        //     //sent to sender
        //     //$message = $this->load->view('templates/email/leave_approve.tpl.php', [], true);

        //     $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
        //     $this->email->to('joseph.gono@systemantech.com');

        //     $this->email->subject('Leave Request');
        //     $this->email->message('Disapproval notification has been successfully sent to Josh Gono');

        //     $this->email->send();

        // } else {

        // }
    }

    public function edit($id)
    {
        // get specific leave based on the id
        $leave = $this->leave_model->get_leave_by(['attendance_leaves.id' => $id]);

        $this->data = array(
            'page_header'       => 'Leave Management',
            'leave'             => $leave,
            'active_menu'       => $this->active_menu,
        );

        // $leaves = $this->leave_model->get_leave_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('leave_add'));

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('leave_add') == TRUE)
        {
            $leave_id = $this->leave_model->update($id, $data);

            if ( ! $leave_id) {
                $this->session->set_flashdata('failed', 'Failed to update leave.');
                redirect('attendance_leaves');
            } else {
                $this->session->set_flashdata('success', 'Leave successfully updated!');
                redirect('attendance_leaves');
            }
        }
        $this->load_view('forms/attendance_leave-edit');
    }

    public function details($id)
    {
        $leave = $this->leave_model->get_leave_by(['attendance_leaves.id' => $id]);

        $this->data = array(
            'page_header' => 'Leave Details',
            'leave'       => $leave,
            'active_menu' => $this->active_menu,
        );

        $this->load_view('pages/attendance_leave-details');
    }

    public function approve_leave($id)
    {
        $attendance_leave = $this->leave_model->get_by(['id' => $id]);

        $withpay          = $attendance_leave['payment_status'];

        $leave_types = $this->employee_model->get_employee_leave_credit([
            'employee_leave_credits.employee_id' => $attendance_leave['employee_id'],
            'position_leave_credits.attendance_leave_type_id' => $attendance_leave['attendance_leave_type_id']
        ]);


        $leave_balance   = $leave_types[0]['elc_balance'];
        $updated_balance = 0;

        $total_days_filed = daterange($attendance_leave['date_start'], $attendance_leave['date_end']);  //Number of days filed...
        $updated_balance  = calculate_leave_balance($leave_balance, $total_days_filed);                 //Calculate days filed of Leave...

        $requester              = $this->employee_model->get_by(['id' => $attendance_leave['employee_id']]);
        $data['modal_title']    = 'Approve Official Business';
        $data['modal_message']  = sprintf(lang('approve_leave_message'), $requester['full_name']);
        $data['url']            = 'attendance_leaves/approve_leave/' . $id;
        $data['mode']           = 'approve';
        // dump($data);

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'approve') {
            if ($updated_balance != 0) {

                $employee_leave_credits_id = $leave_types[0]['elc_id'];

                $update_leave_credit    = $this->employee_leave_credit_model->update($employee_leave_credits_id, ['balance' => $updated_balance]);
                $update_approval_status = $this->leave_model->update($id, ['approval_status' => 1]);

                $leave_data = $this->leave_model->get_employee_attendance_leave([
                    'attendance_leaves.id' => $id
                ]);

                $approver_data   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);
                // dump($approver_data);
                $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

                $requester_data  = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);
                $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

                $data = [
                    'approver_data'   => $approver_data,
                    'approver_email'  => $approver_email,
                    'requester_data'  => $requester_data,
                    'requester_email' => $requester_email,
                    'leave_data'      => $leave_data
                ];

                // dump($data);exit;

                $subject = 'Leave Request'; // TODO: let's make this dynamic
                $email_template = 'templates/email/leave_confirmation.php'; // TODO: let's make this dynamic also
                $name = $subject.' - '.$requester_data['full_name'];

                $message = $this->load->view($email_template, $data, TRUE);

                // $this->email->from('cristhiansagun@gmail.com');
                $this->email->from($approver_email);
                $this->email->to($requester_email, $name);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();

                $this->load->library('email');

                $this->session->set_flashdata('success', 'You have successfully approved the filed leave.');
                redirect('attendance_leaves');
            } else {

                $update_payment_status  = $this->leave_model->update($id, ['payment_status' => 0]);
                $update_approval_status = $this->leave_model->update($id, ['approval_status' => 1]);

                if ($update_approval_status) {

                    $this->load->library('email');

                    $leave_data = $this->leave_model->get_employee_attendance_leave([
                        'attendance_leaves.id' => $id
                    ]);

                    $approver_data   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);
                    $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

                    $requester_data  = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);
                    $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

                    $data = [
                        'approver_data'   => $approver_data,
                        'approver_email'  => $approver_email,
                        'requester_data'  => $requester_data,
                        'requester_email' => $requester_email,
                        'leave_data'      => $leave_data
                    ];

                    $subject = 'Leave Request'; // TODO: let's make this dynamic
                    $email_template = 'templates/email/leave_confirmation.php'; // TODO: let's make this dynamic also
                    $name = $subject.' - '.$requester_data['full_name'];

                    $message = $this->load->view($email_template, $data, TRUE);

                    $this->email->from($approver_email);
                    // $this->email->to($approver_email);
                    $this->email->to($requester_email, $name);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $this->email->send();
                }
            }
        }

        $this->load->view('modals/modal-confirmation', $data);
    }


    public function reject_leave($id)
    {
        dump($id, 'reject_leave:');
    }

    public function cancel_leave($id)
    {
        $attendance_leave = $this->leave_model->get_by(['id' => $id]);
        $withpay          = $attendance_leave['payment_status'];

        $leave_types = $this->employee_model->get_employee_leave_credit([
            'employee_leave_credits.employee_id' => $attendance_leave['employee_id'],
            'position_leave_credits.attendance_leave_type_id' => $attendance_leave['attendance_leave_type_id']
        ]);

        $leave_balance   = $leave_types[0]['elc_balance'];
        $updated_balance = 0;

        $total_days_filed = daterange($attendance_leave['date_start'], $attendance_leave['date_end']);

        //Calculate days filed of Leave...
        $updated_balance  = add_leave_balance($leave_balance, $total_days_filed);

        $requester              = $this->employee_model->get_by(['id' => $attendance_leave['employee_id']]);
        $data['modal_title']    = 'Cancel Official Business';
        $data['modal_message']  = sprintf(lang('cancel_leave_message'), $requester['full_name']);
        $data['url']            = 'attendance_leaves/cancel_leave/' . $id;
        $data['mode']           = 'cancel';
        // dump($data);

        $post = $this->input->post();


        if (isset($post['mode']) && $post['mode'] == 'cancel') {
            if ($updated_balance != 0) {

                $employee_leave_credits_id = $leave_types[0]['elc_id'];

                $update_leave_credit    = $this->employee_leave_credit_model->update($employee_leave_credits_id, ['balance' => $updated_balance]);
                $update_approval_status = $this->leave_model->update($id, ['status' => 0]);

                $leave_data = $this->leave_model->get_employee_attendance_leave([
                    'attendance_leaves.id' => $id
                ]);

                $approver_data   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);
                // dump($approver_data);
                $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

                $requester_data  = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);
                $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

                $data = [
                    'approver_data'   => $approver_data,
                    'approver_email'  => $approver_email,
                    'requester_data'  => $requester_data,
                    'requester_email' => $requester_email,
                    'leave_data'      => $leave_data
                ];

                $subject = 'Leave Request'; // TODO: let's make this dynamic
                $email_template = 'templates/email/leave_confirmation.php'; // TODO: let's make this dynamic also
                $name = $subject.' - '.$requester_data['full_name'];

                $message = $this->load->view($email_template, $data, TRUE);

                // $this->email->from('cristhiansagun@gmail.com');
                $this->email->from($approver_email);
                $this->email->to($requester_email, $name);
                $this->email->subject($subject);
                $this->email->message('Your '.$leave_types['leave_type'].' has been cancelled by '.$approver_data['full_name']);
                $this->email->send();

                $this->load->library('email');

                $this->session->set_flashdata('success', 'You have been cancelled the filed leave.');
                redirect('attendance_leaves');

            } else {

                $update_payment_status  = $this->leave_model->update($id, ['payment_status' => 0]);
                $update_approval_status = $this->leave_model->update($id, ['status' => 0]);

                if ($update_approval_status) {

                    $leave_data = $this->leave_model->get_employee_attendance_leave([
                        'attendance_leaves.id' => $id
                    ]);

                    $approver_data   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);
                    $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

                    $requester_data  = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);
                    $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

                    $data = [
                        'approver_data'   => $approver_data,
                        'approver_email'  => $approver_email,
                        'requester_data'  => $requester_data,
                        'requester_email' => $requester_email,
                        'leave_data'      => $leave_data
                    ];

                    $subject = '[HRIS - Cancelled] Attendance:'.$leave_data['leave_type'].' Request'.' - '.$id; // TODO: let's make this dynamic
                    $email_template = 'templates/email/leave_confirmation.php'; // TODO: let's make this dynamic also
                    $name = $subject.' - '.$requester_data['full_name'];

                    $message = $this->load->view($email_template, $data, TRUE);

                    $this->email->from($approver_email);
                    $this->email->to($approver_email);
                    // $this->email->to('cristhiansagun@gmail.com', $name);
                    $this->email->subject($subject);
                    $this->email->message('Your '.$leave_types['leave_type'].' has been cancelled by '.$approver_data['full_name']);
                    $this->email->send();

                    $this->load->library('email');

                    // $message = $this->load->view('templates/email/leave_approve.tpl.php', [], true);

                    // $this->email->from('joseph.gono@systemantech.com', 'OBR - Josh Gono');
                    // $this->email->to('gono.josh@gmail.com');

                    // $this->email->subject('Leave Request - Approved');
                    // $this->email->message($message);

                    // $this->email->send();

                    // //an email notificaton will be sent to user that filed an OB

                    // $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
                    // $this->email->to('joseph.gono@systemantech.com');

                    // $this->email->subject('Leave Request');
                    // $this->email->message('Approval notification has been successfully sent to Josh Gono');

                    // $this->email->send();

                } else {

                }
            }
        }

        $this->load->view('modals/modal-confirmation', $data);
    }

    public function ajax_check_leave_balance()
    {
        $response_data = [];

        $posted_data = $this->input->post();

        $employee_id = $this->ion_auth->user()->row()->employee_id;

        $leave_request_days = daterange($posted_data['date_start'], $posted_data['date_end']);
        $leave_type_id      = $posted_data['leave_type'];

        $have_balance = $this->employee_model->check_leave_balance($employee_id, $leave_type_id, $leave_request_days);

        $message = ($have_balance) ? 'Have enough balance.':'Not enough balance.';

        // exit;
        $response_data['message'] = $message;
        $response_data['leave_request_days'] = $leave_request_days;
        $response_data['have_balance'] = $have_balance;
        $response_data['posted_data'] = $posted_data;

        echo json_encode($response_data);
    }

}
