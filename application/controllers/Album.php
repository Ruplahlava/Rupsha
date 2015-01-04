<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Album
 *
 * @author Parek
 */
class Album extends CI_Controller {

    const ALBUM_VIEW = '';
    const WELCOME_VIEW = '';
    const ERROR_VIEW = '';
    
    
    public function __construct() {
        parent::__construct();
    }

    /**
     * @description Main viewing method
     * @param string $hash
     */
    public function index($hash = NULL) {
        $album = $this->foto->get_album(array('hash' => $hash));
        if (NULL === $hash) {
            // welcome page
            $this->_welcome();
        } elseif (FALSE !== $album) {
            // album content
            $this->_show_album($album);
        } else {
            // 404
            $this->_show_error();
        }
    }
    
    /**
     * 
     */
    public function _welcome() {
        
    }
    
    /**
     * 
     * @param array $album
     */
    public function _show_album($album) {
        
    }
    
    /**
     * 
     */
    public function _show_error() {
        
    }
    
    

}
