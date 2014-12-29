<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication
{
//  Instance of CI;
    protected $ci;

    public function __construct()
    {
        $this->ci = & get_instance();
        
    }

    /**
     * is_logged
     * @return boolean 
     */
    public function is_logged()
    {
        return false;
    }
    
    
    /**
     * _check_admin_page
     */
    public function _check_admin_page() {
        if (in_array($this->ci->router->class, $this->admin_classes) && !$this->session->userdata('is_logged')) {
            redirect(base_url() . "admin/login");
        }
    }

}
/* End of file Someclass.php */