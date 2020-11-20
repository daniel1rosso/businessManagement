<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Informes extends MY_Controller {

    protected $data = array(
        'active' => 'informes'
    );

    public function __construct() {
        parent::__construct();
    }

    public function listar_cte_clientes() {
        $this->data['clientes'] = $this->app_model->get_clientes();

        $this->load_view('informes/listar_cte_clientes', $this->data);
    }

    public function listar_cte_clientes_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $cta_corrienteTotal = $this->app_model->get_estado_cuenta_corriente_total();

        if (!empty($cta_corrienteTotal)) {
            foreach ($cta_corrienteTotal as $key => $value) {
                //--- Obtencion de datos necesarios para el llenado de la tabla ---//
                $cliente = $this->app_model->get_cliente_byIdCliente($value['idCliente']);
                $ingreso = $this->app_model->get_ingreso_by_idGenIngreso($value['idGenIngreso']);

                $fecha_cobro = strtotime($value['fechaCobro']);
                $fecha_cobro = date("d/m/Y", $fecha_cobro);

                if ($value['idMedioCobro'] > 0) {
                    $caja = $this->app_model->get_caja_by_idCuenta($value['idMedioCobro']);
                    $cuenta = $caja[0]['descripcion'];

                    $puntoVenta = $this->app_model->get_punto_by_idPtoVenta($caja[0]['idPtoVenta']);
                    $numeroPtoVta = $puntoVenta[0]['numeroPtoVta'];

                    $idCuentaCorriente = $value['idCuentaCorriente'];
                    $idGenComprobante = $value['idGenComprobante'];
                } else {
                    $numeroPtoVta = "- |";
                    $idCuentaCorriente = '-';
                    $cuenta = "-";
                }

                if (!empty($value['idGenComprobante'])):
                    $opcionComprobante = '<a target="_blank" href="../uploads/comprobantes/cobro/' . $value['idGenIngreso'] . '/' . $idGenComprobante . '.pdf">' .
                            $numeroPtoVta . '-' . $idCuentaCorriente .
                            '</a>';
                else:
                    $opcionComprobante = "-";
                endif;
                //--- Fin de la obtencion de los datos ---//

                $dato[] = array(
                    $value['idCuentaCorriente'],
                    $fecha_cobro,
                    $cliente[0]['nombEmpresa'],
                    "$" . number_format($value['debito'], 2, ",", "."),
                    "$" . number_format($value['credito'], 2, ",", "."),
                    "$" . number_format($ingreso[0]['total'], 2, ",", "."),
                    "$" . number_format($value['saldo'], 2, ",", "."),
                    $opcionComprobante,
                    $cuenta,
                    $value['descripcion'],
                    "DT_RowId" => $value['idCuentaCorriente']
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

    public function listar_cte_clientes_table_filtro_date($fechaDesde = null, $fechaHasta = null, $idCliente = null) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        
        if ($idCliente == 0 && $fechaDesde != '' && $fechaHasta != ''){
            $cta_corrienteTotal = $this->app_model->get_estado_cuenta_corriente_total_by_desde_hasta($fechaDesde, $fechaHasta);
        } else {
            $cta_corrienteTotal = $this->app_model->get_estado_cuenta_corriente_total_by_desde_hasta_idCliente($fechaDesde, $fechaHasta, $idCliente);
        }

        if (!empty($cta_corrienteTotal)) {
            foreach ($cta_corrienteTotal as $key => $value) {
                //--- Obtencion de datos necesarios para el llenado de la tabla ---//
                $cliente = $this->app_model->get_cliente_byIdCliente($value['idCliente']);
                $ingreso = $this->app_model->get_ingreso_by_idGenIngreso($value['idGenIngreso']);
                                
                $fecha_cobro = strtotime($value['fechaCobro']);
                $fecha_cobro = date("d/m/Y", $fecha_cobro);

                if ($value['idMedioCobro'] > 0) {
                    $caja = $this->app_model->get_caja_by_idCuenta($value['idMedioCobro']);
                    $cuenta = $caja[0]['descripcion'];

                    $puntoVenta = $this->app_model->get_punto_by_idPtoVenta($caja[0]['idPtoVenta']);
                    if ($puntoVenta) {
                        $numeroPtoVta = $puntoVenta[0]['numeroPtoVta'];
                    }
                    $idCuentaCorriente = $value['idCuentaCorriente'];
                    $idGenComprobante = $value['idGenComprobante'];
                } else {
                    $numeroPtoVta = "- |";
                    $idCuentaCorriente = '-';
                    $cuenta = "-";
                }

                if (!empty($value['idGenComprobante'])):
                    $opcionComprobante = '<a target="_blank" href="../uploads/comprobantes/cobro/' . $value['idGenIngreso'] . '/' . $idGenComprobante . '.pdf">' .
                            $numeroPtoVta . '-' . $idCuentaCorriente .
                            '</a>';
                else:
                    $opcionComprobante = "-";
                endif;
                //--- Fin de la obtencion de los datos ---//

                $dato[] = array(
                    $value['idCuentaCorriente'],
                    $fecha_cobro,
                    $cliente[0]['nombEmpresa'],
                    "$" . number_format($value['debito'], 2, ",", "."),
                    "$" . number_format($value['credito'], 2, ",", "."),
                    "$" . number_format($ingreso[0]['total'], 2, ",", "."),
                    "$" . number_format($value['saldo'], 2, ",", "."),
                    $opcionComprobante,
                    $cuenta,
                    $value['descripcion'],
                    "DT_RowId" => $value['idCuentaCorriente']
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

    public function listar_cte_clientes_table_filtro($idCliente) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $cta_corrienteTotal = $this->app_model->get_estado_cuenta_corriente_total_by_idCliente($idCliente);

        if (!empty($cta_corrienteTotal)) {
            foreach ($cta_corrienteTotal as $key => $value) {
                //--- Obtencion de datos necesarios para el llenado de la tabla ---//
                $cliente = $this->app_model->get_cliente_byIdCliente($value['idCliente']);
                $ingreso = $this->app_model->get_ingreso_by_idGenIngreso($value['idGenIngreso']);

                $fecha_cobro = strtotime($value['fechaCobro']);
                $fecha_cobro = date("d/m/Y", $fecha_cobro);

                if ($value['idMedioCobro'] > 0) {
                    $caja = $this->app_model->get_caja_by_idCuenta($value['idMedioCobro']);
                    $cuenta = $caja[0]['descripcion'];

                    $puntoVenta = $this->app_model->get_punto_by_idPtoVenta($caja[0]['idPtoVenta']);
                    $numeroPtoVta = $puntoVenta[0]['numeroPtoVta'];

                    $idCuentaCorriente = $value['idCuentaCorriente'];
                    $idGenComprobante = $value['idGenComprobante'];
                } else {
                    $numeroPtoVta = "- |";
                    $idCuentaCorriente = '-';
                    $cuenta = "-";
                }

                if (!empty($value['idGenComprobante'])):
                    $opcionComprobante = '<a target="_blank" href="../uploads/comprobantes/cobro/' . $value['idGenIngreso'] . '/' . $idGenComprobante . '.pdf">' .
                            $numeroPtoVta . '-' . $idCuentaCorriente .
                            '</a>';
                else:
                    $opcionComprobante = "-";
                endif;
                //--- Fin de la obtencion de los datos ---//

                $dato[] = array(
                    $value['idCuentaCorriente'],
                    $fecha_cobro,
                    $cliente[0]['nombEmpresa'],
                    "$" . number_format($value['debito'], 2, ",", "."),
                    "$" . number_format($value['credito'], 2, ",", "."),
                    "$" . number_format($ingreso[0]['total'], 2, ",", "."),
                    "$" . number_format($value['saldo'], 2, ",", "."),
                    $opcionComprobante,
                    $cuenta,
                    $value['descripcion'],
                    "DT_RowId" => $value['idCuentaCorriente']
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

    public function totales_cte_clientes($idCliente, $fechaDesde, $fechaHasta) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        $totalACobrar = 0;
        $totalCobrado = 0;
        $totalVenta = 0;
        $cta_corriente_clientes = false;
        if ($idCliente == 0 && $fechaDesde == '' && $fechaHasta == '' ) {
            $cta_corriente_clientes = $this->app_model->get_estado_cuenta_corriente_total();
        } elseif ($idCliente != 0 && $fechaDesde == '' && $fechaHasta == '' ) {
            $cta_corriente_clientes = $this->app_model->get_estado_cuenta_corriente_total_by_idCliente($idCliente);
        } elseif ($idCliente != 0 && $fechaDesde == 0 && $fechaHasta == 0 ) {
            $cta_corriente_clientes = $this->app_model->get_estado_cuenta_corriente_total_by_idCliente($idCliente);
        } elseif ($idCliente == 0 && $fechaDesde != '' && $fechaHasta != '' ) {
            $cta_corriente_clientes = $this->app_model->get_estado_cuenta_corriente_total_by_desde_hasta($fechaDesde, $fechaHasta);
        } elseif ($idCliente != 0 && $fechaDesde != '' && $fechaHasta != '' ) {
            $cta_corriente_clientes = $this->app_model->get_estado_cuenta_corriente_total_by_desde_hasta_idCliente($fechaDesde, $fechaHasta, $idCliente);
        }
        if ($cta_corriente_clientes) {
            foreach ($cta_corriente_clientes as $key => $value) {
                $totalACobrar += $value['debito'];
                $totalCobrado += $value['credito'];
            }
        }
        $totalVenta = $totalACobrar;
        $totalACobrar = $totalACobrar - $totalCobrado;
        if ($totalVenta && $totalACobrar) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "totalVenta" => $totalVenta, "totalACobrar" => $totalACobrar, "totalCobrado" => $totalCobrado);
        } else {
            $msg = "Algun total no se obtuvo correspondiente";
            $dato = array("valid" => false, "msg" => $msg, "totalVenta" => $totalVenta, "totalACobrar" => $totalACobrar, "totalCobrado" => $totalCobrado);
        }

        echo json_encode($dato);
    }

    public function totales_cte_clientes_total() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        $totalACobrar = 0;
        $totalCobrado = 0;
        $totalVenta = 0;
        $cta_corriente_clientes = $this->app_model->get_estado_cuenta_corriente_total();
        
        if ($cta_corriente_clientes) {
            foreach ($cta_corriente_clientes as $key => $value) {
                $totalACobrar += $value['debito'];
                $totalCobrado += $value['credito'];
            }
        }
        $totalVenta = $totalACobrar;
        $totalACobrar = $totalACobrar - $totalCobrado;
        if ($totalVenta && $totalACobrar) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "totalVenta" => $totalVenta, "totalACobrar" => $totalACobrar, "totalCobrado" => $totalCobrado);
        } else {
            $msg = "Algun total no se obtuvo correspondiente";
            $dato = array("valid" => false, "msg" => $msg, "totalVenta" => $totalVenta, "totalACobrar" => $totalACobrar, "totalCobrado" => $totalCobrado);
        }

        echo json_encode($dato);
    }

    public function exportar_to_excel_cte_clientes() {
        $this->load->helper('mysql_to_excel_helper');

        //--- tomar datos del post ---//
        $fechaDesde = $this->input->post('fechaI_informeCteClientes', true);
        $fechaHasta = $this->input->post('fechaF_informeCteClientes', true);
        $selectClienteCte = $this->input->post('selectClienteCte_informeCteClientes', true);
        
        //--- fecha actual ---//
        $hoy = getdate();
        $fechaActual = $hoy['mday'] . $hoy['mon'] . $hoy['year'];

        //--- exportar excel ---//
        //--- verificar si es vacio o no el filtro de fechas ---//
        if ($fechaDesde == 0 && $fechaHasta == 0 && $selectClienteCte == 0) {
            to_excel($this->app_model->get_cuentas_corrientes_cliente_exportar(), "informeCteClientes" . $fechaActual);
        } elseif ($selectClienteCte != 0 && $fechaDesde == 0 && $fechaHasta == 0 ) {
            to_excel($this->app_model->get_cuentas_corrientes_cliente_exportar_by_idCliente($selectClienteCte), "informeCteClientes" . $fechaActual . "-idCliente" . $selectClienteCte);
        } elseif ($fechaDesde != 0 && $fechaHasta != 0 && $selectClienteCte == 0) {
            to_excel($this->app_model->get_cuentas_corrientes_cliente_exportar_by_desde_hasta($fechaDesde, $fechaHasta), "informeCteClientes" . $fechaActual . "-desde" . $fechaDesde . "-hasta" . $fechaHasta);
        } elseif ($fechaDesde != 0 && $fechaHasta != 0 && $selectClienteCte != 0) {
            to_excel($this->app_model->get_cuentas_corrientes_cliente_exportar_by_desde_hasta_idCliente($fechaDesde, $fechaHasta, $selectClienteCte), "informeCteClientes" . $fechaActual . "-desde" . $fechaDesde . "-hasta" . $fechaHasta . "-idCliente" . $selectClienteCte);
        }
    }

    public function get_cuenta_cte_by_idCliente() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $idCliente = $this->input->post('idCliente', true);

            if ($idCliente != "") {
                //--- Obtengo estado de cuenta de esa deuda puntual ---//
                $cta_corrienteTotal = $this->app_model->get_estado_cuenta_corriente_by_idCliente($idCliente);
            } elseif ($idCliente == "") {
                $cta_corrienteTotal = $this->app_model->get_estado_cuenta_corriente_total();
            }
            if ($cta_corrienteTotal) {
                foreach ($cta_corrienteTotal as $key => $value) {
                    $cta_corriente[$key]['idCuentaCorriente'] = $value['idCuentaCorriente'];
                    $cliente = $this->app_model->get_cliente_byIdCliente($value['idCliente']);
                    $cta_corriente[$key]['nombEmpresa'] = $cliente[0]['nombEmpresa'];
                    $cta_corriente[$key]['idGenComprobante'] = $value['idGenComprobante'];
                    $cta_corriente[$key]['idGenIngreso'] = $value['idGenIngreso'];
                    $ingreso = $this->app_model->get_ingreso_by_idGenIngreso($value['idGenIngreso']);
                    $cta_corriente[$key]['total'] = $ingreso[0]['total'];
                    $cta_corriente[$key]['debito'] = $value['debito'];
                    $cta_corriente[$key]['credito'] = $value['credito'];
                    $cta_corriente[$key]['nombPdf'] = $value['nombPdf'];
                    if ($value['idMedioCobro'] > 0) {
                        $caja = $this->app_model->get_caja_by_idCuenta($value['idMedioCobro']);
                        $cta_corriente[$key]['cuenta'] = $caja[0]['descripcion'];

                        $puntoVenta = $this->app_model->get_punto_by_idPtoVenta($caja[0]['idPtoVenta']);
                        $cta_corriente[$key]['numeroPtoVta'] = $puntoVenta[0]['numeroPtoVta'];

                        $cta_corriente[$key]['idCuentaCorrientePdf'] = $value['idCuentaCorriente'];
                    } else {
                        $cta_corriente[$key]['numeroPtoVta'] = "- |";
                        $cta_corriente[$key]['idCuentaCorrientePdf'] = '-';
                        $cta_corriente[$key]['cuenta'] = "-";
                    }
                    $cta_corriente[$key]['saldo'] = $value['saldo'];
                    $cta_corriente[$key]['descripcion'] = $value['descripcion'];
                    $cta_corriente[$key]['fechaCobro'] = $value['fechaCobro'];
                    $cta_corriente[$key]['fechaAlta'] = $value['fechaAlta'];
                }
                $debito = 0;
                $credito = 0;
                $totalVentas = 0;
                foreach ($cta_corrienteTotal as $key => $value) {
                    $debito += $value['debito'];
                    $credito += $value['credito'];
//                        if ($value['descripcion']) {
//                            $totalVentas += $debito;
//                        }
                }
            } else {
                $cta_corriente = [];
                $debito = 0;
                $credito = 0;
                $totalVentas = 0;
            }

            $adeudado = $debito - $credito;

            if ($cta_corriente) {
                $msg = "Ok";
                $dato = array("valid" => true, "msg" => $msg, "cta_corriente" => $cta_corriente, "adeudado" => $adeudado, "totalVentas" => $debito, "cobrado" => $credito);
            } else {
                $msg = "No se ha encontrado ningun registro con ese id";
                $dato = array("valid" => false, "msg" => $msg, "adeudado" => $adeudado, "totalVentas" => $debito, "cobrado" => $credito);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function listar_cte_proveedores() {
        $this->data['proveedores'] = $this->app_model->get_proveedores();

        $this->load_view('informes/listar_cte_proveedores', $this->data);
    }

    public function listar_cte_proveedores_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $cta_corriente_proveedores = $this->app_model->get_estado_cuenta_corriente_proveedor_total();

        if (!empty($cta_corriente_proveedores)) {
            foreach ($cta_corriente_proveedores as $key => $value) {
                //--- Obtencion de datos necesarios para el llenado de la tabla ---//
                $proveedor = $this->app_model->get_proveedor_byId($value['idProveedor']);
                $egreso = $this->app_model->get_egreso_by_idGenEgreso($value['idGenEgreso']);

                $fecha_pago = strtotime($value['fechaPago']);
                $fecha_pago = date("d/m/Y", $fecha_pago);

                if ($value['idMedioPago'] > 0) {
                    $caja = $this->app_model->get_caja_by_idCuenta($value['idMedioPago']);
                    $cuenta = $caja[0]['descripcion'];

                    $puntoVenta = $this->app_model->get_punto_by_idPtoVenta($caja[0]['idPtoVenta']);
                    $numeroPtoVta = $puntoVenta[0]['numeroPtoVta'];

                    $idCuentaCorriente = $value['idCuentaCorriente'];
                    $idGenComprobante = $value['idGenComprobante'];
                } else {
                    $numeroPtoVta = "- |";
                    $idCuentaCorriente = '-';
                    $cuenta = "-";
                }

                if (!empty($value['idGenComprobante'])):
                    $opcionComprobante = '<a target="_blank" href="../uploads/comprobantes/pago/' . $value['idGenEgreso'] . '/' . $idGenComprobante . '.pdf">' .
                            $numeroPtoVta . '-' . $idCuentaCorriente .
                            '</a>';
                else:
                    $opcionComprobante = "-";
                endif;
                //--- Fin de la obtencion de los datos ---//

                $dato[] = array(
                    $value['idCuentaCorriente'],
                    $fecha_pago,
                    $proveedor[0]['nombEmpresa'],
                    "$" . number_format($value['aPagar'], 2, ",", "."),
                    "$" . number_format($value['pague'], 2, ",", "."),
                    "$" . number_format($egreso[0]['total'], 2, ",", "."),
                    "$" . number_format($value['saldo'], 2, ",", "."),
                    $opcionComprobante,
                    $cuenta,
                    $value['descripcion'],
                    "DT_RowId" => $value['idCuentaCorriente']
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

    public function listar_cte_proveedores_table_filtro($idProveedor) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $cta_corriente_proveedores = $this->app_model->get_estado_cuenta_corriente_proveedor_total_by_idProveedor($idProveedor);

        if (!empty($cta_corriente_proveedores)) {
            foreach ($cta_corriente_proveedores as $key => $value) {
                //--- Obtencion de datos necesarios para el llenado de la tabla ---//
                $proveedor = $this->app_model->get_proveedor_byId($value['idProveedor']);
                $egreso = $this->app_model->get_egreso_by_idGenEgreso($value['idGenEgreso']);

                $fecha_pago = strtotime($value['fechaPago']);
                $fecha_pago = date("d/m/Y", $fecha_pago);

                if ($value['idMedioPago'] > 0) {
                    $caja = $this->app_model->get_caja_by_idCuenta($value['idMedioPago']);
                    $cuenta = $caja[0]['descripcion'];

                    $puntoVenta = $this->app_model->get_punto_by_idPtoVenta($caja[0]['idPtoVenta']);
                    $numeroPtoVta = $puntoVenta[0]['numeroPtoVta'];

                    $idCuentaCorriente = $value['idCuentaCorriente'];
                    $idGenComprobante = $value['idGenComprobante'];
                } else {
                    $numeroPtoVta = "- |";
                    $idCuentaCorriente = '-';
                    $cuenta = "-";
                }

                if (!empty($value['idGenComprobante'])):
                    $opcionComprobante = '<a target="_blank" href="../uploads/comprobantes/pago/' . $value['idGenEgreso'] . '/' . $idGenComprobante . '.pdf">' .
                            $numeroPtoVta . '-' . $idCuentaCorriente .
                            '</a>';
                else:
                    $opcionComprobante = "-";
                endif;
                //--- Fin de la obtencion de los datos ---//

                $dato[] = array(
                    $value['idCuentaCorriente'],
                    $fecha_pago,
                    $proveedor[0]['nombEmpresa'],
                    "$" . number_format($value['aPagar'], 2, ",", "."),
                    "$" . number_format($value['pague'], 2, ",", "."),
                    "$" . number_format($egreso[0]['total'], 2, ",", "."),
                    "$" . number_format($value['saldo'], 2, ",", "."),
                    $opcionComprobante,
                    $cuenta,
                    $value['descripcion'],
                    "DT_RowId" => $value['idCuentaCorriente']
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

    public function listar_cte_proveedores_table_filtro_date($fechaDesde, $fechaHasta, $idProveedor) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        if ($idProveedor == 0) {
            $cta_corriente_proveedores = $this->app_model->get_estado_cuenta_corriente_proveedor_total_desde_hasta($fechaDesde, $fechaHasta);
        } else {
            $cta_corriente_proveedores = $this->app_model->get_estado_cuenta_corriente_proveedor_total_desde_hasta_idProveedor($fechaDesde, $fechaHasta, $idProveedor);
        }

        if (!empty($cta_corriente_proveedores)) {
            foreach ($cta_corriente_proveedores as $key => $value) {
                //--- Obtencion de datos necesarios para el llenado de la tabla ---//
                $proveedor = $this->app_model->get_proveedor_byId($value['idProveedor']);
                $egreso = $this->app_model->get_egreso_by_idGenEgreso($value['idGenEgreso']);

                $fecha_pago = strtotime($value['fechaPago']);
                $fecha_pago = date("d/m/Y", $fecha_pago);

                if ($value['idMedioPago'] > 0) {
                    $caja = $this->app_model->get_caja_by_idCuenta($value['idMedioPago']);
                    $cuenta = $caja[0]['descripcion'];

                    $puntoVenta = $this->app_model->get_punto_by_idPtoVenta($caja[0]['idPtoVenta']);
                    $numeroPtoVta = $puntoVenta[0]['numeroPtoVta'];

                    $idCuentaCorriente = $value['idCuentaCorriente'];
                    $idGenComprobante = $value['idGenComprobante'];
                } else {
                    $numeroPtoVta = "- |";
                    $idCuentaCorriente = '-';
                    $cuenta = "-";
                }

                if (!empty($value['idGenComprobante'])):
                    $opcionComprobante = '<a target="_blank" href="../uploads/comprobantes/pago/' . $value['idGenEgreso'] . '/' . $idGenComprobante . '.pdf">' .
                            $numeroPtoVta . '-' . $idCuentaCorriente .
                            '</a>';
                else:
                    $opcionComprobante = "-";
                endif;
                //--- Fin de la obtencion de los datos ---//

                $dato[] = array(
                    $value['idCuentaCorriente'],
                    $fecha_pago,
                    $proveedor[0]['nombEmpresa'],
                    "$" . number_format($value['aPagar'], 2, ",", "."),
                    "$" . number_format($value['pague'], 2, ",", "."),
                    "$" . number_format($egreso[0]['total'], 2, ",", "."),
                    "$" . number_format($value['saldo'], 2, ",", "."),
                    $opcionComprobante,
                    $cuenta,
                    $value['descripcion'],
                    "DT_RowId" => $value['idCuentaCorriente']
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

    public function totales_cte_proveedores($fechaDesde, $fechaHasta, $idProveedor) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Declaracion de variables ---//
        $totalAPagar = 0;
        $totalPagado = 0;
        $totalComprado = 0;
        
        if ($idProveedor == 0 && $fechaDesde == '' && $fechaHasta == '' ) {
            $cta_corriente_proveedores = $this->app_model->get_estado_cuenta_corriente_proveedor_total();
        } elseif ($idProveedor != 0 && $fechaDesde == '' && $fechaHasta == '' ) {
            $cta_corriente_proveedores = $this->app_model->get_estado_cuenta_corriente_proveedor_total_by_idProveedor($idProveedor);
        } elseif ($idProveedor != 0 && $fechaDesde == 0 && $fechaHasta == 0 ) {
            $cta_corriente_proveedores = $this->app_model->get_estado_cuenta_corriente_proveedor_total_by_idProveedor($idProveedor);
        } elseif ($idProveedor == 0 && $fechaDesde != '' && $fechaHasta != '' ) {
            $cta_corriente_proveedores = $this->app_model->get_estado_cuenta_corriente_proveedor_total_desde_hasta($fechaDesde, $fechaHasta);
        } elseif ($idProveedor != 0 && $fechaDesde != '' && $fechaHasta != '' ) {
            $cta_corriente_proveedores = $this->app_model->get_estado_cuenta_corriente_proveedor_total_desde_hasta_idProveedor($fechaDesde, $fechaHasta, $idProveedor);
        }

        if ($cta_corriente_proveedores) {
            foreach ($cta_corriente_proveedores as $key => $value) {
                $totalAPagar += $value['aPagar'];
                $totalPagado += $value['pague'];
            }
        }
        $totalComprado = $totalAPagar;
        $totalAPagar = $totalAPagar - $totalPagado;
        if ($totalAPagar != 0 && $totalComprado != 0) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "totalComprado" => $totalComprado, "totalAPagar" => $totalAPagar, "totalPagado" => $totalPagado);
        } else {
            $msg = "Algun total no se obtuvo correspondiente";
            $dato = array("valid" => false, "msg" => $msg, "totalComprado" => $totalComprado, "totalAPagar" => $totalAPagar, "totalPagado" => $totalPagado);
        }

        echo json_encode($dato);
    }

    public function totales_cte_proveedores_total() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        $totalAPagar = 0;
        $totalPagado = 0;
        $totalComprado = 0;
        $cta_corriente_proveedores = $this->app_model->get_estado_cuenta_corriente_proveedor_total();
        
        if ($cta_corriente_proveedores) {
            foreach ($cta_corriente_proveedores as $key => $value) {
                $totalAPagar += $value['aPagar'];
                $totalPagado += $value['pague'];
            }
        }
        $totalComprado = $totalAPagar;
        $totalAPagar = $totalAPagar - $totalPagado;
        if ($totalAPagar && $totalComprado) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "totalAPagar" => $totalAPagar, "totalPagado" => $totalPagado, "totalComprado" => $totalComprado);
        } else {
            $msg = "Algun total no se obtuvo correspondiente";
            $dato = array("valid" => false, "msg" => $msg, "totalAPagar" => $totalAPagar, "totalPagado" => $totalPagado, "totalComprado" => $totalComprado);
        }

        echo json_encode($dato);
    }

    public function exportar_to_excel_cte_proveedores() {
        $this->load->helper('mysql_to_excel_helper');

        //--- tomar datos del post ---//
        $fechaDesde = $this->input->post('fechaI_informeCteProveedores', true);
        $fechaHasta = $this->input->post('fechaF_informeCteProveedores', true);
        $selectProveedorCte = $this->input->post('selectProveedorCte_informeCteProveedores', true);

        //--- fecha actual ---//
        $hoy = getdate();
        $fechaActual = $hoy['mday'] . $hoy['mon'] . $hoy['year'];

        //--- exportar excel ---//
        //--- verificar si es vacio o no el filtro de fechas ---//
        if ($fechaDesde == 0 && $fechaHasta == 0 && $selectProveedorCte == 0) {
            to_excel($this->app_model->get_cuentas_corrientes_proveedores_exportar(), "informeCteClientes" . $fechaActual);
        } elseif ($selectProveedorCte != 0 && $fechaDesde == 0 && $fechaHasta == 0) {
            to_excel($this->app_model->get_cuentas_corrientes_proveedores_exportar_by_idProveedor($selectProveedorCte), "informeCteClientes" . $fechaActual . "-idCliente" . $selectProveedorCte);
        } elseif ($selectProveedorCte == 0 && $fechaDesde != 0 && $fechaHasta != 0) {
            to_excel($this->app_model->get_cuentas_corrientes_proveedores_exportar_by_desde_hasta($fechaDesde, $fechaHasta), "informeCteClientes" . $fechaActual . "-desde" . $fechaDesde . "-hasta" . $fechaHasta);
        } elseif ($fechaDesde != 0 && $fechaHasta != 0 && $selectProveedorCte != 0) {
            to_excel($this->app_model->get_cuentas_corrientes_proveedores_exportar_by_desde_hasta_idProveedor($fechaDesde, $fechaHasta, $selectProveedorCte), "informeCteClientes" . $fechaActual . "-desde" . $fechaDesde . "-hasta" . $fechaHasta . "-idCliente" . $selectProveedorCte);
        }
    }

}
