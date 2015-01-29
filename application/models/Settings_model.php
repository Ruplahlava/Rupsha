<?php

class Settings_model extends CI_Model
{

    /**
     * 
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
     * @param array $post
     */
    public function set_page_settings($post)
    {
       return $this->db->update('page_settings', $post, 'id=1');
    }

}