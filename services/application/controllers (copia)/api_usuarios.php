<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Cache-Control, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

class Api_Usuarios extends MY_Controller {

    protected $data = array(
        'active' => 'usuarios'
    );

    public function __construct() {
        parent::__construct();
    }

    public function get_usuarios_online() {
        $usuarios = $this->app_model_bar->get_usuarios_online();
        $usuariosOnline = [];

        if ($usuarios) {
            foreach ($usuarios as $key => $value) {
                $usuariosOnline[$key]['idUserWaiter'] = $value['idUsuario'];
                $usuariosOnline[$key]['nameWaiter'] = $value['nombreCompleto'];

                $mesasAbiertas = $this->app_model_bar->get_mesas_abiertas_byIdUsuario($value['idUsuario']);
                if ($mesasAbiertas) {
                    $usuariosOnline[$key]['tablesOpen'] = count($mesasAbiertas);
                    $usuariosOnline[$key]['tablesUser'] = $mesasAbiertas;
                } else {
                    $usuariosOnline[$key]['tablesOpen'] = 0;
                    $usuariosOnline[$key]['tablesUser'] = Array();
                }
            }

            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "usuarios" => $usuariosOnline);
        } else {
            $msg = "No se encotaron usuarios conectados ";
            $dato = array("valid" => false, "msg" => $msg, "usuarios" => false);
        }

        echo json_encode($dato);
    }

}
