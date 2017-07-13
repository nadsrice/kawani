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
class Attendance_official_businesses extends MY_Controller {

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
            'attendance_official_business_model',
            'account_model',
            'contact_person_model',
            'user_model',
            'employee_model',
            'employee_info_model'
        ]);
    }

    public function index()
    {
        // todo: get all official_businesses records from database order by name ascending
            // todo: load official_business model
            // todo: load view & past the retrieved data from model
        $status = $this->uri->segment(3);

        if ( ! isset($status)) {
            $selected = '';
            $status = '';
        }

        $total_rejected     = $this->attendance_official_business_model->count_by(['approval_status' => 0]); //0 = denied
        $total_approved     = $this->attendance_official_business_model->count_by(['approval_status' => 1]); //1 = approved
        $total_pending      = $this->attendance_official_business_model->count_by(['approval_status' => 2]); //2 = pending
        $total_cancelled    = $this->attendance_official_business_model->count_by(['status' => 0]);         //0 = cancelled

        $user                       = $this->ion_auth->user()->row();
        // $user_data                  = $this->user_model->get_by(['id' => $user_id]);

        $official_businesses        = $this->attendance_official_business_model->get_ob_all();

        $my_official_business       = $this->attendance_official_business_model->get_ob_requests_by([
            'attendance_official_businesses.employee_id' => $user->employee_id]);

        $approval_official_business = $this->attendance_official_business_model->get_ob_requests_by([
            'attendance_official_businesses.approver_id' => $user->employee_id]);

        $this->data = array(
            'page_header'                  => 'Official Business Management',
            'official_businesses'          => $official_businesses,
            'my_official_businesses'       => $my_official_business,
            'approval_official_businesses' => $approval_official_business,
            'total_rejected'               => $total_rejected,
            'total_approved'               => $total_approved,
            'total_pending'                => $total_pending,
            'total_cancelled'              => $total_cancelled,
            'active_menu'                  => $this->active_menu
        );

        $this->load_view('pages/attendance_official_business-lists');
    }

    public function add()
    {
        $accounts = $this->account_model->get_account_all();
        $contact_persons = $this->contact_person_model->get_contact_person_all();

        $user_id = $this->ion_auth->user()->row()->id;
        $user_data = $this->user_model->get_by(['id' => $user_id]);
        $approver_id = $this->employee_info_model->get_by(['employee_id' => $user_data['employee_id']]);

        $employee_id = $this->ion_auth->user()->row()->employee_id;
        $employee_information = $this->employee_model->get_employee_information(['employee_id' => $employee_id]);
        $employee_data = $this->employee_model->get_by(['id' => $employee_id]);

        $this->data = array(
            'page_header'     => 'Official Business Management',
            'accounts'        => $accounts,
            'contact_persons' => $contact_persons,
            'user_data'       => $user_data,
            'approver_id'     => $approver_id,
            'active_menu'     => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('ob_add'));

        if (isset($data['date'])) {
            // convert date format from mm/dd/yyyy to yyyy-mm-dd
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        }

        if (isset($data['account_id']))
        {
            $data['employee_id'] = $employee_id;
            $data['approver_id'] = $employee_information[0]['reports_to'];
        }

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('ob_add') == TRUE)
        {
            $official_business_id = $this->attendance_official_business_model->insert($data);

            if ( ! $official_business_id) {
                $this->session->set_flashdata('failed', 'Failed to add new official business.');
                redirect('attendance_official_businesses');
            } else {

                //KAWANI will automatically send an email to approver for verification

                $this->load->library('email');

                // $ob_data = $this->attendance_official_business_model->get_by(['id' => $official_business_id]);
                // $ob_id = $official_business_id;

                $user_id = $this->ion_auth->user()->row()->id;
                $user_data = $this->user_model->get_by(['id' => $user_id]);



                // $data = [
                //     'employee_data'  => $employee_data,
                //     'ob_data'        => $ob_data,
                //     'account'        => $account,
                //     'contact_person' => $contact_person,
                //     'ob_id'          => $ob_id,

                /**
                 *
                 */

                $ob_data = $this->attendance_official_business_model->get_ob_requests_by([
                    'attendance_official_businesses.id' => $official_business_id
                ]);


                $requester_data  = $this->employee_model->get_by(['id' => $ob_data[0]['employee_id']]);
                $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

                $approver_data   = $this->employee_model->get_by(['id' => $ob_data[0]['approver_id']]);
                $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

                // dump($ob_data);
                // dump($requester_data);
                // dump($requester_email);
                // dump($approver_data);
                // dump($approver_email);exit;

                $data = [
                    'requester_data'  => $requester_data,
                    'requester_email' => $requester_email,
                    'approver_data'   => $approver_data,
                    'approver_email'  => $approver_email,
                    'ob_data'         => $ob_data[0]
                ];

                // dump($data);exit;


                $subject = '[HRIS - Approval] Attendance: Official Business Request'.'-'.$official_business_id;   // TODO: let's make this dynamic
                //$email_template = 'templates/email/official_business.tpl.php';                              // TODO: let's make this dynamic also
                $name = $subject.' - '.$requester_data['full_name'];
                $kawani_email = 'lohicasoft@gmail.com';
                $message = $this->load->view('templates/email/official_business.tpl.php', $data, true);


                $this->email->from($requester_email);
                // $this->email->to('cristhiansagun@gmail.com');
                $this->email->to($approver_data);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();

                $this->email->from($kawani_email);
                $this->email->to($requester_email);
                $this->email->subject($subject);
                $this->email->message("You've successfully filed an official business request - ".$official_business_id." to ".$approver_data['full_name']);
                $this->email->send();

                $this->session->set_flashdata('success', 'Successfully added new official business.');
                redirect('attendance_official_businesses');

            }
        }
        $this->load_view('forms/attendance_official_business-add');
    }

    public function approve($ob_id)
    {
        $this->load->model('attendance_official_business_model');
        $update = $this->attendance_official_business_model->update($ob_id, ['approval_status' => 1]);

        if ($update) {

            $this->load->library('email');

            $message = $this->load->view('templates/email/ob_approve.tpl.php', [], true);

            $this->email->from('joseph.gono@systemantech.com', 'OBR - Josh Gono');
            $this->email->to('gono.josh@gmail.com');

            $this->email->subject('Official Business Request - Approved');
            $this->email->message($message);

            $this->email->send();

            //an email notificaton will be sent to user that filed an OB

            $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
            $this->email->to('joseph.gono@systemantech.com');

            $this->email->subject('Official Business Request');
            $this->email->message('Approval notification has been successfully sent to Josh Gono');

            $this->email->send();

        } else {

        }
    }

    public function disapprove($ob_id)
    {
        $this->load->model('attendance_official_business_model');
        $update = $this->attendance_official_business_model->update($ob_id, ['approval_status' => 0]);

        if ($update) {

            $this->load->library('email');

            $message = $this->load->view('templates/email/ob_disapprove.tpl.php', [], true);

            $this->email->from('joseph.gono@systemantech.com', 'OBR - Josh Gono');
            $this->email->to('gono.josh@gmail.com');

            $this->email->subject('Official Business Request - Disapproved');
            $this->email->message($message);

            $this->email->send();

            //sent to sender
            //$message = $this->load->view('templates/email/ob_approve.tpl.php', [], true);

            $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
            $this->email->to('joseph.gono@systemantech.com');

            $this->email->subject('Official Business Request');
            $this->email->message('Disapproval notification has been successfully sent to Josh Gono');

            $this->email->send();

        } else {

        }
    }

    public function cancel($ob_id)
    {
        $this->load->model('attendance_official_business_model');
        $update = $this->attendance_official_business_model->update($ob_id, ['status' => 0]);

        if ($update) {

            $this->load->library('email');

            $message = $this->load->view('templates/email/ob_disapprove.tpl.php', [], true);

            $this->email->from('joseph.gono@systemantech.com', 'OBR - Josh Gono');
            $this->email->to('gono.josh@gmail.com');

            $this->email->subject('Official Business Request - Cancelled');
            $this->email->message($message);

            $this->email->send();

            //sent to sender
            //$message = $this->load->view('templates/email/ob_approve.tpl.php', [], true);

            $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
            $this->email->to('joseph.gono@systemantech.com');

            $this->email->subject('Official Business Request');
            $this->email->message('Disapproval notification has been successfully sent to Josh Gono');

            $this->email->send();

        } else {

        }
    }

    public function edit($id)
    {
        // get specific official_business based on the id
        $official_business = $this->attendance_official_business_model->get_ob_by(['attendance_official_businesses.id' => $id]);
        $account           = $this->account_model->get_account_by(['attendance_official_businesses.id' => $id]);
        $contact_person    = $this->contact_person_model->get_contact_person_by(['attendance_official_businesses.id' => $id]);

        $this->data = array(
            'page_header'       => 'Official Business Management',
            'official_business' => $official_business,
            'account'           => $account,
            'contact_person'    => $contact_person,
            'active_menu'       => $this->active_menu,
        );

        // $official_businesses = $this->attendance_official_business_model->get_ob_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('ob_add'));

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('ob_add') == TRUE)
        {
            $official_business_id = $this->attendance_official_business_model->update($id, $data);

            if ( ! $official_business_id) {
                $this->session->set_flashdata('failed', 'Failed to update official business.');
                redirect('attendance_official_businesses');
            } else {
                $this->session->set_flashdata('success', 'Official Business successfully updated!');
                redirect('attendance_official_businesses');
            }
        }
        $this->load_view('forms/attendance_official_business-edit');
    }

    public function details($id)
    {
        $official_business = $this->attendance_official_business_model->get_ob_by(['attendance_official_businesses.id' => $id]);

        $this->data = array(
            'page_header'       => 'Official Business Details',
            'official_business' => $official_business,
            'active_menu'       => $this->active_menu,
        );

        $this->load_view('pages/attendance_official_business-details');
    }

    public function view_ob($id)
    {
        $view_ob        = $this->attendance_official_business_model->get_by(['id' => $id]);
        $account_name   = $this->account_model->get_by(['id' => $view_ob['account_id']]);
        $contact_person = $this->contact_person_model->get_by(['id' => $view_ob['contact_person_id']]);

        $data = array(

            'view_ob'           => $view_ob,
            'account_name'      => $account_name,
            'contact_person'    => $contact_person,

        );

        $this->load->view('modals/modal-ob', $data);
    }

    public function approve_official_business($id)
    {
        $official_business_data         = $this->attendance_official_business_model->get_by(['id' => $id]);
        $data['official_business_data'] = $official_business_data;

        $employee_id = $official_business_data['employee_id'];

        if ( ! isset($employee_id) ) {

            $this->session->set_flashdata('failed', '');
            redirect('attendance_official_businesses');

        }

        $requester = $this->employee_model->get_by(['id' => $employee_id]);
        $data['modal_title']   = 'Approve Official Business';
        $data['modal_message'] = sprintf(lang('approve_official_business_message'), $requester['full_name']);
        $data['url']  = 'attendance_official_businesses/approve_official_business/' . $official_business_data['id'];
        $data['mode'] = 'approve';

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'approve') {
            $result = $this->attendance_official_business_model->update($id, ['approval_status' => 1]);

            if ($result){

                $this->load->library('email');

                // $ut_id = $official_business_data;

                // $user_id = $this->ion_auth->user()->row()->id;
                // $user_data = $this->user_model->get_by(['id' => $user_id]);

                // $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);

                // $data = [
                //     'employee_data'  => $employee_data,
                //     'ut_id'          => $ut_id,
                // ];

                //$message = $this->load->view('templates/email/ob.tpl.php', $data, true);
                $ob_data = $this->attendance_official_business_model->get_ob_requests_by([
                    'attendance_official_businesses.id' => $id
                ]);

                // dump($id);

                $requester_data  = $this->employee_model->get_by(['id' => $ob_data[0]['employee_id']]);
                $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

                $approver_data   = $this->employee_model->get_by(['id' => $ob_data[0]['approver_id']]);
                $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

                // dump($ob_data);
                // dump($requester_data);
                // dump($requester_email);
                // dump($approver_data);
                // dump($approver_email);exit;

                $data = [
                    'requester_data'  => $requester_data,
                    'requester_email' => $requester_email,
                    'approver_data'   => $approver_data,
                    'approver_email'  => $approver_email,
                    'ob_data'         => $ob_data[0]
                ];

                $subject = '[HRIS - Approved] Attendance: Official Business Request'.'-'.$id;   // TODO: let's make this dynamic
                //$email_template = 'templates/email/official_business.tpl.php';                              // TODO: let's make this dynamic also
                $name = $subject.' - '.$requester_data['full_name'];
                $kawani_email = 'lohicasoft@gmail.com';

                $this->email->from($approver_data);
                $this->email->to($requester_email);
                $this->email->subject($subject);
                $this->email->message('Your official business request - '.$id.' has been successfully approved by '.$approver_data['full_name']);

                $this->email->from($kawani_email);
                $this->email->to($approver_data);
                $this->email->subject($subject);
                $this->email->message("You've successfully approved the official business request - ".$id." of ".$requester_data['full_name']);

                $this->email->send();
                redirect('attendance_official_businesses');

                $this->session->set_flashdata('message', 'Official Business successfully approved');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to approve official business');
                redirect('attendance_official_businesses');
            }
        }
        $this->load->view('modals/modal-undertime-confirmation', $data);
    }

    public function reject_official_business($id)
    {
        $official_business_data         = $this->attendance_official_business_model->get_by(['id' => $id]);
        $data['official_business_data'] = $official_business_data;

        $employee_id = $official_business_data['employee_id'];

        if ( ! isset($employee_id) ) {

            $this->session->set_flashdata('failed', '');
            redirect('attendance_official_businesses');

        }

        $requester = $this->employee_model->get_by(['id' => $employee_id]);
        $data['modal_title']   = 'Reject Official Business';
        $data['modal_message'] = sprintf(lang('reject_official_business_message'), $requester['full_name']);
        $data['url']  = 'attendance_official_businesses/reject_official_business/' . $official_business_data['id'];
        $data['mode'] = 'reject';

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'reject') {
            $result = $this->attendance_official_business_model->update($id, ['approval_status' => 0]);

            if ($result){
                $this->session->set_flashdata('message', 'Official Business successfully rejected');

                $this->load->library('email');

                $ut_id = $official_business_data;

                $user_id = $this->ion_auth->user()->row()->id;
                $user_data = $this->user_model->get_by(['id' => $user_id]);

                $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);

                $data = [
                    'employee_data'  => $employee_data,
                    'ut_id'          => $ut_id,
                ];

                //$message = $this->load->view('templates/email/ob.tpl.php', $data, true);

                $this->email->from('gono.josh@gmail.com', 'Official Business - Josh Gono');
                $this->email->to('joseph.gono@systemantech.com');

                $this->email->subject('[KAWANI-Attendance]: Official Business Request');
                $this->email->message('Your official business request was rejected');

                $this->email->send();
                redirect('attendance_official_businesses');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to reject official business');
                redirect('attendance_official_businesses');
            }
        }
        $this->load->view('modals/modal-confirmation', $data);
    }


    public function cancel_official_business($id)
    {
        $official_business_data         = $this->attendance_official_business_model->get_by(['id' => $id]);
        $data['official_business_data'] = $official_business_data;

        $employee_id = $official_business_data['employee_id'];

        if ( ! isset($employee_id) ) {

            $this->session->set_flashdata('failed', '');
            redirect('attendance_official_businesses');

        }

        $requester = $this->employee_model->get_by(['id' => $employee_id]);

        $data['modal_title']   = 'Cancel Official Business';
        $data['modal_message'] = sprintf(lang('cancel_official_business_message'), $requester['full_name']);
        $data['url']  = 'attendance_official_businesses/cancel_official_business/' . $official_business_data['id'];
        $data['mode'] = 'cancel';

        $post = $this->input->post();

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'cancel') {
            $result = $this->attendance_official_business_model->update($id, ['status' => 0]);

            if ($result){
                $this->session->set_flashdata('message', 'Official Business successfully cancelled');

                $this->load->library('email');

                $ut_id = $official_business_data;

                $user_id = $this->ion_auth->user()->row()->id;
                $user_data = $this->user_model->get_by(['id' => $user_id]);

                $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);

                $data = [
                    'employee_data'  => $employee_data,
                    'ut_id'          => $ut_id,
                ];

                //$message = $this->load->view('templates/email/ob.tpl.php', $data, true);

                $this->email->from('gono.josh@gmail.com', 'Official Business - Josh Gono');
                $this->email->to('joseph.gono@systemantech.com');

                $this->email->subject('[KAWANI-Attendance]: Official Business Request');
                $this->email->message('Your official business request was cancelled');

                $this->email->send();
                redirect('attendance_official_businesses');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to cancel official business');
                redirect('attendance_official_businesses');
            }
        }
        $this->load->view('modals/modal-confirmation', $data);
    }
}
