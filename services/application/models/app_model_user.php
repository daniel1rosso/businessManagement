<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class App_model_user extends CI_Model
{
    public function compare_username_password($username, $password)
    {
        $values = array(
            'usuario' => $username,
            'password' => $password
        );
        $this->db->where($values);
        $result = $this->db->get('usuarios');
        return ($result != '') ? $result->result_array() : false;
    }
}
