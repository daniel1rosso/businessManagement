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

class Api_Mesas extends MY_Controller {

    protected $data = array(
        'active' => 'mesas'
    );

    public function listar_mesas() {
        $mesas = $this->app_model_bar->get_mesas();

        if (!empty($mesas)) {
            foreach ($mesas as $key => $value) {
                if ($value['idPedido'] != "0") {
                    $mesas[$key]["pedidos"] = $this->app_model_bar->get_pedidosByIdPedido($value['idPedido']);
                } else {
                    $mesas[$key]["pedidos"] = false;
                }
            }
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "datos" => $mesas);
        } else {
            $msg = "No se encontraron mesas registradas";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function busca_mesas_libres() {
        $mesas_libres = $this->app_model_bar->get_mesas_libres();

        if ($mesas_libres) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "datos" => $mesas_libres);
        } else {
            $msg = "No hay mesas libres";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function cambiar_mesa() {
        $msg = "";

        if ($_POST) {
            $idMesa = $this->input->post('idMesa', true);
            $idMesaNueva = $this->input->post('idMesaNueva', true);
            $idPedido = $this->input->post('idPedido', true);

            if (!empty($idMesa) && !empty($idMesaNueva)) {
                $mesa = $this->app_model_bar->get_mesa_byId($idMesaNueva);
                if ($mesa) {
                    if ($mesa[0]['idEstadoMesa'] == "1") {
                        $result1 = $this->app_model_bar->cambiar_mesa_pedido_transaccion($idPedido, $idMesaNueva, $idMesa);

                        if ($result1) {
                            $msg = "Ok";
                            $dato = array("valid" => true, "msg" => $msg);
                        } else {
                            $msg = "No se pudo realizar el cambio de mesa";
                            $dato = array("valid" => false, "msg" => $msg);
                        }
                    } else {
                        $msg = "La mesa se encuentra ocupada";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "Error al obtener datos de la mesa";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Hay datos faltantes";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_mozos() {
        $mozos = $this->app_model_bar->get_mozos();

        if (!empty($mozos)) {

            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "datos" => $mozos);
        } else {
            $msg = "No se encontraron mozos registrados";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function cambiar_mozo() {
        $idMozoNuevo = $this->input->post('idMozoNuevo', true);
        $idGenPedido = $this->input->post('idGenPedido', true);

        if ($_POST) {
            if (!empty($idMozoNuevo) && !empty($idGenPedido)) {
                $result = $this->app_model_bar->cambiar_mozo_by_idGenPedido($idGenPedido, $idMozoNuevo);
                if ($result) {
                    $msg = "Cambio efectuado";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al cambiar de mozo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Hay datos vacios.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
