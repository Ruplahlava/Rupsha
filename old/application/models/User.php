<?php

/**
 * Description of User
 *
 * @author Parek
 */
class User extends CI_Model
{

    /**
     * get_user_login
     * 
     * @param string $login
     * @param string $password
     * @return boolean
     */
    public function get_user_login($login, $password)
    {
        $credentials = array(
            'login'    => $login,
            'password' => sha1($password)
        );
        $user        = $this->db->get_where('users', $credentials);

        return $user;
    }

    /**
     * 
     * @param int $id
     * @return array
     */
    public function get_user($id)
    {
        $query = $this->db->get_where('users', array('id' => $id));
        if ($query->num_rows !== 0) {
            return $query->result();
        }
        return false;
    }

    public function get_all_users()
    {
        return $this->db->get_where('users', 'admin != 1')->result();
    }

    /**
     * 
     * @param string $login
     * @return integer
     */
    public function get_id($login)
    {
        $query = $this->db->get_where('users', array('login' => $login));
        if ($query->num_rows !== 0) {
            $result = $query->result();
            return $result[0]->id;
        }
        return false;
    }

    /**
     * 
     * @param int $id
     * @param array $data
     * @return boolean
     */
    public function update_user($id, $data)
    {
        return $this->db->update('users', $data, 'id=' . $id);
    }

    /**
     * 
     * @param int $id
     */
    public function delete_user($id)
    {
        return $this->db->delete('users', array('id' => $id));
    }

    public function add_user($login, $password)
    {
        $data['login']    = $login;
        $data['password'] = sha1($login);
        return $this->db->insert('users', $data);
    }

}