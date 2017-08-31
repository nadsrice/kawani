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
class Undertimes extends MY_Controller {

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
        $this->load->model(['undertime_model', 'user_model', 'employee_model']);
    }

    function index()
    {

        $status = $this->uri->segment(3);
        $user   = $this->ion_auth->user()->row();
        
        if ( ! isset($status)) {
            $selected = '';
            $status = '';
        }

        $total_rejected  = $this->undertime_model->count_by(['approval_status' => 0, 'employee_id' => $user->employee_id]); 
        $total_approved  = $this->undertime_model->count_by(['approval_status' => 1, 'employee_id' => $user->employee_id]); 
        $total_pending   = $this->undertime_model->count_by(['approval_status' => 2, 'employee_id' => $user->employee_id]); 
        $total_cancelled = $this->undertime_model->count_by(['status' => 0, 'employee_id' => $user->employee_id]);         

        $user_id         = $this->ion_auth->user()->row()->id;
        $user_data       = $this->user_model->get_by(['id' => $user_id]);

        $undertimes = $this->undertime_model->get_undertimes([
            'attendance_undertimes.approver_id' => $user_data['employee_id']
        ]);

        $my_undertimes = $this->undertime_model->get_undertimes([
            'employee_id' => $user_data['employee_id']
        ]);

        $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);

        $this->data = array(
            'page_header'       => 'Undertime Management',
            'undertimes'        => $undertimes,
            'my_undertimes'     => $my_undertimes,
            'total_denied'      => $total_denied,
            'total_approved'    => $total_approved,
            'total_pending'     => $total_pending,
            'total_cancelled'   => $total_cancelled,
            'status'            => $status,
            'selected'          => $status,
            'selected'          => $status,
            'employee_data'     => $employee_data,
            'active_menu'       => $this->active_menu

        );
        $this->load_view('pages/attendance_undertime-lists');
    }

    function add()
    {
        $this->data = array(
            'page_header' => 'Undertime Management',
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('undertime_add'));

        if (isset($data['date'])) {
            // convert date format from mm/dd/yyyy to yyyy-mm-dd
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        }

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('undertime_add') == TRUE)
        {
            $this->session->set_flashdata('log_parameters', [
                'action_mode' => 0,
                'perm_key'    => 'file_undertime',
                'old_data'    => NULL,
                'new_data'    => $data
            ]);

            $undertime_id = $this->undertime_model->insert($data);

            if ( ! $undertime_id) {
                $this->session->set_flashdata('failed', 'Failed to add new undertime.');
                redirect('attendance_undertimes');
            } else {
                $this->session->set_flashdata('success', 'Undertime successfully filed.');
                redirect('attendance_undertimes');

                $this->load->library('email');

                $ut_data = $this->undertime_model->get_by(['id' => $undertime_id]);
                $ut_id = $undertime_id;

                $user_id = $this->ion_auth->user()->row()->id;
                $user_data = $this->user_model->get_by(['id' => $user_id]);

                $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);

                $data = [
                    'employee_data'  => $employee_data,
                    'ut_data'        => $ut_data,
                    'ut_id'          => $ut_id,
                ];

                $message = $this->load->view('templates/email/attendance_undertime-notification.php', $data, true);

                $this->email->from('gono.josh@gmail.com', 'Undertime - Josh Gono');
                $this->email->to('joseph.gono@systemantech.com');

                $this->email->subject('Undertime Request');
                $this->email->message($message);

                $this->email->send();
                redirect('attendance_undertimes');
            }
        }

        $this->load_view('forms/attendance_undertime-add');
    }

    function edit($id)
    {
        // get specific undertime based on the id
        $undertime = $this->undertime_model->get_undertime_by(['attendance_undertimes.id' => $id]);
        // dump($undertime);exit;
        // get all company records where status is equal to active
        //$companies = $this->company_model->get_many_by(['active_status' => 1]);
        // dump($this->db->last_query());exit;
        $this->data = array(
            'page_header' => 'Undertime Management',
            'undertime'      => $undertime,
            'active_menu' => $this->active_menu,
        );

        // $undertimes = $this->undertime_model->get_undertime_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('undertime_add'));

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('undertime_add') == TRUE)
        {
            $undertime_id = $this->undertime_model->update($id, $data);

            if ( ! $undertime_id) {
                $this->session->set_flashdata('failed', 'Failed to update undertime.');
                redirect('attendance_undertimes');
            } else {
                $this->session->set_flashdata('success', 'Undertime successfully updated!');
                redirect('attendance_undertimes');
            }
        }
        $this->load_view('forms/attendance_undertime-edit');
    }

    function details($id)
    {
        $undertime = $this->undertime_model->get_undertime_by(['attendance_undertimes.id' => $id]);
        $employee_infos = $this->employee_info_model->get_employee_info_data(['attendance_undertimes.id' => $id]);

        $this->data = array(
            'page_header' => 'Undertime Details',
            'undertime'      => $undertime,
            'employee_infos' => $employee_infos,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/attendance_undertime-details');
    }

    public function edit_confirmation($id)
    {
        $edit_undertime = $this->undertime_model->get_by(['id' => $id]);
        $data['edit_undertime'] = $edit_undertime;
        $this->load->view('modals/modal-update-undertime', $data);
    }


   public function approve($ut_id)
    {
        $this->load->model('undertime_model');

        // $this->session->set_flashdata('log_parameters', [
        //     'action_mode' => 0,
        //     'perm_key'    => 'approve_undertime',
        //     'old_data'    => NULL,
        //     'new_data'    => $data
        // ]);

        $update = $this->undertime_model->update($ut_id, ['approval_status' => 1]);

        if ($update) {

            $this->load->library('email');

            //$message = $this->load->view('templates/email/ob_approve.tpl.php', [], true);

            $this->email->from('joseph.gono@systemantech.com', 'Undertime - Josh Gono');
            $this->email->to('gono.josh@gmail.com');

            $this->email->subject('Undertime Request - Approved');
            $this->email->message('Your undertime request was successfully approved');

            $this->email->send();

            //an email notificaton will be sent to user that filed an OB

            $this->email->from('gono.josh@gmail.com', 'Undertime - Josh Gono');
            $this->email->to('joseph.gono@systemantech.com');

            $this->email->subject('Undertime Request');
            $this->email->message('Approval notification has been successfully sent to Josh Gono');

            $this->email->send();
            redirect('attendance_undertimes');

        } else {

        }
    }

    public function reject($ut_id)
    {
        $this->load->model('undertime_model');
        $update = $this->undertime_model->update($ut_id, ['approval_status' => 0]);

        if ($update) {

            $this->load->library('email');

            //$message = $this->load->view('templates/email/ob_disapprove.tpl.php', [], true);

            $this->email->from('joseph.gono@systemantech.com', 'Undertime - Josh Gono');
            $this->email->to('gono.josh@gmail.com');

            $this->email->subject('Undertime Request - Disapproved');
            $this->email->message('Your undertime request was rejected');

            $this->email->send();

            //sent to sender
            //$message = $this->load->view('templates/email/ob_approve.tpl.php', [], true);

            $this->email->from('gono.josh@gmail.com', 'Undertime - Josh Gono');
            $this->email->to('joseph.gono@systemantech.com');

            $this->email->subject('Undertime Request');
            $this->email->message('Disapproval notification has been successfully sent to Josh Gono');

            $this->email->send();
            redirect('attendance_undertimes');

        } else {

        }
    }

    public function cancel($ut_id)
    {
        $this->load->model('undertime_model');
        $update = $this->undertime_model->update($ut_id, ['status' => 0]);

        if ($update) {

            $this->load->library('email');

            //$message = $this->load->view('templates/email/ob_disapprove.tpl.php', [], true);

            $this->email->from('joseph.gono@systemantech.com', 'Undertime - Josh Gono');
            $this->email->to('gono.josh@gmail.com');

            $this->email->subject('Undertime Request - Cancelled');
            $this->email->message('Your undertime request was cancelled');

            $this->email->send();

            //sent to sender
            //$message = $this->load->view('templates/email/ob_approve.tpl.php', [], true);

            $this->email->from('gono.josh@gmail.com', 'Undertime - Josh Gono');
            $this->email->to('joseph.gono@systemantech.com');

            $this->email->subject('Undertime Request');
            $this->email->message('Cancellation notification has been successfully sent to Josh Gono');

            $this->email->send();
            redirect('attendance_undertimes');

        } else {

        }
    }

    public function approve_undertime($id)
    {
        $undertime_data         = $this->undertime_model->get_by(['id' => $id]);
        $data['undertime_data'] = $undertime_data;

        $employee_id = $undertime_data['employee_id'];
        $requester = $this->employee_model->get_by(['id' => $employee_id]);

        $data['modal_title']   = 'Approve Undertime';
        $data['modal_message'] = sprintf(lang('approve_undertime_message'), $requester['full_name']);
        $data['url']  = 'attendance_undertimes/approve_undertime/' . $undertime_data['id'];
        $data['mode'] = 'approve';

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'approve') {
            $result = $this->undertime_model->update($id, ['approval_status' => 1]);

            if ($result){
                $this->session->set_flashdata('message', 'Undertime successfully approved');

                $this->load->library('email');

                $ut_id = $undertime_data;

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
                $this->email->message('Your undertime request has been successfully approved');

                $this->email->send();
                redirect('attendance_undertimes');

                //Don't Repeat Your Code
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to approve undertime');
                redirect('attendance_undertimes');
            }
        }
        $this->load->view('modals/modal-undertime-confirmation', $data);
    }

    public function reject_undertime($id)
    {
        $undertime_data         = $this->undertime_model->get_by(['id' => $id]);
        $data['undertime_data'] = $undertime_data;

        $employee_id = $undertime_data['employee_id'];
        $requester = $this->employee_model->get_by(['id' => $employee_id]);

        $data['modal_title']   = 'Reject Undertime';
        $data['modal_message'] = sprintf(lang('reject_undertime_message'), $requester['full_name']);
        $data['url']  = 'attendance_undertimes/reject_undertime/' . $undertime_data['id'];
        $data['mode'] = 'reject';

        // TODO: make variable that will pass on the view
            // TODO: $mode = ex: approve, cancel, reject
            // TODO: $url = 'attendance_undertimes/wild_card_function/'.wild_card_id
            // TODO: $modal_title
            // TODO: $confirmation_message

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'reject') {
            $result = $this->undertime_model->update($id, ['approval_status' => 0]);

            if ($result){
                $this->session->set_flashdata('message', 'Undertime successfully rejected');

                $this->load->library('email');

                $ut_id = $undertime_data;

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
                $this->email->message('Your undertime request was rejected');

                $this->email->send();
                redirect('attendance_undertimes');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to reject undertime');
                redirect('attendance_undertimes');
            }
        }
        $this->load->view('modals/modal-undertime-confirmation', $data);
    }


    public function cancel_undertime($id)
    {
        $undertime_data         = $this->undertime_model->get_by(['id' => $id]);
        $data['undertime_data'] = $undertime_data;

        $employee_id = $undertime_data['employee_id'];
        $requester = $this->employee_model->get_by(['id' => $employee_id]);

        $data['modal_title']   = 'Cancel Undertime';
        $data['modal_message'] = sprintf(lang('cancel_undertime_message'), $requester['full_name']);
        $data['url']  = 'attendance_undertimes/cancel_undertime/' . $undertime_data['id'];
        $data['mode'] = 'cancel';

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'cancel') {
            $result = $this->undertime_model->update($id, ['status' => 0]);

            if ($result){
                $this->session->set_flashdata('message', 'Undertime successfully cancelled');

                $this->load->library('email');

                $ut_id = $undertime_data;

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
                $this->email->message('Your undertime request was cancelled');

                $this->email->send();
                redirect('attendance_undertimes');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to cancel undertime');
                redirect('attendance_undertimes');
            }
        }
        $this->load->view('modals/modal-undertime-confirmation', $data);
    }

    public function view_undertime($id)
    {
        $view_ut        = $this->undertime_model->get_by(['id' => $id]);
        $employee_data  = $this->employee_model->get_by(['id' => $id]);


        $data = array(

            'view_ut'           => $view_ut,
            'employee_data'     => $employee_data,

        );

        dump($id);
        dump($employee_data);exit;
        $this->load->view('modals/modal-undertime-view', $data);
    }

    /**
     * Ajax calls
     *
     */

    public function ajax_my_undertime()
    {
        $data = ['status' => 'success', 'message' => 'test message ajax_my_undertime!'];
         $my_employee_id           = $this->ion_auth->user()->row()->employee_id;

        $data['summary'] = [
            'total_denied' => $this->undertime_model->count_by([
                'approval_status' => 0,
                'employee_id' => $my_employee_id
            ]),
            'total_approved' => $this->undertime_model->count_by([
                'approval_status' => 1,
                'employee_id' => $my_employee_id
            ]),
            'total_pending' => $this->undertime_model->count_by([
                'approval_status' => 2,
                'employee_id' => $my_employee_id
            ]),
            'total_cancelled' => $this->undertime_model->count_by([
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
            'total_denied'    => $this->undertime_model->count_by(['approval_status' => 0]),
            'total_approved'  => $this->undertime_model->count_by(['approval_status' => 1]),
            'total_pending'   => $this->undertime_model->count_by(['approval_status' => 2]),
            'total_cancelled' => $this->undertime_model->count_by(['status' => 0]),
        ];

        echo json_encode($data);
    }
}
