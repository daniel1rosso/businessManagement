<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utils {

    public static function listDirectory($dir) {
        $result = array();
        $root = scandir($dir);
        foreach ($root as $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            if (is_file("$dir$value")) {
                $result[] = "$dir$value";
                continue;
            }
            if (is_dir("$dir$value")) {
                $result[] = "$dir$value/";
            }
            foreach (self::listDirectory("$dir$value/") as $value) {
                $result[] = $value;
            }
        }
        return $result;
    }

}

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    protected function debug($var) {
        echo '<pre>';
        die(var_dump($var));
        echo '<pre>';
    }

    //--- ADMIN - WEB ---//
    public function load_view($view, $data = '') {
        $data['url'] = base_url();
        $data['CI'] = & get_instance();
        $data['anioFooter'] = date('Y');
        $data['title'] = 'MYPYME';
        $userdata = $this->session->all_userdata();

        if (!$this->is_login() || $userdata['idNivel'] == 6) {
            return false;
        }

        if ($view == 'login') {
            $this->load->view('templates/head_login', $data);
            $this->load->view($view, $data);
        } else {
            $data['userdata'] = $this->session->all_userdata();

            if (!empty($userdata)) {
                $idUsuario = $userdata['idUsuario'];
                $result = $this->app_model->get_usuario_info($idUsuario);
                if (isset($result)) {
                    $data['nivelUsuario'] = $result[0]['nivel'];
                }

                function sort_by_posicion($a, $b) {
                    return $a['posicion'] - $b['posicion'];
                }

                $idNivelGen = $this->app_model->get_idNivel_byUser($userdata['idNivel']);
                $i = 0;
                $menuOrdenado = false;
                $menu = false;
                if ($idNivelGen) {
                    foreach ($idNivelGen as $value) {
                        $unMenu = $this->app_model->get_menu_byIdNivel($value['idGenMenuNivel']);
                        if ($unMenu) {
                            if ($unMenu != 0 || $unMenu != '') {
                                $i++;
                                $menu[$i] = $unMenu;
                            }
                        }
                    }
                    if ($menu) {
                        $menuOrdenado = [];
                        for ($i = 1; $i < count($menu) + 1; $i++) {
                            array_push($menuOrdenado, $menu[$i][0]);
                        }
                        uasort($menuOrdenado, 'sort_by_posicion');
                    }
                }


                $data['menu'] = $menuOrdenado;
                $notificacionesEgresos[] = [];
                $notificacionesGastos[] = [];
                $cantNotiEgreso = 0;
                $cantNotiGasto = 0;
                $cantNotificaciones = 0;
                //--- Consultas para las notificaciones de deudas que contiene el usuario tanto de compras vencidas como gastos vencidos ---//
                $notificacionesEgresos = $this->app_model->get_notificaciones_egresos( );
                $notificacionesGastos = $this->app_model->get_notificaciones_gastos( );
                if ($notificacionesEgresos != []) {
                    $cantNotiEgreso = count($notificacionesEgresos);
                }
                if ($notificacionesGastos != []) {
                    $cantNotiGasto = count($notificacionesGastos);
                }
                $cantNotificaciones = $cantNotiEgreso + $cantNotiGasto;
                $data['notificacionesEgresos'] = $notificacionesEgresos;
                $data['notificacionesGastos'] = $notificacionesGastos;
                $data['cantNotificaciones'] = $cantNotificaciones;
            }

            $data['user'] = $this->session->all_userdata();

            //-- Modales de Importacion --//
            $this->load->view($view, $data);
        }
    }

    //--- FUNCIONES ---//
    public function pushGCM($titulo, $descripcion, $registrationIds) {
        // API access key from Google FCM App Console
        define('API_ACCESS_KEY', 'AIzaSyC_q1aEAs0sUuGnFsyUlKgV_QWUP0V9ZXI');

        // 'vibrate' available in GCM, but not in FCM
        $fcmMsg = array(
            'body' => $descripcion,
            'title' => $titulo,
            'sound' => "default",
            'color' => "#203E78",
            'largeIcon' => 'http://24.232.94.248/assets/images/logos/logo.png',
            'smallIcon' => 'http://24.232.94.248/assets/images/logos/logo.png'
        );

        $fcmFields = array(
            //'to' => $singleID ;  // expecting a single ID
            'registration_ids' => $registrationIds, // expects an array of ids            
            'priority' => 'high',
            'notification' => $fcmMsg
        );

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);
    }

    public function generarPassword() {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $longpalabra = 8;
        for ($pass = '', $n = strlen($caracteres) - 1; strlen($pass) < $longpalabra;) {
            $x = rand(0, $n);
            $pass .= $caracteres[$x];
        }
        return $pass;
    }

    public function generarID() {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $longpalabra = 15;
        for ($pass = '', $n = strlen($caracteres) - 1; strlen($pass) < $longpalabra;) {
            $x = rand(0, $n);
            $pass .= $caracteres[$x];
        }
        return $pass;
    }

    public function emptyDir($dir) {
        if (is_dir($dir)) {
            $scn = scandir($dir);
            foreach ($scn as $files) {
                if ($files !== '.') {
                    if ($files !== '..') {
                        if (!is_dir($dir . '/' . $files)) {
                            unlink($dir . '/' . $files);
                        } else {
                            $this->emptyDir($dir . '/' . $files);
                            rmdir($dir . '/' . $files);
                        }
                    }
                }
            }
        }
    }

    protected function get_userdata() {
        return $this->session->all_userdata();
    }

    public function act_session() {
        $user_session = $this->session->all_userdata();
        $user = $this->app_model->get_user_by_id($user_session['idusers']);
        $this->session->set_userdata($user[0]);
    }

    function is_login() {
        $CI = & get_instance();
        $CI->load->library('session');
        $CI->load->helper('url');

        $session = $CI->session->all_userdata();

        if (isset($session['logged_in'])) {
            return true;
        } else {
            return false;
        }
    }

    public function get_logo() {
        $result = $this->app_model->get_logo();
        if (empty($result)) {
            return false;
        } else {
            return $result[0]['path'];
        }
    }

}
