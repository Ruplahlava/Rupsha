<?php

/**
 * Description of Album
 *
 * @author Parek
 */
class Album extends CI_Controller
{
    const ALBUM_VIEW   = 'album/album';
    const WELCOME_VIEW = 'welcome';
    const ERROR_VIEW   = '404';

    protected $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
        $this->data['settings'] = $this->settings_model->get_page_settings();
        
    }

    /**
     * @description Main viewing method
     * @param string $hash
     */
    public function index($hash = NULL)
    {
        if (NULL === $hash) {
            // welcome page
            $this->_welcome();
        } elseif($hash === 'hits'){
            $this->_hits();
        } elseif (FALSE !== $album = $this->foto->get_album('', array('hash' => $hash))) {
            // album content
            $this->_show_album($album);
        } else {
            // 404
            $this->_show_error();
        }
    }
    public function _hits()
    {
        $photo_data = array('name'=>substr(preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->input->post('photo')),0,-3),'id_album' =>$this->input->post('album'));
        $photo = $this->foto->get_photo($photo_data);
        $this->foto->increase_hits('foto',$photo[0]->id);
    }

    /**
     * 
     */
    public function _welcome()
    {
        
    }

    /**
     * 
     * @param array $album
     */
    public function _show_album($album)
    {
        $this->load->model('user');
        $this->data['album'] = $album;
        $this->data['photo'] = $this->foto->get_album_content($album[0]->id);
        $this->data['user']  = $this->user->get_user($album[0]->id_user);
        $this->data['title'] = $album[0]->name . ' - Rupsha';
        $this->foto->increase_hits('album', $album[0]->id);
        $this->load->view(self::ALBUM_VIEW, $this->data);
    }

    /**
     * 
     */
    public function _show_error()
    {
        
    }

}