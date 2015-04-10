<?php

class Uploader extends CI_Controller
{
    //views
    const UPLOADER_VIEW  = 'admin/uploader';
    const ALBUM_ADD_VIEW = 'admin/album_add';
    const MAIN_VIEW      = 'admin/main';
    //title
    const TITLE_MAIN     = "Fotoshare - Admin";
    //Path
    const UPLOAD_PATH    = "./img/user/";

    public $data;
    public $admin_methods;

    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = self::TITLE_MAIN;
        $this->admin_methods = array(
            "index",
            "upload"
        );
    }

    /**
     * index
     */
    public function index()
    {
        redirect(base_url() . 'admin/uploader/upload');
    }

    /**
     * upload
     */
    public function upload()
    {
        // Pridani alba       
        if ($this->input->post() && $this->_validate_album($this->input->post())) {
            $post            = $this->input->post();
            $post['id_user'] = $this->authentication->get_user_id();
            $post['hash']    = substr(bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)), 0, 10);
            $this->foto->add_album($post);
            redirect(current_url());
            // Klasicke zobrazeni           
        } else if (FALSE !== $this->uri->segment(4) && !is_numeric($this->uri->segment(4))) {
            $this->data['album'] = $this->foto->get_album($this->authentication->get_user_id());
            $this->load->view(self::ALBUM_ADD_VIEW, $this->data);
            // Nahravani fotek
        } else {
            $this->authentication->is_owner($this->uri->segment(4));
            if ('upload' === $this->uri->segment(5)) {
                $picture_data = $this->_process_picture();
                json_encode(array('name' => $picture_data['raw_name'], 'size' => $picture_data['full_path']));
            } else {
                // Zobrazeni uploaderu     
                $this->data['id_album']        = $this->uri->segment(4);
                $this->data['user']            = $this->authentication->get_user_login();
                $this->data['album']           = $this->foto->get_album($this->authentication->get_user_id(), $this->uri->segment(4));
                $this->data['album_xeditable'] = $this->_prep_album_xeditable($this->data['album'][0]);
                $this->load->view(self::UPLOADER_VIEW, $this->data);
            }
        }
    }

    /**
     * _upload_picture
     * @return array
     */
    public function _upload_picture()
    {
        $config['upload_path']   = self::UPLOAD_PATH . $this->authentication->get_user_login() . '/' . $this->uri->segment(4);
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if (!is_dir($config['upload_path'])) { //create the folder if it's not already exists
            mkdir($config['upload_path'], 0755, TRUE);
        }

        if (!$this->upload->do_upload('file')) {
            print_r($this->upload->display_errors());
            die();
        } else {
            return $this->upload->data();
        }
    }

    /**
     * _process_picture
     * @return boolean
     */
    public function _process_picture()
    {
        $this->load->library('image_lib');
        $picture_data = $this->_upload_picture();
        $this->_create_thumb($picture_data);
        $this->_create_watermark($picture_data);

        chmod($picture_data['full_path'], 0700);
        $foto['name']      = $picture_data['raw_name'];
        $foto['extension'] = $picture_data['file_ext'];
        $foto['text']      = $this->input->post('text');
        $this->foto->add_photo($foto, $this->uri->segment(4));
        return $picture_data;
    }

    /**
     * 
     * @param array $picture_data
     */
    public function _create_thumb($picture_data)
    {
        $config['image_library']  = 'gd2';
        $config['source_image']   = $picture_data['full_path'];
        $config['maintain_ratio'] = true;
        $config['create_thumb']   = TRUE;
        $config['width']          = 220;
        $config['height']         = 220;

        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            print_r($this->image_lib->display_errors());
            die("Unable to resize and/or watermark picture.");
        }
    }

    /**
     * 
     * @param array $picture_data
     */
    public function _create_watermark($picture_data)
    {
        $this->_image_resize($picture_data);
        $config['image_library']    = 'gd2';
        $config['source_image']     = $picture_data['full_path'];
        $config['quality']          = 100;
        $config['wm_type']          = 'overlay';
        $config['wm_overlay_path']  = './img/wm/dnc.png'; //the overlay image
        $config['wm_opacity']       = 50;
//      coord of transparent pixel
        $config['wm_x_transp']      = 0;
        $config['wm_y_transp']      = 0;
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'right';
        $config['wm_padding']       = '20';
        $config['create_thumb']     = TRUE;
        $config['thumb_marker']     = "_wm";

        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            print_r($this->image_lib->display_errors());
            die("Unable to watermark picture.");
        }
    }
    
    /**
     * Resizes picture if it is bigger then desired
     * @param array $picture_data
     */
    public function _image_resize($picture_data)
    {
        $this->load->model('settings_model');
        $page_settings = $this->settings_model->get_page_settings();
        if($page_settings[0]->max_dimension < $picture_data['image_width'] || $page_settings[0]->max_dimension < $picture_data['image_height']) {
            $config['image_library']  = 'gd2';
            $config['source_image']   = $picture_data['full_path'];
            $config['maintain_ratio'] = TRUE;
            if (0 != $page_settings[0]->max_dimension) {
                $config['width']  = $page_settings[0]->max_dimension;
                $config['height'] = $page_settings[0]->max_dimension;
            }
            $config['quality'] = $page_settings[0]->quality;
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            if (!$this->image_lib->resize()) {
                print_r($this->image_lib->display_errors());
                die("Unable to resize picture.");
            }
        }
        return true;
    }

    /**
     * _validate_album
     * @return boolean
     */
    public function _validate_album()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required|encode_php_tags|htmlspecialchars');
        $this->form_validation->set_rules('date', 'Date', 'encode_php_tags|htmlspecialchars');
        $this->form_validation->set_rules('place', 'place', 'encode_php_tags|htmlspecialchars');
        $this->form_validation->set_rules('text', 'Text', 'encode_php_tags|htmlspecialchars|nl2br');

        if (FALSE === $this->form_validation->run()) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * @description provides JSON for dropzone
     */
    public function get_photo_dz($id_album)
    {
        $this->authentication->is_owner($id_album);
        $photos = $this->foto->get_album_content($id_album);
        foreach ($photos as $value) {
            $photo['name'] = $value->name . '_thumb' . $value->extension;
            $photo['size'] = filesize('./img/user/' . $this->authentication->get_user_login() . '/' . $id_album . '/' . $value->name . '_wm' . $value->extension);
            $photo['text'] = $value->text;
            $photo['id']   = $value->id;
            $photo['sort'] = $value->name.'_'.$value->id;
            $result[]      = $photo;
        }
        echo json_encode($result);
    }

    public function del_photo_dz()
    {
        $foto['name'] = substr($this->input->post('name'), 0, -10);
        if (FALSE !== $foto_db      = $this->foto->delete_photo($foto)) {
            $this->authentication->is_owner($foto_db[0]->id_album);
            unlink('./img/user/' . $this->authentication->get_user_login() . '/' . $foto_db[0]->id_album . '/' . $foto_db[0]->name . '_wm' . $foto_db[0]->extension);
            unlink('./img/user/' . $this->authentication->get_user_login() . '/' . $foto_db[0]->id_album . '/' . $foto_db[0]->name . '_thumb' . $foto_db[0]->extension);
            unlink('./img/user/' . $this->authentication->get_user_login() . '/' . $foto_db[0]->id_album . '/' . $foto_db[0]->name . $foto_db[0]->extension);
        }
    }

    /**
     * 
     * @param int $id
     */
    public function delete_album($id)
    {
        $this->authentication->is_owner($id);
        $photos = $this->foto->get_album_content($id);
        if (FALSE !== $photos) {
            foreach ($photos as $value) {
                if (FALSE !== $foto_db = $this->foto->delete_photo($value->id)) {
                    unlink('./img/user/' . $this->authentication->get_user_login() . '/' . $foto_db[0]->id_album . '/' . $foto_db[0]->name . '_wm' . $foto_db[0]->extension);
                    unlink('./img/user/' . $this->authentication->get_user_login() . '/' . $foto_db[0]->id_album . '/' . $foto_db[0]->name . '_thumb' . $foto_db[0]->extension);
                    unlink('./img/user/' . $this->authentication->get_user_login() . '/' . $foto_db[0]->id_album . '/' . $foto_db[0]->name . $foto_db[0]->extension);
                }
            }
            rmdir('./img/user/' . $this->authentication->get_user_login() . '/' . $photos[0]->id_album);
        }
        $this->foto->delete_album($id);
        redirect(base_url() . 'admin/uploader/upload');
    }

    /**
     * 
     * @param int $id_album
     */
    public function change_text_dz()
    {
        $this->load->helper('string');
        $foto_update['text'] = quotes_to_entities(htmlspecialchars($this->input->post('value')));
        $id_foto             = $this->input->post('pk');
        $foto                = $this->foto->get_photo($id_foto);
        $this->authentication->is_owner($foto[0]->id_album);
        $this->foto->update_photo($id_foto, $foto_update);
    }

    /**
     * 
     * @param int $id
     * @param string $what
     */
    public function alter_album($id, $what)
    {
        $this->authentication->is_owner($id);
        switch ($what) {
            case 'date':
                $datetime      = DateTime::createFromFormat('Y-m-d', $this->input->post('value'));
                $data['date']   = $datetime->format('Y-m-d h:m:s');
                break;
            case 'location':
                $data['place'] = $this->input->post('value');
                break;
            case 'text':
                $data['text']  = $this->input->post('value');
                break;
            case 'name':
                $data['name']  = $this->input->post('value');
                break;
            default:
                die('Not acceptable value');
        }
        $this->foto->update_album($id, $data);
    }

    /**
     * 
     * @param object $album
     */
    public function _prep_album_xeditable($album)
    {
        // Empty value
        foreach ($album as $key => $value) {
            if (empty($value)) {
                $album->$key = 'Empty';
            }
        }
        $datetime    = DateTime::createFromFormat('Y-m-d h:m:s', $album->date);
        $album->date = $datetime->format('d.m.Y');
        return $album;
    }
    
    /**
     * @todo check if photos are in album
     * @param string $param
     */
    public function sort_dz($id_album = null)
    {
        $this->authentication->is_owner($id_album);
        $post = $this->input->post();
        $counter = 1;
        $sorted = array();
        foreach ($post as $key => $value){
            $tmpa['order'] = $counter;
            $tmpa['id'] = $value[0];
            $sorted[] = $tmpa;
            $counter++;
        }
        $this->foto->sort_update($sorted);
    }

}