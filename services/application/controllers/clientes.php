<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clientes extends MY_Controller {

    protected $data = array(
        'active' => 'clientes'
    );

    public function __construct() {
        parent::__construct();
        parent::datosFormCliente();
    }

    public function listar_clientes() {

        $this->load_view('clientes/listar_clientes', $this->data);
    }

    public function listar_clientes_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $clientes = $this->app_model->get_clientes();

        if ($clientes) {
            foreach ($clientes as $key => $value) {

                if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29) {
                    $opcion = '<a href="#modal-delete" class="tip delete_cliente" role="button" data-id="' . $value['idCliente'] . '" data-idGen="' . $value['idGenCliente'] . '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' .
                            '&nbsp;' .
                            '<a href="#" class="tip edit_cliente" data-id="' . $value['idGenCliente'] . '" data-original-title="Editar"><i class="icon-pencil3"></i></a>';
                } else {
                    $opcion = '<a href="#" class="tip edit_cliente" data-id="' . $value['idGenCliente'] . '" data-original-title="Editar"><i class="icon-pencil3"></i></a>';
                }

                $dato[] = array(
                    $value['idCliente'],
                    $value['nombEmpresa'],
                    $value['nombre'],
                    $value['apellido'],
                    $value['email'],
                    $value['tel'],
                    $value['cel'],
                    $value['localidad'],
                    $value['provincia'],
                    $opcion,
                    "DT_RowId" => $value['idGenCliente']
                );
            }
        }

        $aa = array(
            'sEcho' => 1,
            'iTotalRecords' => count($dato),
            'iTotalDisplayRecords' => 10,
            'aaData' => $dato
        );
        echo json_encode($aa);
    }

    public function get_info_cliente() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idGenCliente = $this->input->post('id', true);
        $msg = "";

        if (!empty($idGenCliente)) {
            $cliente = $this->app_model->get_info_cliente_byIdGen($idGenCliente);
            if ($cliente) {
                $msg = "Los datos fueron obtenidos con exito";
                $dato = array("valid" => true, "msg" => $msg, "cliente" => $cliente);
            } else {
                $msg = "Error al obtener datos del cliente, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
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
            $selectProvincia = $this->input->post('selectProvincia_formCliente', true);
            $selectLocalidad = $this->input->post('selectLocalidad_formCliente', true);
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

            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];

            $idGenCliente = $this->generarID();

            if (
                    ! empty($idGenCliente) AND
                    ! empty($inputCliente) AND
                    ! empty($inputApellido) AND
                    ! empty($inputNombre) AND
                    ! isset($selectProvincia) AND
                    ! isset($selectLocalidad)
            ) {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg, "inputCliente" => $inputCliente, "inputApellido" => $inputApellido, "inputNombre" => $inputNombre, "selectProvincia" => $selectProvincia, "selectLocalidad" => $selectLocalidad);
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
                        $idUsuario, $idGenCliente, $tipoAccion = 1, $tipoOperacion = 3, "Se agregó el cliente " . $inputRazonSocial, //detalle
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

    public function update_cliente() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $idGenCliente = $this->input->post('inputIdGenCliente_formCliente', true);
            $inputCliente = $this->input->post('inputCliente', true);
            $inputApodoML = $this->input->post('inputApodoML', true);
            $inputApellido = $this->input->post('inputApellido', true);
            $inputNombre = $this->input->post('inputNombre', true);
            $inputNumTel = $this->input->post('inputNumTel', true);
            $inputNumCel = $this->input->post('inputNumCel', true);
            $inputCorreo = $this->input->post('inputCorreo', true);
            $inputWeb = $this->input->post('inputWeb', true);
            $selectProvincia = $this->input->post('selectProvincia_formCliente', true);
            $selectLocalidad = $this->input->post('selectLocalidad_formCliente', true);
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

            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];

            if (
                    !isset($idGenCliente) AND
                    !isset($inputCliente) AND
                    !isset($inputApellido) AND
                    !isset($inputNombre) AND
                    !isset($selectProvincia) AND
                    !isset($selectLocalidad)
            ) {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg, "inputCliente" => $inputCliente, "inputApellido" => $inputApellido, "inputNombre" => $inputNombre, "selectProvincia" => $selectProvincia, "selectLocalidad" => $selectLocalidad);
            } else {
                //--- Actualizo - Cliente ---//
                $result_update_cliente = $this->app_model->update_cliente(
                        $idGenCliente, $idUsuario, $inputCliente, $inputNombre, $inputApellido, $inputNumTel, $inputNumCel, $inputCorreo, $inputWeb, $inputDomicilio, $inputApodoML, $selectLocalidad, $selectProvincia, $inputNumDir, $inputPiso, $inputDpto, $inputCodPostal, $inputNota
                );

                //--- Actualizo - Detalle Venta ---//
                $result_update_cliente_detalle_venta = $this->app_model->update_cliente_detalle_venta(
                        $idGenCliente, $idUsuario, $selectCatVentas, $inputDtoGeneral, $inputNotaCliente
                );

                //--- Actualizo - Detalle Facturacion ---//
                $result_update_cliente_detalle_facturacion = $this->app_model->update_cliente_detalle_facturacion(
                        $idGenCliente, $idUsuario, $inputRazonSocial, $selectTipoDoc, $inputNumDoc, $selectCondIva, $selectCompTipo, $inputNumTelFac, $inputNumCelFac, $inputDomicilioFiscal, $selectLocalidadFac, $selectProvinciaFac, $inputCodPostalFac
                );

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenCliente, $tipoAccion = 2, $tipoOperacion = 3, "Se agregó el cliente " . $inputRazonSocial, //detalle
                        $total = 0
                );

                if (
                        $result_update_cliente ||
                        $result_update_cliente_detalle_venta ||
                        $result_update_cliente_detalle_facturacion &&
                        $result_insert_historico
                ) {
                    
                    $cliente = $this->app_model->get_cliente_byIdGen($idGenCliente);
                    
                    if ($cliente) {
                        $msg = "Registro actualizado";
                        $dato = array("valid" => true, "msg" => $msg, "cliente" => $cliente, "idGenCliente" => $idGenCliente);
                    }
                } else {
                    $msg = "Error al actualizar registro";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_cliente() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        $idCliente = $this->input->post('id', true);
        $idGenCliente = $this->input->post('idGen', true);
        $msg = "";
        $debito = 0;
        $credito = 0;

        if ($_POST) {
            if (!empty($idCliente) && !empty($idGenCliente)) {
                $cliente = $this->app_model->get_cliente_byIdGen($idGenCliente);
                //--- obtenemos el estado de la cuenta corriente del cliente
                $cuenta_corriente = $this->app_model->get_cuenta_corriente_by_idCliente($idCliente);
                if ($cuenta_corriente) {
                    foreach ($cuenta_corriente as $key => $value) {
                        $debito += $value["debito"];
                        $credito += $value["credito"];
                    }
                }
                //--- obtenemos el saldo del cliente al dia de la fecha ---//
                $saldo = $credito - $debito;
                if ($saldo >= 0) {
                    //--- Guardo - Historico ---//
                    $result_insert_historico = $this->app_model->set_historico(
                            $idUsuario, $idGenCliente, $tipoAccion = 3, $tipoOperacion = 3, $detalle = 'Se eliminó el cliente ' . $cliente[0]['nombEmpresa'], //detalle
                            $total = 0
                    );

                    //--- Borro Cliente ---//            
                    $result_eliminar_cliente = $this->app_model->eliminar_cliente($idGenCliente);
                    $result_eliminar_cliente_detalle_venta = $this->app_model->eliminar_cliente_detalle_venta($idGenCliente);
                    $result_eliminar_cliente_detalle_facturacion = $this->app_model->eliminar_cliente_detalle_facturacion($idGenCliente);

                    if (
                            $result_eliminar_cliente &&
                            $result_eliminar_cliente_detalle_venta &&
                            $result_eliminar_cliente_detalle_facturacion &&
                            $result_insert_historico
                    ) {
                        $msg = "Cliente eliminado exitosamente";
                        $dato = array("valid" => true, "msg" => $msg, "id" => $idCliente, "idGen" => $idGenCliente);
                    } else {
                        $msg = "No se pudo eliminar el cliente seleccionado, vuelva a intentarlo";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "Dicho cliente se encuentra con deudas, una vez saldada su deuda podra borrarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "No se obtuvo los datos minimos para realizar la operacion, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
