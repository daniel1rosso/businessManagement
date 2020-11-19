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
//        $data['title'] = 'COPA PYMES - ADMIN';	
        $data['title'] = 'BiSoft';
        $userdata = $this->session->all_userdata();

        if (!$this->is_login() || $userdata['idNivel'] == 6) {
            $this->load->view('templates/head_login', $data);
            $this->load->view('login', $data);
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
            $this->load->view('templates/head', $data);
            $this->load->view('templates/modales/modales');
            
            //-- Modales de Importacion --//
            $this->load->view('templates/modales/modales_importarXLS');
            
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view($view, $data);
            $this->load->view('templates/footer', $data);
        }
    }

    //--- WEB - PUBLICO ---//
    public function load_view_public($view, $data = '') {
        $data['url'] = base_url();
        $data['anioFooter'] = date('Y');
        $data['title'] = 'COPA PYMES - WEB';
        $data['userdata'] = $this->session->all_userdata();
        $userdata = $this->session->all_userdata();

        $this->data['active'] = 'inicio';

        $this->load->view('templates_publico/head', $data);
        $this->load->view('templates_publico/modales/modales');
        $this->load->view('templates_publico/header', $data);
        $this->load->view('templates_publico/menu', $data);
        $this->load->view($view, $data);
        $this->load->view('templates_publico/footer', $data);
    }

    //--- ADMIN WEB - PUBLICO ---//
    public function load_view_public_admin($view, $data = '') {
        $data['url'] = base_url();
        $data['anioFooter'] = date('Y');
        $data['title'] = 'COPA PYMES - USUARIO';
        $data['userdata'] = $this->session->all_userdata();
        $userdata = $this->session->all_userdata();

        if (!$this->is_login() OR $userdata['idNivel'] != 6) {
            $this->load->view('templates_publico_admin/head_login', $data);
            $this->load->view('login_public', $data);
            return false;
        }

        if ($view == 'login_public' AND ! $this->is_login() AND $userdata['idNivel'] != 6) {
            $this->load->view('templates_publico_admin/head_login', $data);
            $this->load->view($view, $data);
        } else if ($view == 'login_public' AND $this->is_login() AND $userdata['idNivel'] == 6) {
            redirect('/dashboard_public');
        } else if ($this->is_login() AND $userdata['idNivel'] == 6) {
            $data['user'] = $this->session->all_userdata();
            $this->load->view('templates_publico_admin/head', $data);
            $this->load->view('templates_publico_admin/modales/modales');
            $this->load->view('templates_publico_admin/header', $data);
            $this->load->view('templates_publico_admin/menu', $data);
            $this->load->view($view, $data);
            $this->load->view('templates_publico_admin/footer', $data);
        }
    }

    //--- FORMULARIOS ---//
    public function datosFormCuentaTesoreria() {
        $tipo_cuentas_tesoreria = $this->app_model->get_tesoreria_tipo_cuenta();
        if ($tipo_cuentas_tesoreria) {
            foreach ($tipo_cuentas_tesoreria as $key => $value) {
                $this->data['tipo_cuentas_tesoreria'][$key]['idTipoCuenta'] = $value['idTipoCuenta'];
                $this->data['tipo_cuentas_tesoreria'][$key]['descripcion'] = $value['descripcion'];
            }
        }
    }

    public function datosFormCliente() {
        $sexo = $this->app_model->get_sexo();
        if ($sexo) {
            foreach ($sexo as $key => $value) {
                $this->data['sexo'][$key]['idSexo'] = $value['idSexo'];
                $this->data['sexo'][$key]['cod'] = $value['cod'];
                $this->data['sexo'][$key]['tipo'] = $value['tipo'];
            }
        }

        $estado_civil = $this->app_model->get_estado_civil();
        if ($estado_civil) {
            foreach ($estado_civil as $key => $value) {
                $this->data['estado_civil'][$key]['idCivil'] = $value['idCivil'];
                $this->data['estado_civil'][$key]['cod'] = $value['cod'];
                $this->data['estado_civil'][$key]['estado'] = $value['estado'];
            }
        }

        $categorias_ventas = $this->app_model->get_categorias_ventas();
        if ($categorias_ventas) {
            foreach ($categorias_ventas as $key => $value) {
                $this->data['categorias_ventas'][$key]['idCategoriaVentas'] = $value['idCategoriaVentas'];
                $this->data['categorias_ventas'][$key]['descripcion'] = $value['descripcion'];
            }
        }

        $documentos_tipos = $this->app_model->get_documentos_tipos();
        if ($documentos_tipos) {
            foreach ($documentos_tipos as $key => $value) {
                $this->data['documentos_tipos'][$key]['idTipoDocumento'] = $value['idTipoDocumento'];
                $this->data['documentos_tipos'][$key]['descripcion'] = $value['descripcion'];
            }
        }

        $iva_condiciones = $this->app_model->get_iva_condiciones();
        if ($iva_condiciones) {
            foreach ($iva_condiciones as $key => $value) {
                $this->data['iva_condiciones'][$key]['idCondicionIva'] = $value['idCondicionIva'];
                $this->data['iva_condiciones'][$key]['descripcion'] = $value['descripcion'];
            }
        }

        $comprobantes_tipos = $this->app_model->get_comprobantes_tipos();
        if ($comprobantes_tipos) {
            foreach ($comprobantes_tipos as $key => $value) {
                $this->data['comprobantes_tipos'][$key]['idTipoComprobante'] = $value['idTipoComprobante'];
                $this->data['comprobantes_tipos'][$key]['descripcion'] = $value['descripcion'];
            }
        }

        $provincias = $this->app_model->get_provincias();
        if ($provincias) {
            foreach ($provincias as $key => $value) {
                $this->data['provincias'][$key]['idProvincia'] = $value['idProvincia'];
                $this->data['provincias'][$key]['provincia'] = $value['provincia'];
            }
        }
    }

    public function datosFormProveedores() {
        $sexo = $this->app_model->get_sexo();
        if ($sexo) {
            foreach ($sexo as $key => $value) {
                $this->data['sexo'][$key]['idSexo'] = $value['idSexo'];
                $this->data['sexo'][$key]['cod'] = $value['cod'];
                $this->data['sexo'][$key]['tipo'] = $value['tipo'];
            }
        }

        $estado_civil = $this->app_model->get_estado_civil();
        if ($estado_civil) {
            foreach ($estado_civil as $key => $value) {
                $this->data['estado_civil'][$key]['idCivil'] = $value['idCivil'];
                $this->data['estado_civil'][$key]['cod'] = $value['cod'];
                $this->data['estado_civil'][$key]['estado'] = $value['estado'];
            }
        }

        $categorias_compras = $this->app_model->get_categorias_compras();
        if ($categorias_compras) {
            foreach ($categorias_compras as $key => $value) {
                $this->data['categorias_compras'][$key]['idCategoriaCompras'] = $value['idCategoriaCompras'];
                $this->data['categorias_compras'][$key]['descripcion'] = $value['descripcion'];
            }
        }

        $documentos_tipos = $this->app_model->get_documentos_tipos();
        if ($documentos_tipos) {
            foreach ($documentos_tipos as $key => $value) {
                $this->data['documentos_tipos'][$key]['idTipoDocumento'] = $value['idTipoDocumento'];
                $this->data['documentos_tipos'][$key]['descripcion'] = $value['descripcion'];
            }
        }

        $iva_condiciones = $this->app_model->get_iva_condiciones();
        if ($iva_condiciones) {
            foreach ($iva_condiciones as $key => $value) {
                $this->data['iva_condiciones'][$key]['idCondicionIva'] = $value['idCondicionIva'];
                $this->data['iva_condiciones'][$key]['descripcion'] = $value['descripcion'];
            }
        }

        $comprobantes_tipos = $this->app_model->get_comprobantes_tipos();
        if ($comprobantes_tipos) {
            foreach ($comprobantes_tipos as $key => $value) {
                $this->data['comprobantes_tipos'][$key]['idTipoComprobante'] = $value['idTipoComprobante'];
                $this->data['comprobantes_tipos'][$key]['descripcion'] = $value['descripcion'];
            }
        }

        $provincias = $this->app_model->get_provincias();
        if ($provincias) {
            foreach ($provincias as $key => $value) {
                $this->data['provincias'][$key]['idProvincia'] = $value['idProvincia'];
                $this->data['provincias'][$key]['provincia'] = $value['provincia'];
            }
        }
    }

    public function datosFormProductos() {
        $proveedores = $this->app_model->get_proveedores();
        if ($proveedores) {
            foreach ($proveedores as $key => $value) {
                $this->data['proveedores'][$key]['idProveedor'] = $value['idProveedor'];
                $this->data['proveedores'][$key]['nombre'] = $value['nombre'];
            }
        }

        $iva_tipos = $this->app_model->get_iva_tipos();
        if ($iva_tipos) {
            foreach ($iva_tipos as $key => $value) {
                $this->data['iva_tipos'][$key]['idIva'] = $value['idIva'];
                $this->data['iva_tipos'][$key]['descripcion'] = $value['descripcion'];
            }
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
            'largeIcon' => 'http://pymes.bisoft.com.ar/assets/images/logos/logo.png',
            'smallIcon' => 'http://pymes.bisoft.com.ar/assets/images/logos/logo.png'
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
