<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class App_model_user extends CI_Model
{
    public function compare_user_password($user, $password)
    {
        $values = array(
            'usuario' => $user,
            'password' => $password
        );
        $this->db->where($values);
        $result = $this->db->get('usuarios');
        return ($result != '') ? $result->result_array() : false;
    }
}
