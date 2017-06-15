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
class Sites extends MY_Controller {

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
    }

    function index()
    {
        $sites = $this->site_model->get_site_all();
        
        $this->data = array(
            'page_header' => 'Site Management',
            'sites'    => $sites,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/site-lists');
    }

    function add()
    {
        $companies = $this->company_model->get_many_by(['active_status' => 1]);
        $branches = $this->branch_model->get_many_by(['active_status' => 1]);

        $this->data = array(
            'page_header' => 'Sites Management',
            'companies'   => $companies,
            'branches'   => $branches,
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('site_add'));
        
        $this->form_validation->set_data($data);

        if ($this->form_validation->run('site_add') == TRUE)
        {
            $site_id = $this->site_model->insert($data);

            if ( ! $site_id) {

                $this->session->set_flashdata('failed', 'Failed to add new site.');
                redirect('sites');
            } else {
                $this->session->set_flashdata('success', 'Successfully added new site.');
                redirect('sites');
            }
        }

        $this->load_view('forms/site-add');
    }

    function edit($id)
    {
        // get specific site based on the id
        $site = $this->site_model->get_site_by(['sites.id' => $id]);
        // dump($site);exit;
        // get all company records where status is equal to active
        //$companies = $this->company_model->get_many_by(['active_status' => 1]);
        // dump($this->db->last_query());exit;
        $this->data = array(
            'page_header' => 'Site Management',
            'site'      => $site,
            'active_menu' => $this->active_menu,
        );

        // $sites = $this->site_model->get_site_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('site_add'));
        
        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('site_add') == TRUE)
        {
            $site_id = $this->site_model->update($id, $data);

            if ( ! $site_id) {
                $this->session->set_flashdata('failed', 'Failed to update site.');
                redirect('sites');
            } else {
                $this->session->set_flashdata('success', 'Site successfully updated!');
                redirect('sites');
            }
        }
        $this->load_view('forms/site-edit');       
    }

    function details($id)
    {
        $site = $this->site_model->get_site_by(['sites.id' => $id]);

        $this->data = array(
            'page_header' => 'Site Details',
            'site'      => $site,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/site-details');           
    }
}