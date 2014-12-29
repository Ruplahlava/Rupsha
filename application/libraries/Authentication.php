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

}
/* End of file Someclass.php */