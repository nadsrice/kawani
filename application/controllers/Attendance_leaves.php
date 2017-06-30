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
class Attendance_leaves extends MY_Controller {

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
            'attendance_leave_model',
            'user_model'
            ]);
    }

    public function index()
    {
        // todo: get all leaves records from database order by name ascending
            // todo: load leave model
            // todo: load view & past the retrieved data from model
        $leaves = $this->attendance_leave_model->get_leave_all();
        //$employee_info = $this->employee_model->get_employee_data('employee_contacts', ['employee_id' => 3]);

        $this->data = array(
            'page_header' => 'Leave Management',
            'leaves'    => $leaves,
            'active_menu' => $this->active_menu,
        );

        $this->load_view('pages/attendance_leave-lists');
    }

    public function add()
    {          
        $this->data = array(
            'page_header'     => 'Leave Management',
            'active_menu'     => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('leave_add'));
        
        if (isset($data['date_start']) && isset($data['date_end'])) {
            // convert date format from mm/dd/yyyy to yyyy-mm-dd
            $data['date_start'] = date('Y-m-d', strtotime($data['date_start']));
            $data['date_end'] = date('Y-m-d', strtotime($data['date_end']));
        }

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('leave_add') == TRUE)
        {
            $leave_id = $this->attendance_leave_model->insert($data);

            if ( ! $leave_id) {
                $this->session->set_flashdata('failed', 'Failed to add new leave.');
                redirect('attendance_leaves');
            } else {

                $this->session->set_flashdata('success', 'Successfully added new leave.');

                //KAWANI will automatically send an email to approver for verification

                // $this->load->library('email');

                // $this->load->model('employee_model');
                // $leave_data = $this->attendance_leave_model->get_by(['id' => $leave_id]);
                
                // $user_id = $this->ion_auth->user()->row()->id;
                // $user_data = $this->user_model->get_by(['id' => $user_id]);
                
                // $employee_data = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);

                // $data = [
                //     'employee_data'  => $employee_data,
                // ];

                // $message = $this->load->view('templates/email/leave.tpl.php', $data, true);

                // $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
                // $this->email->to('joseph.gono@systemantech.com');

                // $this->email->subject('Leave Request');
                // $this->email->message($message);

                // $this->email->send();
                redirect('attendance_leaves');                
               
            }
        }
        $this->load_view('forms/attendance_leave-add');  
    }

    public function approve($leave_id)
    {
        // $this->load->model('attendance_leave_model');
        // $update = $this->attendance_leave_model->update($leave_id, ['approval_status' => 1]);

        // if ($update) {
            
        //     $this->load->library('email');

        //     $message = $this->load->view('templates/email/leave_approve.tpl.php', [], true);

        //     $this->email->from('joseph.gono@systemantech.com', 'OBR - Josh Gono');
        //     $this->email->to('gono.josh@gmail.com');

        //     $this->email->subject('Leave Request - Approved');
        //     $this->email->message($message);

        //     $this->email->send();

        //     //an email notificaton will be sent to user that filed an OB
         
        //     $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
        //     $this->email->to('joseph.gono@systemantech.com');

        //     $this->email->subject('Leave Request');
        //     $this->email->message('Approval notification has been successfully sent to Josh Gono');

        //     $this->email->send();

        // } else {

        // }
    }

    public function disapprove($leave_id)
    {
        // $this->load->model('attendance_leave_model');
        // $update = $this->attendance_leave_model->update($leave_id, ['approval_status' => 0]);

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
        $leave = $this->attendance_leave_model->get_leave_by(['attendance_leaves.id' => $id]);

        $this->data = array(
            'page_header'       => 'Leave Management',
            'leave'             => $leave,
            'active_menu'       => $this->active_menu,
        );

        // $leaves = $this->attendance_leave_model->get_leave_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('leave_add'));
        
        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('leave_add') == TRUE)
        {
            $leave_id = $this->attendance_leave_model->update($id, $data);

            if ( ! $leave_id) {
                $this->session->set_flashdata('failed', 'Failed to update leave.');
                redirect('leaves');
            } else {
                $this->session->set_flashdata('success', 'Leave successfully updated!');
                redirect('leaves');
            }
        }
        $this->load_view('forms/attendance_leave-edit');         
    }

    public function details($id)
    {
        $leave = $this->attendance_leave_model->get_leave_by(['attendance_leaves.id' => $id]);
      
        $this->data = array(
            'page_header'       => 'Leave Details',
            'leave'             => $leave,
            'active_menu'       => $this->active_menu,
        );

        $this->load_view('pages/attendance_leave-details');          
    }
}
