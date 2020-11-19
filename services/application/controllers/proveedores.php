<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proveedores extends MY_Controller {

    protected $data = array(
        'active' => 'proveedores'
    );

    public function __construct() {
        parent::__construct();
        parent::datosFormProveedores();
    }

    public function listar_proveedores() {
        $this->data['mediosPagos'] = $this->app_model->get_medios_pagos();

        $this->data['categorias_compras'] = $this->app_model->get_categorias_compras();

        $this->load_view('proveedores/listar_proveedores', $this->data);
    }

    public function listar_proveedores_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $proveedores = $this->app_model->get_proveedores();

        if ($proveedores) {
            foreach ($proveedores as $key => $value) {

                $opcion = '<a href="#modal-delete" class="tip delete_proveedor" role="button" data-id="' . $value['idGenProveedor'] . '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' .
                        '&nbsp;' .
                        '<a href="#" class="tip edit_proveedor" data-id="' . $value['idGenProveedor'] . '" data-original-title="Editar"><i class="icon-pencil3"></i></a>';

                $dato[] = array(
                    $value['idProveedor'],
                    $value['nombre'],
                    $value['apellido'],
                    $value['email'],
                    $value['tel'],
                    $value['cel'],
                    $value['localidad'],
                    $value['provincia'],
                    $opcion,
                    "DT_RowId" => $value['idGenProveedor']
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

    public function get_info_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idGenProveedor = $this->input->post('id', true);
        $msg = "";

        if (!empty($idGenProveedor)) {
            $proveedor = $this->app_model->get_info_proveedor_byIdGen($idGenProveedor);
            if ($proveedor) {
                $msg = "Ok";
                $dato = array("valid" => true, "msg" => $msg, "proveedor" => $proveedor);
            } else {
                $msg = "Error al obtener datos del proveedor, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function set_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $inputProveedor = $this->input->post('inputProveedor', true);
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
            $selectCatCompras = $this->input->post('selectCatCompras_formProveedor', true);
            $inputDtoGeneral = $this->input->post('inputDtoGeneral', true);
            $inputNotaInterna = $this->input->post('inputNotaInterna', true);
            $inputRazonSocial = $this->input->post('inputRazonSocial', true);
            $inputNumTelFac = $this->input->post('inputNumTelFac', true);
            $inputNumCelFac = $this->input->post('inputNumCelFac', true);
            $selectTipoDoc = $this->input->post('selectTipoDoc', true);
            $inputNumDoc = $this->input->post('inputNumDoc', true);
            $inputDomicilioFiscal = $this->input->post('inputDomicilioFiscal', true);
            $selectCondIva = $this->input->post('selectCondIva', true);
            $selectCompTipo = $this->input->post('selectCompTipo', true);
            $selectProvinciaFac = $this->input->post('selectProvinciaFac', true);
            $selectLocalidadFac = $this->input->post('selectLocalidadFac_formProveedor', true);
            $inputCodPostalFac = $this->input->post('inputCodPostalFac', true);
            $selectMedioPago = $this->input->post('selectMedioPago_formProveedor', true);
            $inputCBU = $this->input->post('inputCBU_formProveedor', true);

            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];

            $idGenProveedor = $this->generarID();

            if (
                    !empty($inputProveedor) AND
                    !empty($inputApellido) AND
                    !empty($inputNombre) AND
                    !isset($selectProvincia) AND
                    !isset($selectLocalidad)
            ) {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            } else {
                //--- Guardo - Proveedor ---//
                $result_insert_proveedor = $this->app_model->insert_proveedor(
                        $idGenProveedor, $idUsuario, $inputProveedor, $inputNombre, $inputApellido, $inputNumTel, $inputNumCel, $inputCorreo, $inputWeb, $inputDomicilio, $selectLocalidad, $selectProvincia, $inputNumDir, $inputPiso, $inputDpto, $inputCodPostal, $inputNota
                );

                //--- Guardo - Detalle Venta ---//
                $result_insert_proveedor_detalle_compra = $this->app_model->insert_proveedor_detalle_compra(
                        $idGenProveedor, $idUsuario, $selectCatCompras, $inputDtoGeneral, $inputNotaInterna
                );

                //--- Guardo - Detalle Facturacion ---//
                $result_insert_proveedor_detalle_facturacion = $this->app_model->insert_proveedor_detalle_facturacion(
                        $idGenProveedor, $idUsuario, $inputRazonSocial, $selectTipoDoc, $inputNumDoc, $selectCondIva, $selectCompTipo, $inputNumTelFac, $inputNumCelFac, $inputDomicilioFiscal, $selectLocalidadFac, $selectProvinciaFac, $inputCodPostalFac, $selectMedioPago, $inputCBU
                );

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenProveedor, $tipoAccion = 1, $tipoOperacion = 4, "Se agregó el proveedor " . $inputRazonSocial, //detalle
                        $total = 0
                );


                if (
                        $result_insert_proveedor &&
                        $result_insert_proveedor_detalle_compra &&
                        $result_insert_proveedor_detalle_facturacion &&
                        $result_insert_historico
                ) {
                    $proveedor = $this->app_model->get_proveedor_byIdGen($idGenProveedor);
                    if ($proveedor) {
                        $msg = "Registro agregado";
                        $dato = array("valid" => true, "msg" => $msg, "proveedor" => $proveedor);
                    } else {
                        $msg = "Ocurrio un error en la insercion";
                        $dato = array("valid" => false, "msg" => $msg, "result_insert_proveedor" => $result_insert_proveedor
                            , "result_insert_proveedor_detalle_compra" => $result_insert_proveedor_detalle_compra,
                            "result_insert_proveedor_detalle_facturacion" => $result_insert_proveedor_detalle_facturacion, "result_insert_historico" => $result_insert_historico);
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

    public function update_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $idGenProveedor = $this->input->post('inputIdGenProveedor_formProveedor', true);
            $inputProveedor = $this->input->post('inputProveedor', true);
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
            $selectCatCompras = $this->input->post('selectCatCompras_formProveedor', true);
            $inputDtoGeneral = $this->input->post('inputDtoGeneral', true);
            $inputNotaInterna = $this->input->post('inputNotaInterna', true);
            $inputRazonSocial = $this->input->post('inputRazonSocial', true);
            $inputNumTelFac = $this->input->post('inputNumTelFac', true);
            $inputNumCelFac = $this->input->post('inputNumCelFac', true);
            $selectTipoDoc = $this->input->post('selectTipoDoc', true);
            $inputNumDoc = $this->input->post('inputNumDoc', true);
            $inputDomicilioFiscal = $this->input->post('inputDomicilioFiscal', true);
            $selectCondIva = $this->input->post('selectCondIva', true);
            $selectCompTipo = $this->input->post('selectCompTipo', true);
            $selectProvinciaFac = $this->input->post('selectProvinciaFac', true);
            $selectLocalidadFac = $this->input->post('selectLocalidadFac_formProveedor', true);
            $inputCodPostalFac = $this->input->post('inputCodPostalFac', true);
            $selectMedioPago = $this->input->post('selectMedioPago_formProveedor', true);
            $inputCBU = $this->input->post('inputCBU_formProveedor', true);
            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];

            if (
                    !empty($idGenProveedor) AND
                    !empty($inputProveedor) AND
                    !empty($inputApellido) AND
                    !empty($inputNombre) AND
                    !isset($selectProvincia) AND
                    !isset($selectLocalidad)
            ) {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            } else {
                //--- Actualizo - Proveedor ---//
                $result_update_proveedor = $this->app_model->update_proveedor(
                        $idGenProveedor, $idUsuario, $inputProveedor, $inputNombre, $inputApellido, $inputNumTel, $inputNumCel, $inputCorreo, $inputWeb, $inputDomicilio, $selectLocalidad, $selectProvincia, $inputNumDir, $inputPiso, $inputDpto, $inputCodPostal, $inputNota
                );

                //--- Actualizo - Detalle Venta ---//
                $result_update_proveedor_detalle_compra = $this->app_model->update_proveedor_detalle_compra(
                        $idGenProveedor, $idUsuario, $selectCatCompras, $inputDtoGeneral, $inputNotaInterna
                );

                //--- Actualizo - Detalle Facturacion ---//
                $result_update_proveedor_detalle_facturacion = $this->app_model->update_proveedor_detalle_facturacion(
                        $idGenProveedor, $idUsuario, $inputRazonSocial, $selectTipoDoc, $inputNumDoc, $selectCondIva, $selectCompTipo, $inputNumTelFac, $inputNumCelFac, $inputDomicilioFiscal, $selectLocalidadFac, $selectProvinciaFac, $inputCodPostalFac, $selectMedioPago, $inputCBU
                );

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenProveedor, $tipoAccion = 2, $tipoOperacion = 4, "Se modificó el proveedor " . $inputRazonSocial, //detalle
                        $total = 0
                );


                if (
                        $result_update_proveedor ||
                        $result_update_proveedor_detalle_compra ||
                        $result_update_proveedor_detalle_facturacion &&
                        $result_insert_historico
                ) {
                    $proveedor = $this->app_model->get_proveedor_byIdGen($idGenProveedor);
                    if ($proveedor) {
                        $msg = "Registro actualizado";
                        $dato = array("valid" => true, "msg" => $msg, "proveedor" => $proveedor);
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

    public function eliminar_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        if ($_POST) {
            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];

            $idGenProveedor = $this->input->post('id', true);
            $msg = "";
            if (!empty($idGenProveedor)) {
                $proveedor = $this->app_model->get_proveedor_byIdGen($idGenProveedor);
                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenProveedor, $tipoAccion = 3, $tipoOperacion = 4, $detalle = 'Se elimino el proveedor ' . $proveedor[0]['nombEmpresa'], //detalle
                        $total = 0
                );

                //--- Borro Proveedor ---//
                $result_eliminar_proveedor = $this->app_model->eliminar_proveedor($idGenProveedor);
                $result_eliminar_proveedor_detalle_compra = $this->app_model->eliminar_proveedor_detalle_compra($idGenProveedor);
                $result_eliminar_proveedor_detalle_facturacion = $this->app_model->eliminar_proveedor_detalle_facturacion($idGenProveedor);

                if (
                        $result_eliminar_proveedor &&
                        $result_eliminar_proveedor_detalle_compra &&
                        $result_eliminar_proveedor_detalle_facturacion &&
                        $result_insert_historico
                ) {
                    $msg = "Proveedor eliminado con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al eliminar el proveedor, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "No se obtuvieron los datos minimos para eliminar el proveedor, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
