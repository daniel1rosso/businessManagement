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

class Api_Clientes extends MY_Controller {

    protected $data = array(
        'active' => 'clientes'
    );

    public function __construct() {
        parent::__construct();
        parent::datosFormCliente();
    }

    public function get_clientes() {
        $clientes = $this->app_model->get_clientes();

        if (!empty($clientes)) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "datos" => $clientes);
        } else {
            $msg = "No se encontraron clientes registrados";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function set_cliente() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $inputCliente = $this->input->post('inputCliente', true);
            $inputApodoML = $this->input->post('inputApodoML', true);
            $inputApellido = $this->input->post('inputApellido', true);
            $inputNombre = $this->input->post('inputNombre', true);
            $inputNumTel = $this->input->post('inputNumTel', true);
            $inputNumCel = $this->input->post('inputNumCel', true);
            $inputCorreo = $this->input->post('inputCorreo', true);
            $inputWeb = $this->input->post('inputWeb', true);
            $selectProvincia = $this->input->post('selectProvincia', true);
            $selectLocalidad = $this->input->post('selectLocalidad', true);
            $inputCodPostal = $this->input->post('inputCodPostal', true);
            $inputDomicilio = $this->input->post('inputDomicilio', true);
            $inputNumDir = $this->input->post('inputNumDir', true);
            $inputPiso = $this->input->post('inputPiso', true);
            $inputDpto = $this->input->post('inputDpto', true);
            $inputNota = $this->input->post('inputNota', true);
            $selectCatVentas = $this->input->post('selectCatVentas', true);
            $inputDtoGeneral = $this->input->post('inputDtoGeneral', true);
            $inputNotaCliente = $this->input->post('inputNotaCliente', true);
            $inputRazonSocial = $this->input->post('inputRazonSocial', true);
            $inputNumTelFac = $this->input->post('inputNumTelFac', true);
            $inputNumCelFac = $this->input->post('inputNumCelFac', true);
            $selectTipoDoc = $this->input->post('selectTipoDoc', true);
            $inputNumDoc = $this->input->post('inputNumDoc', true);
            $inputDomicilioFiscal = $this->input->post('inputDomicilioFiscal', true);
            $selectCondIva = $this->input->post('selectCondIva', true);
            $selectCompTipo = $this->input->post('selectCompTipo', true);
            $selectProvinciaFac = $this->input->post('selectProvinciaFac', true);
            $selectLocalidadFac = $this->input->post('selectLocalidadFac', true);
            $inputCodPostalFac = $this->input->post('inputCodPostalFac', true);
            $idUsuario = $this->input->post('idUsuario', true);


            $idGenCliente = $this->generarID();

            if (
//                empty($inputCliente) OR            
//                empty($inputApodoML) OR            
                    empty($inputApellido) OR
                    empty($inputNombre) OR
//                empty($inputNumTel) OR            
//                empty($inputNumCel) OR            
//                empty($inputCorreo) OR            
//                empty($inputWeb) OR            
                    empty($selectProvincia) OR
                    empty($selectLocalidad) OR
                    empty($inputCodPostal) OR
                    empty($inputDomicilio) OR
                    empty($inputNumDir) OR
//                empty($inputPiso) OR            
//                empty($inputDpto) OR            
//                empty($inputNota) OR            
//                empty($selectCatVentas) OR            
//                empty($inputDtoGeneral) OR            
//                empty($inputNotaCliente) OR            
//                empty($inputRazonSocial) OR            
//                empty($inputNumTelFac) OR            
//                empty($inputNumCelFac) OR            
                    empty($selectTipoDoc) OR
//                empty($inputNumDoc) OR            
//                empty($inputDomicilioFiscal) OR            
                    empty($selectCondIva)
//                empty($selectCompTipo) OR            
//                empty($selectProvinciaFac) OR            
//                empty($selectLocalidadFac) OR            
//                empty($inputCodPostalFac)            
            ) {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            } else {
                //--- Guardo - Cliente ---//
                $result_insert_cliente = $this->app_model->insert_cliente(
                        $idGenCliente, $idUsuario, $inputCliente, $inputNombre, $inputApellido, $inputNumTel, $inputNumCel, $inputCorreo, $inputWeb, $inputDomicilio, $inputApodoML, $selectLocalidad, $selectProvincia, $inputNumDir, $inputPiso, $inputDpto, $inputCodPostal, $inputNota
                );

                //--- Guardo - Detalle Venta ---//
                $result_insert_cliente_detalle_venta = $this->app_model->insert_cliente_detalle_venta(
                        $idGenCliente, $idUsuario, $selectCatVentas, $inputDtoGeneral, $inputNotaCliente
                );

                //--- Guardo - Detalle Facturacion ---//
                $result_insert_cliente_detalle_facturacion = $this->app_model->insert_cliente_detalle_facturacion(
                        $idGenCliente, $idUsuario, $inputRazonSocial, $selectTipoDoc, $inputNumDoc, $selectCondIva, $selectCompTipo, $inputNumTelFac, $inputNumCelFac, $inputDomicilioFiscal, $selectLocalidadFac, $selectProvinciaFac, $inputCodPostalFac
                );

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenCliente, $tipoAccion = 1, $tipoOperacion = 3, $inputRazonSocial, //detalle
                        $total = 0
                );

                if (
                        $result_insert_cliente &&
                        $result_insert_cliente_detalle_venta &&
                        $result_insert_cliente_detalle_facturacion &&
                        $result_insert_historico
                ) {
                    $cliente = $this->app_model->get_cliente_byIdGen($idGenCliente);
                    if ($cliente) {
                        $msg = "Registro agregado";
                        $dato = array("valid" => true, "msg" => $msg, "cliente" => $cliente);
                    }
                } else {
                    $msg = "Error al procesar registro";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_factura_tipos() {
        $facturasTipos = $this->app_model->get_factura_tipos();

        if (!empty($facturasTipos)) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "datos" => $facturasTipos);
        } else {
            $msg = "No se encontraron tipos de facturas registradas";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_documentos_tipos() {
        $documentosTipos = $this->app_model->get_documentos_tipos();

        if (!empty($documentosTipos)) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "datos" => $documentosTipos);
        } else {
            $msg = "No se encontraron tipos de facturas registradas";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_provincias_y_localidades() {
        $provincias = $this->app_model->get_provincias();
        $localidades = $this->app_model->get_localidades();

        if (!empty($provincias) && !empty($localidades)) {
            $datos = array("provincias" => $provincias, "localidades" => $localidades);
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "datos" => $datos);
        } else {
            $msg = "No se encontraron tipos de facturas registradas";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_iva_condiciones() {
        $ivaCondiciones = $this->app_model->get_iva_condiciones();

        if (!empty($ivaCondiciones)) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "datos" => $ivaCondiciones);
        } else {
            $msg = "No se encontraron tipos de facturas registradas";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
