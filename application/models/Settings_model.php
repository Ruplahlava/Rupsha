<?php
class Settings_model extends CI_Model {

     public function get_settings()
     {
         $settings = $this->db->get('page_settings');
         if($settings->num_rows() === 0){
             $this->db->query('INSERT INTO page_settings VALUES() ');
             $settings = $this->db->get('page_settings');
         }
         return $settings->result();
     }
}
