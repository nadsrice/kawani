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
class Overtimes extends MY_Controller {

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
        $this->load->model(['overtime_model']);
    }

    function index()
    {
        $status = $this->uri->segment(3);
        $user   = $this->ion_auth->user()->row();

        if ( ! isset($status)) {
            $selected = '';
            $status = '';
        }

        $total_rejected  = $this->overtime_model->count_by(['approval_status' => 0, 'employee_id' => $user->employee_id]); 
        $total_approved  = $this->overtime_model->count_by(['approval_status' => 1, 'employee_id' => $user->employee_id]); 
        $total_pending   = $this->overtime_model->count_by(['approval_status' => 2, 'employee_id' => $user->employee_id]); 
        $total_cancelled = $this->overtime_model->count_by(['status' => 0, 'employee_id' => $user->employee_id]);

        $my_overtimes       = $this->overtime_model->get_overtimes([
            'attendance_overtimes.employee_id' => $user->employee_id]);

        $approval_overtimes = $this->overtime_model->get_overtimes([
            'attendance_overtimes.approver_id' => $user->employee_id]);

        $this->data = array(
            'page_header'        => 'Overtime Management',
            'my_overtimes'       => $my_overtimes,
            'approval_overtimes' => $approval_overtimes,
            'total_rejected'     => $total_rejected,
            'total_approved'     => $total_approved,
            'total_pending'      => $total_pending,
            'total_cancelled'    => $total_cancelled,
            'active_menu'        => $this->active_menu,
        );
        $this->load_view('pages/attendance_overtime-lists');
    }

    function add()
    {

        $this->data = array(
            'page_header' => 'Overtime Management',
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('overtime_add'));

        if (isset($data['date'])) {
            // convert date format from mm/dd/yyyy to yyyy-mm-dd
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        }

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('overtime_add') == TRUE)
        {
            $this->session->set_flashdata('log_parameters', [
                'action_mode' => 0,
                'perm_key'    => 'file_overtime',
                'old_data'    => NULL,
                'new_data'    => $data
            ]);
            $overtime_id = $this->overtime_model->insert($data);

            if ( ! $overtime_id) {
                $this->session->set_flashdata('failed', 'Failed to add new overtime.');
                redirect('attendance_overtimes');
            } else {
                $this->session->set_flashdata('success', 'Overtime successfully filed.');

                $this->load->library('email');

                $ot_data = $this->overtime_model->get_by(['id' => $overtime_id]);
                $ot_id = $overtime_id;

                $user_id = $this->ion_auth->user()->row()->id;
                $user_data = $this->user_model->get_by(['id' => $user_id]);

                $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);

                $data = [
                    'employee_data'  => $employee_data,
                    'ot_data'        => $ot_data,
                    'ot_id'          => $ot_id,
                ];

                // dump($data);
                // dump($employee_data);exit;

                $message = $this->load->view('templates/email/attendance_overtime-notification.php', $data, true);

                $this->email->from('gono.josh@gmail.com', 'Overtime - Josh Gono');
                $this->email->to('joseph.gono@systemantech.com');

                $this->email->subject('Overtime Request');
                $this->email->message($message);

                $this->email->send();

                redirect('attendance_overtimes');
            }
        }

        $this->load_view('forms/attendance_overtime-add');
    }

    function edit($id)
    {
        // get specific overtime based on the id
        $overtime = $this->overtime_model->get_overtime_by(['attendance_overtimes.id' => $id]);
        // dump($overtime);exit;
        // get all company records where status is equal to active
        //$companies = $this->company_model->get_many_by(['active_status' => 1]);
        // dump($this->db->last_query());exit;
        $this->data = array(
            'page_header' => 'Overtime Management',
            'overtime'    => $overtime,
            'active_menu' => $this->active_menu,
        );

        // $overtimes = $this->overtime_model->get_overtime_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('overtime_add'));

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('overtime_add') == TRUE)
        {
            $overtime_id = $this->overtime_model->update($id, $data);

            if ( ! $overtime_id) {
                $this->session->set_flashdata('failed', 'Failed to update overtime.');
                redirect('attendance_overtimes');
            } else {
                $this->session->set_flashdata('success', 'Overtime successfully updated!');
                redirect('attendance_overtimes');
            }
        }
        $this->load_view('forms/attendance_overtime-edit');
    }

    function details($id)
    {
        $overtime = $this->overtime_model->get_overtime_by(['attendance_overtimes.id' => $id]);
        $employee_infos = $this->employee_info_model->get_employee_info_data(['attendance_overtimes.id' => $id]);

        $this->data = array(
            'page_header'    => 'Overtime Details',
            'overtime'       => $overtime,
            'employee_infos' => $employee_infos,
            'active_menu'    => $this->active_menu,
        );
        $this->load_view('pages/attendance_overtime-details');
    }

    public function edit_confirmation($id)
    {
        $edit_overtime = $this->overtime_model->get_by(['id' => $id]);
        $data['edit_overtime'] = $edit_overtime;
        $this->load->view('modals/modal-update-overtime', $data);
    }

    public function update_status($id)
    {
        $overtime_data = $this->overtime_model->get_by(['id' => $id]);
        $data['overtime_data'] = $overtime_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->overtime_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->overtime_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $overtime_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('attendance_overtimes');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$overtime_data['name'].'!');
                redirect('attendance_overtimes');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-overtime-status', $data);
        }
    }

    public function approve($ot_id)
    {
        $this->load->model('overtime_model');
        $update = $this->overtime_model->update($ot_id, ['approval_status' => 1]);

        if ($update) {

            $this->load->library('email');

            //$message = $this->load->view('templates/email/ob_approve.tpl.php', [], true);

            $this->email->from('joseph.gono@systemantech.com', 'Overtime - Josh Gono');
            $this->email->to('gono.josh@gmail.com');

            $this->email->subject('Overtime Request - Approved');
            $this->email->message('Your overtime request was successfully approved');

            $this->email->send();

            //an email notificaton will be sent to user that filed an OB

            $this->email->from('gono.josh@gmail.com', 'Overtime - Josh Gono');
            $this->email->to('joseph.gono@systemantech.com');

            $this->email->subject('Overtime Request');
            $this->email->message('Approval notification has been successfully sent to Josh Gono');

            $this->email->send();
            redirect('attendance_overtimes');

        } else {

        }
    }

    public function reject($ot_id)
    {
        $this->load->model('overtime_model');
        $update = $this->overtime_model->update($ot_id, ['approval_status' => 0]);

        if ($update) {

            $this->load->library('email');

            //$message = $this->load->view('templates/email/ob_disapprove.tpl.php', [], true);

            $this->email->from('joseph.gono@systemantech.com', 'Overtime - Josh Gono');
            $this->email->to('gono.josh@gmail.com');

            $this->email->subject('Overtime Request - Disapproved');
            $this->email->message('Your overtime request was rejected');

            $this->email->send();

            //sent to sender
            //$message = $this->load->view('templates/email/ob_approve.tpl.php', [], true);

            $this->email->from('gono.josh@gmail.com', 'Overtime - Josh Gono');
            $this->email->to('joseph.gono@systemantech.com');

            $this->email->subject('Overtime Request');
            $this->email->message('Disapproval notification has been successfully sent to Josh Gono');

            $this->email->send();
            redirect('attendance_overtimes');

        } else {

        }
    }

    public function cancel($ot_id)
    {
        $this->load->model('overtime_model');
        $update = $this->overtime_model->update($ot_id, ['status' => 0]);

        if ($update) {

            $this->load->library('email');

            //$message = $this->load->view('templates/email/ob_disapprove.tpl.php', [], true);

            $this->email->from('joseph.gono@systemantech.com', 'Overtime - Josh Gono');
            $this->email->to('gono.josh@gmail.com');

            $this->email->subject('Overtime Request - Cancelled');
            $this->email->message('Your overtime request was cancelled');

            $this->email->send();

            //sent to sender
            //$message = $this->load->view('templates/email/ob_approve.tpl.php', [], true);

            $this->email->from('gono.josh@gmail.com', 'Overtime - Josh Gono');
            $this->email->to('joseph.gono@systemantech.com');

            $this->email->subject('Overtime Request');
            $this->email->message('Cancellation notification has been successfully sent to Josh Gono');

            $this->email->send();
            redirect('attendance_overtimes');

        } else {

        }
    }

    public function view_overtime()
    {

    }

    public function approve_overtime($id)
    {
        $overtime_data         = $this->overtime_model->get_by(['id' => $id]);
        $data['overtime_data'] = $overtime_data;

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'approve') {
            $result = $this->overtime_model->update($id, ['approval_status' => 1]);

            if ($result){
                $this->session->set_flashdata('message', 'Undertime successfully approved');

                $this->load->library('email');

                $ut_id = $overtime_data;

                $user_id = $this->ion_auth->user()->row()->id;
                $user_data = $this->user_model->get_by(['id' => $user_id]);

                $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);

                $data = [
                    'employee_data'  => $employee_data,
                    'ut_id'          => $ut_id,
                ];

                //$message = $this->load->view('templates/email/ob.tpl.php', $data, true);

                $this->email->from('gono.josh@gmail.com', 'Undertime - Josh Gono');
                $this->email->to('joseph.gono@systemantech.com');

                $this->email->subject('[KAWANI-Attendance]: Undertime Request');
                $this->email->message('Your overtime request has been successfully approved');

                $this->email->send();
                redirect('attendance_overtimes');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to approve overtime');
                redirect('attendance_overtimes');
            }
        }
        $this->load->view('modals/modal-overtime-approve', $data);
    }

    public function reject_overtime($id)
    {
        $overtime_data         = $this->overtime_model->get_by(['id' => $id]);
        $data['overtime_data'] = $overtime_data;

        // TODO: make variable that will pass on the view
            // TODO: $mode = ex: approve, cancel, reject
            // TODO: $url = 'attendance_overtimes/wild_card_function/'.wild_card_id
            // TODO: $modal_title
            // TODO: $confirmation_message

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'reject') {
            $result = $this->overtime_model->update($id, ['approval_status' => 0]);

            if ($result){
                $this->session->set_flashdata('message', 'Undertime successfully rejected');

                $this->load->library('email');

                $ut_id = $overtime_data;

                $user_id = $this->ion_auth->user()->row()->id;
                $user_data = $this->user_model->get_by(['id' => $user_id]);

                $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);

                $data = [
                    'employee_data'  => $employee_data,
                    'ut_id'          => $ut_id,
                ];

                //$message = $this->load->view('templates/email/ob.tpl.php', $data, true);

                $this->email->from('gono.josh@gmail.com', 'Undertime - Josh Gono');
                $this->email->to('joseph.gono@systemantech.com');

                $this->email->subject('[KAWANI-Attendance]: Undertime Request');
                $this->email->message('Your overtime request was rejected');

                $this->email->send();
                redirect('attendance_overtimes');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to reject overtime');
                redirect('attendance_overtimes');
            }
        }
        $this->load->view('modals/modal-overtime-reject', $data);
    }


    public function cancel_overtime($id)
    {
        $overtime_data         = $this->overtime_model->get_by(['id' => $id]);
        $data['overtime_data'] = $overtime_data;

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'cancel') {
            $result = $this->overtime_model->update($id, ['status' => 0]);

            if ($result){
                $this->session->set_flashdata('message', 'Undertime successfully cancelled');

                $this->load->library('email');

                $ut_id = $overtime_data;

                $user_id = $this->ion_auth->user()->row()->id;
                $user_data = $this->user_model->get_by(['id' => $user_id]);

                $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);

                $data = [
                    'employee_data'  => $employee_data,
                    'ut_id'          => $ut_id,
                ];

                //$message = $this->load->view('templates/email/ob.tpl.php', $data, true);

                $this->email->from('gono.josh@gmail.com', 'Undertime - Josh Gono');
                $this->email->to('joseph.gono@systemantech.com');

                $this->email->subject('[KAWANI-Attendance]: Undertime Request');
                $this->email->message('Your overtime request was cancelled');

                $this->email->send();
                redirect('attendance_overtimes');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to cancel overtime');
                redirect('attendance_overtimes');
            }
        }
        $this->load->view('modals/modal-overtime-cancel', $data);
    }

    /**
     * Ajax calls
     *
     */

    public function ajax_my_overtime()
    {
        $data = ['status' => 'success', 'message' => 'test message ajax_my_overtime!'];
         $my_employee_id           = $this->ion_auth->user()->row()->employee_id;

        $data['summary'] = [
            'total_denied' => $this->overtime_model->count_by([
                'approval_status' => 0,
                'employee_id' => $my_employee_id
            ]),
            'total_approved' => $this->overtime_model->count_by([
                'approval_status' => 1,
                'employee_id' => $my_employee_id
            ]),
            'total_pending' => $this->overtime_model->count_by([
                'approval_status' => 2,
                'employee_id' => $my_employee_id
            ]),
            'total_cancelled' => $this->overtime_model->count_by([
                'status' => 0,
                'employee_id' => $my_employee_id
            ]),
        ];

        echo json_encode($data);
    }

    public function ajax_approval()
    {
        $data = ['status' => 'success', 'message' => 'test message ajax_approval!'];

        $data['summary'] = [
            'total_denied'    => $this->overtime_model->count_by(['approval_status' => 0]),
            'total_approved'  => $this->overtime_model->count_by(['approval_status' => 1]),
            'total_pending'   => $this->overtime_model->count_by(['approval_status' => 2]),
            'total_cancelled' => $this->overtime_model->count_by(['status' => 0]),
        ];

        echo json_encode($data);
    }
}
