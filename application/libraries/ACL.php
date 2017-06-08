<?php

/**
 *
 */
class ACL {

    /**
     * Store CI instances
     */
    protected $ci;

    /**
     * Store current user_id
     */
    protected $user_id;

    /**
     * Store current user role_id
     */
    protected $user_role_id;

    /**
     * Store class model_system
     */
    protected $model_system;

    /**
     * Class construtor
     */
    function __construct() {
        $this->ci = & get_instance();

        $this->ci->load->library('ion_auth');
        $this->ci->load->model('model_system');

        $user = $this->ci->ion_auth->user()->row();
        // $user_roles = $this->ci->ion_auth->get_users_groups($this->user_id)->result();
        // $this->user_id = $user->id;
        // $this->user_role_id = $user_roles[0]->id; // Index 0 for default user_role_id
        $this->model_system = $this->ci->model_system;
    }

    /**
     * Get role navigation menu
     */
    public function get_role_navigation_menu($role_id) {
        $modules = $this->model_system->get_role_permission_modules([
            'role_permission.role_id' => $role_id,
            'role_permission.active_status' => 1
        ]);


        $navigation_menu = array();

        foreach ($modules as $module) {

            $key = strtolower($module->s_module_name);

            $modules_functions = $this->model_system->get_role_permission_functions([
                'role_permission.role_id' => $role_id,
                'role_permission.active_status' => 1,
                's_function.system_module_id' => $module->s_module_id
            ]);

            $navigation_menu[$key] = [
                'module_id' => $module->s_module_id,
                'module_name' => $module->s_module_name,
                'module_icon' => $module->s_module_icon,
                'module_status' => $module->s_module_status,
                'module_functions' => $modules_functions,
            ];
        }

        return $navigation_menu;
    }

}

/* End of file Acl.php */
/* Location: ./application/library/Acl.php */
