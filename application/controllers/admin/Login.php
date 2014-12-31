<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author POSTRS01
 */
class Login extends CI_Controller
{
    CONST LOGIN_VIEW = "admin/login";
    
    protected $data;
    
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = "Login - Rupsha";
    }

    /**
     * login
     */
    public function index()
    {
        if ($this->input->post()) {
            if (TRUE === $this->_validate_login() && $this->authentication->is_logged($this->input->post('login'), $this->input->post('password'))) {
                $userdata = array(
                    'is_logged' => true,
                    'login'     => $this->input->post('login')
                );
                $this->session->set_userdata($userdata);
                redirect(base_url() . 'admin');
            } else {
                $this->session->set_flashdata('invalid_credentials', TRUE);
                $this->load->view(self::LOGIN_VIEW, $this->data);
            }
        } else {
            $this->load->view(self::LOGIN_VIEW, $this->data);
        }
    }

    /**
     * logout
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . "admin/uploader/login");
    }

    /**
     * _validate_login()
     * @return boolean
     */
    public function _validate_login()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('login', 'Username', 'required|encode_php_tags');
        $this->form_validation->set_rules('password', 'Password', 'required|encode_php_tags');

        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}