<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download_zip {
    private $ci;

    /**
     *
     */
    public function __construct()
    {
        $this->ci = & get_instance();
    }

    /**
     * Create zip for album
     * @param string $sQuality
     * @param string $sId
     * @return array
     */
    public function generate_zip($sQuality = '', $sId = null)
    {
        $sPath = $this->get_photo_path($sId);
        if ($this->zip_exists($sId)) {
            return array('success' => '0', 'error' => 'file already exists');
        }
        $this->ci->load->library('zip');
        $this->ci->load->model('foto');
        $this->ci->zip->compression_level = 0;
        $sAffix = '';
        if ('hq' !== strtolower($sQuality)) {
            $sAffix = "_wm";
        }
        if ($sId !== null) {
            $oPhotos = $this->ci->foto->get_album_content($sId);
            foreach ($oPhotos as $aSinglePhoto) {

                $sPhotoPath = $sPath . $aSinglePhoto->name . $sAffix . $aSinglePhoto->extension;
                $this->ci->zip->read_file($sPhotoPath);
            }
            if ($this->ci->zip->archive($sPath . ZIP_FILENAME)) {
                return array('success' => '1');
            } else {
                return array('success' => '0', 'error' => 'error while archiving');
            }
        }

    }

    /**
     * Deletes zip from album
     * @param string $sId
     * @return array
     */
    public function delete_zip($sId = null)
    {
        if ($this->zip_exists($sId) && unlink($this->get_photo_path($sId).ZIP_FILENAME)) {
            $aResponse = array('success' => '1');
        }else{
            $aResponse = array('success' => '0','error'=>'file does not exists');
        }
        return $aResponse;
    }

    /**
     * Check if zip exists for certain album
     * @param string $sId
     * @return bool
     */
    public function zip_exists($sId){
        return file_exists($this->get_photo_path($sId).ZIP_FILENAME);
    }

    /**
     * Return path to photos
     * @param string $sId
     * @return string
     */
    public function get_photo_path($sId){
        $this->ci->load->library('authentication');
        $sLogin = $this->ci->authentication->get_user_login();
        return UPLOAD_PATH . $sLogin . '/' . $sId . '/';
    }

}