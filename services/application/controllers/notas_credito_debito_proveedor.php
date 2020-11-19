<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notas_Credito_Debito_Proveedor extends MY_Controller {

    protected $data = array(
        'active' => 'egresos'
    );

    public function __construct() {
        parent::__construct();
    }

    public function listar_nota_credito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->load_view('notas_credito_debito_proveedor/listar_nota_credito_proveedor', $this->data);
    }

    public function listar_nota_credito_proveedor_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $notas_credito = $this->app_model->get_notas_credito_proveedor();

        if ($notas_credito) {
            foreach ($notas_credito as $key => $value) {

                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-success";
                    $texto = "Acreditado";
                endif;

                $opcion = ' <div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                        '<ul class="dropdown-menu icons-right">' .
                        '<li><a href="' . base_url() . 'notas_credito_debito_proveedor/modificar_nota_credito/' . $value['idNotaCredito'] . '"><i class="icon-cogs"></i> Editar</a></li>' .
                        '<li><a href="#modal-delete" class="tip deleteNotaCreditoProveedor" data-id="' . $value['idNotaCredito'] . '" data-toggle="modal" onclick="deleteNotaCreditoProveedor(' . $value['idNotaCredito'] . ')" ><i class="icon-close"></i> Eliminar</a></li>' .
                        '<li><a onclick="ver_nota_credito_proveedor(' . $value['idNotaCredito'] . ')"><i style="font-size: 1.5em;" class="fas fa-binoculars"></i> Ver Nota</a></li>' .
                        '</ul>' .
                        '</div>';

                $vendedor = $value['apellidoVend'] . ", " . $value['nombreVend'];

                $dato[] = array(
                    $value['idNotaCredito'],
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVencimiento'],
                    $value['nombEmpresa'],
                    $value['tipoNota'],
                    $value['subTotalSinDescuento'],
                    $value['subTotalConDescuento'],
                    $value['total'],
                    $vendedor,
                    "DT_RowId" => $value['idNotaCredito']
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

    public function listar_nota_debito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->load_view('notas_credito_debito_proveedor/listar_nota_debito_proveedor', $this->data);
    }

    public function listar_nota_debito_proveedor_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $notas_debito = $this->app_model->get_notas_debito_proveedor();

        if ($notas_debito) {
            foreach ($notas_debito as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 2) :
                    $class = "btn-success";
                    $texto = "Abonado";

                    $ver_nota_debito = "block";
                    $editar_nota_debito = "none";
                    $eliminar_no_debito = "none";
                    $abonar_nota_debito = "none";
                elseif ($value['idEstado'] == 1):
                    $class = "btn-danger";
                    $texto = "No Abonado";

                    $ver_nota_debito = "block";
                    $editar_nota_debito = "block";
                    $eliminar_no_debito = "block";
                    $abonar_nota_debito = "block";
                endif;

                $opcion = ' <div class="btn-group">' .
                        '<button id="btn' . $value['idNotaDebito'] . '" class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                        '<ul class="dropdown-menu icons-right">' .
                        '<li id="editarNotaDebitoProveedor' . $value['idNotaDebito'] . '" style="display:' . $editar_nota_debito . ';" ><a href="' . base_url() . 'notas_credito_debito_proveedor/modificar_nota_debito/' . $value['idNotaDebito'] . '"><i class="icon-cogs"></i> Editar</a></li>' .
                        '<li id="eliminarNotaDebitoProveedor' . $value['idNotaDebito'] . '" style="display:' . $eliminar_no_debito . ';" ><a href="#modal-delete" class="tip deleteNotaDebitoProveedor" data-id="' . $value['idNotaDebito'] . '" data-toggle="modal" onclick="deleteNotaDebitoProveedor(' . $value['idNotaDebito'] . ')" ><i class="icon-close"></i> Eliminar</a></li>' .
                        '<li id="abonarNotaDebitoProveedor' . $value['idNotaDebito'] . '" style="display:' . $abonar_nota_debito . ';" ><a class="tip abonarNotaDebitoProveedor" data-id="' . $value['idNotaDebito'] . '" data-toggle="modal"onclick="abonarProveedor(' . $value['idNotaDebito'] . ')" ><i style="font-size: 1.5em;" class="fas fa-file-invoice-dollar"></i> Abonado</a></li>' .
                        '<li id="verNotaDebitoProveedor' . $value['idNotaDebito'] . '" style="display:' . $ver_nota_debito . ';" ><a onclick="ver_nota_debito_proveedor(' . $value['idNotaDebito'] . ')"><i style="font-size: 1.5em;" class="fas fa-binoculars"></i> Ver Nota</a></li>' .
                        '</ul>' .
                        '</div>';

                $vendedor = $value['apellidoVend'] . ", " . $value['nombreVend'];

                $dato[] = array(
                    $value['idNotaDebito'],
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVencimiento'],
                    $value['nombEmpresa'],
                    $value['tipoNota'],
                    $value['subTotalSinDescuento'],
                    $value['subTotalConDescuento'],
                    $value['total'],
                    $vendedor,
                    "DT_RowId" => $value['idNotaDebito']
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

    public function listar_nota_debito_proveedor_table_by_idNotaDebito($idNotaDebito) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $notas_debito = $this->app_model->get_notas_debito_proveedor_by_idNotaDebito($idNotaDebito);
        $notas_debito_detalle = $this->app_model->get_detalle_notas_debito_proveedor_by_idGenNotaDebito($notas_debito[0]['idGenNotaDebito']);
        $iva_tipos = $this->app_model->get_iva_tipos();
        $iva_tipos_option = "";

        if ($notas_debito_detalle) {
            foreach ($notas_debito_detalle as $key => $value) {

                $idProducto = "'" . $value['idProducto'] . "'";

                $cantidad = '<input type="text" value="' . $value['cantidad'] . '" id="cantProd' . $value['idProducto'] . '" onkeyup="calculoDetalleNotaDebitoModificarProveedor(' . $idProducto . ')" class="form-control">' .
                        '<div id="errorStock' . $value['idProducto'] . '" class="btn-danger erroBoxs" style="display: none">' .
                        '</div>' . '<input type="hidden" value="' . $value['cantidad'] . '" id="altaProd' . $value['idProducto'] . '" readonly class="form-control">';

                $precio = '<div class="input-group">' .
                        '<span class="input-group-addon">$</span>' .
                        '<input type="text" value="' . $value['precio'] . '" id="precioProd' . $value['idProducto'] . '" disabled class="form-control">' .
                        '</div>';

                $descuento = '<div class="input-group">' .
                        '<span class="input-group-addon">%</span>' .
                        '<input type="text" value="' . $value['descuento'] . '" id="descProd' . $value['idProducto'] . '" onkeyup="calculoDetalleNotaDebitoModificarProveedor(' . $idProducto . ',' . ')" class="form-control">' .
                        '</div>';

                $subTotal = '<div class="input-group">' .
                        '<span class="input-group-addon">$</span>' .
                        '<input type="text" value="' . $value['subTotal'] . '" id="subTotalProd' . $value['idProducto'] . '" readonly class="form-control">' .
                        '</div>';

                if ($iva_tipos) {
                    for ($i = 0; $i < count($iva_tipos); $i++) {
                        $iva_tipos_option = $iva_tipos_option . '<option value="' . $iva_tipos[$i]['valorIva'] . '">' . $iva_tipos[$i]['descripcion'] . '</option>';
                    }
                }

                $iva = '<select id="selectIva' . $value['idProducto'] . '" class="select-full" onchange="calculoDetalleNotaDebitoModificarProveedor(' . $idProducto . ',' . ')" required>' .
                        '<option value="0">IVA</option>' .
                        $iva_tipos_option .
                        '</select>';

                $accion = '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaNotaDebitoModificarProveedor(' . $idProducto . ')"></i>';

                $dato[] = array(
                    $value['idProducto'],
                    $value['codigo'],
                    $value['nombre'],
                    $cantidad,
                    $precio,
                    $descuento,
                    $subTotal,
                    $iva,
                    $accion,
                    $value['idProducto'],
                    "DT_RowId" => $value['idProducto']
                );
            }
        }

        $aa = array(
            'sEcho' => 1,
            'iTotalRecords' => count($dato),
            'iTotalDisplayRecords' => 10,
            'notas_debito_detalle' => $notas_debito_detalle,
            'aaData' => $dato
        );

        echo json_encode($aa);
    }

    public function agregar_nota_debito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['proveedores'] = $this->app_model->get_proveedores();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['notas_tipos'] = $this->app_model->get_notas_tipos();

        $this->data['egresos'] = $this->app_model->get_egresos();

        $this->load_view('notas_credito_debito_proveedor/agregar_nota_debito_proveedor', $this->data);
    }

    public function set_nota_debito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $datosNotaDebito = $this->input->post('datosNotaDebitoProveedor', true);
            $datosDetalleNotaDebito = $this->input->post('datosDetalleNotaDebitoProveedor', true);

            $idGenNotaDebito = substr(md5(microtime()), 15, 17);

            if (
                    !empty($datosNotaDebito) AND ! empty($datosDetalleNotaDebito)
            ) {
                //--- verificamos que ningun idProducto sea 0 sino se mostrar un mensaje de error ---//
                $coincidentia_0 = array_search(0, array_column($datosDetalleNotaDebito, 'idProducto'));

                if ($coincidentia_0) {
                    $msg = "El producto " . $coincidentia_0 . " no ha sido cargado correctamente.";
                    $dato = array("valid" => false, "msg" => $msg);
                } else {
                    $userdata = $this->session->all_userdata();
                    $idVendedor = $userdata['idUsuario'];

                    //--- Fecha Emision ---//
                    if (empty($datosNotaDebito["inputFechaEmision"])) {
                        $fechaEmision = date("Y-m-d");
                    } else {
                        $fechaEmision = $datosNotaDebito["inputFechaEmision"];
                    }

                    //--- Fecha Vencimiento ---//
                    if (empty($datosNotaDebito["inputFechaVencimiento"])) {
                        $fechaVencimiento = date("Y-m-d");
                    } else {
                        $fechaVencimiento = $datosNotaDebito["inputFechaVencimiento"];
                    }

                    $idEstado = 1; //Estado de no abonado
                    //--- Obtencion de las configuraciones de la empresa ---//
                    $empresa = $this->app_model->get_empresas();

                    //--- condicion de si esta vacio o no para que por defecto sera 0 ---//
//                    ($idGenPresupuesto == "") ? $idGenPresupuesto == "0" : $idGenPresupuesto;
//                    
                    $subTotalSinDescuento = $datosNotaDebito["totalVenta"] + $datosNotaDebito["descuentoEfectuado"];

                    if($datosNotaDebito["selectTipoNota"] == 0){
                        $selectTipoNota = 2;
                    } else {
                        $selectTipoNota = $datosNotaDebito["selectTipoNota"];
                    }

                    //--- Guardo - Nota Debito ---//
                    $result_insert_nota_debito = $this->app_model->insert_nota_debito_proveedor(
                            $idGenNotaDebito, $idVendedor, $datosNotaDebito["selectProveedor"], //selectProveedor
                            $fechaEmision, //fechaEmision
                            $fechaVencimiento, // fecha Vencimiento
                            $selectTipoNota, // selectTipoNota
                            $datosNotaDebito["selectCompra"], //selectVenta
                            $datosNotaDebito["notaCliente"], //notaCliente
                            $datosNotaDebito["notaInterna"], //notaInterna
                            $datosNotaDebito["importeNoGravado"], //importeNoGravado
                            $subTotalSinDescuento, //SubTotalSinDescuento
                            $datosNotaDebito["totalVenta"], //SubTotalConDescuento
                            $datosNotaDebito["totalVenta"], //totalVenta
                            $datosNotaDebito["descuentoEfectuado"], //descuentoTotal
                            $idEstado
                    );

                    //--- Guardo - Detalistar_nota_debito_table_by_idNotaDebitoe Nota de Debito ---//
                    //foreach($datosVenta as $key => $value){
                    for ($i = 0; $i < count($datosDetalleNotaDebito); $i++) {
                        $result_insert_ingreso_detalle = $this->app_model->insert_nota_debito_proveedor_detalle(
                                $idGenNotaDebito, $datosDetalleNotaDebito[$i]['idProducto'], $datosDetalleNotaDebito[$i]['cantidad'], $datosDetalleNotaDebito[$i]['precio'], $datosDetalleNotaDebito[$i]['descuento'], $datosDetalleNotaDebito[$i]['subtotalProd'], $datosDetalleNotaDebito[$i]['iva'], $datosDetalleNotaDebito[$i]['ivaText']
                        );
                    }
                }

                //--- Actualizacion del saldo a la cuenta corriente del Proveedor ---//
                $fechaCuentaCorriente = date("Y-m-d H:i:s");
                $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente_proveedores_idGenNota(
                    $datosNotaDebito["selectCompra"], $idGenComprobante = 0, $idGenNotaDebito, $datosNotaDebito["selectProveedor"], //selectCliente
                    $fechaCuentaCorriente, //fechaCobro
                    $aPagar = $datosNotaDebito["totalVenta"], $pague = 0, $idMedioPago = 1, //Medio de cobro
                    $saldo = $datosNotaDebito["totalVenta"], //Saldo
                    $descripcionPago = "Nota de Débito"
                );

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idVendedor, $idGenNotaDebito, $tipoAccion = 1, $tipoOperacion = 20, $datosNotaDebito["selectProveedor"], //detalle
                        $datosNotaDebito["totalVenta"] //total
                );

                if ($result_insert_nota_debito && $result_cuenta_corriente) {
                    $msg = "Registro agregado";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al procesar registro";
                    $dato = array("valid" => false, "msg" => $msg, "datosNotaDebito" => $datosNotaDebito, 'datosDetalleNotaDebito' => $datosNotaDebito);
                }
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function agregar_nota_credito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['proveedores'] = $this->app_model->get_proveedores();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['notas_tipos'] = $this->app_model->get_notas_tipos();

        $this->data['egresos'] = $this->app_model->get_egresos();

        $this->load_view('notas_credito_debito_proveedor/agregar_nota_credito_proveedor', $this->data);
    }

    public function set_nota_credito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $datosNotaCredito = $this->input->post('datosNotaCreditoProveedor', true);
            $datosDetalleNotaCredito = $this->input->post('datosDetalleNotaCreditoProveedor', true);

            $idGenNotaCredito = substr(md5(microtime()), 15, 17);

            if (
                    !empty($datosNotaCredito) AND ! empty($datosDetalleNotaCredito)
            ) {
                //--- verificamos que ningun idProducto sea 0 sino se mostrar un mensaje de error ---//
                $coincidentia_0 = array_search(0, array_column($datosDetalleNotaCredito, 'idProducto'));

                if ($coincidentia_0) {
                    $msg = "El producto " . $coincidentia_0 . " no ha sido cargado correctamente.";
                    $dato = array("valid" => false, "msg" => $msg);
                } else {
                    $userdata = $this->session->all_userdata();
                    $idVendedor = $userdata['idUsuario'];

                    //--- Fecha Emision ---//
                    if (empty($datosNotaCredito["inputFechaEmision"])) {
                        $fechaEmision = date("Y-m-d");
                    } else {
                        $fechaEmision = $datosNotaCredito["inputFechaEmision"];
                    }

                    //--- Fecha Vencimiento ---//
                    if (empty($datosNotaCredito["inputFechaVencimiento"])) {
                        $fechaVencimiento = date("Y-m-d");
                    } else {
                        $fechaVencimiento = $datosNotaCredito["inputFechaVencimiento"];
                    }

                    $idEstado = 1; //Estado Acreditado
                    //--- Obtencion de las configuraciones de la empresa ---//
                    $empresa = $this->app_model->get_empresas();

                    //--- condicion de si esta vacio o no para que por defecto sera 0 ---//
//                    ($idGenPresupuesto == "") ? $idGenPresupuesto == "0" : $idGenPresupuesto;

                    $subTotalSinDescuento = $datosNotaCredito["totalVenta"] + $datosNotaCredito["descuentoEfectuado"];

                    if($datosNotaCredito["selectTipoNota"] == 0){
                        $selectTipoNota = 1;
                    } else {
                        $selectTipoNota = $datosNotaCredito["selectTipoNota"];
                    }

                    //--- Guardo - Nota Credito ---//
                    $result_insert_nota_credito = $this->app_model->insert_nota_credito_proveedor(
                            $idGenNotaCredito, $idVendedor, $datosNotaCredito["selectProveedor"], //selectProveedor
                            $fechaEmision, //fechaEmision
                            $fechaVencimiento, // fecha Vencimiento
                            $selectTipoNota, // selectTipoNota
                            $datosNotaCredito["selectCompra"], //selectCompra
                            $datosNotaCredito["notaCliente"], //notaCliente
                            $datosNotaCredito["notaInterna"], //notaInterna
                            $datosNotaCredito["importeNoGravado"], //importeNoGravado
                            $subTotalSinDescuento, //SubTotalSinDescuento
                            $datosNotaCredito["totalVenta"], //SubTotalConDescuento
                            $datosNotaCredito["totalVenta"], //totalVenta
                            $datosNotaCredito["descuentoEfectuado"], //descuentoTotal
                            $idEstado
                    );

                    //--- Guardo - Detalle Nota de Debito ---//
                    //foreach($datosVenta as $key => $value){
                    for ($i = 0; $i < count($datosDetalleNotaCredito); $i++) {
                        $result_insert_ingreso_detalle = $this->app_model->insert_nota_credito_proveedor_detalle(
                                $idGenNotaCredito, $datosDetalleNotaCredito[$i]['idProducto'], $datosDetalleNotaCredito[$i]['cantidad'], $datosDetalleNotaCredito[$i]['precio'], $datosDetalleNotaCredito[$i]['descuento'], $datosDetalleNotaCredito[$i]['subtotalProd'], $datosDetalleNotaCredito[$i]['iva'], $datosDetalleNotaCredito[$i]['ivaText']
                        );
                    }
                }

                //--- Agregado del saldo a la cuenta corriente del cliete ---//
                $fechaCuentaCorriente = date("Y-m-d H:i:s");
                $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente_proveedores_idGenNota(
                    $datosNotaCredito["selectCompra"], $idGenComprobante = 0, $idGenNotaCredito, $datosNotaCredito["selectProveedor"], //selectCliente
                    $fechaCuentaCorriente, //fechaCobro
                    $aPagar = $datosNotaCredito["totalVenta"], $pague = 0, $idMedioPago = 1, //Medio de cobro
                    $saldo = $datosNotaCredito["totalVenta"], //Saldo
                    $descripcionPago = "Nota de Crédito"
                );

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idVendedor, $idGenNotaCredito, $tipoAccion = 1, $tipoOperacion = 21, $datosNotaCredito["selectProveedor"], //detalle
                        $datosNotaCredito["totalVenta"] //total
                );

                if ($result_insert_nota_credito && $result_cuenta_corriente) {
                    $msg = "Registro agregado";
                    $dato = array("valid" => true, "msg" => $msg, "result_cuenta_corriente" => $result_cuenta_corriente);
                } else {
                    $msg = "Error al procesar registro";
                    $dato = array("valid" => false, "msg" => $msg, "datosNotaCredito" => $datosNotaCredito, 'datosDetalleNotaCredito' => $datosNotaCredito);
                }
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function listar_nota_credito_proveedor_table_by_idNotaCredito($idNotaCredito) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $notas_credito = $this->app_model->get_notas_credito_proveedor_by_idNotaCredito($idNotaCredito);
        $notas_credito_detalle = $this->app_model->get_detalle_notas_credito_proveedor_by_idGenNotaCredito($notas_credito[0]['idGenNotaCredito']);
        $iva_tipos = $this->app_model->get_iva_tipos();
        $iva_tipos_option = "";

        if ($notas_credito_detalle) {
            foreach ($notas_credito_detalle as $key => $value) {

                $idProducto = "'" . $value['idProducto'] . "'";

                $cantidad = '<input type="text" value="' . $value['cantidad'] . '" id="cantProd' . $value['idProducto'] . '" onkeyup="calculoDetalleNotaCreditoModificarProveedor(' . $idProducto . ')" class="form-control">' .
                        '<div id="errorStock' . $value['idProducto'] . '" class="btn-danger erroBoxs" style="display: none">' .
                        '</div>' . '<input type="hidden" value="' . $value['cantidad'] . '" id="altaProd' . $value['idProducto'] . '" readonly class="form-control">';

                $precio = '<div class="input-group">' .
                        '<span class="input-group-addon">$</span>' .
                        '<input type="text" value="' . $value['precio'] . '" id="precioProd' . $value['idProducto'] . '" disabled class="form-control">' .
                        '</div>';

                $descuento = '<div class="input-group">' .
                        '<span class="input-group-addon">%</span>' .
                        '<input type="text" value="' . $value['descuento'] . '" id="descProd' . $value['idProducto'] . '" onkeyup="calculoDetalleNotaCreditoModificarProveedor(' . $idProducto . ',' . ')" class="form-control">' .
                        '</div>';

                $subTotal = '<div class="input-group">' .
                        '<span class="input-group-addon">$</span>' .
                        '<input type="text" value="' . $value['subTotal'] . '" id="subTotalProd' . $value['idProducto'] . '" readonly class="form-control">' .
                        '</div>';

                if ($iva_tipos) {
                    for ($i = 0; $i < count($iva_tipos); $i++) {
                        $iva_tipos_option = $iva_tipos_option . '<option value="' . $iva_tipos[$i]['valorIva'] . '">' . $iva_tipos[$i]['descripcion'] . '</option>';
                    }
                }

                $iva = '<select id="selectIva' . $value['idProducto'] . '" class="select-full" onchange="calculoDetalleNotaCreditoModificarProveedor(' . $idProducto . ',' . ')" required>' .
                        '<option value="0">IVA</option>' .
                        $iva_tipos_option .
                        '</select>';

                $accion = '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaNotaCreditoModificarProveedor(' . $idProducto . ')"></i>';

                $dato[] = array(
                    $value['idProducto'],
                    $value['codigo'],
                    $value['nombre'],
                    $cantidad,
                    $precio,
                    $descuento,
                    $subTotal,
                    $iva,
                    $accion,
                    $value['idProducto'],
                    "DT_RowId" => $value['idProducto']
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

    public function modificar_nota_debito($idNotaDebito = null) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $nota_debito = $this->app_model->get_notas_debito_proveedor_by_idNotaDebito($idNotaDebito);
        $this->data['nota_debito'] = $nota_debito;

        $this->data['detalle_nota_debito'] = $this->app_model->get_detalle_notas_debito_by_idGenNotaDebito($nota_debito[0]['idGenNotaDebito']);

        $this->data['proveedores'] = $this->app_model->get_proveedores();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['notas_tipos'] = $this->app_model->get_notas_tipos();

        $this->data['egresos'] = $this->app_model->get_egresos();

        $this->load_view('notas_credito_debito_proveedor/modificar_nota_debito_proveedor', $this->data);
    }

    public function update_nota_debito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {

            $datosNotaDebito = $this->input->post('datosNotaDebitoProveedor', true);
            $datosDetalleNotaDebito = $this->input->post('datosDetalleNotaDebitoProveedor', true);
            $idNotaDebito = $this->input->post('idNotaDebito', true);

            $nota_debito_anterior = $this->app_model->get_notas_debito_proveedor_by_idNotaDebito($idNotaDebito);
            $idGenNotaDebito = $nota_debito_anterior[0]['idGenNotaDebito'];
            $nota_debito_detalle_anterior = $this->app_model->get_detalle_notas_debito_proveedor_by_idGenNotaDebito($idGenNotaDebito);

            $coincidentia_0 = false;
            foreach ($datosDetalleNotaDebito as $key => $value) {
                if ($datosDetalleNotaDebito[$key]['idProducto']) {
                    $coincidentia_0 = $key;
                    break;
                }
            }

            if ($coincidentia_0) {
                $msg = "El producto " . $coincidentia_0 . " no ha sido cargado correctamente. Intentelo de nuevo.";
                $dato = array("valid" => false, "msg" => $msg);
            } else {
                if (
                        !empty($datosNotaDebito) AND ! empty($datosDetalleNotaDebito)
                ) {
                    $userdata = $this->session->all_userdata();
                    $idVendedor = $userdata['idUsuario'];

                    //--- Fecha Emision ---//
                    if (empty($datosNotaDebito["inputFechaEmision"])) {
                        $fechaEmision = date("Y-m-d");
                    } else {
                        $fechaEmision = $datosNotaDebito["inputFechaEmision"];
                    }

                    //--- Fecha Vencimiento ---//
                    if (empty($datosNotaDebito["inputFechaVencimiento"])) {
                        $fechaVencimiento = date("Y-m-d");
                    } else {
                        $fechaVencimiento = $datosNotaDebito["inputFechaVencimiento"];
                    }

                    $idEstado = $nota_debito_anterior[0]['idEstado']; //Estado de no abonado

                    $subTotalSinDescuento = $datosNotaDebito["totalVenta"] + $datosNotaDebito["descuentoEfectuado"];

                    //--- Guardo - Nota Debito ---//
                    $result_insert_nota_debito = $this->app_model->update_nota_debito_proveedor(
                            $idGenNotaDebito, $idVendedor, $datosNotaDebito["selectProveedor"], //selectCliente
                            $fechaEmision, //fechaEmision
                            $fechaVencimiento, // fecha Vencimiento
                            $datosNotaDebito["selectTipoNota"], // selectTipoNota
                            $datosNotaDebito["selectCompra"], //selectCompra
                            $datosNotaDebito["notaCliente"], //notaCliente
                            $datosNotaDebito["notaInterna"], //notaInterna
                            $datosNotaDebito["importeNoGravado"], //importeNoGravado
                            $subTotalSinDescuento, //SubTotalSinDescuento
                            $datosNotaDebito["totalVenta"], //SubTotalConDescuento
                            $datosNotaDebito["totalVenta"], //totalVenta
                            $datosNotaDebito["descuentoEfectuado"], //descuentoTotal
                            $idEstado
                    );

                    //--- Validamos que este llegando algun valor de la tabla anterior para saber si se debe agregar un nuevo registro o no ---//
                    if (empty($datosDetalleNotaDebito)) {

                        //--- Insertamos registros cuando la tabla esta vacia ---//
                        foreach ($datosDetalleNotaDebito as $keys => $values) {
                            $result_insert_nota_debito_detalle = $this->app_model->insert_nota_debito_proveedor_detalle(
                                    $idGenNotaDebito, $datosDetalleNotaDebito[$keys]['idProducto'], $datosDetalleNotaDebito[$keys]['cantidad'], $datosDetalleNotaDebito[$keys]['precio'], $datosDetalleNotaDebito[$keys]['descuento'], $datosDetalleNotaDebito[$keys]['subtotalProd'], $datosDetalleNotaDebito[$keys]['iva'], $datosDetalleNotaDebito[$keys]['ivaText']
                            );
                        }
                    } else {

                        $valorComparar = [];
                        foreach ($datosDetalleNotaDebito as $key => $value) {
                            array_push($valorComparar, $value['idProducto']);
                        }

                        foreach ($nota_debito_detalle_anterior as $key => $value) {
                            if (!in_array($nota_debito_detalle_anterior[$key]['idProducto'], $valorComparar)) {
                                //--- Borrar ---//
                                $delete_ingreso = $this->app_model->drop_nota_debito_proveedor_detalle($idGenNotaDebito, $nota_debito_detalle_anterior[$key]['idProducto']);
                            }
                        }

                        $valorComparar = [];
                        foreach ($nota_debito_detalle_anterior as $key => $value) {
                            array_push($valorComparar, $value['idProducto']);
                        }

                        foreach ($datosDetalleNotaDebito as $key => $value) {
                            if (!in_array($datosDetalleNotaDebito[$key]['idProducto'], $valorComparar)) {
                                //--- INSERT ---//
                                $result_insert_nota_debito_detalle = $this->app_model->insert_nota_debito_proveedor_detalle(
                                        $idGenNotaDebito, $datosDetalleNotaDebito[$key]['idProducto'], $datosDetalleNotaDebito[$key]['cantidad'], $datosDetalleNotaDebito[$key]['precio'], $datosDetalleNotaDebito[$key]['descuento'], $datosDetalleNotaDebito[$key]['subtotalProd'], $datosDetalleNotaDebito[$key]['iva'], $datosDetalleNotaDebito[$key]['ivaText']
                                );
                            } else {
                                //--- Update ---//
                                $this->app_model->update_nota_debito_proveedor_detalle($idGenNotaDebito, $datosDetalleNotaDebito[$key]['idProducto'], $datosDetalleNotaDebito[$key]['cantidad'], $datosDetalleNotaDebito[$key]['precio'], $datosDetalleNotaDebito[$key]['descuento'], $datosDetalleNotaDebito[$key]['subtotalProd'], $datosDetalleNotaDebito[$key]['iva'], $datosDetalleNotaDebito[$key]['ivaText']);
                            }
                        }
                    }

                    //--- Actualizamos la cuenta corriente ---//
                    $this->app_model->update_cuenta_corrientes_proveedores_by_idGenNota_ordenAsc_limit1($idGenNotaDebito, $datosNotaDebito["selectProveedor"], $datosNotaDebito["totalVenta"], 0, $datosNotaDebito["totalVenta"]);

                    //--- Guardo - Historico ---//
                    $resultHistorico = $this->app_model->set_historico(
                            $idVendedor, $idGenNotaDebito, $tipoAccion = 2, $tipoOperacion = 20, $datosNotaDebito["selectProveedor"], //detalle
                            $datosNotaDebito["totalVenta"] //total
                    );
                }
                if ($resultHistorico) {
                    $msg = "Actualización fue realizada con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function delete_nota_debito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idNotaDebito = $this->input->post('idNotaDebito', true);
        $nota_debito = $this->app_model->get_notas_debito_proveedor_by_idNotaDebito($idNotaDebito);
        $idGenNotaDebito = $nota_debito[0]['idGenNotaDebito'];
        $nota_debito_detalle = $this->app_model->get_detalle_notas_debito_proveedor_by_idGenNotaDebito($idGenNotaDebito);

        //--- Guardo ---//
        if ($_POST) {
            $userdata = $this->session->all_userdata();
            $idVendedor = $userdata['idUsuario'];

            //--- Borramos la nota de debito ---//
            $this->app_model->drop_nota_debito_proveedor($idGenNotaDebito);

            //--- Borramos el detale de la nota de debito ---//
            foreach ($nota_debito_detalle as $key => $value) {
                $this->app_model->drop_nota_debito_proveedor_detalle($idGenNotaDebito, $value['idProducto']);
            }

            //--- Actualizamos la cuenta corriente ---//
            $this->app_model->drop_cuenta_corrientes_proveedor_by_idGenNota($idGenNotaDebito);

            //--- Guardo - Historico ---//
            $resultHistorico = $this->app_model->set_historico(
                    $idVendedor, $idGenNotaDebito, $tipoAccion = 3, $tipoOperacion = 20, $nota_debito[0]['idProveedor'], //detalle
                    $nota_debito[0]['total'] //total
            );


            if ($resultHistorico) {
                $msg = "Borrado Exitoso";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Algo no se borro corectamente, vuelva a intentarlo.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function abonar_nota_debito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        if ($_POST) {

            $idNotaDebito = $this->input->post('idNotaDebito', true);

            $abonado = $this->app_model->abonar_nota_debito_proveedor($idNotaDebito);

            if ($abonado) {
                $msg = "Cambio de estado exitoso";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Algo no se borro corectamente, vuelva a intentarlo.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function modificar_nota_credito($idNotaCredito = null) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $nota_credito = $this->app_model->get_notas_credito_proveedor_by_idNotaCredito($idNotaCredito);
        $this->data['nota_credito'] = $nota_credito;

        $this->data['detalle_nota_credito'] = $this->app_model->get_detalle_notas_credito_by_idGenNotaCredito($nota_credito[0]['idGenNotaCredito']);

        $this->data['proveedores'] = $this->app_model->get_proveedores();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['notas_tipos'] = $this->app_model->get_notas_tipos();

        $this->data['egresos'] = $this->app_model->get_egresos();

        $this->load_view('notas_credito_debito_proveedor/modificar_nota_credito_proveedor', $this->data);
    }

    public function update_nota_credito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {

            $datosNotaCredito = $this->input->post('datosNotaCreditoProveedor', true);
            $datosDetalleNotaCredito = $this->input->post('datosDetalleNotaCreditoProveedor', true);
            $idNotaCredito = $this->input->post('idNotaCredito', true);

            $nota_credito_anterior = $this->app_model->get_notas_credito_proveedor_by_idNotaCredito($idNotaCredito);
            $idGenNotaCredito = $nota_credito_anterior[0]['idGenNotaCredito'];
            $nota_credito_detalle_anterior = $this->app_model->get_detalle_notas_credito_proveedor_by_idGenNotaCredito($idGenNotaCredito);

            $coincidentia_0 = false;
            foreach ($datosDetalleNotaCredito as $key => $value) {
                if ($datosDetalleNotaCredito[$key]['idProducto']) {
                    $coincidentia_0 = $key;
                    break;
                }
            }

            if ($coincidentia_0) {
                $msg = "El producto " . $coincidentia_0 . " no ha sido cargado correctamente. Intentelo de nuevo.";
                $dato = array("valid" => false, "msg" => $msg);
            } else {
                if (
                        !empty($datosNotaCredito) AND ! empty($datosDetalleNotaCredito)
                ) {
                    $userdata = $this->session->all_userdata();
                    $idVendedor = $userdata['idUsuario'];

                    //--- Fecha Emision ---//
                    if (empty($datosNotaCredito["inputFechaEmision"])) {
                        $fechaEmision = date("Y-m-d");
                    } else {
                        $fechaEmision = $datosNotaCredito["inputFechaEmision"];
                    }

                    //--- Fecha Vencimiento ---//
                    if (empty($datosNotaCredito["inputFechaVencimiento"])) {
                        $fechaVencimiento = date("Y-m-d");
                    } else {
                        $fechaVencimiento = $datosNotaCredito["inputFechaVencimiento"];
                    }

                    $idEstado = $nota_credito_anterior[0]['idEstado']; //Estado de no abonado

                    $subTotalSinDescuento = $datosNotaCredito["totalVenta"] + $datosNotaCredito["descuentoEfectuado"];

                    //--- Guardo - Nota Credito ---//
                    $result_insert_nota_credito = $this->app_model->update_nota_credito_proveedor(
                            $idGenNotaCredito, $idVendedor, $datosNotaCredito["selectProveedor"], //selectCliente
                            $fechaEmision, //fechaEmision
                            $fechaVencimiento, // fecha Vencimiento
                            $datosNotaCredito["selectTipoNota"], // selectTipoNota
                            $datosNotaCredito["selectCompra"], //selectVenta
                            $datosNotaCredito["notaCliente"], //notaCliente
                            $datosNotaCredito["notaInterna"], //notaInterna
                            $datosNotaCredito["importeNoGravado"], //importeNoGravado
                            $subTotalSinDescuento, //SubTotalSinDescuento
                            $datosNotaCredito["totalVenta"], //SubTotalConDescuento
                            $datosNotaCredito["totalVenta"], //totalVenta
                            $datosNotaCredito["descuentoEfectuado"], //descuentoTotal
                            $idEstado
                    );

                    //--- Validamos que este llegando algun valor de la tabla anterior para saber si se debe agregar un nuevo registro o no ---//
                    if (empty($datosDetalleNotaCredito)) {

                        //--- Insertamos registros cuando la tabla esta vacia ---//
                        foreach ($datosDetalleNotaCredito as $keys => $values) {
                            $result_insert_nota_credito_detalle = $this->app_model->insert_nota_credito_proveedor_detalle(
                                    $idGenNotaCredito, $datosDetalleNotaCredito[$keys]['idProducto'], $datosDetalleNotaCredito[$keys]['cantidad'], $datosDetalleNotaCredito[$keys]['precio'], $datosDetalleNotaCredito[$keys]['descuento'], $datosDetalleNotaCredito[$keys]['subtotalProd'], $datosDetalleNotaCredito[$keys]['iva'], $datosDetalleNotaCredito[$keys]['ivaText']
                            );
                        }
                    } else {

                        $valorComparar = [];
                        foreach ($datosDetalleNotaCredito as $key => $value) {
                            array_push($valorComparar, $value['idProducto']);
                        }

                        foreach ($nota_credito_detalle_anterior as $key => $value) {
                            if (!in_array($nota_credito_detalle_anterior[$key]['idProducto'], $valorComparar)) {
                                //--- Borrar ---//
                                $delete_ingreso = $this->app_model->drop_nota_credito_proveedor_detalle($idGenNotaCredito, $nota_credito_detalle_anterior[$key]['idProducto']);
                            }
                        }

                        $valorComparar = [];
                        foreach ($nota_credito_detalle_anterior as $key => $value) {
                            array_push($valorComparar, $value['idProducto']);
                        }

                        foreach ($datosDetalleNotaCredito as $key => $value) {
                            if (!in_array($datosDetalleNotaCredito[$key]['idProducto'], $valorComparar)) {
                                //--- INSERT ---//
                                $result_insert_nota_credito_detalle = $this->app_model->insert_nota_credito_proveedor_detalle(
                                        $idGenNotaCredito, $datosDetalleNotaCredito[$key]['idProducto'], $datosDetalleNotaCredito[$key]['cantidad'], $datosDetalleNotaCredito[$key]['precio'], $datosDetalleNotaCredito[$key]['descuento'], $datosDetalleNotaCredito[$key]['subtotalProd'], $datosDetalleNotaCredito[$key]['iva'], $datosDetalleNotaCredito[$key]['ivaText']
                                );
                            } else {
                                //--- Update ---//
                                $this->app_model->update_nota_credito_proveedor_detalle($idGenNotaCredito, $datosDetalleNotaCredito[$key]['idProducto'], $datosDetalleNotaCredito[$key]['cantidad'], $datosDetalleNotaCredito[$key]['precio'], $datosDetalleNotaCredito[$key]['descuento'], $datosDetalleNotaCredito[$key]['subtotalProd'], $datosDetalleNotaCredito[$key]['iva'], $datosDetalleNotaCredito[$key]['ivaText']);
                            }
                        }
                    }

                    //--- Actualizamos la cuenta corriente ---//
                    $this->app_model->update_cuenta_corrientes_proveedores_by_idGenNota_ordenAsc_limit1($idGenNotaCredito, $datosNotaCredito["selectProveedor"], $datosNotaCredito["totalVenta"], 0, $datosNotaCredito["totalVenta"]);

                    //--- Guardo - Historico ---//
                    $resultHistorico = $this->app_model->set_historico(
                            $idVendedor, $idGenNotaCredito, $tipoAccion = 2, $tipoOperacion = 21, $datosNotaCredito["selectProveedor"], //detalle
                            $datosNotaCredito["totalVenta"] //total
                    );
                }
                if ($resultHistorico) {
                    $msg = "Actualización fue realizada con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function delete_nota_credito_proveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idNotaCredito = $this->input->post('idNotaCredito', true);
        $nota_credito = $this->app_model->get_notas_credito_proveedor_by_idNotaCredito($idNotaCredito);
        $idGenNotaCredito = $nota_credito[0]['idGenNotaCredito'];
        $nota_credito_detalle = $this->app_model->get_detalle_notas_credito_proveedor_by_idGenNotaCredito($idGenNotaCredito);

        //--- Guardo ---//
        if ($_POST) {
            $userdata = $this->session->all_userdata();
            $idVendedor = $userdata['idUsuario'];

            //--- Borramos la nota de debito ---//
            $this->app_model->drop_nota_credito_proveedor($idGenNotaCredito);

            //--- Borramos el detale de la nota de debito ---//
            foreach ($nota_credito_detalle as $key => $value) {
                $this->app_model->drop_nota_credito_proveedor_detalle($idGenNotaCredito, $value['idProducto']);
            }

            //--- Actualizamos la cuenta corriente ---//
            $this->app_model->drop_cuenta_corrientes_proveedor_by_idGenNota($idGenNotaCredito);

            //--- Guardo - Historico ---//
            $resultHistorico = $this->app_model->set_historico(
                    $idVendedor, $idGenNotaCredito, $tipoAccion = 3, $tipoOperacion = 21, $nota_credito[0]['idProveedor'], //detalle
                    $nota_credito[0]['total'] //total
            );


            if ($resultHistorico) {
                $msg = "Borrado Exitoso";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Algo no se borro corectamente, vuelva a intentarlo.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function generar_pdf_nota_debito_proveedor() {

        $idNotaDebito = $this->input->post('idNota', true);

        //--- Datos ---//
        $nota_debito = $this->app_model->get_notas_debito_proveedor_by_idNotaDebito($idNotaDebito);
        $nota_debito_detalle = $this->app_model->get_detalle_notas_debito_proveedor_by_idGenNotaDebito($nota_debito[0]['idGenNotaDebito']);
        $egreso_nota_debito = $this->app_model->get_egresos_nota_debito($idNotaDebito);

        //-- CARGO LIBRERIAS --//
        $this->load->library('html2pdf');

        $this->html2pdf->folder('./uploads/notasdebito_proveedor/');
        $this->html2pdf->filename("notaDebito$idNotaDebito.pdf");
        $this->html2pdf->paper('a4', 'portrait');

        $cuerpo = "";
        foreach ($nota_debito_detalle as $key => $value) :
            $cuerpo .= '<tr id="' . $value['idProducto'] . '">
                            <td class="tg-swzm">' . $value['codigo'] . '</td>
                            <td class="tg-swzm">' . $value['nombre'] . '</td>
                            <td class="tg-swzm">' . intval($value['cantidad']) . '</td>
                            <td class="tg-swzm"> - </td>
                            <td class="tg-swzm"> $' . number_format(floatval($value['precio']), 2, ",", ".") . '</td>
                            <td class="tg-swzm">' . intval($value['descuento']) . '</td>
                            <td class="tg-swzm"> - </td>
                            <td class="tg-swzm"> $' . number_format(floatval($value['subTotal']), 2, ",", ".") . '</td>
                        </tr>';
        endforeach;

        $this->html2pdf->html('
                    <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;}
                        .tg td{font-family:Arial, sans-serif;font-size:7px;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                        .tg th{font-family:Arial, sans-serif;font-size:7px;font-weight:normal;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                        .tg .tg-704r{font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:left;vertical-align:middle;width: 50%;}
                        .tg .tg-nkla{background-color:#f9f9f9;border-color:inherit;font-family:Arial, Helvetica, sans-serif !important;;font-size:12px; text-align:left;vertical-align:top}
                        .tg .tg-swzm{font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f0f0f0;border-color:inherit;text-align:center;vertical-align:middle;height: auto;}
                        .tg .tg-zb0m{font-size:22px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:center;vertical-align:middle;width: 45%;}
                        .tg .tg-zb0z{font-size:15px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:center;vertical-align:middle}
                        .tg .tg-3usq{background-color:#f9f9f9;border-color:inherit;font-family:Arial, Helvetica, sans-serif !important;;font-size:12px; text-align:left;vertical-align:top}
                        .tg .tg-bjuv{font-size:15px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:center;vertical-align:middle}
                        .tg .tg-r0gd{font-size:12px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#cccccc;border-color:inherit;text-align:center;vertical-align:middle}
                        .tg  {border-collapse:collapse;border-spacing:0;}
                        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:7px;overflow:hidden;padding:10px 9px;word-break:normal;}
                        .tg th{border-color:black;border-style:solid;borde  r-width:1px;font-family:Arial, sans-serif;font-size:7px;font-weight:normal;overflow:hidden;padding:10px 9px;word-break:normal;}
                        .tg .tg-n21a{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:right;vertical-align:top;font-size:8px;}
                        .tg .tg-236u{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:center;vertical-align:middle}
                        .tg .tg-0lax{text-align:left;vertical-align:top;vertical-align:bottom;font-size:5px;}
                        .tg .tg-l2oz{font-weight:bold;text-align:right;vertical-align:top;font-size:5px;font-family:"Arial Black", Gadget, sans-serif !important;}
                    </style>
                    <div style="border: 0.5px solid black;margin: 0 auto;position: absolute;width: 100%;border: 0.5px solid black;">
                        <table class="tg" style="width: 100%;" >
                            <tr style="height: 10px;">
                                <th class="tg-bjuv" colspan="8"><span style="font-weight:bold;">ORIGINAL</span></th>
                            </tr>
                            <tr>
                                <td class="tg-zb0m" colspan="3"><span style="font-weight:bold">TELEPATHIC SOFT</span></td>
                                <td class="tg-zb0z" colspan="2"><span style="font-weight:bold;font-size:35px;">X </span><br> <span style="font-weight:bold;font-size:15px;">COD. ' . ($nota_debito[0]['idNotaDebito'] == "" ? "-" : $nota_debito[0]['idNotaDebito']) . '</span></td>
                                <td class="tg-zb0m" colspan="3"><span style="font-weight:bold">NOTA DÉBITO</span></td>
                            </tr>
                            <tr>
                                <td class="tg-704r" colspan="4">Razón Social:' . ($egreso_nota_debito[0]['razonSocial'] == "" ? "-" : $egreso_nota_debito[0]['razonSocial']) . '<br><br>Domicilio Comercial:' . ($egreso_nota_debito[0]['domicilioComercial'] == "" ? "-" : $egreso_nota_debito[0]['domicilioComercial']) . '<br><br>Condición frente al IVA:' . $egreso_nota_debito[0]['condicionIva'] . '</td>
                                <td class="tg-704r" colspan="4">Nro. Factura de referencia:' . ($egreso_nota_debito[0]['idIngreso'] == "" ? "-" : $egreso_nota_debito[0]['idIngreso']) . '<br>Punto de Venta: - Comp. Nro:' . ($nota_debito[0]['idNotaDebito'] == "" ? "-" : $nota_debito[0]['idNotaDebito']) . '<br>Fecha de Emisión:' . ($nota_debito[0]['fechaAlta'] == "" ? "-" : $nota_debito[0]['fechaAlta']) . '<br>CUIT:' . ($egreso_nota_debito[0]['cuit'] == "" ? "-" : $egreso_nota_debito[0]['cuit']) . '<br>Ingresos Brutos: - <br>Fecha de Inicio de Actividades: - </td>
                            </tr>
                            <tr>
                                <td class="tg-nkla" colspan="3">Periodo Facturado Desde: - </td>
                                <td class="tg-nkla" colspan="2"><span style="font-weight:400;font-style:normal">Hasta: - </span></td>
                                <td class="tg-3usq" colspan="3"><span style="font-weight:400;font-style:normal">Fecha de Vto. para el pago: - </span><br></td>
                            </tr>
                            <tr>
                                <td class="tg-704r" colspan="4">CUIT:' . ($egreso_nota_debito[0]['cuit'] == "" ? "-" : $egreso_nota_debito[0]['cuit']) . '<br>Condición frente al IVA:' . $egreso_nota_debito[0]['condicionIva'] . '<br>Condición de venta: Efectivo</td>
                                <td class="tg-704r" colspan="4">Apellido y nombre / Razón Social:' . ($egreso_nota_debito[0]['apellidoCliente'] == "" ? "-" : $egreso_nota_debito[0]['apellidoCliente'] . ", ") . '' . ($egreso_nota_debito[0]['nombreCliente'] == "" ? "" : $egreso_nota_debito[0]['nombreCliente']) . '<br>Domicilio:' . ($egreso_nota_debito[0]['domicilioCliente'] == "" ? "-" : $egreso_nota_debito[0]['domicilioCliente']) . '</td>
                            </tr>
                            <tr>
                                <td class="tg-r0gd">Código</td>
                                <td class="tg-r0gd">Producto / Servicio</td>
                                <td class="tg-r0gd">Cantidad</td>
                                <td class="tg-r0gd">U. Medida</td>
                                <td class="tg-r0gd">Precio Unit.</td>
                                <td class="tg-r0gd">% Bonif.</td>
                                <td class="tg-r0gd">Imp. Bonif.</td>
                                <td class="tg-r0gd">Subtotal</td>
                            </tr>
                            <!--  Inicio TBODY con esa clase -->
                            <tbody>' .
                $cuerpo
                . '
                            </tbody>
                            <!--  FIN TBODY -->
                            <!--  INICIO TFOOD -->
                            <tfoot style="width: 100%; display: table; padding-top:100px;">
                                <tr>
                                    <th class="tg-n21a" colspan="8"><br><br><br>Subtotal:' . ($nota_debito[0]['subTotalConDescuento'] == "" ? "-" : $nota_debito[0]['subTotalSinDescuento']) . '<br>Importe Otros Tributos: - <br>Importe Total:' . ($nota_debito[0]['total'] == "" ? "-" : $nota_debito[0]['total']) . '</th>
                                </tr>
                                <tr >
                                    <td class="tg-0lax" colspan="4">Pág.: 1/1</td>
                                    <td class="tg-l2oz" colspan="4">CAE N°:<br>Fecha de Vto. de CAE</td>
                                </tr>
                            </tfoot>
                            <!--  FIN TFOOD -->
                        </table>
                    </div>
                ');

        $this->html2pdf->create('save');
    }

    public function generar_pdf_nota_credito_proveedor() {

        $idNotaCredito = $this->input->post('idNota', true);

        //--- Datos ---//
        $nota_credito = $this->app_model->get_notas_credito_proveedor_by_idNotaCredito($idNotaCredito);
        $nota_credito_detalle = $this->app_model->get_detalle_notas_credito_proveedor_by_idGenNotaCredito($nota_credito[0]['idGenNotaCredito']);
        $egreso_nota_credito = $this->app_model->get_egresos_nota_credito($idNotaCredito);

        //-- CARGO LIBRERIAS --//
        $this->load->library('html2pdf');

        $this->html2pdf->folder('./uploads/notascredito_proveedor/');
        $this->html2pdf->filename("notaCredito$idNotaCredito.pdf");
        $this->html2pdf->paper('a4', 'portrait');

        $cuerpo = "";
        foreach ($nota_credito_detalle as $key => $value) :
            $cuerpo .= '<tr id="' . $value['idProducto'] . '">
                            <td class="tg-swzm">' . $value['codigo'] . '</td>
                            <td class="tg-swzm">' . $value['nombre'] . '</td>
                            <td class="tg-swzm">' . intval($value['cantidad']) . '</td>
                            <td class="tg-swzm"> - </td>
                            <td class="tg-swzm"> $' . number_format(floatval($value['precio']), 2, ",", ".") . '</td>
                            <td class="tg-swzm">' . intval($value['descuento']) . '</td>
                            <td class="tg-swzm"> - </td>
                            <td class="tg-swzm"> $' . number_format(floatval($value['subTotal']), 2, ",", ".") . '</td>
                        </tr>';
        endforeach;

        $this->html2pdf->html('
                    <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;}
                        .tg td{font-family:Arial, sans-serif;font-size:7px;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                        .tg th{font-family:Arial, sans-serif;font-size:7px;font-weight:normal;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                        .tg .tg-704r{font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:left;vertical-align:middle;width: 50%;}
                        .tg .tg-nkla{background-color:#f9f9f9;border-color:inherit;font-family:Arial, Helvetica, sans-serif !important;;font-size:12px; text-align:left;vertical-align:top}
                        .tg .tg-swzm{font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f0f0f0;border-color:inherit;text-align:center;vertical-align:middle;height: auto;}
                        .tg .tg-zb0m{font-size:22px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:center;vertical-align:middle;width: 45%;}
                        .tg .tg-zb0z{font-size:15px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:center;vertical-align:middle}
                        .tg .tg-3usq{background-color:#f9f9f9;border-color:inherit;font-family:Arial, Helvetica, sans-serif !important;;font-size:12px; text-align:left;vertical-align:top}
                        .tg .tg-bjuv{font-size:15px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:center;vertical-align:middle}
                        .tg .tg-r0gd{font-size:12px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#cccccc;border-color:inherit;text-align:center;vertical-align:middle}
                        .tg  {border-collapse:collapse;border-spacing:0;}
                        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:7px;overflow:hidden;padding:10px 9px;word-break:normal;}
                        .tg th{border-color:black;border-style:solid;borde  r-width:1px;font-family:Arial, sans-serif;font-size:7px;font-weight:normal;overflow:hidden;padding:10px 9px;word-break:normal;}
                        .tg .tg-n21a{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:right;vertical-align:top;font-size:8px;}
                        .tg .tg-236u{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:center;vertical-align:middle}
                        .tg .tg-0lax{text-align:left;vertical-align:top;vertical-align:bottom;font-size:5px;}
                        .tg .tg-l2oz{font-weight:bold;text-align:right;vertical-align:top;font-size:5px;font-family:"Arial Black", Gadget, sans-serif !important;}
                    </style>
                    <div style="border: 0.5px solid black;margin: 0 auto;position: absolute;width: 100%;border: 0.5px solid black;">
                        <table class="tg" style="width: 100%;" >
                            <tr style="height: 10px;">
                                <th class="tg-bjuv" colspan="8"><span style="font-weight:bold;">ORIGINAL</span></th>
                            </tr>
                            <tr>
                                <td class="tg-zb0m" colspan="3"><span style="font-weight:bold">TELEPATHIC SOFT</span></td>
                                <td class="tg-zb0z" colspan="2"><span style="font-weight:bold;font-size:35px;">X </span><br> <span style="font-weight:bold;font-size:15px;">COD. ' . ($nota_credito[0]['idNotaCredito'] == "" ? "-" : $nota_credito[0]['idNotaCredito']) . '</span></td>
                                <td class="tg-zb0m" colspan="3"><span style="font-weight:bold">NOTA CRÉDITO</span></td>
                            </tr>
                            <tr>
                                <td class="tg-704r" colspan="4">Razón Social:' . ($egreso_nota_credito[0]['razonSocial'] == "" ? "-" : $egreso_nota_credito[0]['razonSocial']) . '<br><br>Domicilio Comercial:' . ($egreso_nota_credito[0]['domicilioComercial'] == "" ? "-" : $egreso_nota_credito[0]['domicilioComercial']) . '<br><br>Condición frente al IVA:' . $egreso_nota_credito[0]['condicionIva'] . '</td>
                                <td class="tg-704r" colspan="4">Nro. Factura de referencia:' . ($egreso_nota_credito[0]['idIngreso'] == "" ? "-" : $egreso_nota_credito[0]['idIngreso']) . '<br>Punto de Venta: - Comp. Nro:' . ($nota_credito[0]['idNotaCredito'] == "" ? "-" : $nota_credito[0]['idNotaCredito']) . '<br>Fecha de Emisión:' . ($nota_credito[0]['fechaAlta'] == "" ? "-" : $nota_credito[0]['fechaAlta']) . '<br>CUIT:' . ($egreso_nota_credito[0]['cuit'] == "" ? "-" : $egreso_nota_credito[0]['cuit']) . '<br>Ingresos Brutos: - <br>Fecha de Inicio de Actividades: - </td>
                            </tr>
                            <tr>
                                <td class="tg-nkla" colspan="3">Periodo Facturado Desde: - </td>
                                <td class="tg-nkla" colspan="2"><span style="font-weight:400;font-style:normal">Hasta: - </span></td>
                                <td class="tg-3usq" colspan="3"><span style="font-weight:400;font-style:normal">Fecha de Vto. para el pago: - </span><br></td>
                            </tr>
                            <tr>
                                <td class="tg-704r" colspan="4">CUIT:' . ($egreso_nota_credito[0]['cuit'] == "" ? "-" : $egreso_nota_credito[0]['cuit']) . '<br>Condición frente al IVA:' . $egreso_nota_credito[0]['condicionIva'] . '<br>Condición de venta: Efectivo</td>
                                <td class="tg-704r" colspan="4">Apellido y nombre / Razón Social:' . ($egreso_nota_credito[0]['apellidoCliente'] == "" ? "-" : $egreso_nota_credito[0]['apellidoCliente'] . ", ") . '' . ($egreso_nota_credito[0]['nombreCliente'] == "" ? "" : $egreso_nota_credito[0]['nombreCliente']) . '<br>Domicilio:' . ($egreso_nota_credito[0]['domicilioCliente'] == "" ? "-" : $egreso_nota_credito[0]['domicilioCliente']) . '</td>
                            </tr>
                            <tr>
                                <td class="tg-r0gd">Código</td>
                                <td class="tg-r0gd">Producto / Servicio</td>
                                <td class="tg-r0gd">Cantidad</td>
                                <td class="tg-r0gd">U. Medida</td>
                                <td class="tg-r0gd">Precio Unit.</td>
                                <td class="tg-r0gd">% Bonif.</td>
                                <td class="tg-r0gd">Imp. Bonif.</td>
                                <td class="tg-r0gd">Subtotal</td>
                            </tr>
                            <!--  Inicio TBODY con esa clase -->
                            <tbody>' .
                $cuerpo
                . '
                            </tbody>
                            <!--  FIN TBODY -->
                            <!--  INICIO TFOOD -->
                            <tfoot style="width: 100%; display: table; padding-top:100px;">
                                <tr>
                                    <th class="tg-n21a" colspan="8"><br><br><br>Subtotal:' . ($nota_credito[0]['subTotalConDescuento'] == "" ? "-" : $nota_credito[0]['subTotalSinDescuento']) . '<br>Importe Otros Tributos: - <br>Importe Total:' . ($nota_credito[0]['total'] == "" ? "-" : $nota_credito[0]['total']) . '</th>
                                </tr>
                                <tr >
                                    <td class="tg-0lax" colspan="4">Pág.: 1/1</td>
                                    <td class="tg-l2oz" colspan="4">CAE N°:<br>Fecha de Vto. de CAE</td>
                                </tr>
                            </tfoot>
                            <!--  FIN TFOOD -->
                        </table>
                    </div>
                ');

        $this->html2pdf->create('save');
    }

}
