<?php

/**
 * Description of Settings
 *
 * @author Parek
 */
class Settings extends CI_Controller
{
    protected $data;

    const USERS_VIEW    = 'admin/settings/users';
    const ACCOUNT_VIEW  = 'admin/settings/account';
    const GALLERY_VIEW  = 'admin/settings/gellery';
    const PAGE_VIEW     = 'admin/settings/page';
    const MAINPAGE_VIEW = 'admin/settings/mainpage';

    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Settings';
        $this->load->model('settings_model');
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
        if (true === $this->authentication->is_admin()) {
            $this->load->model('user');
            $this->data['title'] = 'Users';
            $this->data['users'] = $this->user->get_all_users();
            $this->load->view(self::USERS_VIEW, $this->data);
        }
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
        if (true === $this->authentication->is_admin()) {
            $this->data['title']    = 'Page';
            $this->data['settings'] = $this->settings_model->get_page_settings();
            $this->load->view(self::PAGE_VIEW, $this->data);
        }
    }

    /**
     * 
     */
    public function pwd_change()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (true === $this->authentication->is_logged($this->authentication->get_user_login(), $this->input->post('old_password'))) {
            $this->form_validation->set_rules('new_password', 'Password', 'required|matches[match_password]');
            $this->form_validation->set_rules('match_password', 'Password', 'required|matches[new_password]');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('err', 'Passwords do not match!');
                redirect(base_url() . 'admin/settings/account/');
            } else {
                $this->session->set_flashdata('succ', 'Password changed!');
                $this->authentication->change_password($this->input->post('new_password'));
                redirect(base_url() . 'admin/settings/account/');
            }
        } else {
            $this->session->set_flashdata('err', 'Old password is incorrect!');
            redirect(base_url() . 'admin/settings/account/');
        }
    }
    /**
     * 
     */
    public function page_set()
    {
        if (true === $this->authentication->is_admin()) {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('quality', 'Quality', 'greater_than_equal_to[0]|less_than_equal_to[100]');
            $this->form_validation->set_rules('max_dimension', 'Quality', 'greater_than_equal_to[0]');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('err', 'Please set propper values.');
                redirect(base_url() . 'admin/settings/page/');
            } else {
                $this->session->set_flashdata('succ', 'Settings updated!');
                $this->settings_model->set_page_settings($this->input->post());
                redirect(base_url() . 'admin/settings/page/');
            }
        }
    }

    /**
     * 
     * @param int $id
     */
    public function delete_user($id)
    {
        if (true === $this->authentication->is_admin()) {
            $this->load->model('user');
            $this->user->delete_user($id);
            $this->session->set_flashdata('succ', 'User Deleted!<br>Photos and albums have to be removed manually.');
            redirect(base_url() . 'admin/settings/users/');
        }
    }
    /**
     * 
     */
    public function add_user()
    {
        if (true === $this->authentication->is_admin()) {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('user');
            $this->form_validation->set_rules('login', 'login', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('err', 'Both fields are required.');
                redirect(base_url() . 'admin/settings/users/');
            } else {
                $this->session->set_flashdata('succ', 'User Created!');
                $this->user->add_user($this->input->post('login'),$this->input->post('password'));
                redirect(base_url() . 'admin/settings/users/');
            }
        }
    }
    
    /**
     * 
     */
    public function mainpage()
    {
        if (true === $this->authentication->is_admin()) {
            $this->data['title']    = 'Mainpage';
            $this->data['settings'] = $this->settings_model->get_page_settings();
            $this->load->view(self::MAINPAGE_VIEW, $this->data);
        }
    }
    /**
     * Switches mainpage on/off
     */
    public function mainpage_switch()
    {
        if (true === $this->authentication->is_admin()) {
            $settings = $this->settings_model->get_page_settings();
            if($settings[0]->mainpage == '1'){
                //shuts down mainpage
                $this->settings_model->set_page_settings(array('mainpage'=>'0'));
            }else{
                //enables it
                $this->settings_model->set_page_settings(array('mainpage'=>'1'));
            }
        }
    }
    
    /**
     * Set data for mainpage
     */
    public function mainpage_set()
    {
        if (true === $this->authentication->is_admin()) {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('mainpage_style', 'style', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('err', 'Ooops something went wrong!');
                redirect(base_url() . 'admin/settings/mainpage/');
            } else {
                $this->settings_model->set_page_settings($this->input->post());
                $this->session->set_flashdata('succ', 'Settings updated!');
                redirect(base_url() . 'admin/settings/mainpage/');
            }
        }
    }

}