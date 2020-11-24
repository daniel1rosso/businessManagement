<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends MY_Controller {

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
            //--- Data ---//
            $username = $request->username;
            $password = $request->password;
            //--- Encryption ---//
            $pepper = "c1isvFdxMDdmjOlvxpecFw";
            $pwd_peppered = hash_hmac("sha256", $password, $pepper);
            //--- user validation ---//
            $result = $this->app_model_user->compare_username_password($username, $pwd_peppered);

            if($result) {
                //--- Data the user_session ---//
                $user_session = array(
                    'idUsuario' => $result[0]['idUsuario'],
                    'nombreCompleto' => $result[0]['nombreCompleto'],
                    'apellido' => $result[0]['apellido'],
                    'email' => $result[0]['email'],
                    'telefono' => $result[0]['telefono'],
                    'user' => $result[0]['usuario'],
                    'idNivel' => $result[0]['idNivel'],
                    'logged_in' => true
                );
                
                //--- Session control ---//
                $this->app_model_user->set_log_usuario($user_session['idUsuario'], $user_session['nombreCompleto'].' '.$user_session['apellido'], $user_session['idNivel']);

                //--- Generate userdata ---//
                $this->session->set_userdata($user_session);
                $this->userdata = $user_session;
                //--- Cookie ---//
                $userdata = $this->session->all_userdata();
                
                //--- Reply ---//
                $dato['msg'] = "Login success";
                $dato['valid'] = true;
                $dato['user_session'] = $user_session;
                $dato['userdata'] = $userdata;

            } else {
                $dato['msg'] = "Username or password incorrect";
                $dato['valid'] = false;
            }

        } else {
            $dato['msg'] = "There is not post";
            $dato['valid'] = false;
        }
        
        echo json_encode($dato);
    }

    public function logout() {
        //--- Detroy session ---//
        $this->session->sess_destroy();
        
        //--- Reply ---//
        $dato['msg'] = "Session detroyed";
        $dato['valid'] = true;

        echo json_encode($dato);
    }

    public function list_users() {
        //--- List users ---//
        $result = $this->app_model_user->list_users();

        if($result) {
            //--- Reply ---//
            $dato['msg'] = "List users success";
            $dato['valid'] = true;
            $dato['users'] = $result;
        } else {
            //--- Reply ---//
            $dato['msg'] = "Error getting the list of users";
            $dato['valid'] = false;
            $dato['users'] =  [];
        }

        echo json_encode($dato);
    }

    public function add_user() {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin,access-control-allow-methods, access-control-allow-headers');
        
        //--- Guardo ---//
        $postdata = file_get_contents("php://input");
        $request  = json_decode($postdata);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
            //--- Data ---//
            $nivel = $request->idNivel;
            $idProvincia = $request->idProvincia;
            $idLocalidad = $request->idLocalidad;
            $nombre = $request->nombrePersona;
            $apellido = $request->apellido;
            $nombreUsuario = $request->username;
            $password = $request->password;
            $email = $request->email;
            $telefono = $request->telefono;
            $menu = json_decode($request->idMenu);
            $idGeneradoUsuarioMenuAdmin = $this->generarID();
            $idGenCuenta = $this->generarID();

            //--- Validate data ---//
            if (!empty($telefono) && !empty($email) && !empty($idLocalidad) && !empty($idProvincia) && !empty($nombre) && !empty($apellido) && !empty($nombreUsuario) && !empty($password) && !empty($nivel)) {
                //--- Encryption ---//
                $pepper = "c1isvFdxMDdmjOlvxpecFw";
                $pwd_peppered = hash_hmac("sha256", $password, $pepper);
                //--- Add user to database ---//
                $result = $this->app_model_user->add_usuario($idProvincia, $idLocalidad, $nombre, $apellido, $nombreUsuario, $pwd_peppered, $nivel, $email, $telefono, $idGeneradoUsuarioMenuAdmin);
                //--- Get new user ---//
                $idUsuario = $this->app_model_user->get_usuario_by_idGeneradoUsuarioMenuAdmin($idGeneradoUsuarioMenuAdmin);
                $idUsuario = $idUsuario[0]['idUsuario'];

                //--- Verificamos que sea mozo o vendedor ---//
                if (intval($nivel) == 9 || intval($nivel) == 10) {
                    //--- Agregado de la cuenta de tesoreria (caja chica al vendedor o mozo) ---//
                    $this->app_model_user->insert_tesoreria_cuentas($idGenCuenta, $idUsuario, 1, $nombreUsuario, 4);
                }

                //--- Assign menu ---//
                if (count($menu) > 0) {
                    $menu_add = true;
                    foreach ($menu as $values) {
                        $this->app_model_user->add_menu_usuario($idUsuario, $values);
                    }
                } else {
                    $menu_add = false;
                }

                //--- Retry ---//
                if ($result && $menu_add) {
                    $msg = "Add user sucess";
                    $dato = array("valid" => true, "msg" => $msg, "idUsuario" => $idUsuario);
                } else {
                    $msg = "Error addeding the user";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Minimal data is missing";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "There is not post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function update_user() {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin,access-control-allow-methods, access-control-allow-headers');
        
        //--- Guardo ---//
        $postdata = file_get_contents("php://input");
        $request  = json_decode($postdata);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
            //--- Data ---//
            $idUsuario = $request->idUsuario;
            $nivel = $request->idNivel;
            $idProvincia = $request->idProvincia;
            $idLocalidad = $request->idLocalidad;
            $nombre = $request->nombrePersona;
            $apellido = $request->apellido;
            $nombreUsuario = $request->username;
            $password = $request->password;
            $email = $request->email;
            $telefono = $request->telefono;
            $menu = json_decode($request->idMenu);

            //--- Validate data ---//
            if (!empty($idUsuario) && !empty($telefono) && !empty($email) && !empty($idLocalidad) && !empty($idProvincia) && !empty($nombre) && !empty($apellido) && !empty($nombreUsuario) && !empty($password) && !empty($nivel)) {
                //--- Encryption ---//
                $pepper = "c1isvFdxMDdmjOlvxpecFw";
                $pwd_peppered = hash_hmac("sha256", $password, $pepper);

                //--- Datos anteriores del usuario ---//
                $usuario_antes_actualizarse = $this->app_model_user->get_usuario_byId($idUsuario);
                //--- Verificamos que el usuario antes de actualizarse no sea ni mozo, ni vendedor ---//
                if ($usuario_antes_actualizarse[0]['idNivel'] != 9 && $usuario_antes_actualizarse[0]['idNivel'] != 10) {
                    //--- Verificamos que sea mozo o vendedor ---//
                    if (intval($nivel) == 9 || intval($nivel) == 10) {
                        $cuenta_corriente = $this->app_model_user->get_tesoreria_cuentas_by_idUsuario($idUsuario);
                        //--- Verificamos que no tenga una tesoreria_cuentas ---//
                        if (!$cuenta_corriente) {
                            //--- Id Gen ---//
                            $idGenCuenta = $this->generarID();
                            //--- Agregado de la cuenta de tesoreria (caja chica al vendedor o mozo ---//
                            $this->app_model_user->insert_tesoreria_cuentas($idGenCuenta, $idUsuario, 1, $nombreUsuario, 4);
                        }
                    }
                }

                //--- Update user ---//
                $result = $this->app_model_user->update_usuario($idUsuario, $idProvincia, $idLocalidad, $nombre, $apellido, $nombreUsuario, $pwd_peppered, $nivel, $email, $telefono);

                //--- Delete menu admin ---//
                $this->app_model_user->delete_usuarioMenuAdmin($idUsuario);

                //--- Assign menu ---//
                if (count($menu) > 0) {
                    $menu_add = true;
                    foreach ($menu as $values) {
                        $this->app_model_user->add_menu_usuario($idUsuario, $values);
                    }
                } else {
                    $menu_add = false;
                }

                //--- Retry ---//
                if ($result && $menu_add) {
                    $msg = "La actualizaciòn de los datos del usuarios se registraron exitosamente";
                    $dato = array("valid" => true, "msg" => $msg, "idUsuario" => $idUsuario);
                } else {
                    $msg = "Error al actualizar los datos del usuario, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Minimal data is missing";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "There is not post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function delete_user() {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin,access-control-allow-methods, access-control-allow-headers');
        
        //--- Guardo ---//
        $postdata = file_get_contents("php://input");
        $request  = json_decode($postdata);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $dato = array();
            //--- Data ---//
            $idUsuario = $request->idUsuario;

            //--- Delete user ---//
            $result = $this->app_model_user->delete_user($idUsuario);

            if($result) {
                //--- Reply ---//
                $dato['msg'] = "Delete user success";
                $dato['valid'] = true;
                $dato['users'] = $result;
            } else {
                $dato['msg'] = "Error deleting user";
                $dato['valid'] = false;
                $dato['users'] =  [];
            }

        } else {
            $dato['msg'] = "There is not post";
            $dato['valid'] = false;
        }

        echo json_encode($dato);
    }

}
