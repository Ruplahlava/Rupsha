<?php

class Uploader extends CI_Controller {

    //views
    const UPLOADER_VIEW = 'admin/uploader';
    const ALBUM_ADD_VIEW = 'admin/album_add';
    const MAIN_VIEW = 'admin/main';
    //title
    const TITLE_MAIN = "Fotoshare - Admin";
    //Path
    const UPLOAD_PATH = "./img/user/";

    public $data;
    public $admin_methods;

    /**
     * __construct
     */
    public function __construct() {
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
    public function index() {
        $this->load->view(self::MAIN_VIEW, $this->data);
    }

    /**
     * upload
     */
    public function upload() {
        // Pridani alba       
        if ($this->input->post() && $this->_validate_album($this->input->post())) {
            $post = $this->input->post();
            $post['id_user'] = $this->session->userdata('id_user');
            $post['hash'] = substr(bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)),0,10);
            $this->foto->add_album($post);
            redirect(current_url());
            // Klasicke zobrazeni           
        } else if (FALSE !== $this->uri->segment(4) && !is_numeric($this->uri->segment(4))) {
            $this->data['album'] = $this->foto->get_album($this->session->userdata('id_user'));
            $this->load->view(self::ALBUM_ADD_VIEW, $this->data);
            // Nahravani fotek
        } else {
            if ('upload' === $this->uri->segment(5)) {
                $this->_process_picture();
            } else {
                // Zobrazeni uploaderu     
                $this->data['id_album'] = $this->uri->segment(4);
                $this->data['user'] = $this->session->userdata('login');
                $this->data['album'] = $this->foto->get_album($this->session->userdata('id_user'),$this->uri->segment(4));
                $this->load->view(self::UPLOADER_VIEW, $this->data);
            }
        }
    }

    /**
     * _upload_picture
     * @return array
     */
    public function _upload_picture() {
        $config['upload_path'] = self::UPLOAD_PATH . $this->session->userdata('login') . '/' . $this->uri->segment(4);
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;

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
    public function _process_picture() {
        $this->load->library('image_lib');
        $picture_data = $this->_upload_picture();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $picture_data['full_path'];
        $config['maintain_ratio'] = true;
        $config['create_thumb'] = TRUE;
        $config['width'] = 220;
        $config['height'] = 220;
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            print_r($this->image_lib->display_errors());
            die("Unable to resize and/or watermark picture.");
        }
        $config = null;
        $config['image_library'] = 'gd2';
        $config['source_image'] = $picture_data['full_path'];
        $config['wm_type'] = 'overlay';
        $config['wm_overlay_path']  = './img/login/pick8_1.jpg'; //the overlay image
        $config['wm_opacity']       = 50;
//      coord of transparent pixel
        $config['wm_x_transp']       = 0;
        $config['wm_y_transp']       = 0;
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'right';
        $config['wm_padding'] = '20';
        $config['create_thumb'] = TRUE;
        $config['thumb_marker'] = "_wm";
        
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {   
            print_r($this->image_lib->display_errors());
            die("Unable to resize and/or watermark picture.");
        }

        chmod($picture_data['full_path'], 0700);
        $foto['name']=$picture_data['raw_name'];
        $foto['extension']=$picture_data['file_ext'];
//        TBD
//        $foto['text']=  $this->input->post('text');
        $this->foto->add_photo($foto,$this->uri->segment(4));
        return true;
    }

    /**
     * _validate_album
     * @return boolean
     */
    public function _validate_album() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required|encode_php_tags|htmlspecialchars');
        $this->form_validation->set_rules('date', 'Date', 'encode_php_tags|htmlspecialchars');
        $this->form_validation->set_rules('place', 'place', 'encode_php_tags|htmlspecialchars');
        $this->form_validation->set_rules('text', 'Text', 'encode_php_tags|htmlspecialchars|nl2br');

        if ($this->form_validation->run() == FALSE) {
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
        $photos = $this->foto->get_album_content($id_album);
        foreach ($photos as $value) {
                $photo['name'] = $value->name.'_thumb.jpg';
                $photo['size'] = filesize('./index.php');
                $result[] = $photo;
        }
        echo json_encode($result);
    }
}
