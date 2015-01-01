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

}
