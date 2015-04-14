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
        } elseif ($hash === 'hits') {
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
        $photo_data = array('name' => substr(preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->input->post('photo')), 0, -3), 'id_album' => $this->input->post('album'));
        $photo      = $this->foto->get_photo($photo_data);
        $this->foto->increase_hits('foto', $photo[0]->id);
    }

    /**
     * 
     */
    public function _welcome()
    {
        $this->data['title'] = 'Rupsha - Opensource picture sharing tool';
        $this->data['overview_array'] = $this->foto->getOverviewData();
//        print_r($this->data['overview_array']);
        $this->load->view(self::WELCOME_VIEW, $this->data);
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
        $this->data['title'] = 'Not found - Rupsha';
        $this->load->view(self::ERROR_VIEW, $this->data);
    }

    /**
     * @todo hack for json response for nanogallery
     * @param int $id_album
     */
    public function nanoProvider($id_album = NULL)
    {
        if (!empty($id_album) and FALSE !== $album = $this->foto->get_album('', array('id' => $id_album))) {
            $this->load->model('user');
            $json   = array();
            $photos = $this->foto->get_album_content($id_album);
            $user   = $this->user->get_user($album[0]->id_user);
            foreach ($photos as $photo) {
                $json[]['src']         = base_url() . 'img/user/' . $user[0]->login . '/' . $id_album . '/' . $photo->name . '_wm' . $photo->extension;
                $json[]['srct']        = base_url() . 'img/user/' . $user[0]->login . '/' . $id_album . '/' . $photo->name . '_thumb' . $photo->extension;
                $json[]['title']       = $album[0]->name;
                $json[]['description'] = $album[0]->text;
                $json[]['albumID'] = $album[0]->text;
            }
        }
        echo json_encode($json);
    }

}