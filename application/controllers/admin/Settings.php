<?php

/**
 * Description of Settings
 *
 * @author Parek
 */
class Settings extends CI_Controller
{
    protected $data;

    const USERS_VIEW   = 'admin/settings/users';
    const ACCOUNT_VIEW = 'admin/settings/account';
    const GALLERY_VIEW = 'admin/settings/gellery';
    const PAGE_VIEW    = 'admin/settings/page';

    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Settings';
    }

    /**
     * 
     */
    public function index()
    {
        
    }

    /**
     * Admin only!
     */
    public function users()
    {
        
    }

    /**
     * 
     */
    public function account()
    {
        $this->data['title'] = 'Account';
        $this->load->view(self::ACCOUNT_VIEW, $this->data);
    }

    /**
     * 
     */
    public function gallery()
    {
        
    }

    /**
     * 
     */
    public function page()
    {
        
    }

    /**
     * 
     */
    public function pwd_change()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (TRUE === $this->authentication->is_logged($this->authentication->get_user_login(), $this->input->post('old_password'))) {
            $this->form_validation->set_rules('new_password', 'Password', 'required|matches[match_password]');
            $this->form_validation->set_rules('match_password', 'Password', 'required|matches[new_password]');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('err', 'Passwords do not match!');
                redirect(base_url() . 'admin/settings/account/');
            } else {
                $this->session->set_flashdata('succ', 'Password changed!');
                redirect(base_url() . 'admin/settings/account/');
            }
        } else {
            $this->session->set_flashdata('err', 'Old password is incorrect!');
            redirect(base_url() . 'admin/settings/account/');
        }
    }

}