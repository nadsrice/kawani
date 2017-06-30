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
class Attendance_overtimes extends MY_Controller {

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
        $this->load->model(['attendance_overtime_model']);
    }

    function index()
    {
        $overtime = $this->attendance_overtime_model->get_overtime_all();

        $this->data = array(
            'page_header' => 'Overtime Management',
            'overtime'    => $overtime,
            'active_menu' => $this->active_menu,
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
            $overtime_id = $this->attendance_overtime_model->insert($data);

            if ( ! $overtime_id) {
                $this->session->set_flashdata('failed', 'Failed to add new overtime.');
                redirect('attendance_overtimes');
            } else {
                $this->session->set_flashdata('success', 'Overtime successfully filed.');
                redirect('attendance_overtimes');

                $this->load->library('email');

                $ot_data = $this->attendance_overtime_model->get_by(['id' => $overtime_id]);
                $ot_id = $overtime_id;
                
                $user_id = $this->ion_auth->user()->row()->id;
                $user_data = $this->user_model->get_by(['id' => $user_id]);
                
                $employee_data = $this->employee_model->get_by(['id' => $user_data['employee_id']]);

                $data = [
                    'employee_data'  => $employee_data,
                    'ot_data'        => $ot_data,
                    'ot_id'          => $ot_id,
                ];

                $message = $this->load->view('templates/email/ob.tpl.php', $data, true);

                $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
                $this->email->to('joseph.gono@systemantech.com');

                $this->email->subject('Official Business Request');
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
        $overtime = $this->attendance_overtime_model->get_overtime_by(['attendance_overtimes.id' => $id]);
        // dump($overtime);exit;
        // get all company records where status is equal to active
        //$companies = $this->company_model->get_many_by(['active_status' => 1]);
        // dump($this->db->last_query());exit;
        $this->data = array(
            'page_header' => 'Overtime Management',
            'overtime'      => $overtime,
            'active_menu' => $this->active_menu,
        );

        // $overtimes = $this->attendance_overtime_model->get_overtime_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('overtime_add'));

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('overtime_add') == TRUE)
        {
            $overtime_id = $this->attendance_overtime_model->update($id, $data);

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
        $overtime = $this->attendance_overtime_model->get_overtime_by(['attendance_overtimes.id' => $id]);
        $employee_infos = $this->employee_info_model->get_employee_info_data(['attendance_overtimes.id' => $id]);

        $this->data = array(
            'page_header' => 'Overtime Details',
            'overtime'      => $overtime,
            'employee_infos' => $employee_infos,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/attendance_overtime-details');
    }

    public function edit_confirmation($id)
    {
        $edit_overtime = $this->attendance_overtime_model->get_by(['id' => $id]);
        $data['edit_overtime'] = $edit_overtime;
        $this->load->view('modals/modal-update-overtime', $data);
    }

    public function update_status($id)
    {
        $overtime_data = $this->attendance_overtime_model->get_by(['id' => $id]);
        $data['overtime_data'] = $overtime_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->attendance_overtime_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->attendance_overtime_model->update($id, ['active_status' => 1]);
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
}
