<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication
{
//  Instance of CI;
    protected $ci;
    protected $admin_classes = array();

    public function __construct()
    {
        $this->ci              = & get_instance();
        $this->admin_classes[] = 'uploader';
        $this->_check_admin_page();
    }

    /**
     * is_logged
     * @return boolean 
     */
    public function is_logged($login, $password)
    {
        $this->ci->load->model('user');
        $user = $this->ci->user->get_user_login($login, $password);
        if ($user->num_rows() !== 0) {
            return TRUE;
        }
        return false;
    }

    /**
     * _check_admin_page
     */
    public function _check_admin_page()
    {
        if (in_array($this->ci->router->class, $this->admin_classes) && !$this->ci->session->userdata('is_logged')) {
            redirect(base_url() . "admin/login");
        }
    }

    public function is_owner($id_album)
    {
        $album = $this->ci->foto->get_album($this->get_user_id(), $id_album);
        $result = $album[0]->id_user === $this->get_user_id() ? true : false;
        if(FALSE === $result){
            die('Unauthorised');
        }
        return true;
    }

    /**
     * 
     * @return string
     */
    public function get_user_login()
    {
        return $this->ci->session->userdata('login');
    }
    
    
    /**
     * 
     * @return int
     */
    public function get_user_id()
    {
        return $this->ci->session->userdata('id_user');
    }

}
/* End of file Someclass.php */