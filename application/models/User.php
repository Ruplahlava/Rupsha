<?php

/**
 * Description of User
 *
 * @author Parek
 */
class User extends CI_Model {

    /**
     * logged
     * 
     * @param string $login
     * @param string $password
     * @return boolean
     */
    public function get_user_login($login, $password) {
        $credentials = array(
            'login' => $login,
            'password' => sha1($password)
        );
        $user = $this->db->get_where('users', $credentials);

        return $user;
    }

    /**
     * 
     * @param string $login
     * @return integer
     */
    public function get_id($login) {
        $query = $this->db->get_where('users', array('login' => $login));
        if ($query->num_rows !== 0) {
            $result = $query->result();
            return $result[0]->id;
        }
        return false;
    }

}
