<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Abonos extends MY_Controller {

    protected $data = array(
        'active' => 'ingresos'
    );

    public function __construct() {
        parent::__construct();
    }

    public function listar_ventas($idGenAbono) {
        $this->data['idGenAbono'] = $idGenAbono;
        $this->load_view('abonos/listar_ventas', $this->data);
    }

    public function listar_ventas_abono_table($idGenAbono) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $ingresos = $this->app_model->get_ingreso_by_idGenAbono($idGenAbono);
        $estados = $this->app_model->get_estados();

        if ($ingresos) {
            foreach ($ingresos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-success";
                    $texto = "Cobrado";
                elseif ($value['idEstado'] == 2):
                    $class = "btn-info";
                    $texto = "A Cobrar";
                elseif ($value['idEstado'] == 3):
                    $class = "btn-danger";
                    $texto = "Vencido";
                else:
                    $class = "btn-warning";
                    $texto = "Sin Estado";
                endif;

                $facturaIdIngreso = $this->app_model->get_factura_idGenIngreso($value['idGenIngreso']);
                if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29 && $facturaIdIngreso == false) {
                    $bloque1 = '<li><a href="' . base_url() . 'ventas/editar_venta/' . $value['idIngreso'] . '"><i class="icon-cogs"></i> Editar</a></li>' .
                            '<li><a href="#modal-delete" class="tip deleteIngreso" data-id="' . $value['idIngreso'] . '" data-toggle="modal" ><i class="icon-close"></i> Eliminar</a></li>' .
                            '<li class="divider"></li>';
                } else {
                    $bloque1 = '';
                }

                $idGenIngreso = "'" . $value['idGenIngreso'] . "'";
                if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29) {
                    $bloque2 = '<li><a href="#"><i class="icon-notebook"></i> Crear NC/ND</a></li>' .
                            '<li><a href="#"><i class="icon-newspaper"></i> Crear remito</a></li>' .
                            '<li><a href="#"><i class="icon-clipboard"></i> Cta Cte</a></li>' .
                            '<li class="divider"></li>' .
                            '<li><a href="#" onclick="generarPdfDetalleVenta(' . $idGenIngreso . ')"><i class="icon-binoculars"></i> Ver detalle</a></li>' .
                            '<li><a href="#"><i class="icon-attachment"></i> Enviar detalle</a></li>';
                }

                $opcion = ' <div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                        '<ul class="dropdown-menu icons-right">' .
                        $bloque1 .
                        '<li><a href="#modal-agregar-cobro" class="tip agregarCobro" data-id="' . $value['idGenIngreso'] . '" data-toggle="modal" ><i class="icon-tag5"></i> Agregar cobranza</a></li>' .
                        $bloque2 .
                        '</ul>' .
                        '</div>';

                $dato[] = array(
                    $opcion,
                    $value['idTipoIngreso'],
                    $value['fechaEmision'],
                    $value['fechaVtoCobro'],
                    $value['nombEmpresa'],
                    $value['categoria'],
                    "$" . number_format($value['total'] + $value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['aCobrar'], 2, ",", "."),
                    "$" . number_format($value['total'] - $value['aCobrar'], 2, ",", "."),
                    $value['nombreVend'],
                    "DT_RowId" => $value['idIngreso']
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

    public function listar_abonos() {
        $this->load_view('abonos/listar_abonos', $this->data);
    }

    public function agregar_abono() {
        $this->data['clientes'] = $this->app_model->get_clientes();

        $this->data['categoriasVentas'] = $this->app_model->get_categorias_ventas();

        $this->data['facturaTipos'] = $this->app_model->get_factura_tipos();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['modalidadesAbono'] = $this->app_model->get_abono_modalidades();

        $this->data['empresa'] = $this->app_model->get_empresas();

        $this->load_view('abonos/agregar_abono', $this->data);
    }

    public function set_abono() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $datosFacturacion = $this->input->post('datosFacturacion', true);
            $datosVenta = $this->input->post('datosVenta', true);

            $idGenAbono = substr(md5(microtime()), 15, 17);

            if (
                    !empty($datosFacturacion) AND ! empty($datosVenta) AND ! empty($idGenAbono)
            ) {
                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];
                $hoy = date("Y-m-d");
                $aCobrar = $datosFacturacion["total"];
                $saldado = 0;

                //--- Fecha Emision ---//
                if (empty($datosFacturacion["inputFechaEmision"])) {
                    $fechaEmision = date("Y-m-d");
                } else {
                    $fechaEmision = $datosFacturacion["inputFechaEmision"];
                }

                //--- Fecha Vto. del Cobro ---//
                if (empty($datosFacturacion["inputFechaCobro"])) {
                    $fechaCobro = date("Y-m-d");
                } else {
                    $fechaCobro = $datosFacturacion["inputFechaCobro"];
                }
                //--- Fecha fin. Abono---//
                if (empty($datosFacturacion["inputFechaFinAbono"])) {
                    $fechaFinAbono = "0000-00-00";
                } else {
                    $fechaFinAbono = $datosFacturacion["inputFechaFinAbono"];
                }
                //--- Fecha inicio. Abono---//
                if (empty($datosFacturacion["inputFechaInicioAbono"])) {
                    $fechaInicioAbono = "0000-00-00";
                } else {
                    $fechaInicioAbono = $datosFacturacion["inputFechaInicioAbono"];
                }

                //--- Obtencion de las configuraciones de la empresa ---//
                $empresa = $this->app_model->get_empresas();

                //--- Guardo - Abono ---//
                $result_insert_abono = $this->app_model->insert_abono(
                        $idGenAbono, $datosFacturacion["inputFechaPrimeraVenta"], //inputFechaPrimeraVenta
                        $fechaCobro, $datosFacturacion["selectModalidadAbono"], //selectModalidadAbono
                        $fechaFinAbono, $idEstado = 1, //Activo
                        $idVendedor, $datosFacturacion["selectCliente"], //selectCliente
                        $fechaInicioAbono, //inputFechaInicioAbono
                        $fechaEmision, //fechaEmision
                        $fechaCobro, //fechaCobro
                        $datosFacturacion["selectTipoFact"], //selectTipoFac
                        $datosFacturacion["selectCategoriaVenta"], //selectCatVenta  
                        $datosFacturacion["selectSubCategoriaVenta"], //selectSubCategoriaVenta
                        $datosFacturacion["notaCliente"], //notaCliente
                        $datosFacturacion["notaInterna"], //notaInterna
                        $datosFacturacion["totalNoGravado"], //importeNoGravado
                        $datosFacturacion["total"], //totalVenta
                        $datosFacturacion["descTotal"], //descuentoTotal
                        $datosFacturacion["descCliente"], //descuentoCliente
                        $datosFacturacion["totalIva"], //ivaTotal
                        $datosFacturacion["fechaInicioServicio"], //fechaInicioServicio
                        $datosFacturacion["fechaFinServicio"] //fechaFinServicio
                );
                //--- Guardo - Detalle de Abono ---//
                for ($i = 0; $i < count($datosVenta); $i++) {
                    $result_insert_ingreso_detalle = $this->app_model->insert_abono_detalle(
                            $idGenAbono, $datosVenta[$i]['idProducto'], $datosVenta[$i]['cantidad'], $datosVenta[$i]['precio'], $datosVenta[$i]['descuento'], $datosVenta[$i]['subtotalProd'], $datosVenta[$i]['iva'], $datosVenta[$i]['ivaText']
                    );
                }
                
                if ($datosFacturacion["inputFechaPrimeraVenta"] == $hoy) {
                    $idGenIngreso = substr(md5(microtime()), 15, 17);
                    //--- Guardo - Ingreso ---//
                    $result_insert_ingreso = $this->app_model->insert_ingreso(
                            $idGenIngreso, $idGenAbono, $tipoIngreso = 2, // Abonoo
                            $idVendedor, $datosFacturacion["selectCliente"], //selectCliente
                            $fechaEmision, //fechaEmision
                            $fechaCobro, //fechaCobro
                            $datosFacturacion["selectTipoFact"], //selectTipoFac
                            $datosFacturacion["selectCategoriaVenta"], //selectCatVenta
                            $datosFacturacion["notaCliente"], //notaCliente
                            $datosFacturacion["notaInterna"], //notaInterna
                            $datosFacturacion["totalNoGravado"], //importeNoGravado
                            $datosFacturacion["total"], //totalVenta
                            $datosFacturacion["descTotal"], //descuentoTotal
                            $datosFacturacion["descCliente"], //descuentoCliente
                            $datosFacturacion["totalIva"], //ivaTotal
                            $datosFacturacion["selectSubCategoriaVenta"], //selectSubCategoriaVenta
                            0, //razonSocial
                            0, //idGenPresupuesto
                            $aCobrar, //aCobrar                                    
                            $saldado, $idEstado = 2,   //Estado de A cobrar  
                            $datosFacturacion["fechaInicioServicio"], //fechaInicioServicio
                            $datosFacturacion["fechaFinServicio"] //fechaFinServicio
                    );
                    $fechaCobroCuentaCorriente = date("Y-m-d H:i:s");

                    $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                            $idGenIngreso, $idGenComprobante = 0, $datosFacturacion["selectCliente"], //selectCliente
                            $fechaCobroCuentaCorriente, //fechaCobro
                            $debito = $aCobrar, //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                            $credito = 0, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                            $idMedioCobro = 0, //Medio de cobro
                            $saldo = $aCobrar, //Saldo
                            $descripcionCobro = "Primer ingreso"
                    );

                    $result_abono = $this->app_model->get_abono_by_idGenAbono($idGenAbono);
                    if ($result_abono) {
                        $vtasCreadas = $result_abono[0]['ventasCreadas'] + 1;
                        $result_update_abono_vta = $this->app_model->update_abono_vtas_creadas_by_idGenAbono($idGenAbono, $vtasCreadas);
                    }
                    $result_log_abono = $this->app_model->insert_log_abono($idGenAbono);

                    //--- Guardo - Detalle de Ingreso ---//
                    for ($i = 0; $i < count($datosVenta); $i++) {
                        $producto_idProducto = $this->app_model->get_productos_byId($datosVenta[$i]['idProducto']);
                        $result_insert_ingreso_detalle = $this->app_model->insert_ingreso_detalle(
                                $idGenIngreso, $datosVenta[$i]['idProducto'], $datosVenta[$i]['cantidad'], $datosVenta[$i]['precio'], $datosVenta[$i]['descuento'], $datosVenta[$i]['subtotalProd'], $datosVenta[$i]['iva'], $datosVenta[$i]['ivaText']
                        );
                        //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                        if ($empresa[0]['stock'] == 0) {
                            if ($producto_idProducto[0]['controlStock'] == 0) {

                                $cantidadActualizada = $datosVenta[$i]['stock'] - $datosVenta[$i]['cantidad'];
                                $result = $this->app_model->update_stock_by_idProducto($datosVenta[$i]['idProducto'], $cantidadActualizada);

                                //--- Guardo el movimiento del stock ---//
                                $hoy = getdate();
                                $d = $hoy['mday'];
                                (($d < 10) ? $d = "0" . $d : $d);
                                $m = $hoy['mon'];
                                (($m < 10) ? $m = "0" . $m : $m);
                                $y = $hoy['year'];
                                $fecha = $d . "-" . $m . "-" . $y;
                                $movimiento_stock = $this->app_model->insert_movimiento_stock($producto_idProducto[0]['idGenProducto'], $idGenIngreso, 2, $datosVenta[$i]['cantidad'], "Se realizo el abono", 0, $idVendedor, $fecha);
                            }
                        }
                    }
                } else {
                    $result_insert_ingreso_detalle = true;
                }

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idVendedor, $idGenAbono, $tipoAccion = 1, $tipoOperacion = 26, "Se agregó un nuevo abono a " . $datosFacturacion["selectCliente"], //detalle
                        $datosFacturacion["total"] //total
                );


                if ($result_insert_ingreso_detalle && $result_insert_abono) {
                    $msg = "Registro agregado";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al procesar registro";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    //** Ventas **//    

    public function buscaSubcategoriaVentaDetalle() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idCategoriaVentaDetalle = $this->input->post('idCategoriaVentaDetalle', true);
        $subcategoriasVentasDetalle = $this->app_model->get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($idCategoriaVentaDetalle);

        echo '<option value="0">Seleccionar Subcategoria Venta</option>';
        foreach ($subcategoriasVentasDetalle as $key) {
            echo '<option value="' . $key['idSubcategoriaVenta'] . '">' . $key['descripcion'] . '</option>';
        }
    }

    public function editar_abono($idGenAbono = null) {
        $this->data['idGenAbono'] = $idGenAbono;

        $abono = $this->app_model->get_abono_by_idGenAbono($idGenAbono);
        $this->data['abono'] = $abono;

        $this->data['abonoDetalle'] = $this->app_model->get_abonos_detalle($abono[0]['idGenAbono']);

        $this->data['clientes'] = $this->app_model->get_clientes();

        $this->data['categoriasVentas'] = $this->app_model->get_categorias_ventas();

        $this->data['subcategoriasVentasDetalle'] = $this->app_model->get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($abono[0]['idCategoria']);

        $this->data['facturaTipos'] = $this->app_model->get_factura_tipos();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['modalidadesAbono'] = $this->app_model->get_abono_modalidades();

        $this->data['ivaTipos'] = $this->app_model->get_iva_tipos();

        $this->data['empresa'] = $this->app_model->get_empresas();

        $this->load_view('abonos/editar_abono', $this->data);
    }

    public function update_abono() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $datosFacturacion = $this->input->post('datosFacturacion', true);
            $datosVenta = $this->input->post('datosVenta', true);
            $idGenAbono = $this->input->post('idGenAbono', true);
            $totalVenta = $this->input->post('totalVenta', true);
            $importeNoGravado = $this->input->post('importeNoGravado', true);

            if (
                    !empty($datosFacturacion) AND ! empty($datosVenta) AND ! empty($idGenAbono) AND ! empty($totalVenta) AND ! empty($importeNoGravado)
            ) {
                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];
                $hoy = date("Y-m-d");
                $aCobrar = $datosFacturacion["total"];
                $saldado = 0;
                $idEstado = 2; //Estado de A cobrar
                $ivaTotal = 0;

                $abono = $this->app_model->get_abono_by_idGenAbono($idGenAbono);
                $abonoDetalle = $this->app_model->get_detalle_abono_by_idGenAbono($idGenAbono);

                //--- Fecha Emision ---//
                if (empty($datosFacturacion["inputFechaEmision"])) {
                    $fechaEmision = date("Y-m-d");
                } else {
                    $fechaEmision = $datosFacturacion["inputFechaEmision"];
                }

                //--- Fecha Vto. del Cobro ---//
                if (empty($datosFacturacion["inputFechaCobro"])) {
                    $fechaCobro = date("Y-m-d");
                } else {
                    $fechaCobro = $datosFacturacion["inputFechaCobro"];
                }
                //--- Fecha fin. Abono---//
                if (empty($datosFacturacion["inputFechaFinAbono"])) {
                    $fechaFinAbono = "0000-00-00";
                } else {
                    $fechaFinAbono = $datosFacturacion["inputFechaFinAbono"];
                }
                //--- Fecha inicio. Abono---//
                if (empty($datosFacturacion["inputFechaInicioAbono"])) {
                    $fechaInicioAbono = "0000-00-00";
                } else {
                    $fechaInicioAbono = $datosFacturacion["inputFechaInicioAbono"];
                }

                //--- Obtencion de los datos de las configuraciones de la empresa ---//
                $empresa = $this->app_model->get_empresas();

                //--- Ingreso ---//
                $ingreso = $this->app_model->get_ingreso_idGenAbono($idGenAbono);

                if ((($abono[0]['ventasCreadas'] <= 1 && $datosFacturacion["inputFechaPrimeraVenta"] != $abono[0]['fechaPrimerVenta']) ||
                        ($abono[0]['ventasCreadas'] > 1 && $datosFacturacion["inputFechaPrimeraVenta"] == $abono[0]['fechaPrimerVenta']))) {

                    //--- Actualizo - Abono ---//
                    $result_update_abono = $this->app_model->update_abono(
                            $idGenAbono, $datosFacturacion["inputFechaPrimeraVenta"], //inputFechaPrimeraVenta
                            $fechaCobro, $datosFacturacion["selectModalidadAbono"], //selectModalidadAbono
                            $fechaFinAbono, $idEstado = $datosFacturacion["idEstado"], //Activo
                            $idVendedor, $datosFacturacion["selectCliente"], //selectCliente
                            $fechaInicioAbono, //inputFechaInicioAbono
                            $fechaEmision, //fechaEmision
                            $fechaCobro, //fechaCobro
                            $datosFacturacion["selectTipoFact"], //selectTipoFac
                            $datosFacturacion["selectCategoriaVenta"], //selectCatVenta
                            $datosFacturacion["selectSubCategoriaVenta"], //selectSubCategoriaVenta
                            $datosFacturacion["notaCliente"], //notaCliente
                            $datosFacturacion["notaInterna"], //notaInterna
                            $datosFacturacion["totalNoGravado"], //importeNoGravado
                            $datosFacturacion["total"], //totalVenta
                            $datosFacturacion["descTotal"], //descuentoTotal
                            $datosFacturacion["descCliente"], //descuentoCliente
                            $datosFacturacion["totalIva"], //ivaTotal
                            $datosFacturacion["fechaInicioServicio"], //fechaInicioServicio
                            $datosFacturacion["fechaFinServicio"] //fechaFinServicio
                    );

                    //--- Guardo - Detalle de Abono ---//
                    if (empty($abonoDetalle)) {

                        //--- Insertamos registros cuando la tabla esta vacia ---//
                        foreach ($datosVenta as $keys => $values) {
                            $producto_idProducto = $this->app_model->get_productos_byId($values['idProducto']);

                            $result_insert_ingreso_detalle = $this->app_model->insert_abono_detalle(
                                    $idGenAbono, $values['idProducto'], $values['cantidad'], $values['precio'], $values['descuento'], $values['subtotalProd'], $values['iva'], $values['ivaText']
                            );
                            if ($producto_idProducto[0]['controlStock'] == 0)
                            //--- Diferencia de cantidades ---//
                                $cantidadActualizada = $values['stock'] - $values['cantidad'];
                            //--- Actualizacion de stock ---//
                            $result2 = $this->app_model->update_stock_by_idProducto($values['idProducto'], $cantidadActualizada);

                            //--- Guardo el movimiento del stock ---//
                            $hoy = getdate();
                            $d = $hoy['mday'];
                            (($d < 10) ? $d = "0" . $d : $d);
                            $m = $hoy['mon'];
                            (($m < 10) ? $m = "0" . $m : $m);
                            $y = $hoy['year'];
                            $fecha = $d . "-" . $m . "-" . $y;
                            $movimiento_stock = $this->app_model->insert_movimiento_stock($producto_idProducto[0]['idGenProducto'], $ingreso[0]['idGenIngreso'], $values['cantidad'], "Se agregaron productos a al abono", $fecha);
                            $ivaTotal += $values['subtotalProd'] * $values['iva'];
                        }
                    } else {
                        //--- Los valores que se encuentran en $datosVenta son los que se encuentran actualmente ingresados y en $ingresoDetalle se encuentran los valores que estan en la base de datos ---//
                        $valorComparar = [];
                        foreach ($abonoDetalle as $key => $value) {
                            array_push($valorComparar, $value['idProducto']);
                        }
                        foreach ($datosVenta as $key => $value) {
                            $producto_idProducto = $this->app_model->get_productos_byId($value['idProducto']);
                            if (!in_array($datosVenta[$key]['idProducto'], $valorComparar)) {
                                //--- INSERT ---//
                                $result_insert_ingreso_detalle = $this->app_model->insert_abono_detalle($idGenAbono, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                                if ($empresa[0]['stock'] == 0) {
                                    if ($producto_idProducto[0]['controlStock'] == 0) {
                                        //--- Descontamos Stock ---//
                                        $cantidadActualizada = $datosVenta[$key]['stock'] - $datosVenta[$key]['cantidad'];
                                        //--- Actualizacion de Stock ---//
                                        $this->app_model->update_stock_by_idProducto($datosVenta[$key]['idProducto'], $cantidadActualizada);

                                        //--- Guardo el movimiento del stock ---//
                                        $hoy = getdate();
                                        $d = $hoy['mday'];
                                        (($d < 10) ? $d = "0" . $d : $d);
                                        $m = $hoy['mon'];
                                        (($m < 10) ? $m = "0" . $m : $m);
                                        $y = $hoy['year'];
                                        $fecha = $d . "-" . $m . "-" . $y;
                                        $movimiento_stock = $this->app_model->insert_movimiento_stock($producto_idProducto[0]['idGenProducto'], $ingreso[0]['idGenIngreso'], $value['cantidad'], "Se agregaron productos a al abono", $fecha);
                                    }
                                }
                                $ivaTotal += $datosVenta[$key]['subtotalProd'] * $datosVenta[$key]['iva'];
                            } else {
                                //--- Update ---//
                                if ($datosVenta[$key]['cantidad'] > $abonoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosVenta[$key]['idProducto']) {
                                    //--- Update registro detalle ingreso ---//
                                    $this->app_model->update_abono_detalle_by_idAbono($idGenAbono, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                    //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                                    if ($empresa[0]['stock'] == 0) {
                                        if ($producto_idProducto[0]['controlStock'] == 0) {
                                            //--- Diferencia para stock ---//
                                            $diferencia = $datosVenta[$key]['cantidad'] - $abonoDetalle[$key]['cantidad'];
                                            $cantidadActualizada = $datosVenta[$key]['stock'] - $diferencia;
                                            //--- Update stock ---//
                                            $result2 = $this->app_model->update_stock_by_idProducto($abonoDetalle[$key]['idProducto'], $cantidadActualizada);

                                            //--- Guardo el movimiento del stock ---//
                                            $hoy = getdate();
                                            $d = $hoy['mday'];
                                            (($d < 10) ? $d = "0" . $d : $d);
                                            $m = $hoy['mon'];
                                            (($m < 10) ? $m = "0" . $m : $m);
                                            $y = $hoy['year'];
                                            $fecha = $d . "-" . $m . "-" . $y;
                                            $movimiento_stock = $this->app_model->update_movimiento_stock($producto_idProducto[0]['idGenProducto'], 2, $ingreso[0]['idGenIngreso'], $datosVenta[$key]['cantidad'], "Se agregaron producto al abono", $cantidadActualizada, $idVendedor, $fecha);
                                        }
                                    }
                                } elseif ($datosVenta[$key]['cantidad'] < $abonoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosVenta[$key]['idProducto']) {
                                    //--- Update registro detalle ingreso ---//
                                    $this->app_model->update_abono_detalle_by_idAbono($idGenAbono, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                    //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                                    if ($empresa[0]['stock'] == 0) {
                                        if ($producto_idProducto[0]['controlStock'] == 0) {
                                            //--- Diferencia para stock ---//
                                            $diferencia = $abonoDetalle[$key]['cantidad'] - $datosVenta[$key]['cantidad'];
                                            $cantidadActualizada = $datosVenta[$key]['stock'] + $diferencia;
                                            //--- Update stock ---//
                                            $result2 = $this->app_model->update_stock_by_idProducto($abonoDetalle[$key]['idProducto'], $cantidadActualizada);

                                            //--- Guardo el movimiento del stock ---//
                                            $hoy = getdate();
                                            $d = $hoy['mday'];
                                            (($d < 10) ? $d = "0" . $d : $d);
                                            $m = $hoy['mon'];
                                            (($m < 10) ? $m = "0" . $m : $m);
                                            $y = $hoy['year'];
                                            $fecha = $d . "-" . $m . "-" . $y;
                                            $movimiento_stock = $this->app_model->update_movimiento_stock($producto_idProducto[0]['idGenProducto'], $ingreso[0]['idGenIngreso'], $datosVenta[$key]['cantidad'], 2, "Se agregaron producto al abono", $cantidadActualizada, $idVendedor, $fecha);
                                        }
                                    }
                                } elseif ($datosVenta[$key]['cantidad'] == $abonoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosVenta[$key]['idProducto']) {
                                    //--- Update registro detalle ingreso ---//
                                    $this->app_model->update_abono_detalle_by_idAbono($idGenAbono, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                }
                                $ivaTotal += $datosVenta[$key]['subtotalProd'] * $datosVenta[$key]['iva'];
                            }
                        }

                        $valorComparar = [];
                        foreach ($datosVenta as $key => $value) {
                            array_push($valorComparar, $value['idProducto']);
                        }

                        foreach ($abonoDetalle as $key => $value) {
                            if (!in_array($abonoDetalle[$key]['idProducto'], $valorComparar)) {
                                //--- Borrar ---//
                                $producto = $this->app_model->get_productos_byId($abonoDetalle[$key]['idProducto']);

                                if ($producto[0]['controlStock'] == 0) {
                                    //--- update stock producto ---//
                                    $cantidadTotal = $producto[0]['stock'] + $abonoDetalle[$key]['cantidad'];
                                    $update_stock_producto = $this->app_model->update_stock_by_idProducto($abonoDetalle[$key]['idProducto'], $cantidadTotal);

                                    //--- Guardo el movimiento del stock ---//
                                    $movimiento_stock = $this->app_model->drop_movimiento_stock($producto[0]['idGenProducto'], $ingreso[0]['idGenIngreso'], "Se elimino el producto del abono");
                                }

                                //--- eliminar el detalle del abono ---//
                                $delete_ingreso = $this->app_model->eliminar_abono_by_idGenAbono_idProducto($idGenAbono, $abonoDetalle[$key]['idProducto']);
                            }
                        }
                    }

                    //--- Validamos si la fecha primera venta fue modificada ----//
                    if ($abono[0]['ventasCreadas'] == 1 && $datosFacturacion["inputFechaPrimeraVenta"] != $abono[0]['fechaPrimerVenta']) {
                        //--- Eliminamos el ingreso correspondiente al idGenIngreso ---//
                        $this->app_model->eliminar_ingreso_by_idGenIngreso($ingreso[0]['idGenIngreso']);
                        //--- Eliminamos el detalle del ingreso correspondiente al idGenIngreso ---//
                        $this->app_model->eliminar_ingreso_detalle_by_idGenIngreso($ingreso[0]['idGenIngreso']);
                        //--- Eliminamos el abono correspondiente al idGenAbono ---//
                        $this->app_model->eliminar_abono_by_idGenAbono($idGenAbono);
                        //--- Actualizamos la cantidad de ventas creadas del abono correspondiente al idGenAbono ---//
                        $this->app_model->update_abono_vtas_creadas_by_idGenAbono($idGenAbono, $vtasCreadas = 0);
                    } else {
                        $ingreso_abono = $this->app_model->get_ingreso_by_idGenAbono($idGenAbono);
                        $idGenIngreso = $ingreso_abono[0]['idGenIngreso'];
                        if ($idGenIngreso) {

                            //--- Actualizo - Ingreso ---//
                            $result_update_ingreso = $this->app_model->update_ingreso_by_idGenAbono(
                                    $idGenAbono, 6,//tipoIngreso
                                    $datosFacturacion["selectCliente"], //selectCliente
                                    $fechaEmision, //fechaEmision
                                    $fechaCobro, //fechaCobro
                                    $datosFacturacion["selectTipoFact"], //selectTipoFact
                                    $datosFacturacion["selectCategoriaVenta"], //selectCatVenta  
                                    $fechaInicioAbono,
                                    "", // duracion
                                    $datosFacturacion["selectModalidadAbono"], //selectModalidadAbono
                                    $datosFacturacion["notaCliente"], //notaCliente
                                    $datosFacturacion["notaInterna"], //notaInterna
                                    $datosFacturacion["selectTipoFact"], //selectTipoFac
                                    $datosFacturacion["totalNoGravado"], //importeNoGravado
                                    $datosFacturacion["total"], //totalVenta
                                    $datosFacturacion["descTotal"], //descuentoTotal
                                    $ivaTotal, //ivaTotal
                                    $datosFacturacion["selectSubCategoriaVenta"], //selectSubCategoriaVenta
                                    $aCobrar = $datosFacturacion['total'], 
                                    $saldado = $datosFacturacion["cobrado"]
                            );

                            $ingresoDetalle = $this->app_model->get_ingreso_detalle_by_idGenIngreso($idGenIngreso);

                            //--- Guardo - Detalle de Ingreso ---//
                            if (empty($ingresoDetalle)) {

                                //--- Insertamos registros cuando la tabla esta vacia ---//
                                foreach ($datosVenta as $keys => $values) {
                                    $result_primero = $this->app_model->insert_ingreso_detalle(
                                            $idGenIngreso, $values['idProducto'], $values['cantidad'], $values['precio'], $values['descuento'], $values['subtotalProd'], $values['iva'], $datosVenta[$key]['ivaText']
                                    );
                                }
                            } else {

                                //--- Los valores que se encuentran en $datosVenta son los que se encuentran actualmente ingresados y en $ingresoDetalle se encuentran los valores que estan en la base de datos ---//
                                $valorComparar = [];
                                foreach ($ingresoDetalle as $key => $value) {
                                    array_push($valorComparar, $value['idProducto']);
                                }
                                foreach ($datosVenta as $key => $value) {
                                    if (!in_array($datosVenta[$key]['idProducto'], $valorComparar)) {
                                        //--- INSERT ---//
                                        $this->app_model->insert_ingreso_detalle($idGenIngreso, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                    } else {
                                        //--- Update ---//
                                        if ($datosVenta[$key]['cantidad'] > $ingresoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosVenta[$key]['idProducto']) {
                                            //--- Update registro detalle ingreso ---//
                                            $this->app_model->update_ingreso_detalle_by_idProducto($idGenIngreso, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                        } elseif ($datosVenta[$key]['cantidad'] < $ingresoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosVenta[$key]['idProducto']) {
                                            //--- Update registro detalle ingreso ---//
                                            $this->app_model->update_ingreso_detalle_by_idProducto($idGenIngreso, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                        } elseif ($datosVenta[$key]['cantidad'] == $ingresoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosVenta[$key]['idProducto']) {
                                            //--- Update registro detalle ingreso ---//
                                            $this->app_model->update_ingreso_detalle_by_idProducto($idGenIngreso, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                        }
                                    }
                                }

                                $valorComparar = [];
                                foreach ($datosVenta as $key => $value) {
                                    array_push($valorComparar, $value['idProducto']);
                                }

                                foreach ($ingresoDetalle as $key => $value) {
                                    if (!in_array($ingresoDetalle[$key]['idProducto'], $valorComparar)) {
                                        //--- Borrar ---//
                                        $producto = $this->app_model->get_productos_byId($ingresoDetalle[$key]['idProducto']);
                                        //--- eliminar el detalle presupuesto ---//
                                        $delete_ingreso = $this->app_model->eliminar_ingreso_by_idGenIngreso_idProducto($idGenIngreso, $ingresoDetalle[$key]['idProducto']);
                                    }
                                }
                            }
                        }
                    }

                    $hoy = date("Y-m-d");
                    $ingreso = $this->app_model->get_ingreso_idGenAbono($idGenAbono);

                    if ($datosFacturacion["inputFechaPrimeraVenta"]  == $hoy && empty($ingreso)) {
                        $idGenIngreso = substr(md5(microtime()), 15, 17);
                        //--- Guardo - Ingreso ---//
                        $result_insert_ingreso = $this->app_model->insert_ingreso(
                                $idGenIngreso, $idGenAbono, $tipoIngreso = 2, // Abonoo
                                $idVendedor, $datosFacturacion["selectCliente"], //selectCliente
                                $fechaEmision, //fechaEmision
                                $fechaCobro, //fechaCobro
                                $datosFacturacion["selectTipoFact"], //selectTipoFac
                                $datosFacturacion["selectCategoriaVenta"], //selectCatVenta
                                $datosFacturacion["notaCliente"], //notaCliente
                                $datosFacturacion["notaInterna"], //notaInterna
                                $datosFacturacion["totalNoGravado"], //importeNoGravado
                                $datosFacturacion["total"], //totalVenta
                                $datosFacturacion["descTotal"], //descuentoTotal
                                $datosFacturacion["descCliente"], //descuentoCliente
                                $ivaTotal, //ivaTotal
                                $datosFacturacion["selectSubCategoriaVenta"], //selectSubCategoriaVenta
                                0, //razonSocial
                                0, //idGenPresupuesto
                                $aCobrar, //aCobrar                                    
                                $saldado, $idEstado = 2,   //Estado de A cobrar  
                                $datosFacturacion["fechaInicioServicio"], //fechaInicioServicio
                                $datosFacturacion["fechaFinServicio"] //fechaFinServicio
                        );
                        $fechaCobroCuentaCorriente = date("Y-m-d H:i:s");
    
                        $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                                $idGenIngreso, $idGenComprobante = 0, $datosFacturacion["selectCliente"], //selectCliente
                                $fechaCobroCuentaCorriente, //fechaCobro
                                $debito = $aCobrar, //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                                $credito = 0, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                                $idMedioCobro = 0, //Medio de cobro
                                $saldo = $aCobrar, //Saldo
                                $descripcionCobro = "Primer ingreso"
                        );
    
                        $result_abono = $this->app_model->get_abono_by_idGenAbono($idGenAbono);
                        if ($result_abono) {
                            $vtasCreadas = $result_abono[0]['ventasCreadas'] + 1;
                            $result_update_abono_vta = $this->app_model->update_abono_vtas_creadas_by_idGenAbono($idGenAbono, $vtasCreadas);
                        }
                        $result_log_abono = $this->app_model->insert_log_abono($idGenAbono);
    
                        //--- Guardo - Detalle de Ingreso ---//
                        for ($i = 0; $i < count($datosVenta); $i++) {
                            $producto_idProducto = $this->app_model->get_productos_byId($datosVenta[$i]['idProducto']);
                            $result_insert_ingreso_detalle = $this->app_model->insert_ingreso_detalle(
                                    $idGenIngreso, $datosVenta[$i]['idProducto'], $datosVenta[$i]['cantidad'], $datosVenta[$i]['precio'], $datosVenta[$i]['descuento'], $datosVenta[$i]['subtotalProd'], $datosVenta[$i]['iva'], $datosVenta[$i]['ivaText']
                            );
                            //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                            if ($empresa[0]['stock'] == 0) {
                                if ($producto_idProducto[0]['controlStock'] == 0) {
    
                                    $cantidadActualizada = $datosVenta[$i]['stock'] - $datosVenta[$i]['cantidad'];
                                    $result = $this->app_model->update_stock_by_idProducto($datosVenta[$i]['idProducto'], $cantidadActualizada);
    
                                    //--- Guardo el movimiento del stock ---//
                                    $hoy = getdate();
                                    $d = $hoy['mday'];
                                    (($d < 10) ? $d = "0" . $d : $d);
                                    $m = $hoy['mon'];
                                    (($m < 10) ? $m = "0" . $m : $m);
                                    $y = $hoy['year'];
                                    $fecha = $d . "-" . $m . "-" . $y;
                                    $movimiento_stock = $this->app_model->insert_movimiento_stock($producto_idProducto[0]['idGenProducto'], $idGenIngreso, 2, $datosVenta[$i]['cantidad'], "Se realizo el abono", 0, $idVendedor, $fecha);
                                }
                            }
                        }
                    } else {
                        $result_insert_ingreso_detalle = true;
                    }

                    //--- Guardo - Historico ---//
                    $result_insert_historico = $this->app_model->set_historico(
                            $idVendedor, $idGenAbono, $tipoAccion = 2, $tipoOperacion = 26, "Se modificó un nuevo abono a " . $datosFacturacion["selectCliente"], //detalle
                            $datosFacturacion["total"] //total
                    );

                    $msg = "Datos actualizados";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "La fecha de la primer venta solo puede ser modificada si existe 1 o 0 ventas (Ingresos) creadas.";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_abono() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        $idAbono = $this->input->post('id', true);
        $msg = "";

        if (!empty($idAbono)) {

            $abono = $this->app_model->get_abono_by_idAbono($idAbono);
            if ($abono) {
                $ingreso = $this->app_model->get_ingreso_idGenAbono($abono[0]['idGenAbono']);
                $abonoDetalle = $this->app_model->get_detalle_abono_by_idGenAbono($abono[0]['idGenAbono']);
                foreach ($abonoDetalle as $key => $value) {
                    //--- Borrar ---//
                    $producto = $this->app_model->get_productos_byId($abonoDetalle[$key]['idProducto']);

                    if ($producto[0]['controlStock'] == 0) {
                        //--- update stock producto ---//
                        $cantidadTotal = $producto[0]['stock'] + $abonoDetalle[$key]['cantidad'];
                        $update_stock_producto = $this->app_model->update_stock_by_idProducto($abonoDetalle[$key]['idProducto'], $cantidadTotal);
                        //--- Guardo el movimiento del stock ---//
                        $movimiento_stock = $this->app_model->drop_movimiento_stock($producto[0]['idGenProducto'], $ingreso[0]['idGenIngreso'], "Se elimino el producto del abono");
                    }

                    //--- eliminar el detalle del abono ---//
                    $delete_ingreso = $this->app_model->eliminar_abono_by_idGenAbono_idProducto($abono[0]['idGenAbono'], $abonoDetalle[$key]['idProducto']);
                }

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idAbono, $tipoAccion = 3, $tipoOperacion = 26, $detalle = 'Se elimino un abono a ' . $ingreso[0]['nombEmpresa'], //detalle
                        $total = 0
                );

                //--- Eliminar el abono ---//
                $result = $this->app_model->eliminar_abono_by_idAbono($idAbono);
            } else {
                $result = false;
                $result = false;
            }
            if ($result && $movimiento_stock) {
                $msg = "Registro eliminado";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al eliminar registro";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Id vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function listar_abonos_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $abonos = $this->app_model->get_abonos();
        $estadosAbonos = $this->app_model->get_estados_abonos();

        if ($abonos) {
            foreach ($abonos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-success";
                    $texto = "Activo";
                    $estado_activar = "none";
                    $estado_pausar = "block";
                    $estado_terminar = "block";
                elseif ($value['idEstado'] == 3):
                    $class = "btn-info";
                    $texto = "Pausado";
                    $estado_activar = "block";
                    $estado_pausar = "none";
                    $estado_terminar = "block";
                elseif ($value['idEstado'] == 2):
                    $class = "btn-danger";
                    $texto = "Terminado";
                    $estado_activar = "block";
                    $estado_pausar = "block";
                    $estado_terminar = "none";
                endif;

                $idGenAbono = "'" . $value['idGenAbono'] . "'";

                if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29):
                    $opcion = '<td>' .
                            '<div class="btn-group">' .
                            '<button id="btn' . $value['idGenAbono'] . '" class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                            '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                            '<ul class="dropdown-menu icons-right">' .
                            '<li><a href="' . base_url() . 'abonos/ver_abono/' . $value['idGenAbono'] . '"><i class="icon-grid3"></i> Ver</a></li>' .
                            '<li><a href="' . base_url() . 'abonos/editar_abono/' . $value['idGenAbono'] . '"><i class="icon-cogs"></i> Editar</a></li>' .
                            '<li id="activar' . $value['idGenAbono'] . '" style="display:' . $estado_activar . ';"><a onclick="activarAbono(' . $idGenAbono . ');"><i class="icon-cogs"></i> Activar</a></li>' .
                            '<li id="pausar' . $value['idGenAbono'] . '" style="display:' . $estado_pausar . ';"><a onclick="pausarAbono(' . $idGenAbono . ');"><i class="icon-cogs"></i> Pausar</a></li>' .
                            '<li id="terminar' . $value['idGenAbono'] . '" style="display:' . $estado_terminar . ';"><a onclick="terminarAbono(' . $idGenAbono . ');"><i class="icon-cogs"></i> Terminar</a></li>' .
                            '<li><a href="#modal-delete" class="tip deleteAbono" data-id="' . $value['idAbono'] . '" data-toggle="modal" ><i class="icon-close"></i> Eliminar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li><a href="' . base_url() . 'abonos/listar_ventas/' . $value['idGenAbono'] . '"><i class="icon-tag5"></i> Ver ventas creadas</a></li>' .
                            '</ul>' .
                            '</div>' .
                            '</td>';
                endif;

                $dato[] = array(
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVtoCobro'],
                    $value['nombEmpresa'],
                    $value['descripModalidad'],
                    $value['ventasCreadas'],
                    "$" . number_format($value['total'] + $value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    $value['nombreVend'],
                    "DT_RowId" => $value['idAbono']
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

    public function pausar_abono() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        $idGenAbono = $this->input->post('idGenAbono', true);
        $msg = "";

        if (!empty($idGenAbono)) {
            //--- Pausar abono ---//
            $estado_pausado = $this->app_model->pausar_abono_by_idGenAbono($idGenAbono);

            //--- Guardo - Historico ---//
            $result_insert_historico = $this->app_model->set_historico(
                    $idUsuario, $idGenAbono, $tipoAccion = 7, $tipoOperacion = 26, $detalle = 'Se pauso el abono', //detalle
                    $total = 0
            );

            if ($estado_pausado) {
                $msg = "Abono pausado";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al pausar el abono";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Id vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function terminar_abono() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        $idGenAbono = $this->input->post('idGenAbono', true);
        $msg = "";

        if (!empty($idGenAbono)) {
            //--- Terminar abono ---//
            $estado_terminado = $this->app_model->terminar_abono_by_idGenAbono($idGenAbono);

            //--- Guardo - Historico ---//
            $result_insert_historico = $this->app_model->set_historico(
                    $idUsuario, $idGenAbono, $tipoAccion = 8, $tipoOperacion = 26, $detalle = 'Se pauso el abono', //detalle
                    $total = 0
            );

            if ($estado_terminado) {
                $msg = "Abono terminado";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al terminar el abono";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Id vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function activar_abono() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        $idGenAbono = $this->input->post('idGenAbono', true);
        $msg = "";

        if (!empty($idGenAbono)) {
            //--- Terminar abono ---//
            $estado_activado = $this->app_model->activar_abono_by_idGenAbono($idGenAbono);

            //--- Guardo - Historico ---//
            $result_insert_historico = $this->app_model->set_historico(
                    $idUsuario, $idGenAbono, $tipoAccion = 9, $tipoOperacion = 26, $detalle = 'Se pauso el abono', //detalle
                    $total = 0
            );

            if ($estado_activado) {
                $msg = "Abono activado";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al activar el abono";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Id vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function listar_abonos_detalle_table($idGenAbono) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $abonos_detalle = $this->app_model->get_detalle_abono_by_idGenAbono($idGenAbono);
        $ivaTipos = $this->app_model->get_iva_tipos();
        $empresa = $this->app_model->get_empresas();
        if ($abonos_detalle) {
            foreach ($abonos_detalle as $key => $value) {

                $idGenAbono = "'" . $value['idGenAbono'] . "'";

                $opcines_iva = "";

                if (isset($ivaTipos)):
                    for ($j = 0; $j < count($ivaTipos); $j++) :
                        if ($ivaTipos[$j]['valorIva'] == $value['iva']):
                            $opcines_iva .= '<option selected value="' . $ivaTipos[$j]['valorIva'] . '">' . $ivaTipos[$j]['descripcion'] . '</option>';
                        else:
                            $opcines_iva .= '<option value="' . $ivaTipos[$j]['valorIva'] . '">' . $ivaTipos[$j]['descripcion'] . '</option>';
                        endif;
                    endfor;
                endif;

                //--- control de stock ---//
                $cantidad = "";
                if ($empresa[0]['stock'] == 0) {
                    $cantidad = '<input type="text" value="' . $value["cantidad"] . '" id="cantProd' . $value["idProducto"] . '" onkeyup="calculoAbonoEditar(' . $value["idProducto"] . ',' . $value["stock"] . ',' . $value["cantidad"] . ',' . $empresa[0]['stock'] . ')" class="form-control">';
                } elseif ($empresa[0]['stock'] == 1) {
                    $cantidad = '<input type="text" value="' . $value["cantidad"] . '" id="cantProd' . $value["idProducto"] . '"  onkeyup="calculoAbonoEditar(' . $value["idProducto"] . ',' . $value["stock"] . ',' . $value["cantidad"] . ',' . $empresa[0]['stock'] . ')" class="form-control">';
                }

                $dato[] = array(
                    $value["idProducto"],
                    $value['codigo'],
                    $value['nombre'],
                    $cantidad,
                    $value['stock'],
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["precio"] . '" id="precioProd' . $value["idProducto"] . '" disabled class="form-control">' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">%</span>' .
                    '<input type="text" value="' . $value["descuento"] . '" id="descProd' . $value["idProducto"] . '" onkeyup="calculoAbonoEditar(' . $value["idProducto"] . ',' . $empresa[0]["stock"] . ')" class="form-control">' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["subTotal"] . '" id="subTotalProd' . $value["idProducto"] . '" readonly class="form-control">' .
                    '</div>',
                    '<select id="selectIva' . $value["idProducto"] . '" onchange="calculoAbonoEditar(' . $value["idProducto"] . ',' . $empresa[0]["stock"] . ')" class="select-full" required>
                        <option value="0">IVA</option>' .
                    $opcines_iva .
                    '</select>',
                    '<i class="icon-remove4" onclick="deleteRowListaAbonoEditar(' . $value["idProducto"] . ')"></i>',
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

    public function listar_abonos_informe() {
        $this->load_view('informes/listar_abonos_informe', $this->data);
    }

    public function listar_abonos_informe_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $abonos = $this->app_model->get_abonos();
        $estados = $this->app_model->get_estados();

        if ($abonos) {
            foreach ($abonos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-info";
                    $texto = "Activado";
                elseif ($value['idEstado'] == 2):
                    $class = "btn-success";
                    $texto = "Pausado";
                elseif ($value['idEstado'] == 3):
                    $class = "btn-danger";
                    $texto = "Terminado";
                else:
                    $class = "btn-warning";
                    $texto = "Sin Estado";
                endif;

                $opcion = '<div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '</div>';

                $dato[] = array(
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVtoCobro'],
                    $value['nombEmpresa'],
                    $value['descripModalidad'],
                    $value['ventasCreadas'],
                    "$" . number_format($value['total'] + $value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    $value['nombreVend'],
                    "DT_RowId" => $value['idAbono']
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

    public function listar_abonos_informe_table_filtro($desde, $hasta) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $abonos = $this->app_model->get_abonos_desde_hasta($desde, $hasta);
        $estados = $this->app_model->get_estados();

        if ($abonos) {
            foreach ($abonos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-info";
                    $texto = "Activado";
                elseif ($value['idEstado'] == 2):
                    $class = "btn-success";
                    $texto = "Pausado";
                elseif ($value['idEstado'] == 3):
                    $class = "btn-danger";
                    $texto = "Terminado";
                else:
                    $class = "btn-warning";
                    $texto = "Sin Estado";
                endif;

                $opcion = '<div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '</div>';

                $dato[] = array(
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVtoCobro'],
                    $value['nombEmpresa'],
                    $value['descripModalidad'],
                    $value['ventasCreadas'],
                    "$" . number_format($value['total'] + $value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    $value['nombreVend'],
                    "DT_RowId" => $value['idAbono']
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

    public function exportar_to_excel_abonos() {
        $this->load->helper('mysql_to_excel_helper');

//        //--- tomar datos del post ---//
        $fechaDesde = $this->input->post('fechaI_informeAbono', true);
        $fechaHasta = $this->input->post('fechaF_informeAbono', true);

        //--- fecha actual ---//
        $hoy = getdate();
        $fechaActual = $hoy['mday'] . $hoy['mon'] . $hoy['year'];

        //--- exportar excel ---//
        //--- verificar si es vacio o no el filtro de fechas ---//
        if ($fechaDesde == 0 && $fechaHasta == 0) {
            to_excel($this->app_model->get_abonos_exportar(), "informeAbonos" . $fechaActual);
        } elseif ($fechaDesde != 0 && $fechaHasta != 0) {
            to_excel($this->app_model->get_abonos_desde_hasta_exportar($fechaDesde, $fechaHasta), "informeGastos" . $fechaActual . "-desde" . $fechaDesde . "-hasta" . $fechaHasta);
        }
    }

    public function ver_abono($idGenAbono = null) {
        $this->data['idGenAbono'] = $idGenAbono;

        $abono = $this->app_model->get_abono_by_idGenAbono($idGenAbono);
        $this->data['abono'] = $abono;

        $this->data['clientes'] = $this->app_model->get_clientes();

        $this->data['categoriasVentas'] = $this->app_model->get_categorias_ventas();

        $this->data['subcategoriasVentasDetalle'] = $this->app_model->get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($abono[0]['idCategoria']);

        $this->data['facturaTipos'] = $this->app_model->get_factura_tipos();

        $this->data['modalidadesAbono'] = $this->app_model->get_abono_modalidades();

        $this->data['ivaTipos'] = $this->app_model->get_iva_tipos();

        $this->data['empresa'] = $this->app_model->get_empresas();

        $this->load_view('abonos/ver_abono', $this->data);
    }

    public function listar_abonos_ver_table($idGenAbono) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $abonos_detalle = $this->app_model->get_detalle_abono_by_idGenAbono($idGenAbono);
        $ivaTipos = $this->app_model->get_iva_tipos();
        $empresa = $this->app_model->get_empresas();
        if ($abonos_detalle) {
            foreach ($abonos_detalle as $key => $value) {

                $idGenAbono = "'" . $value['idGenAbono'] . "'";

                $opcines_iva = "";

                if (isset($ivaTipos)):
                    for ($j = 0; $j < count($ivaTipos); $j++) :
                        if ($ivaTipos[$j]['valorIva'] == $value['iva']):
                            $opcines_iva .= '<option selected value="' . $ivaTipos[$j]['valorIva'] . '">' . $ivaTipos[$j]['descripcion'] . '</option>';
                        else:
                            $opcines_iva .= '<option value="' . $ivaTipos[$j]['valorIva'] . '">' . $ivaTipos[$j]['descripcion'] . '</option>';
                        endif;
                    endfor;
                endif;

                //--- control de stock ---//
                $cantidad = "";
                if ($empresa[0]['stock'] == 0) {
                    $cantidad = '<input type="text" value="' . $value["cantidad"] . '" id="cantProd' . $value["idProducto"] . '" onkeyup="calculoAbonoEditar(' . $value["idProducto"] . ',' . $value["stock"] . ',' . $value["cantidad"] . ',' . $empresa[0]['stock'] . ')" class="form-control" disabled>';
                } elseif ($empresa[0]['stock'] == 1) {
                    $cantidad = '<input type="text" value="' . $value["cantidad"] . '" id="cantProd' . $value["idProducto"] . '"  onkeyup="calculoAbonoEditar(' . $value["idProducto"] . ',' . $value["stock"] . ',' . $value["cantidad"] . ',' . $empresa[0]['stock'] . ')" class="form-control" disabled>';
                }

                $dato[] = array(
                    $value["idProducto"],
                    $value['codigo'],
                    $value['nombre'],
                    $cantidad,
                    $value['stock'],
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["precio"] . '" id="precioProd' . $value["idProducto"] . '"class="form-control" disabled >' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">%</span>' .
                    '<input type="text" value="' . $value["descuento"] . '" id="descProd' . $value["idProducto"] . '" onkeyup="calculoAbonoEditar(' . $value["idProducto"] . ',' . $empresa[0]["stock"] . ')" class="form-control" disabled>' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["subTotal"] . '" id="subTotalProd' . $value["idProducto"] . '" readonly class="form-control">' .
                    '</div>',
                    '<select id="selectIva' . $value["idProducto"] . '" onchange="calculoAbonoEditar(' . $value["idProducto"] . ',' . $empresa[0]["stock"] . ')" class="select-full" required disabled>
                        <option value="0">IVA</option>' .
                    $opcines_iva .
                    '</select>',
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

}
