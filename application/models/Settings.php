<?php
class Settings extends CI_Model {

     public function get_settings($id)
     {
         $settings = $this->db->get('page_settings');
         if($settings->num_rows() === 0){
             $this->db->insert('page_settings');
             $settings = $this->db->get('page_settings');
         }
         return $settings->result();
     }
}
