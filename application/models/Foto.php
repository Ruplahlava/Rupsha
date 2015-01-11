<?php

/**
 * Desc
 */
class Foto extends CI_Model
{

    /**
     * get_album provides single album if id is specified, all if it is not
     * 
     * @param int/boolean $album
     * @return boolean
     */
    public function get_album($id_user, $album = FALSE)
    {
        if (FALSE === $album && empty($album)) {
            $sql           = 'SELECT * 
                    FROM album
                    LEFT JOIN (

                    SELECT COUNT( * ) AS cnt, id_album
                    FROM foto
                    GROUP BY id_album
                    )ft ON album.id = ft.id_album
                    WHERE id_user =' . $id_user;
            $album_content = $this->db->query($sql);
        } elseif (is_array($album)) {
            $album_content = $this->db->get_where('album', $album);
        } else {
            $album_content = $this->db->get_where('album', array('id' => $album, 'id_user' => $id_user));
        }
        if ($album_content->num_rows() !== 0) {
            return $album_content->result();
        }
        return FALSE;
    }

    /**
     * get_album_content
     * 
     * @param array $album
     * @return mixed
     */
    public function get_album_content($album)
    {
        $album_content = $this->db->get_where('foto', array('id_album' => $album));
        if ($album_content->num_rows() !== 0) {
            return $album_content->result();
        }
        return FALSE;
    }

    /**
     * add_album
     * 
     * @param array $post
     * @return boolean
     */
    public function add_album($post)
    {
        if (isset($post['date']) && empty($post['date'])) {
            $post['date'] = date('Y-m-d H:i:s', strtotime($post['date']));
        }
        if ($this->db->insert('album', $post)) {
            return TRUE;
        }
    }

    /**
     * add_photo
     * 
     * @param array $data
     * @param int $id
     * @return boolean 
     */
    public function add_photo($data, $id)
    {
        $data['id_album'] = $id;
        return $this->db->insert("foto", $data);
    }
    
    public function get_photo($id)
    {
        return $this->db->get_where('foto',array('id'=>$id))->result();
    }

    /**
     * increase_hits
     * 
     * @param array $table
     * @param int $id
     * @return boolean
     */
    public function increase_hits($table, $id)
    {
        return $this->db->query("UPDATE $table SET hits = hits +1 WHERE id = $id");
    }

    /**
     * 
     * @param mixed $photo
     * @return boolean or db result
     */
    public function delete_photo($photo)
    {
        if (is_array($photo)) {
            $query = $this->db->get_where('foto', $photo);
            $this->db->delete('foto', $photo);
        } else {
            $query = $this->db->get_where('foto', array('id' => $photo));
            $this->db->delete('foto', array('id' => $photo));
        }
        if ($query->num_rows() !== 0) {
            return $query->result();
        }
        return FALSE;
    }

    /**
     * 
     * @param int $id
     */
    public function delete_album($id)
    {
        $query = $this->db->get_where('album', array('id' => $id));
        $this->db->delete('album', array('id' => $id));
        if ($query->num_rows() !== 0) {
            return $query->result();
        }
        return FALSE;
    }
    
    /**
     * 
     * @param int $id_photo
     * @param array $data
     * @return boolean
     */
    public function update_photo($id_photo,$data)
    {
        if(!is_array($data)){
            die('Second parameter must be an array!');
        }
        if($this->db->update('foto',$data,'id='.$id_photo)){
            return true;
        }
        return false;
    }

}