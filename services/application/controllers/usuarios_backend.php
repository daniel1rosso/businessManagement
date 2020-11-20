<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios_backend extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function login() {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin,access-control-allow-methods, access-control-allow-headers');
        
        //--- Guardo ---//
        $postdata = file_get_contents("php://input");
        $request  = json_decode($postdata);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dato = array();
            $password = $request->password;
            $username = $request->username;

            $result = $this->app_model->compare_user_password($username, $password);

            if($result) {
                $user_session = array(
                    'nombreCompleto' => $result[0]['nombreCompleto'],
                    'apellido' => $result[0]['apellido'],
                    'email' => $result[0]['email'],
                    'telefono' => $result[0]['telefono'],
                    'user' => $result[0]['usuario'],
                    'logged_in' => true
                );

                $this->session->set_userdata($user_session);
                $this->userdata = $user_session;

                $dato['msg'] = "Usuario y contraseña";
                $dato['valid'] = true;
                $dato['user_session'] = $user_session;

            } else {
                $dato['msg'] = "Usuario o contraseña incorrecta";
                $dato['valid'] = false;
            }

        } else {
            $dato['msg'] = "No hay post";
            $dato['valid'] = false;
        }
        
        echo json_encode($dato);
    }

}
