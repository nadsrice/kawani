<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Employees extends MY_Controller {

    private $active_menu = 'Employee';

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->config->load('employee', TRUE);
        $this->load->helper('url');
        $this->load->model([
            'employee_parent_model',
            'employee_spouse_model',
            'employee_dependent_model',
            'civil_status_model',
            'relationship_model'
        ]);
    }

    public function index()
    {
        $employees = $this->employee_model->get_employee_all();

        $this->data = array(
            'page_header' => 'Employee Management',
            'employees'   => $employees,
            'active_menu' => $this->active_menu,
        );

        $this->load_view('pages/employee-lists');
    }

    public function add()
    {
        $this->load->view('modals/modal-add-employee-direct');
    }

    public function save($id = '')
    {
        if (empty($id)) $this->employee_model->create_account();
    }

    public function informations($employee_id)
    {
        // TODO: check permission key = 'employee_information';

        $post = $this->input->post();

        $this->data['show_edit_modal']       = FALSE;
        $this->data['page_header']           = 'Employee Informations';
        $this->data['employee_id']           = $employee_id;
        $this->data['personal_information']  = $this->employee_model->get_by(['id' => $employee_id]);
        $this->data['parents_information']   = $this->employee_parent_model->get_many_by(['employee_id' => $employee_id]);
        $this->data['spouse_information']    = $this->employee_spouse_model->get_by(['employee_id' => $employee_id]);
        $this->data['dependent_information'] = $this->employee_dependent_model->get_by(['employee_id' => $employee_id]);
        $this->data['civil_status']          = $this->civil_status_model->get_many_by(['active_status' => 1]);
        $this->data['relationships']         = $this->relationship_model->get_all();

        $civil_status_id = $this->data['personal_information']['civil_status_id'];

        $this->data['current_civil_status'] = $this->civil_status_model->get_by(['id' => $civil_status_id]);

        if (isset($post['mode']) && $post['mode'] == 'edit')
        {
            $this->data['show_edit_modal'] = TRUE;
            $this->data['modal_content']   = 'modals/employee/modal-'.$post['information_type'];
        }

        $this->load_view('pages/employee-informations');
    }

    public function edit()
    {
        $param = array(
            'information_type' => $this->uri->segment(3),
            'employee_id'      => $this->uri->segment(4),
            'posted_data'      => $this->input->post()
        );

        dump($param);


    }

    public function save_changes()
    {
        $employee_id = $this->uri->segment(3);

        $post = $this->input->post();

        dump($employee_id);
        dump($post);
    }

    public function upload_profile_image()
    {
        dump($_FILES);
        if ( ! empty($_FILES))
        {
            $tempFile = $_FILES['file']['tmp_name'];

            $targetPath = site_url('assets/img/employee/2017');

            $targetFile = $targetPath . $_FILES['file']['name'];

            dump($tempFile);
            dump($targetPath);
            dump($targetFile);

            move_uploaded_file($tempFile, $targetFile);
        }
    }

    public function test_upload()
    {
        //upload file
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1024'; //1 MB

        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                        echo 'File successfully uploaded : uploads/' . $_FILES['file']['name'];
                    }
                }
            }
        } else {
            echo 'Please choose a file';
        }
    }

    protected function remove_specific_data($remove_id, $raw_data)
    {
        foreach ($raw_data as $key => $value) {
            if ($value['id'] == $remove_id) {
                unset($raw_data[$key]);
            }
        }

        return $raw_data;
    }

    public function confirmation()
    {
        $mode = $this->uri->segment(3);
        $information = $this->uri->segment(4);
        $employee_id = (!empty($this->uri->segment(5))) ? $this->uri->segment(5) : NULL;

        $employee = $this->employee_model->get_by('id', $employee_id);

        $exploded = explode('_', $information);
        $information_type = implode(' ', $exploded);
        $message  = sprintf(lang('confirmation_edit_employee_detail'), $mode.' '.$information_type, ucwords(strtolower($employee['full_name'])));

        $data['modal_title']      = ucwords($information_type);
        $data['modal_message']    = $message;
        $data['mode']             = $mode;
        $data['url']              = 'employees/informations/'.$employee_id;
        $data['information_type'] = implode('-', $exploded);

        $this->load->view('modals/modal-confirmation', $data);
    }

    public function cancel_edit($employee_id)
    {
        redirect('employees/informations/'.$employee_id, 'refresh');
    }
}
