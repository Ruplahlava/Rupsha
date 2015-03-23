<?php

class Settings_model extends CI_Model
{

    /**
     * @todo remove insert when installation script is finished
     * @return object
     */
    public function get_page_settings()
    {
        $settings = $this->db->get('page_settings');
        if ($settings->num_rows() === 0) {
            $this->db->query('INSERT INTO page_settings VALUES() ');
            $settings = $this->db->get('page_settings');
        }
        return $settings->result();
    }

    /**
     * 
     * @param array $data
     */
    public function set_page_settings($data)
    {
       return $this->db->update('page_settings', $data, 'id=1');
    }

}