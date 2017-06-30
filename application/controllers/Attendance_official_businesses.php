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
        $this->load->model([
            'attendance_official_business_model',
            'account_model',
            'contact_person_model',
            'user_model',
            'employee_model'
        ]);
    }

    public function index()
    {
        // todo: get all official_businesses records from database order by name ascending
            // todo: load official_business model
            // todo: load view & past the retrieved data from model
        $user_id = $this->ion_auth->user()->row()->id;
        $user_data = $this->user_model->get_by(['id' => $user_id]);

        $official_businesses = $this->attendance_official_business_model->get_ob_all();
        $ob_requests          = $this->attendance_official_business_model->get_my_ob([
            'attendance_official_businesses.approver_id' => $user_data['employee_id'],
            'attendance_official_businesses.approval_status' => 1
        ]);

        // dump($this->db->last_query());
        // dump($ob_request);
        // exit;
        //$employee_info = $this->employee_model->get_employee_data('employee_contacts', ['employee_id' => 3]);

        $this->data = array(
            'page_header'           => 'Official Business Management',
            'official_businesses'   => $official_businesses,
            'ob_requests'            => $ob_requests,
            'active_menu'           => $this->active_menu
        );

        $this->load_view('pages/attendance_official_business-lists');
    }

    public function add()
    {
        $accounts = $this->account_model->get_account_all();
        $contact_persons = $this->contact_person_model->get_contact_person_all();
          
        $this->data = array(
            'page_header'     => 'Official Business Management',
            'accounts'        => $accounts, 
            'contact_persons' => $contact_persons,
            'active_menu'     => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('ob_add'));
        
        if (isset($data['date'])) {
            // convert date format from mm/dd/yyyy to yyyy-mm-dd
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        }

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('ob_add') == TRUE)
        {
            $official_business_id = $this->attendance_official_business_model->insert($data);

            if ( ! $official_business_id) {
                $this->session->set_flashdata('failed', 'Failed to add new official business.');
                redirect('attendance_official_businesses');
            } else {

                $this->session->set_flashdata('success', 'Successfully added new official business.');

                //KAWANI will automatically send an email to approver for verification

                $this->load->library('email');

                $ob_data = $this->attendance_official_business_model->get_by(['id' => $official_business_id]);
                $ob_id = $official_business_id;
                
                $user_id = $this->ion_auth->user()->row()->id;
                $user_data = $this->user_model->get_by(['id' => $user_id]);
                
                $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);
                $account = $this->account_model->get_by(['id' => $ob_data['account_id']]);
                $contact_person = $this->contact_person_model->get_by(['id' => $ob_data['contact_person_id']]);

                $data = [
                    'employee_data'  => $employee_data,
                    'ob_data'        => $ob_data,
                    'account'        => $account,
                    'contact_person' => $contact_person,
                    'ob_id'          => $ob_id,
                ];

                $message = $this->load->view('templates/email/ob.tpl.php', $data, true);

                $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
                $this->email->to('joseph.gono@systemantech.com');

                $this->email->subject('Official Business Request');
                $this->email->message($message);

                $this->email->send();
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
}
