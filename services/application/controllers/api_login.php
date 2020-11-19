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

class Api_Login extends MY_Controller {
    
    public function login_comercio() {
        $msg = "";

        if ($_POST) {
            $user = $this->input->post('user', true);
            $password = $this->input->post('password', true);

            if ((!empty($user)) && (!empty($password))) {
                $result = $this->app_model_bar->compare_user_password_bar($user, sha1($password));

                if ($result) {
                    if ($result[0]['activado'] == 1 && $result[0]['eliminado'] == 0) {
                        $msg = "Todo ok";
                        $dato = array("valid" => true, "msg" => $msg, 'datos' => $result);
                    } else if ($result[0]['eliminado'] == 1) {
                        $msg = "Su cuenta se ha eliminado";
                        $dato = array("valid" => false, "msg" => $msg);
                    } else {
                        $msg = "Su usuario no se encuentra habilitada";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "Usuario o contraseña invalidos";
                    $dato = array("valid" => false, "msg" => $msg, "cambioPasswd" => false);
                }
            } else {
                $msg = "Algun dato obligatorio falta";
                $dato = array("valid" => false, "msg" => $msg, "cambioPasswd" => false);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function login_empleado() {
        $msg = "";
        if ($_POST) {

            $pin = $this->input->post('pin', true);
            $idGenComercio = $this->input->post('idGenComercio', true);
            if ((!empty($pin)) && (!empty($idGenComercio))) {
                $result = $this->app_model_bar->compare_pin_empleado(sha1($pin), $idGenComercio);

                if ($result) {
                    if ($result[0]['activado'] == 1 && $result[0]['eliminado'] == 0) {
                        $result2 = $this->app_model_bar->update_status_empleado(1, $result[0]['idUsuario']);
                        $result3 = $this->app_model_bar->get_mesas_abiertas_byIdUsuario($result[0]['idUsuario']);

                        if ($result3) {
                            $mesasAbiertas = count($result3);
                        } else {
                            $mesasAbiertas = 0;
                        }

                        $msg = "Todo ok";
                        $dato = array("valid" => true, "msg" => $msg, 'datos' => $result, 'mesasAbiertas' => $mesasAbiertas);
                    } else if ($result[0]['eliminado'] == 1) {
                        $msg = "Su cuenta se ha eliminado";
                        $dato = array("valid" => false, "msg" => $msg);
                    } else {
                        $msg = "Su usuario no se encuentra habilitado";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "Pin incorrecto";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Debe ingresar su pin";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function login_cocina() {
        $msg = "";
        if ($_POST) {
            $pin = $this->input->post('pin', true);
            if ((!empty($pin))) {
                $result = $this->app_model_bar->compare_pin_cocina(sha1($pin));

                if ($result) {
                    if ($result[0]['activado'] == 1 && $result[0]['eliminado'] == 0) {
                        $result2 = $this->app_model_bar->update_status_empleado(1, $result[0]['idUsuario']);

                        $msg = "Todo ok";
                        $dato = array("valid" => true, "msg" => $msg, 'datos' => $result);
                    } else if ($result[0]['eliminado'] == 1) {
                        $msg = "Su cuenta se ha eliminado";
                        $dato = array("valid" => false, "msg" => $msg);
                    } else {
                        $msg = "Su usuario no se encuentra habilitado";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "Pin incorrecto";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Debe ingresar su pin";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function logout_empleado() {
        $msg = "";

        if ($_POST) {
            $idUsuario = $this->input->post('idUsuario', true);

            if ((!empty($idUsuario))) {
                $result = $this->app_model_bar->update_status_empleado(0, $idUsuario);

                $msg = "Todo ok";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Algun dato obligatorio falta";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
