<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ventas extends MY_Controller
{
    protected $data = array(
        'active' => 'ingresos'
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function listar_ventas_table()
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $ingresos = $this->app_model->get_ingresos();
        $estados = $this->app_model->get_estados();

        if ($ingresos) {
            foreach ($ingresos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-success";
                $texto = "Cobrado"; elseif ($value['idEstado'] == 2):
                    $class = "btn-info";
                $texto = "A Cobrar"; elseif ($value['idEstado'] == 3):
                    $class = "btn-danger";
                $texto = "Vencido"; else:
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

                //--- Opcion de facturacion ---//
                if ($facturaIdIngreso) {
                    $factura = '<li><a href="#" onclick=""><i class="icon-binoculars"></i> Ver Factura</a></li>';
                } else {
                    $factura = '<li><a href="#" onclick=""><i class="fas fa-file-invoice-dollar fa-lg"></i> Facturar Venta</a></li>';
                }

                $idGenIngreso = "'" . $value['idGenIngreso'] . "'";
                if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29) {
                    $bloque2 = '<li><a onclick="abrir_nc(' . $idGenIngreso . ')"><i class="icon-notebook"></i> Crear NC</a></li>' .
                            '<li><a onclick="abrir_nd(' . $idGenIngreso . ')"><i class="icon-notebook"></i> Crear ND</a></li>' .
                            '<li><a href="' . base_url() . 'remitos/agregar_remito/' . $value['idGenIngreso'] . '"><i class="icon-newspaper"></i> Crear remito</a></li>' .
                            '<li><a onclick="llenado_tabla_cta_cte_clientes(' . $value['idCliente'] . ')" ><i class="icon-clipboard"></i> Cta Cte</a></li>' .
                            '<li class="divider"></li>' .
                            $factura .
                            '<li><a href="#" onclick="verComprobantesPagos(' . $idGenIngreso . ')"><i class="icon-binoculars"></i> Comprobantes</a></li>' .
                            '<li><a href="' . base_url() . 'notas_credito_debito/nota_credito_debito_venta/' . $value['idGenIngreso'] . '"><i class="icon-binoculars"></i> Detalle</a></li>' .
                            '<li><a href="#" onclick="generarPdfDetalleVenta(' . $idGenIngreso . ')"><i class="icon-binoculars"></i> Ver detalle</a></li>' .
                            '<li><a href="#" onclick="enviarDetalleVenta(' . $idGenIngreso . ')" ><i class="icon-attachment"></i> Enviar detalle</a></li>';
                }

                $opcion = ' <div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                        '<ul class="dropdown-menu icons-right">' .
                        $bloque1 .
                        '<li><a class="tip agregarCobro" onclick="llenado_apertura_agregarCobro(' . $idGenIngreso . ',1)" ><i class="icon-tag5"></i> Agregar cobranza</a></li>' .
                        $bloque2 .
                        '</ul>' .
                        '</div>';

                $categoria = $this->app_model->get_categorias_ventas_byId($value['idCategoria']);

                $dato[] = array(
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVtoCobro'],
                    $value['nombEmpresa'],
                    $categoria[0]['descripcion'],
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

    public function listar_ventas()
    {
        $this->data['tesoreriaCuenta'] = $this->app_model->get_tesoreria_cuentas();

        $this->load_view('ventas/listar_ventas', $this->data);
    }

    public function get_comprobantes_pagos()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        if ($_POST) {
            $idGenIngreso = $this->input->post('idGenIngreso');
            if (!empty($idGenIngreso)) {
                $array = array();
                $array_final = [];

                $cta_corrienteTotal = $this->app_model->get_estado_cuenta_corriente_by_idGenIngreso($idGenIngreso);
                if ($cta_corrienteTotal) {
                    foreach ($cta_corrienteTotal as $key => $value) {
                        $idCuentaCorriente = $value['idCuentaCorriente'];
                        $idGenComprobante = $value['idGenComprobante'];
                        $idGenIngreso = $value['idGenIngreso'];
                        $debito = $value['debito'];
                        $credito = $value['credito'];
                        $nombPdf = $value['nombPdf'];
                        $saldo = $value['saldo'];
                        $nombEmpresa = $value['nombEmpresa'];

                        $fecha_cobro = strtotime($value['fechaCobro']);
                        $fecha_cobro = date("d/m/Y", $fecha_cobro);

                        $ingreso = $this->app_model->get_ingreso_by_idGenIngreso($value['idGenIngreso']);
                        $total = $ingreso[0]['total'];

                        if ($value['idMedioCobro'] > 0) {
                            $caja = $this->app_model->get_caja_by_idCuenta($value['idMedioCobro']);
                            $cuenta = $caja[0]['descripcion'];

                            $puntoVenta = $this->app_model->get_punto_by_idPtoVenta($caja[0]['idPtoVenta']);
                            $numeroPtoVta = $puntoVenta[0]['numeroPtoVta'];

                            $idCuentaCorrientePdf = $value['idCuentaCorriente'];
                        } else {
                            $numeroPtoVta = "- |";
                            $idCuentaCorrientePdf = '-';
                            $cuenta = "-";
                        }

                        $numeroComprobante = $numeroPtoVta . $idCuentaCorrientePdf;

                        $array = array("idCuentaCorriente" => $idCuentaCorriente, "idGenComprobante" => $idGenComprobante, "debito" => $debito, "credito" => $credito, "saldo" => $saldo, "nombPdf" => $nombPdf, "fecha_cobro" => $fecha_cobro, "numeroComprobante" => $numeroComprobante, "idGenIngreso" => $idGenIngreso, "numeroPtoVta" => $numeroPtoVta, "nombEmpresa" => $nombEmpresa, "total" => $total);
                        array_push($array_final, $array);
                    }
                } else {
                    $array_final = false;
                }
                if ($array_final) {
                    $msg = "Ok";
                    $dato = array("valid" => true, "msg" => $msg, "array_final" => $array_final);
                } else {
                    $msg = "No se han encontrado comprobantes de pagos asociados a esta venta.";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Hay algun campo vacio";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function generaPDFcupon($idGenIngreso)
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";
        $result = $this->app_model->get_estado_cuenta_pdf_by_idGenIngreso($idGenIngreso);
        $detalleProductos = $this->app_model->get_detalle_productos_by_idGenIngreso($idGenIngreso);

        //--- datos para generar nuevamente el registro actualizado ---//
        $ingreso = $this->app_model->get_ingresos_by_idGenIngresos($idGenIngreso);
        $facturaIdIngreso = $this->app_model->get_factura_idGenIngreso($idGenIngreso);

        if ($result && $ingreso) {
            //-- NOMBRE Y DIRECTORIO --//
            $directorio = 'uploads/comprobantes/cobro/' . $idGenIngreso;

            if (!is_dir($directorio)) {
                mkdir($directorio, 0777);
            }

            //-- CARGO LIBRERIAS --//
            $this->load->library('html2pdf');

            $this->html2pdf->folder('./uploads/comprobantes/cobro/' . $idGenIngreso . "/");
            $this->html2pdf->filename($result[0]['idGenComprobante'] . ".pdf");
            $this->html2pdf->paper('a4', 'portrait');
           
            $acuTotal = 0;
            $cuerpo = "";

            foreach ($result as $key => $value) {
                //-- FECHA --//
                $fecha_cobro = strtotime($value['fechaCobro']);
                $fecha_cobro = date("d/m/Y", $fecha_cobro);

                //-- FILAS --//
                $cuerpo .= '<tr>
                            <td class="tg-swzm" colspan="2">'. $fecha_cobro .'</td>
                            <td class="tg-swzm" colspan="2">'. $value['cuenta'] .'</td>
                            <td class="tg-swzm" colspan="6">'. $detalleProductos[0]['nombre'] .'</td>
                            <td class="tg-swzm" colspan="2">'. "$" . number_format($value['credito'], 2, ',', '.') .'</td>
                        </tr>';
                
                $acuTotal = $value['credito'] + $acuTotal;
            }
            
            $this->html2pdf->html('
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{font-family:Arial, sans-serif;font-size:7px;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg th{font-family:Arial, sans-serif;font-size:7px;font-weight:normal;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg .tg-704r{border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:left;vertical-align:middle;width: 50%;}
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
                .tg .tg-n21a{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:left;vertical-align:top;font-size:8px;}
                .tg .tg-236u{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:center;vertical-align:middle}
                .tg .tg-0lax{font-size:12px;text-align:left;vertical-align:top;vertical-align:bottom;font-size:5px;}
                .tg .tg-l2oz{font-weight:bold;text-align:right;vertical-align:top;font-size:5px;font-family:"Arial Black", Gadget, sans-serif !important;}
            </style>
            <div style="border: 0.5px solid black;margin: 0 auto;position: absolute;width: 100%;border: 0.5px solid black;">
                <table class="tg" style="width: 100%;" >
                    <tr>
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold"></span></td>
                        <td class="tg-zb0z" colspan="2"><span style="font-weight:bold;font-size:50px;text-align: center;">X</span></td>
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold">RECIBO DE COBRANZA</span></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6"></td>
                        <td class="tg-704r" colspan="6"><br><br>Numero Remito: X' . $result[0]['numeroPtoVta'] . '-' . $result[0]['idCuentaCorriente'] . '<br>Fecha emisión:  ' . substr($result[0]['fechaAlta'], 0, 10) . '<br><br><br></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6">Apllido y Nombre / Razón Social: <br>Condición IVA: <br></td>
                        <td class="tg-704r" colspan="6">CUIT: <br>Domicilio Comercial: <br></td>
                    </tr>
                    <tr>
                        <td  colspan="12">Valores Recibidos</td>
                    </tr>
                    <tr>
                        <td class="tg-r0gd" colspan="2">Fecha</td>
                        <td class="tg-r0gd" colspan="2">Forma de Pago</td>
                        <td class="tg-r0gd" colspan="6">Observación</td>
                        <td class="tg-r0gd" colspan="2">Monto</td>
                    </tr>
                    <!--  Inicio TBODY con esa clase -->
                    <tbody>'.
                            $cuerpo
                            .'
                    </tbody>
                    <!--  FIN TBODY -->
                    <!--  INICIO TFOOD -->
                    <tfoot style="width: 100%; display: table; padding-top:100px;">
                        <tr >
                            <td style="border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:right;" colspan="12">Total: ' . "$" . number_format($acuTotal, 2, ',', '.') . '</td>
                        </tr>
                        <tr >
                            <td style="border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:left;" colspan="12">RECIBIDO<br><br> &nbsp; &nbsp; &nbsp; Firma:.................................... Aclaración:.................................... DNI:.................................... Fecha:....................................</td>
                        </tr>
                    </tfoot>
                    <!--  FIN TFOOD -->
                </table>
            </div>
        ');

            $this->html2pdf->create('save');

            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "nombrePdf" => $result[0]['idGenComprobante'] . ".pdf", "ingreso" => $ingreso, 'facturaIdIngreso' => $facturaIdIngreso, "idCuentaCorriente" => $result[0]['idCuentaCorriente'], 'cuenta_corriente' => $result);
        } else {
            $msg = "No se ha podiado realizar el pdf, esta vacio idGenIngreso";
            $dato = array("valid" => true, "msg" => $msg, 'result' => $result, "ingreso" => $ingreso, 'facturaIdIngreso' => $facturaIdIngreso);
        }

        echo json_encode($dato);
    }

    public function get_categoria_subcategoria_venta()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $idCategoriaVenta = $this->input->post('idCategoriaVenta', true);

        //--- Gasto correspondiente al idGenGasto ---//
        $categoria_venta = $this->app_model->get_categorias_ventas_byId($idCategoriaVenta);

        $subcategorias_venta = $this->app_model->get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($idCategoriaVenta);

        if ($categoria_venta && $subcategorias_venta) {
            $msg = "Categoría y subcategorías de venta obtenido";
            $dato = array("valid" => true, "msg" => $msg, "categoria_venta" => $categoria_venta, "subcategorias_venta" => $subcategorias_venta);
        } else {
            $msg = "Error al Obtener las categorias y subcategorias de venta";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function generaPDFDetalleFactura($idGenIngreso)
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $ingreso = $this->app_model->get_ingreso_clientes_by_idGenIngreso($idGenIngreso);
        if (!$ingreso){
            $ingreso = $this->app_model->get_ingreso_clientes_sindatosfacturacion_by_idGenIngreso($idGenIngreso);
            $tipoDoc = "-";
            $cuit = "-";
            $razonSocial = "-";
            $condicionIva = "-";
        } else {
            $tipoDoc = $ingreso[0]['tipoDoc'];
            $cuit = $ingreso[0]['cuit'];
            $condicionIva = $ingreso[0]['condicionIva'];
            if ($ingreso[0]['razonSocial'] == "") {
                $razonSocial = "-";
            } else {
                $razonSocial = $ingreso[0]['razonSocial'];
            }
        }
        $detalleIngreso = $this->app_model->get_ingreso_detalle_by_idGenIngreso($idGenIngreso);

        if ($ingreso && $detalleIngreso && $idGenIngreso) {
            //-- NOMBRE Y DIRECTORIO --//
            $directorio = 'uploads/comprobantes/ventas/' . $idGenIngreso;

            if (!is_dir($directorio)) {
                mkdir($directorio, 0777);
            }

            $nombreArchivo = $idGenIngreso . date("YmdHis");

            //-- CARGO LIBRERIAS --//
            $this->load->library('html2pdf');

            $this->html2pdf->folder('./uploads/comprobantes/ventas/' . $idGenIngreso . "/");
            $this->html2pdf->filename($nombreArchivo . ".pdf");
            $this->html2pdf->paper('a4', 'portrait');

            //-- DATOS TABLA --//
            $acuTotal = 0;
            $cuerpo = "";
            foreach ($detalleIngreso as $key => $value) {
                //-- FILAS --//
                $operacion = $value['subTotal'] + ($value['subTotal'] * $value['iva']);

                $cuerpo .= '<tr>
                            <td class="tg-swzm" colspan="1">'. utf8_decode($value['codigo']) .'</td>
                            <td class="tg-swzm" colspan="3">'. utf8_decode($value['nombre']) .'</td>
                            <td class="tg-swzm" colspan="1">'. $value['cantidad'] .'</td>
                            <td class="tg-swzm" colspan="1">'. "$" . number_format($value['precio'], 2, ',', '.') .'</td>
                            <td class="tg-swzm" colspan="1">'. $value['descuento'] . "%" .'</td>
                            <td class="tg-swzm" colspan="1">'. "$" . number_format($value['subTotal'], 2, ',', '.') .'</td>
                            <td class="tg-swzm" colspan="2">'. $value['ivaText'] .'</td>
                            <td class="tg-swzm" colspan="2">'. "$" . number_format($operacion, 2, ',', '.') .'</td>
                        </tr>';
            }
                        
            if ($ingreso[0]['domicilio'] == "") {
                $domicilio = "-";
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] == "" && $ingreso[0]['dpto'] == "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso -" . " dpto -";
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] != "" && $ingreso[0]['dpto'] == "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso " . $ingreso[0]['piso'] . " dpto -";
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] == "" && $ingreso[0]['dpto'] != "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso -" . " dpto " . $ingreso[0]['dpto'];
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] != "" && $ingreso[0]['dpto'] != "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso " . $ingreso[0]['piso'] . " dpto " . $ingreso[0]['dpto'];
            }
            
            $this->html2pdf->html('
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{font-family:Arial, sans-serif;font-size:7px;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg th{font-family:Arial, sans-serif;font-size:7px;font-weight:normal;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg .tg-704r{border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:left;vertical-align:middle;width: 50%;}
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
                .tg .tg-n21a{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:left;vertical-align:top;font-size:8px;}
                .tg .tg-236u{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:center;vertical-align:middle}
                .tg .tg-0lax{font-size:12px;text-align:left;vertical-align:top;vertical-align:bottom;font-size:5px;}
                .tg .tg-l2oz{font-weight:bold;text-align:right;vertical-align:top;font-size:5px;font-family:"Arial Black", Gadget, sans-serif !important;}
            </style>
            <div style="border: 0.5px solid black;margin: 0 auto;position: absolute;width: 100%;border: 0.5px solid black;" colspan="12" >
                <table class="tg" style="width: 100%;">
                    <tr>
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold"></span></td>
                        <td class="tg-zb0z" colspan="2"><span style="font-weight:bold;font-size:50px;text-align: center;">X</span></td>
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold">DETALLE VENTA</span></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6"></td>
                        <td class="tg-704r" colspan="6"><br><br>Fecha emisión:  ' . date("d/m/Y") . '<br><br><br></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="12">Fecha Vencimiento: ' . date("d/m/Y", ($ingreso[0]['fechaVtoCobro']) ? strtotime($ingreso[0]['fechaVtoCobro']) : "-") . '</td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6">Razón Social: ' . (($razonSocial) ? utf8_decode($razonSocial) : "-") . '<br>Nombre: ' . (($ingreso[0]['nombreCliente']) ? utf8_decode($ingreso[0]['nombreCliente']) : "-") . '<br>Apellido: ' . (($ingreso[0]['apellidoCliente']) ? utf8_decode($ingreso[0]['apellidoCliente']) : "-") . '<br>Celular: ' . (($ingreso[0]['cel']) ? $ingreso[0]['cel'] : "-") . '<br>Domicilio: ' . ((utf8_decode($domicilio)) ? utf8_decode($domicilio) : "-") . '</td>
                        <td class="tg-704r" colspan="6">' . (($ingreso) ? (($tipoDoc) ? $tipoDoc : "-") : "-") . ': ' . (($ingreso) ? (($cuit) ? $cuit : "-") : "-") . '<br>Condición Iva: ' . (($ingreso) ? (($condicionIva) ? $condicionIva : "-") : "-") . '<br>Categoría: ' . ((utf8_decode($ingreso[0]['categoria'])) ? utf8_decode($ingreso[0]['categoria']) : "-") . '<br>Vendedor: ' . (($ingreso[0]['apellidoVend'] AND $ingreso[0]['nombreVend']) ? $ingreso[0]['apellidoVend'] . ", " . $ingreso[0]['nombreVend'] : "-") . '</td>
                    </tr>
                    <tr>
                        <td class="tg-r0gd" colspan="1">Código</td>
                        <td class="tg-r0gd" colspan="3">Descripción</td>
                        <td class="tg-r0gd" colspan="1">Cant.</td>
                        <td class="tg-r0gd" colspan="1">Precio Unit.</td>
                        <td class="tg-r0gd" colspan="1">Descuento</td>
                        <td class="tg-r0gd" colspan="1">Subtotal</td>
                        <td class="tg-r0gd" colspan="2">AliCuota IVA</td>
                        <td class="tg-r0gd" colspan="2">Subtotal Venta</td>
                    </tr>
                    <!--  Inicio TBODY con esa clase -->
                    <tbody>'.
                            $cuerpo
                            .'
                    </tbody>
                    <!--  FIN TBODY -->
                    <!--  INICIO TFOOD -->
                    <tfoot style="width: 100%; display: table; padding-top:100px;">
                        <tr >
                            <td style="border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:right;" colspan="12">Importe Neto Gravado: $' . number_format($ingreso[0]['importeNetoNoGravado'], 2, ',', '.') . '<br>Iva: $' . number_format($ingreso[0]['ivaTotal'], 2, ',', '.') . '<br>Total: $' . number_format($ingreso[0]['total'], 2, ',', '.') . '<br>Total A Cobrar: $' . number_format($ingreso[0]['aCobrar'], 2, ',', '.') . '</td>
                        </tr>
                    </tfoot>
                    <!--  FIN TFOOD -->
                </table>
            </div>
        ');

            $this->html2pdf->create('save');

            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "nombrePdf" => $nombreArchivo . ".pdf", "idGenIngreso" => $idGenIngreso, "ingreso" => $ingreso);
        } else {
            $msg = "No se ha podiado realizar el pdf, esta vacio idGenIngreso";
            $dato = array("valid" => true, "msg" => $msg, "idGenIngreso" => $idGenIngreso, "ingreso" => $ingreso, "detalleIngreso" => $detalleIngreso);
        }
        echo json_encode($dato);
    }

    public function generaPDFComprobanteLegal($idGenIngreso)
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $ingreso = $this->app_model->get_ingreso_clientes_by_idGenIngreso($idGenIngreso);
        if (!$ingreso){
            $ingreso = $this->app_model->get_ingreso_clientes_sindatosfacturacion_by_idGenIngreso($idGenIngreso);
            $tipoDoc = "-";
            $cuit = "-";
            $razonSocial = "-";
            $condicionIva = "-";
        } else {
            $tipoDoc = $ingreso[0]['tipoDoc'];
            $cuit = $ingreso[0]['cuit'];
            $condicionIva = $ingreso[0]['condicionIva'];
            if ($ingreso[0]['razonSocial'] == "") {
                $razonSocial = "-";
            } else {
                $razonSocial = $ingreso[0]['razonSocial'];
            }
        }
        $detalleIngreso = $this->app_model->get_ingreso_detalle_by_idGenIngreso($idGenIngreso);
        $empresa = $this->app_model->get_empresas();

        if ($ingreso && $detalleIngreso && $idGenIngreso) {
            //-- NOMBRE Y DIRECTORIO --//
            $directorio = 'uploads/comprobantes/ventas/' . $idGenIngreso;

            if (!is_dir($directorio)) {
                mkdir($directorio, 0777);
            }

            $nombreArchivo = $idGenIngreso . date("YmdHis");

            //-- CARGO LIBRERIAS --//
            $this->load->library('html2pdf');

            $this->html2pdf->folder('./uploads/comprobantes/ventas/' . $idGenIngreso . "/");
            $this->html2pdf->filename($nombreArchivo . ".pdf");
            $this->html2pdf->paper('a4', 'portrait');

            //-- DATOS TABLA --//
            $acuTotal = 0;
            $cuerpo = "";
            foreach ($detalleIngreso as $key => $value) {
                //-- FILAS --//
                $operacion = $value['subTotal'] + ($value['subTotal'] * $value['iva']);

                $cuerpo .= '<tr>
                <td class="tg-swzm" colspan="1">'. utf8_decode($value['codigo']) .'</td>
                <td class="tg-swzm" colspan="3">'. utf8_decode($value['nombre']) .'</td>
                <td class="tg-swzm" colspan="1">'. $value['cantidad'] .'</td>
                <td class="tg-swzm" colspan="1">'. "$" . number_format($value['precio'], 2, ',', '.') .'</td>
                <td class="tg-swzm" colspan="1">'. $value['descuento'] . "%" .'</td>
                <td class="tg-swzm" colspan="1">'. "$" . number_format($value['subTotal'], 2, ',', '.') .'</td>
                <td class="tg-swzm" colspan="2">'. $value['ivaText'] .'</td>
                <td class="tg-swzm" colspan="2">'. "$" . number_format($operacion, 2, ',', '.') .'</td>
            </tr>';
            }

            if ($ingreso[0]['domicilio'] == "") {
                $domicilio = "-";
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] == "" && $ingreso[0]['dpto'] == "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso -" . " dpto -";
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] != "" && $ingreso[0]['dpto'] == "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso " . $ingreso[0]['piso'] . " dpto -";
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] == "" && $ingreso[0]['dpto'] != "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso -" . " dpto " . $ingreso[0]['dpto'];
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] != "" && $ingreso[0]['dpto'] != "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso " . $ingreso[0]['piso'] . " dpto " . $ingreso[0]['dpto'];
            }

            $this->html2pdf->html('
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{font-family:Arial, sans-serif;font-size:7px;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg th{font-family:Arial, sans-serif;font-size:7px;font-weight:normal;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg .tg-704r{border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:left;vertical-align:middle;width: 50%;}
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
                .tg .tg-n21a{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:left;vertical-align:top;font-size:8px;}
                .tg .tg-236u{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:center;vertical-align:middle}
                .tg .tg-0lax{font-size:12px;text-align:left;vertical-align:top;vertical-align:bottom;font-size:5px;}
                .tg .tg-l2oz{font-weight:bold;text-align:right;vertical-align:top;font-size:5px;font-family:"Arial Black", Gadget, sans-serif !important;}
            </style>
            <div style="border: 0.5px solid black;margin: 0 auto;position: absolute;width: 100%;border: 0.5px solid black;" colspan="12" >
                <table class="tg" style="width: 100%;">
                    <tr>
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold;text-align: center;font-size:24px;">' . (($empresa[0]['razonSocial']) ? $empresa[0]['razonSocial'] : "-") . '</span></td>
                        <td class="tg-zb0z" colspan="2"><span style="font-weight:bold;font-size:40px;text-align: center;">' . (($ingreso[0]['letraTipoFactura']) ? $ingreso[0]['letraTipoFactura'] : "-") . '</span></td>
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold;font-size:17px;text-align: center;">COMPROBANTE LEGAL</span></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6"><br>CUIT: ' . (($empresa[0]['razonSocial']) ? $empresa[0]['razonSocial'] : "-") . '<br>Dirección: ' . (($empresa[0]['direccion']) ? $empresa[0]['direccion'] : "-") . '<br>' . (($empresa[0]['localidad']) ? $empresa[0]['localidad'] : "-") . ', ' . (($empresa[0]['provincia']) ? $empresa[0]['provincia'] : "-") . '<br></td>
                        <td class="tg-704r" colspan="6"><br><br>Fecha emisión:  ' . date("d/m/Y") . '<br><br><br></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="12">Fecha Vencimiento: ' . date("d/m/Y", strtotime((($ingreso[0]['fechaVtoCobro']) ? $ingreso[0]['fechaVtoCobro'] : "00-00-0000"))) . '</td>
                    </tr>
                    <tr>
                    <td class="tg-704r" colspan="6">Razón Social: ' . (($razonSocial) ? utf8_decode($razonSocial) : "-") . '<br>Nombre: ' . (($ingreso[0]['nombreCliente']) ? utf8_decode($ingreso[0]['nombreCliente']) : "-") . '<br>Apellido: ' . (($ingreso[0]['apellidoCliente']) ? utf8_decode($ingreso[0]['apellidoCliente']) : "-") . '<br>Celular: ' . (($ingreso[0]['cel']) ? $ingreso[0]['cel'] : "-") . '<br>Domicilio: ' . ((utf8_decode($domicilio)) ? utf8_decode($domicilio) : "-") . '</td>
                    <td class="tg-704r" colspan="6">' . (($ingreso) ? (($tipoDoc) ? $tipoDoc : "-") : "-") . ': ' . (($ingreso) ? (($cuit) ? $cuit : "-") : "-") . '<br>Condición Iva: ' . (($ingreso) ? (($condicionIva) ? $condicionIva : "-") : "-") . '<br>Categoría: ' . ((utf8_decode($ingreso[0]['categoria'])) ? utf8_decode($ingreso[0]['categoria']) : "-") . '<br>Vendedor: ' . (($ingreso[0]['apellidoVend'] AND $ingreso[0]['nombreVend']) ? $ingreso[0]['apellidoVend'] . ", " . $ingreso[0]['nombreVend'] : "-") . '</td>
                    </tr>
                    <tr>
                        <td class="tg-r0gd" colspan="1">Código</td>
                        <td class="tg-r0gd" colspan="3">Descripción</td>
                        <td class="tg-r0gd" colspan="1">Cant.</td>
                        <td class="tg-r0gd" colspan="1">Precio Unit.</td>
                        <td class="tg-r0gd" colspan="1">Descuento</td>
                        <td class="tg-r0gd" colspan="1">Subtotal</td>
                        <td class="tg-r0gd" colspan="2">AliCuota IVA</td>
                        <td class="tg-r0gd" colspan="2">Subtotal Venta</td>
                    </tr>
                    <!--  Inicio TBODY con esa clase -->
                    <tbody>'.
                            $cuerpo
                            .'
                    </tbody>
                    <!--  FIN TBODY -->
                    <!--  INICIO TFOOD -->
                    <tfoot style="width: 100%; display: table; padding-top:100px;">
                        <tr >
                            <td style="border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:right;" colspan="12">Importe Neto Gravado: $' . number_format((($ingreso[0]['importeNetoNoGravado']) ? $ingreso[0]['importeNetoNoGravado'] : 0), 2, ',', '.') . '<br>Iva: $' . number_format((($ingreso[0]['ivaTotal']) ? $ingreso[0]['ivaTotal'] : 0), 2, ',', '.') . '<br>Total: $' . number_format((($ingreso[0]['total']) ? $ingreso[0]['total'] : 0), 2, ',', '.') . '<br>Total A Cobrar: $' . number_format((($ingreso[0]['aCobrar']) ? $ingreso[0]['aCobrar'] : 0), 2, ',', '.') . '</td>
                        </tr>
                    </tfoot>
                    <!--  FIN TFOOD -->
                </table>
            </div>
        ');

            $this->html2pdf->create('save');

            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "nombrePdf" => $nombreArchivo . ".pdf");
        } else {
            $msg = "No se ha podiado realizar el pdf, esta vacio idGenIngreso";
            $dato = array("valid" => true, "msg" => $msg, "idGenIngreso" => $idGenIngreso, "ingreso" => $ingreso, "detalleIngreso" => $detalleIngreso);
        }
        echo json_encode($dato);
    }

    public function generaPDFComprobanteNoLegal($idGenIngreso)
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $ingreso = $this->app_model->get_ingreso_clientes_by_idGenIngreso($idGenIngreso);
        if (!$ingreso){
            $ingreso = $this->app_model->get_ingreso_clientes_sindatosfacturacion_by_idGenIngreso($idGenIngreso);
            $tipoDoc = "-";
            $cuit = "-";
            $razonSocial = "-";
            $condicionIva = "-";
        } else {
            $tipoDoc = $ingreso[0]['tipoDoc'];
            $cuit = $ingreso[0]['cuit'];
            $condicionIva = $ingreso[0]['condicionIva'];
            if ($ingreso[0]['razonSocial'] == "") {
                $razonSocial = "-";
            } else {
                $razonSocial = $ingreso[0]['razonSocial'];
            }
        }
        $detalleIngreso = $this->app_model->get_ingreso_detalle_by_idGenIngreso($idGenIngreso);

        if ($ingreso && $detalleIngreso && $idGenIngreso) {
            //-- NOMBRE Y DIRECTORIO --//
            $directorio = 'uploads/comprobantes/ventas/' . $idGenIngreso;

            if (!is_dir($directorio)) {
                mkdir($directorio, 0777);
            }

            $nombreArchivo = $idGenIngreso . date("YmdHis");


            $nombreArchivo = $idGenIngreso . date("YmdHis");

            //-- CARGO LIBRERIAS --//
            $this->load->library('html2pdf');

            $this->html2pdf->folder('./uploads/comprobantes/ventas/' . $idGenIngreso . "/");
            $this->html2pdf->filename($nombreArchivo . ".pdf");
            $this->html2pdf->paper('a4', 'portrait');

            //-- DATOS TABLA --//
            $acuTotal = 0;
            $cuerpo = "";
            foreach ($detalleIngreso as $key => $value) {
                //-- FILAS --//
                $operacion = $value['subTotal'] + ($value['subTotal'] * $value['iva']);

                $cuerpo .= '<tr>
                <td class="tg-swzm" colspan="1">'. utf8_decode($value['codigo']) .'</td>
                <td class="tg-swzm" colspan="3">'. utf8_decode($value['nombre']) .'</td>
                <td class="tg-swzm" colspan="1">'. $value['cantidad'] .'</td>
                <td class="tg-swzm" colspan="1">'. "$" . number_format($value['precio'], 2, ',', '.') .'</td>
                <td class="tg-swzm" colspan="1">'. $value['descuento'] . "%" .'</td>
                <td class="tg-swzm" colspan="1">'. "$" . number_format($value['subTotal'], 2, ',', '.') .'</td>
                <td class="tg-swzm" colspan="2">'. $value['ivaText'] .'</td>
                <td class="tg-swzm" colspan="2">'. "$" . number_format($operacion, 2, ',', '.') .'</td>
            </tr>';
            }

            if ($ingreso[0]['domicilio'] == "") {
                $domicilio = "-";
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] == "" && $ingreso[0]['dpto'] == "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso -" . " dpto -";
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] != "" && $ingreso[0]['dpto'] == "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso " . $ingreso[0]['piso'] . " dpto -";
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] == "" && $ingreso[0]['dpto'] != "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso -" . " dpto " . $ingreso[0]['dpto'];
            } elseif ($ingreso[0]['domicilio'] != "" && $ingreso[0]['piso'] != "" && $ingreso[0]['dpto'] != "") {
                $domicilio = $ingreso[0]['domicilio'] . " " . $ingreso[0]['nro'] . " piso " . $ingreso[0]['piso'] . " dpto " . $ingreso[0]['dpto'];
            }

            $this->html2pdf->html('
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{font-family:Arial, sans-serif;font-size:7px;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg th{font-family:Arial, sans-serif;font-size:7px;font-weight:normal;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg .tg-704r{border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:left;vertical-align:middle;width: 50%;}
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
                .tg .tg-n21a{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:left;vertical-align:top;font-size:8px;}
                .tg .tg-236u{background-color:#f9f9f9;border-color:inherit;font-family:"Arial Black", Gadget, sans-serif !important;;font-size:9px; text-align:center;vertical-align:middle}
                .tg .tg-0lax{font-size:12px;text-align:left;vertical-align:top;vertical-align:bottom;font-size:5px;}
                .tg .tg-l2oz{font-weight:bold;text-align:right;vertical-align:top;font-size:5px;font-family:"Arial Black", Gadget, sans-serif !important;}
            </style>
            <div style="border: 0.5px solid black;margin: 0 auto;position: absolute;width: 100%;border: 0.5px solid black;" colspan="12" >
                <table class="tg" style="width: 100%;">
                    <tr>
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold;"></span></td>
                        <td class="tg-zb0z" colspan="2"><span style="font-weight:bold;font-size:50px;text-align: center;">X</span></td>
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold;font-size:17px;text-align: center;">COMPROBANTE NO LEGAL</span></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6"></td>
                        <td class="tg-704r" colspan="6"><br><br>Fecha emisión:  ' . date("d/m/Y") . '<br><br><br></td>
                    </tr>
                    <tr>
                    <td class="tg-704r" colspan="12">Fecha Vencimiento: ' . date("d/m/Y", strtotime((($ingreso[0]['fechaVtoCobro']) ? $ingreso[0]['fechaVtoCobro'] : "00-00-0000"))) . '</td>
                </tr>
                <tr>
                <td class="tg-704r" colspan="6">Razón Social: ' . (($razonSocial) ? utf8_decode($razonSocial) : "-") . '<br>Nombre: ' . (($ingreso[0]['nombreCliente']) ? utf8_decode($ingreso[0]['nombreCliente']) : "-") . '<br>Apellido: ' . (($ingreso[0]['apellidoCliente']) ? utf8_decode($ingreso[0]['apellidoCliente']) : "-") . '<br>Celular: ' . (($ingreso[0]['cel']) ? $ingreso[0]['cel'] : "-") . '<br>Domicilio: ' . ((utf8_decode($domicilio)) ? utf8_decode($domicilio) : "-") . '</td>
                <td class="tg-704r" colspan="6">' . (($ingreso) ? (($tipoDoc) ? $tipoDoc : "-") : "-") . ': ' . (($ingreso) ? (($cuit) ? $cuit : "-") : "-") . '<br>Condición Iva: ' . (($ingreso) ? (($condicionIva) ? $condicionIva : "-") : "-") . '<br>Categoría: ' . ((utf8_decode($ingreso[0]['categoria'])) ? utf8_decode($ingreso[0]['categoria']) : "-") . '<br>Vendedor: ' . (($ingreso[0]['apellidoVend'] AND $ingreso[0]['nombreVend']) ? $ingreso[0]['apellidoVend'] . ", " . $ingreso[0]['nombreVend'] : "-") . '</td>
                    </tr>
                    <tr>
                        <td class="tg-r0gd" colspan="1">Código</td>
                        <td class="tg-r0gd" colspan="3">Descripción</td>
                        <td class="tg-r0gd" colspan="1">Cant.</td>
                        <td class="tg-r0gd" colspan="1">Precio Unit.</td>
                        <td class="tg-r0gd" colspan="1">Descuento</td>
                        <td class="tg-r0gd" colspan="1">Subtotal</td>
                        <td class="tg-r0gd" colspan="2">AliCuota IVA</td>
                        <td class="tg-r0gd" colspan="2">Subtotal Venta</td>
                    </tr>
                    <!--  Inicio TBODY con esa clase -->
                    <tbody>'.
                            $cuerpo
                            .'
                    </tbody>
                    <!--  FIN TBODY -->
                    <!--  INICIO TFOOD -->
                    <tfoot style="width: 100%; display: table; padding-top:100px;">
                        <tr >
                        <td style="border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:right;" colspan="12">Importe Neto Gravado: $' . number_format((($ingreso[0]['importeNetoNoGravado']) ? $ingreso[0]['importeNetoNoGravado'] : 0), 2, ',', '.') . '<br>Iva: $' . number_format((($ingreso[0]['ivaTotal']) ? $ingreso[0]['ivaTotal'] : 0), 2, ',', '.') . '<br>Total: $' . number_format((($ingreso[0]['total']) ? $ingreso[0]['total'] : 0), 2, ',', '.') . '<br>Total A Cobrar: $' . number_format((($ingreso[0]['aCobrar']) ? $ingreso[0]['aCobrar'] : 0), 2, ',', '.') . '</td>
                        </tr>
                    </tfoot>
                    <!--  FIN TFOOD -->
                </table>
            </div>
        ');

            $this->html2pdf->create('save');

            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "nombrePdf" => $nombreArchivo . ".pdf");
        } else {
            $msg = "No se ha podiado realizar el pdf, esta vacio idGenIngreso";
            $dato = array("valid" => true, "msg" => $msg, "idGenIngreso" => $idGenIngreso, "ingreso" => $ingreso, "detalleIngreso" => $detalleIngreso);
        }
        echo json_encode($dato);
    }

    public function agregar_venta()
    {
        $this->data['clientes'] = $this->app_model->get_clientes();

        $this->data['categoriasVentas'] = $this->app_model->get_categorias_ventas();

        $this->data['facturaTipos'] = $this->app_model->get_factura_tipos();

        $this->data['razonSocial'] = $this->app_model->get_razon_social();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['modalidadesAbono'] = $this->app_model->get_abono_modalidades();

        $this->data['empresa'] = $this->app_model->get_empresas();

        $this->load_view('ventas/agregar_venta', $this->data);
    }

    public function buscaSubcategoriaVentaDetalle()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idCategoriaVentaDetalle = $this->input->post('idCategoriaVentaDetalle', true);
        $subcategoriasVentasDetalle = $this->app_model->get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($idCategoriaVentaDetalle);

        echo '<option value="0">Seleccionar Subcategoria</option>';
        foreach ($subcategoriasVentasDetalle as $key) {
            echo '<option value="' . $key['idSubcategoriaVenta'] . '">' . $key['descripcion'] . '</option>';
        }
    }

    public function editar_venta($idIngreso = null)
    {
        $ingreso = $this->app_model->get_ingreso_by_idIngreso($idIngreso);
        $this->data['ingreso'] = $ingreso;

        $this->data['idGenIngreso'] = $ingreso[0]['idGenIngreso'];

        $this->data['productoDetalle'] = $this->app_model->get_ingreso_detalle_by_idGenIngreso($ingreso[0]['idGenIngreso']);

        $cliente = $this->app_model->get_cliente_byIdCliente($ingreso[0]['idCliente']);
        $this->data['cliente'] = $cliente;

        $this->data['cliente_detalle_ventas'] = $this->app_model->get_cliente_detalle_ventas_byIdCliente($cliente[0]['idGenCliente']);

        $this->data['clientes'] = $this->app_model->get_clientes();

        $this->data['categoriasVentas'] = $this->app_model->get_categorias_ventas();

        $this->data['subcategoriasVentasDetalle'] = $this->app_model->get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($ingreso[0]['idCategoria']);

        $this->data['facturaTipos'] = $this->app_model->get_factura_tipos();

        $this->data['razonSocial'] = $this->app_model->get_razon_social();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['modalidadesAbono'] = $this->app_model->get_abono_modalidades();

        $this->data['ivaTipos'] = $this->app_model->get_iva_tipos();

        $this->data['empresa'] = $this->app_model->get_empresas();

        $this->load_view('ventas/editar_venta', $this->data);
    }

    public function agregar_venta_presupuesto($idGenPresupuesto = null)
    {
        $presupuesto = $this->app_model->get_presupuesto_clientes_by_idGenPresupuesto($idGenPresupuesto);
        $this->data['presupuesto'] = $presupuesto;

        $this->data['idGenPresupuesto'] = $idGenPresupuesto;

        $this->data['productoDetalle'] = $this->app_model->get_presupuesto_detalle_by_idGenPresupuesto($presupuesto[0]['idGenPresupuesto']);

        $this->data['clientes'] = $this->app_model->get_clientes();

        $this->data['categoriasVentas'] = $this->app_model->get_categorias_ventas();

        $this->data['subcategoriasVentasDetalle'] = $this->app_model->get_subcategorias_ventas();

        $this->data['facturaTipos'] = $this->app_model->get_factura_tipos();

        $this->data['razonSocial'] = $this->app_model->get_razon_social();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['modalidadesAbono'] = $this->app_model->get_abono_modalidades();

        $this->data['ivaTipos'] = $this->app_model->get_iva_tipos();

        $this->load_view('ventas/agregar_venta_presupuesto', $this->data);
    }

    public function listar_venta_presupuesto_table($idGenPresupuesto)
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $presupuesto_detalle = $this->app_model->get_presupuesto_detalle_by_idGenPresupuesto($idGenPresupuesto);
        $ivaTipos = $this->app_model->get_iva_tipos();

        if ($presupuesto_detalle) {
            foreach ($presupuesto_detalle as $key => $value) {
                $idGenPresupuesto = "'" . $idGenPresupuesto . "'";

                $opcines_iva = "";

                if (isset($ivaTipos)):
                    for ($j = 0; $j < count($ivaTipos); $j++) :
                        if ($ivaTipos[$j]['descripcion'] == $value['ivaText']):
                            $opcines_iva .= '<option selected value="' . $ivaTipos[$j]['valorIva'] . '">' . $ivaTipos[$j]['descripcion'] . '</option>'; else:
                            $opcines_iva .= '<option value="' . $ivaTipos[$j]['valorIva'] . '">' . $ivaTipos[$j]['descripcion'] . '</option>';
                endif;
                endfor;
                endif;

                $dato[] = array(
                    $value["idProducto"],
                    $value['codigo'],
                    $value['nombre'],
                    '<input type="text" value="' . $value["cantidad"] . '" id="cantProd' . $value["idProducto"] . '" onkeyup="calculoVentaPresupuesto(' . $value["idProducto"] . ',' . $value["stock"] . ',' . $value["cantidad"] . ')" class="form-control">' .
                    '<div id="errorStock' . $value["idProducto"] . '" class="btn-danger erroBoxs" style="display: none">' .
                    'Stock: ' . $value["stock"] .
                    '</div>',
                    $value['stock'],
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["precio"] . '" id="precioProd' . $value["idProducto"] . '" disabled class="form-control">' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">%</span>' .
                    '<input type="text" value="' . $value["descuento"] . '" id="descProd' . $value["idProducto"] . '" onkeyup="calculoVentaPresupuesto(' . $value["idProducto"] . ')" class="form-control">' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["subTotal"] . '" id="subTotalProd' . $value["idProducto"] . '" readonly class="form-control">' .
                    '</div>',
                    '<select id="selectIva' . $value["idProducto"] . '" onchange="calculoVentaPresupuesto(' . $value["idProducto"] . ')" class="select-full" required>
                        <option value="0">IVA</option>' .
                    $opcines_iva .
                    '</select>',
                    '<i class="icon-remove4" onclick="deleteRowListaVentaPresupuesto(' . $value["idProducto"] . ')"></i>',
                    $value["idProducto"],
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

    public function set_venta()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $datosFacturacion = $this->input->post('datosFacturacion', true);
            $datosVenta = $this->input->post('datosVenta', true);
            $idGenPresupuesto = $this->input->post('idGenPresupuesto', true);

            $idGenIngreso = substr(md5(microtime()), 15, 17);

            if (
                    !empty($datosFacturacion) AND ! empty($datosVenta)
            ) {
                //--- verificamos que ningun idProducto sea 0 sino se mostrar un mensaje de error ---//
                $coincidentia_0 = array_search(0, array_column($datosVenta, 'idProducto'));

                if ($coincidentia_0) {
                    $msg = "El producto " . $coincidentia_0 . " no ha sido cargado correctamente.";
                    $dato = array("valid" => false, "msg" => $msg);
                } else {
                    $userdata = $this->session->all_userdata();
                    $idVendedor = $userdata['idUsuario'];

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

                    if ($datosFacturacion["cobrado"] == "true") {
                        $aCobrar = 0;
                        $saldado = 1;
                        $idEstado = 1; //Estado de cobrado
                    } else {
                        $aCobrar = $datosFacturacion["total"];
                        $saldado = 0;
                        $idEstado = 2; //Estado de A cobrar
                    }

                    //--- Obtencion de las configuraciones de la empresa ---//
                    $empresa = $this->app_model->get_empresas();

                    //--- condicion de si esta vacio o no para que por defecto sera 0 ---//
//                    ($idGenPresupuesto == "") ? $idGenPresupuesto == "0" : $idGenPresupuesto;
                    //--- Guardo - Ingreso ---//
                    $result_insert_ingreso = $this->app_model->insert_ingreso(
                        $idGenIngreso,
                        $idGenAbono = 0,
                        $tipoIngreso = 1,
                        $idVendedor,
                        $datosFacturacion["selectCliente"], //selectCliente
                            $fechaEmision, //fechaEmision
                            $fechaCobro, //fechaCobro
                            $datosFacturacion["selectTipoFact"], //selectTipoFac
                            $datosFacturacion["selectCategoriaVenta"], //selectCatVenta
                            $datosFacturacion["notaCliente"], //notaCliente
                            $datosFacturacion["notaInterna"], //notaInterna
                            $datosFacturacion["totalNoGravado"], //importeNoGravado
                            $datosFacturacion["total"], //totalVenta
                            $datosFacturacion["descTotal"], //descuentoTotal
                            $datosFacturacion["descCliente"], //descuentoTotal
                            $datosFacturacion["totalIva"], //ivaTotal
                            $datosFacturacion["selectSubCategoriaVenta"], //selectSubCategoriaVenta
                            $datosFacturacion["razonSocial"], //razonSocial
                            $idGenPresupuesto,
                        $aCobrar, //aCobrar
                            $saldado,
                        $idEstado,
                        $datosFacturacion["fechaInicioServicio"], //fechaInicioServicio
                            $datosFacturacion["fechaFinServicio"] //fechaFinServicio
                    );

                    //--- Guardo - Detalle de Ingreso ---//
                    //foreach($datosVenta as $key => $value){
                    for ($i = 0; $i < count($datosVenta); $i++) {
                        $producto_idProducto = $this->app_model->get_productos_byId($datosVenta[$i]['idProducto']);

                        $result_insert_ingreso_detalle = $this->app_model->insert_ingreso_detalle(
                            $idGenIngreso,
                            $datosVenta[$i]['idProducto'],
                            $datosVenta[$i]['cantidad'],
                            $datosVenta[$i]['precio'],
                            $datosVenta[$i]['descuento'],
                            $datosVenta[$i]['subtotalProd'],
                            $datosVenta[$i]['iva'],
                            $datosVenta[$i]['ivaText']
                        );
                        //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                        if ($empresa[0]['stock'] == 0) {
                            if ($producto_idProducto[0]['controlStock'] == 0) {
                                $cantidadActualizada = $datosVenta[$i]['stock'] - $datosVenta[$i]['cantidad'];
                                $result = $this->app_model->update_stock_by_idProducto($datosVenta[$i]['idProducto'], $cantidadActualizada);

                                $producto = $this->app_model->get_producto($datosVenta[$i]['idProducto']);
                                //--- Guardo el movimiento del stock ---//
                                $hoy = getdate();
                                $d = $hoy['mday'];
                                (($d < 10) ? $d = "0" . $d : $d);
                                $m = $hoy['mon'];
                                (($m < 10) ? $m = "0" . $m : $m);
                                $y = $hoy['year'];
                                $fecha = $d . "-" . $m . "-" . $y;
                                $movimiento_stock = $this->app_model->insert_movimiento_stock($producto[0]['idGenProducto'], $idGenIngreso, 2, $datosVenta[$i]['cantidad'], "Se realizo la venta", 0, $idVendedor, $fecha);
                            }
                        }
                    }

                    $fechaCobroCuentaCorriente = date("Y-m-d H:i:s");
                    $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                        $idGenIngreso,
                        $idGenComprobante = 0,
                        $datosFacturacion["selectCliente"], //selectCliente
                            $fechaCobroCuentaCorriente, //fechaCobro
                            $debito = $aCobrar, //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                            $credito = 0, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                            $idMedioCobro = 1, //Medio de cobro
                            $saldo = $aCobrar, //Saldo
                            $descripcionCobro = "Primer ingreso"
                    );

                    //--- Guardo - Historico ---//
                    $result_insert_historico = $this->app_model->set_historico(
                        $idVendedor,
                        $idGenIngreso,
                        $tipoAccion = 1,
                        $tipoOperacion = 2,
                        "Se agregó una venta a " . $datosFacturacion["selectCliente"], //detalle
                            $datosFacturacion["total"] //total
                    );

                    //--- Arqueo Caja ---//
                    $arqueo_cajas_no_cerrado = $this->app_model->get_arqueo_cajas_by_usuario_tunoNoCerrado($idVendedor);

                    if ($arqueo_cajas_no_cerrado) {
                        $pagosEfectivo = $datosFacturacion["total"] + $arqueo_cajas_no_cerrado[0]['pagosEfectivo'];
                        $arqueo_cajas_pagos_efectivo = $this->app_model->update_pagas_arqueo_cajas($arqueo_cajas_no_cerrado[0]['idGenArqueoCajas'], $pagosEfectivo);
                        $montoEsperado = $arqueo_cajas_no_cerrado[0]['montoEsperado'] + $pagosEfectivo;
                        $arqueo_cajas_monto_esperado = $this->app_model->update_deposito($arqueo_cajas_no_cerrado[0]['idGenArqueoCajas'], $montoEsperado);
                    }

                    if ($result_insert_ingreso) {
                        if ($idGenPresupuesto != "") {
                            $presupuesto_aceptado = $this->app_model->update_presupuesto_estado($idGenPresupuesto, 4);
                            $presupuesto_facturado = $this->app_model->update_presupuesto_facturado($idGenPresupuesto);
                        } else {
                            $presupuesto_aceptado = true;
                            $presupuesto_facturado = true;
                        }
                        if ($presupuesto_aceptado && $presupuesto_facturado) {
                            $msg = "Registro agregado";
                            $dato = array("valid" => true, "msg" => $msg, "idGenIngreso" => $idGenIngreso);
                        } else {
                            $msg = "Error al procesar registro";
                            $dato = array("valid" => false, "msg" => $msg);
                        }
                    } else {
                        $msg = "Error al procesar registro";
                        $dato = array("valid" => false, "msg" => $msg, "datosFacturacion" => $datosFacturacion);
                    }
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

    public function set_cobro()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $idGenIngreso = $this->input->post('idGenIngresoCobro', true);
            $inputFechaCobroCobrar = $this->input->post('inputFechaCobroCobrar', true);
            $montoCobro = $this->input->post('montoCobro', true);
            $selectMedioCobro = $this->input->post('selectMedioCobro', true);
            $descripcionCobro = $this->input->post('descripcionCobro', true);


            $saldoAFavor = $this->input->post('saldoAFavor', true);
            $selectSaldoAFavor = $this->input->post('selectSaldoAFavor', true);

            if ($selectSaldoAFavor == 1) {
                $saldoAFavor = 0;
            }

            if (
                    !empty($idGenIngreso) AND ! empty($montoCobro) AND ! empty($selectMedioCobro)
            ) {
                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];

                //--- Fecha del nuevo cobro ---//
                if (empty($inputFechaCobroCobrar)) {
                    $fechaCobroCobrar = date("Y-m-d");
                } else {
                    $fechaCobroCobrar = $inputFechaCobroCobrar;
                }
                $estadoCuenta = $this->app_model->get_estado_cuenta_by_idGenIngreso($idGenIngreso);
                $debito = 0;
                $credito = 0;
                //Calculo todos credito y debito de esa deuda en particular
                foreach ($estadoCuenta as $key => $value) {
                    $debito += $value['debito'];
                    $credito += $value['credito'];
                }
                //--- saldo adeudado ---//
                $adeudado = $debito - $credito;
                //-- monto total con el saldo a favor ---//
                $monto = $montoCobro + $saldoAFavor;

                if ($monto > $adeudado) {
                    $monto = $adeudado;
                }

//                if ($monto > $adeudado) {
//                    $msg = "El monto a cobrar no puede ser mayor al adeudado. Por favor actualice la pagina";
//                    $dato = array("valid" => false, "msg" => $msg);
//                } else {
                $ultPosicion = count($estadoCuenta) - 1;
                $nuevoSaldo = $estadoCuenta[$ultPosicion]['saldo'] - $monto;

                $idGenComprobante = md5(microtime());

                $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                    $idGenIngreso,
                    $idGenComprobante,
                    $estadoCuenta[0]['idCliente'], //selectCliente
                        $fechaCobroCobrar, //fechaCobro
                        $debito = 0, //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                        $credito = $monto, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                        $selectMedioCobro, //Medio de cobro
                        $nuevoSaldo, //Saldo
                        $descripcionCobro //descripcion
                );
                $result4 = $this->app_model->insert_ingreso_egreso_caja(
                    $idCaja = $selectMedioCobro,
                    $idGenIngreso,
                    $ingreso = $monto,
                    $egreso = 0,
                    $descripcionMovimiento = "",
                    $idGenMovimiento = 0,
                    $idTipo = 1 //indica venta
                );
                if ($nuevoSaldo == 0) {
                    $resultUpdate = $this->app_model->update_estado_ingreso_by_idGenIngreso($idGenIngreso, $saldo = $nuevoSaldo, $saldado = 1, $idEstado = 1);
                } else {
                    $resultUpdate = $this->app_model->update_estado_ingreso_by_idGenIngreso($idGenIngreso, $saldo = $nuevoSaldo, $saldado = 0, $idEstado = 2);
                }

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                    $idVendedor,
                    $idGenIngreso,
                    $tipoAccion = 1,
                    $tipoOperacion = 1, //Agrega nuevo cobro
                        "Se agregó un cobro a " . $estadoCuenta[0]['idCliente'], //detalle
                        $monto //montoCobro
                );

                if ($result_cuenta_corriente && $result4) {
                    $msg = "Registro agregado";
                    $dato = array("valid" => true, "msg" => $msg, "idGenIngreso" => $idGenIngreso);
                } else {
                    $msg = "Error al procesar registro";
                    $dato = array("valid" => false, "msg" => $msg);
                }
//                }
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

    public function get_monto_adeudado_by_idGenIngreso()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $idGenIngreso = $this->input->post('idGenIngreso', true);

            if (!empty($idGenIngreso)) {

                //--- Obtengo estado de cuenta de esa deuda puntual ---//
                $estadoCuenta = $this->app_model->get_estado_cuenta_by_idGenIngreso($idGenIngreso);

                $ingreso = $this->app_model->get_ingreso_by_idGenIngreso($idGenIngreso);
                $cuenta_corriente = $this->app_model->get_cuenta_corriente_by_idCliente($ingreso[0]['idCliente']);
                $debito = 0;
                $credito = 0;
                $debitoCC = 0;
                $creditoCC = 0;
                if ($estadoCuenta && $ingreso && $cuenta_corriente) {
                    //Calculo todos credito y debito de esa deuda en particular
                    foreach ($estadoCuenta as $key => $value) {
                        $debito += $value['debito'];
                        $credito += $value['credito'];
                    }
                    $adeudado = $debito - $credito;
                    //--- cuenta corriente calculos de debito y credito del usuario ---//
                    foreach ($cuenta_corriente as $key => $value) {
                        $debitoCC += floatval($cuenta_corriente[$key]['debito']);
                        $creditoCC += floatval($cuenta_corriente[$key]['credito']);
                    }
                    $aFavor = $creditoCC - $debitoCC;

                    $msg = "Ok";
                    $dato = array("valid" => true, "msg" => $msg, "adeudado" => $adeudado, "aFavor" => $aFavor, "aCobrar" => $ingreso[0]['aCobrar'], "aFavor" => $aFavor, "creditoCC" => $creditoCC, "debitoCC" => $debitoCC);
                } else {
                    $msg = "No se ha encontrado ningun registro con ese id";
                    $dato = array("valid" => false, "msg" => $msg, "ingreso" => $ingreso, "estadoCuenta" => $estadoCuenta);
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

    public function update_venta()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $datosFacturacion = $this->input->post('datosFacturacion', true);
            $datosVenta = $this->input->post('datosVenta', true);
            $idGenIngreso = $this->input->post('idGenIngreso', true);
            $totalVenta = $this->input->post('totalVenta', true);
            $importeNoGravado = $this->input->post('importeNoGravado', true);
            $ingreso_anterior = $this->app_model->get_ingreso_by_idGenIngreso($idGenIngreso);

            $coincidentia_0 = false;
            foreach ($datosVenta as $key => $value) {
                if ($datosVenta[$key]['idProducto']) {
                    $coincidentia_0 = $key;
                    break;
                }
            }
            //--- verificamos que ningun idProducto sea 0 sino se mostrar un mensaje de error ---//
//            $coincidentia_0 = array_search(0, array_column($datosVenta, 'idProducto'));

            if ($coincidentia_0) {
                $msg = "El producto " . $coincidentia_0 . " no ha sido cargado correctamente. Intentelo de nuevo.";
                $dato = array("valid" => false, "msg" => $msg);
            } else {
                if (
                        !empty($datosFacturacion) AND ! empty($datosVenta) AND ! empty($idGenIngreso) AND ! empty($ingreso_anterior) AND ! empty($totalVenta)
                ) {
                    $userdata = $this->session->all_userdata();
                    $idVendedor = $userdata['idUsuario'];

                    //--- Fecha Emision ---//
                    if (empty($datosFacturacion[1])) {
                        $fechaEmision = date("Y-m-d");
                    } else {
                        $fechaEmision = $datosFacturacion[1];
                    }

                    //--- Fecha Vto. del Cobro ---//
                    if (empty($datosFacturacion[2])) {
                        $fechaCobro = date("Y-m-d");
                    } else {
                        $fechaCobro = $datosFacturacion[2];
                    }

                    if ($datosFacturacion[14] == "true") {
                        $aCobrar = 0;
                        $saldado = 1;
                        $idEstado = 1; //Estado de cobrado
                    } else {
                        $aCobrar = $datosFacturacion[11];
                        $saldado = 0;
                        $idEstado = 2; //Estado de A cobrar
                    }

                    //--- Obtencion del ingreso y el detalle del ingreso ---//
                    $ingreso = $this->app_model->get_ingreso_by_idGenIngreso($idGenIngreso);
                    $ingresoDetalle = $this->app_model->get_ingreso_detalle_by_idGenIngreso($idGenIngreso);

                    //--- Actualizo - Ingreso ---//
                    $result_update_ingreso = $this->app_model->update_ingreso(
                        $idGenIngreso,
                        $tipoIngreso = 1,
                        $datosFacturacion[0], //selectCliente
                        $fechaEmision, //fechaEmision
                        $fechaCobro, //fechaCobro
                        $datosFacturacion[3], //selectTipoFac
                        $datosFacturacion[4], //selectCatVenta
                        $datosFacturacion[5], //inputFechaInicioAbono
                        $datosFacturacion[6], //inputDuracion
                        $datosFacturacion[7], //selectModalidadAbono
                        $datosFacturacion[8], //notaCliente
                        $datosFacturacion[9], //notaInterna
                        $datosFacturacion[10], //importeNoGravado
                        $datosFacturacion[11], //totalVenta
                        $datosFacturacion[12], //descuentoTotal
                        $datosFacturacion[19], //descuentoCliente
                        $datosFacturacion[13], //ivaTotal
                        $datosFacturacion[15], //selectSubCategoriaVenta
                        $datosFacturacion[16], //razonSocial
                        $aCobrar, //aCobrar
                        $saldado,
                        $idEstado,
                        $datosFacturacion[17], //fechaInicioServicio
                        $datosFacturacion[18] //fechaFinServicio
                    );

                    //--- Obtencion de las configuraciones de la empresa ---//
                    $empresas = $this->app_model->get_empresas();

                    //--- Arqueo Caja ---//
                    $arqueo_cajas_no_cerrado = $this->app_model->get_arqueo_cajas_by_usuario_tunoNoCerrado($idVendedor);

                    if ($arqueo_cajas_no_cerrado) {
                        if ($ingreso[0]['total'] > $datosFacturacion[11]) {
                            $dife = $ingreso[0]['total'] - $datosFacturacion[11];
                            $pagosEfectivo = $arqueo_cajas_no_cerrado[0]['pagosEfectivo'] - $dife;
                            $montoEsperado = $arqueo_cajas_no_cerrado[0]['montoEsperado'] - $dife;
                            $arqueo_cajas_pagos_efectivo = $this->app_model->update_pagas_arqueo_cajas($arqueo_cajas_no_cerrado[0]['idGenArqueoCajas'], $pagosEfectivo);
                            $arqueo_cajas_monto_esperado = $this->app_model->update_deposito($arqueo_cajas_no_cerrado[0]['idGenArqueoCajas'], $montoEsperado);
                        } elseif ($ingreso[0]['total'] < $datosFacturacion[11]) {
                            $dife = $datosFacturacion[11] - $ingreso[0]['total'];
                            $pagosEfectivo = $arqueo_cajas_no_cerrado[0]['pagosEfectivo'] + $dife;
                            $montoEsperado = $arqueo_cajas_no_cerrado[0]['montoEsperado'] + $dife;
                            $arqueo_cajas_pagos_efectivo = $this->app_model->update_pagas_arqueo_cajas($arqueo_cajas_no_cerrado[0]['idGenArqueoCajas'], $pagosEfectivo);
                            $arqueo_cajas_monto_esperado = $this->app_model->update_deposito($arqueo_cajas_no_cerrado[0]['idGenArqueoCajas'], $montoEsperado);
                        }
                    }


                    //--- Se actualiza la cuenta corriente al cliente que fue cambiado ---//
                    if ($datosFacturacion[0] != $ingreso_anterior[0]['idCliente']) {
                        $this->app_model->update_cuenta_corrientes_by_idCliente($datosFacturacion[0], $idGenIngreso);
                    }

                    if (empty($ingresoDetalle)) {

                        //--- Insertamos registros cuando la tabla esta vacia ---//
                        foreach ($datosVenta as $keys => $values) {
                            $producto_idProducto = $this->app_model->get_productos_byId($values['idProducto']);
                            $result_primero = $this->app_model->insert_ingreso_detalle(
                                $idGenIngreso,
                                $values['idProducto'],
                                $values['cantidad'],
                                $values['precio'],
                                $values['descuento'],
                                $values['subtotalProd'],
                                $values['iva'],
                                $values['ivaText']
                            );
                            //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                            if ($empresas[0]['stock'] == 0) {
                                if ($producto_idProducto[0]['controlStock'] == 0) {
                                    $cantidadActualizada = $values['stock'] - $values['cantidad'];
                                    $result2 = $this->app_model->update_stock_by_idProducto($values['idProducto'], $cantidadActualizada);

                                    $producto = $this->app_model->get_producto($values['idProducto']);
                                    //--- Guardo el movimiento del stock ---//
                                    $hoy = getdate();
                                    $d = $hoy['mday'];
                                    (($d < 10) ? $d = "0" . $d : $d);
                                    $m = $hoy['mon'];
                                    (($m < 10) ? $m = "0" . $m : $m);
                                    $y = $hoy['year'];
                                    $fecha = $d . "-" . $m . "-" . $y;
                                    $movimiento_stock = $this->app_model->insert_movimiento_stock($producto[0]['idGenProducto'], $idGenIngreso, 2, $cantidadActualizada, "Se agregaron productos a una venta", 0, $idVendedor, $fecha);
                                }
                            }
                        }
                    } else {

                        //--- Los valores que se encuentran en $datosVenta son los que se encuentran actualmente ingresados y en $ingresoDetalle se encuentran los valores que estan en la base de datos ---//
                        $valorComparar = [];
                        foreach ($ingresoDetalle as $key => $value) {
                            array_push($valorComparar, $value['idProducto']);
                        }
                        foreach ($datosVenta as $key => $value) {
                            $producto_idProducto = $this->app_model->get_productos_byId($value['idProducto']);
                            if (!in_array($datosVenta[$key]['idProducto'], $valorComparar)) {
                                //--- INSERT ---//
                                $this->app_model->insert_ingreso_detalle($idGenIngreso, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                                if ($empresas[0]['stock'] == 0) {
                                    if ($producto_idProducto[0]['controlStock'] == 0) {
                                        //--- Descontamos stock ---//
                                        $cantidadActualizada = $datosVenta[$key]['stock'] - $datosVenta[$key]['cantidad'];
                                        $this->app_model->update_stock_by_idProducto($datosVenta[$key]['idProducto'], $cantidadActualizada);

                                        //--- Guardo el movimiento del stock ---//
                                        $hoy = getdate();
                                        $d = $hoy['mday'];
                                        (($d < 10) ? $d = "0" . $d : $d);
                                        $m = $hoy['mon'];
                                        (($m < 10) ? $m = "0" . $m : $m);
                                        $y = $hoy['year'];
                                        $fecha = $d . "-" . $m . "-" . $y;
                                        $movimiento_stock = $this->app_model->insert_movimiento_stock($producto_idProducto[0]['idGenProducto'], $idGenIngreso, 2, $cantidadActualizada, "Se agregaron productos a una venta", 0, $idVendedor, $fecha);
                                    }
                                }
                            } else {
                                //--- Update ---//
                                if ($datosVenta[$key]['cantidad'] > $ingresoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosVenta[$key]['idProducto']) {
                                    //                                    echo 'entro';
                                    //--- Update registro detalle ingreso ---//
                                    $this->app_model->update_ingreso_detalle_by_idProducto($idGenIngreso, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                    //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                                    if ($empresas[0]['stock'] == 0) {
                                        if ($producto_idProducto[0]['controlStock'] == 0) {
                                            //--- Diferencia para stock ---//
                                            $diferencia = $datosVenta[$key]['cantidad'] - $ingresoDetalle[$key]['cantidad'];
                                            $cantidadActualizada = $datosVenta[$key]['stock'] - $diferencia;
                                            //--- Update stock ---//
                                            $result2 = $this->app_model->update_stock_by_idProducto($ingresoDetalle[$key]['idProducto'], $cantidadActualizada);

                                            //--- Guardo el movimiento del stock ---//
                                            $hoy = getdate();
                                            $d = $hoy['mday'];
                                            (($d < 10) ? $d = "0" . $d : $d);
                                            $m = $hoy['mon'];
                                            (($m < 10) ? $m = "0" . $m : $m);
                                            $y = $hoy['year'];
                                            $fecha = $d . "-" . $m . "-" . $y;
                                            $movimiento_stock = $this->app_model->update_movimiento_stock($producto_idProducto[0]['idGenProducto'], $idGenIngreso, 2, $diferencia, "Se agregaron producto a una venta", 0, $idVendedor, $fecha);
                                        }
                                    }
                                } elseif ($datosVenta[$key]['cantidad'] < $ingresoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosVenta[$key]['idProducto']) {
                                    //--- Update registro detalle ingreso ---//
                                    $this->app_model->update_ingreso_detalle_by_idProducto($idGenIngreso, $datosVenta[$key]['idProducto'], $datosVenta[$key]['cantidad'], $datosVenta[$key]['precio'], $datosVenta[$key]['descuento'], $datosVenta[$key]['subtotalProd'], $datosVenta[$key]['iva'], $datosVenta[$key]['ivaText']);
                                    //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                                    if ($empresas[0]['stock'] == 0) {
                                        if ($producto_idProducto[0]['controlStock'] == 0) {
                                            //--- Diferencia para stock ---//
                                            $diferencia = $ingresoDetalle[$key]['cantidad'] - $datosVenta[$key]['cantidad'];
                                            $cantidadActualizada = $datosVenta[$key]['stock'] + $diferencia;
                                            //--- Update stock ---//
                                            $result2 = $this->app_model->update_stock_by_idProducto($ingresoDetalle[$key]['idProducto'], $cantidadActualizada);

                                            //--- Guardo el movimiento del stock ---//
                                            $hoy = getdate();
                                            $d = $hoy['mday'];
                                            (($d < 10) ? $d = "0" . $d : $d);
                                            $m = $hoy['mon'];
                                            (($m < 10) ? $m = "0" . $m : $m);
                                            $y = $hoy['year'];
                                            $fecha = $d . "-" . $m . "-" . $y;
                                            $movimiento_stock = $this->app_model->update_movimiento_stock($producto_idProducto[0]['idGenProducto'], $idGenIngreso, 2, $diferencia, "Se quitaron productos de una venta", 1, $idVendedor, $fecha);
                                        }
                                    }
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
                                //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                                if ($empresas[0]['stock'] == 0) {
                                    if ($producto[0]['controlStock'] == 0) {
                                        //--- update stock producto ---//
                                        $cantidadTotal = $producto[0]['stock'] + $ingresoDetalle[$key]['cantidad'];
                                        $update_stock_producto = $this->app_model->update_stock_by_idProducto($ingresoDetalle[$key]['idProducto'], $cantidadTotal);

                                        //--- Guardo el movimiento del stock ---//
                                        $movimiento_stock = $this->app_model->drop_movimiento_stock($producto[0]['idGenProducto'], $idGenIngreso, 2, "Se elimino el producto de la venta", 0, $idVendedor);

                                        //--- eliminar el detalle presupuesto ---//
                                        $delete_ingreso = $this->app_model->eliminar_ingreso_by_idGenIngreso_idProducto($idGenIngreso, $ingresoDetalle[$key]['idProducto']);
                                    }
                                }
                            }
                        }
                    }

                    //--- Se comparan para saber si esta venta ya fue parcialmente pagada o saldada para actualizar los estados del ingreso ---//
                    if ($ingreso[0]['total'] == $ingreso[0]['aCobrar']) {
                        $result_estado_ingreso = $this->app_model->update_estado_ingreso_by_idGenIngreso($idGenIngreso, $totalVenta, 0, 2);
                    } else {
                        //--- Verificamos si el total actual de la venta con el monto anterior para saber si debemos aplicarle una suma o resta al aCobrar
                        if ($ingreso_anterior[0]['total'] > $totalVenta) {
                            $totalDiferencia = $ingreso_anterior[0]['aCobrar'] - ($ingreso_anterior[0]['total'] - $totalVenta);
                            //--- comparamos que el monto aCobrar no sea inferior a 0 y si lo salda queden actualizados el estado ---//
                            if (floatval($totalDiferencia) > floatval(0)) {
                                $result_estado_ingreso = $this->app_model->update_estado_ingreso_by_idGenIngreso($idGenIngreso, $totalDiferencia, 0, 2);
                            } elseif (floatval($totalDiferencia) <= floatval(0)) {
                                $result_estado_ingreso = $this->app_model->update_estado_ingreso_by_idGenIngreso($idGenIngreso, 0, 1, 1);
                            }
                        } elseif ($ingreso_anterior[0]['total'] < $totalVenta) {
                            $totalDiferencia = $ingreso_anterior[0]['aCobrar'] + ($totalVenta - $ingreso_anterior[0]['total']);
                            $result_estado_ingreso = $this->app_model->update_estado_ingreso_by_idGenIngreso($idGenIngreso, $totalDiferencia, 0, 2);
                        }
                    }

                    //---- Obtencion de la cuenta corriente que pertenece a este ingreso ---//
                    $get_cuenta_corriente = $this->app_model->get_cuenta_corriente_by_idGenIngreso($idGenIngreso);

                    //--- Saldo calculado con la diferencia correspondiente ---//
                    $saldo = $get_cuenta_corriente[0]['saldo'] + ($totalVenta - $ingreso_anterior[0]['total']);
                    //--- Update cuenta corriente ---//
                    $debito = $totalVenta;
                    $result_cuenta_corriente = $this->app_model->update_cuenta_corrientes_by_idGenIngreso_ordenAsc_limit1(
                        $idGenIngreso,
                        $datosFacturacion[0], //selectCliente
                            $debito, //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                            $credito = 0, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                            $saldo, //Saldo
                            $descripcionCobro = "Ajuste al editar la venta"
                    );

                    //--- Verificamos si los montos son distintos para hacer actualizacion de los montos de saldo de las cuentas corrientes
                    if ($ingreso_anterior[0]['total'] != $totalVenta) {
                        foreach ($get_cuenta_corriente as $key => $value_cuenta_corriente) {
                            //--- Saldo calculado con la diferencia correspondiente ---//
                            if (($totalVenta - $ingreso_anterior[0]['total']) == 0) {
                                $saldo = 0;
                            } else {
                                $saldo = $value_cuenta_corriente['saldo'] + ($totalVenta - $ingreso_anterior[0]['total']);
                            }
                            $result_cuenta_corriente = $this->app_model->update_saldo_cuenta_corrientes_by_idGenIngreso(
                                $idGenIngreso,
                                $value_cuenta_corriente['idCuentaCorriente'],
                                $saldo //Saldo
                            );
                        }
                    }

                    //--- Guardo - Historico ---//
                    $resultHistorico = $this->app_model->set_historico(
                        $idVendedor,
                        $idGenIngreso,
                        $tipoAccion = 2,
                        $tipoOperacion = 2,
                        "Se modificó una venta a " . $datosFacturacion[0], //detalle
                            $datosFacturacion[11] //total
                    );
                }
                if ($resultHistorico) {
                    $msg = "Se actualizaron los datos correctamente";
                    $dato = array("valid" => true, "msg" => $msg, "idGenIngreso" => $idGenIngreso);
                } else {
                    $msg = "Se producjo un error, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_venta()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        $idIngreso = $this->input->post('id', true);
        $msg = "";

        if (!empty($idIngreso)) {
            //--- Guardo - Historico ---//
            $result_insert_historico = $this->app_model->set_historico(
                $idUsuario,
                $idIngreso,
                $tipoAccion = 3,
                $tipoOperacion = 2,
                $detalle = 'Se elimino una venta', //detalle
                    $total = 0
            );


            $ingreso = $this->app_model->get_ingreso_by_idIngreso($idIngreso);
            if ($ingreso) {
                $ingresoDetalle = $this->app_model->get_ingreso_detalle_by_idGenIngreso($ingreso[0]['idGenIngreso']);
                if ($ingresoDetalle) {
                    $count = count($ingresoDetalle);
                    $checkCount = 0;
                    foreach ($ingresoDetalle as $key => $value) {
                        if ($value['eliminado'] == 0) {
                            $productoDetalle = $this->app_model->get_producto($value['idProducto']);
                            $nuevoStock = $productoDetalle[0]['stock'] + $value['cantidad'];
                            $result = $this->app_model->update_stock_by_idProducto($value['idProducto'], $nuevoStock);

                            $producto = $this->app_model->get_producto($value['idProducto']);

                            //--- Guardo el movimiento del stock ---//
                            $movimiento_stock = $this->app_model->drop_movimiento_stock($producto[0]['idGenProducto'], 2, $ingreso[0]['idGenIngreso'], "Se elimino el producto de la venta", 0, $idUsuario);

                            if ($result) {
                                $checkCount++;
                            }
                        } else {
                            $checkCount++;
                        }
                    }
                    if ($count == $checkCount) {
                        $result2 = $this->app_model->eliminar_ingreso_by_idGenIngreso($ingreso[0]['idGenIngreso']);
                        $result3 = $this->app_model->eliminar_cuenta_corriente_by_idGenIngreso($ingreso[0]['idGenIngreso']);
                        $result4 = $this->app_model->eliminar_ingreso_detalle_by_idGenIngreso($ingreso[0]['idGenIngreso']);
                    }
                }
            }


            if ($result2 && $result3 && $result4) {
                $msg = "Categoría eliminada con exito";
                $dato = array("valid" => true, "msg" => $msg, "result2" => $result2, "result3" => $result3, "result4" => $result4);
            } else {
                $msg = "Error al eliminar la categoría, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg, "result2" => $result2, "result3" => $result3, "result4" => $result4);
            }
        } else {
            $msg = "Id vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function listar_categorias_detalle()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $categorias_ventas = $this->app_model->get_categorias_ventas();
        $this->data['categorias_ventas'] = $categorias_ventas;

        $this->load_view('ventas/listar_categorias_detalle', $this->data);
    }

    public function listar_subcategorias()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $subcategorias_ventas = $this->app_model->get_subcategorias_ventas_categoria_detalle();
        $this->data['subcategorias_ventas'] = $subcategorias_ventas;

        $categorias_ventas_detalle = $this->app_model->get_categorias_ventas();
        $this->data['categorias_ventas_detalle'] = $categorias_ventas_detalle;

        $this->load_view('ventas/listar_subcategorias', $this->data);
    }

    public function update_categorias_ventas()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $id = $this->input->post('inputIdModificar_formCatVentas', true);
        $inputDescripcion = $this->input->post('inputDescripcionModificar_formCatVentas', true);

        $result = $this->app_model->update_categoria_ventas($id, $inputDescripcion);

        //--- Recoleccion de datos ---//
        for ($i = 0; $i < 26; $i++) {
            $inputDescripcion_formModificarCatVenta[] = $this->input->post('inputSubcategoria_formCatModificarVentas' . $i, true);
            $idSubcategoria_formModificarCatVenta[] = $this->input->post('idSubcategoria_formCatModificarVentas' . $i, true);
        }

        //--- Operaciones ---//
        //--- Borrado ---//
        $subcategorias = $this->app_model->get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($id );
        if ($subcategorias) {
            foreach ($subcategorias as $key => $value) {
                $contador=0;
                for ($i = 0; $i < 26; $i++) {
                    if ($idSubcategoria_formModificarCatVenta[$i] != $value['idSubcategoriaVenta']) {
                        $contador+=1;
                    }
                }
                if(25 != $contador){
                    
                    $ingresos_categoria = $this->app_model->get_ingreso_by_idCategoria($value['idSubcategoriaVenta']);
                    if (!$ingresos_categoria) {
                        $result_subcategoria = $this->app_model->delete_subcategoria_ventas_by_idSubCategoriaVenta($value['idSubcategoriaVenta']);
                    } else {
                        $result_subcategoria = true;
                    }
                }
            }
        }

        //--- Insert and Update ---//
        for ($i = 0; $i < 26; $i++) {
            $subcategoria = $this->app_model->get_subcategorias_ventas_detalle_by_idSubCategoriaVenta($idSubcategoria_formModificarCatVenta[$i]);
            if (!$subcategoria && $inputDescripcion_formModificarCatVenta[$i] != false) {
                $result_subcategoria = $this->app_model->insert_subcategoria_ventas($inputDescripcion_formModificarCatVenta[$i], $id);
            } else if ($subcategoria && $inputDescripcion_formModificarCatVenta[$i] != false) {
                $result_subcategoria = $this->app_model->update_subcategoria_ventas($idSubcategoria_formModificarCatVenta[$i], $inputDescripcion_formModificarCatVenta[$i], $id);
            } else {
                $result_subcategoria = true;
            }
        }

        $userdata = $this->session->all_userdata();
        $idVendedor = $userdata['idUsuario'];

        //--- Guardo - Historico ---//
        $result_insert_historico = $this->app_model->set_historico(
            $idVendedor,
            $id,
            $tipoAccion = 2,
            $tipoOperacion = 10, //Agrega nuevo cobro
                "Se modificó una categoría de venta", //detalle
                0 //montoCobro
        );
        if ($result || $result_subcategoria) {
            $msg = "Categoría de venta fue actualizada con exito";
            $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id);
        } else {
            $msg = "Error al actualizar la categoría de venta, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg, "subcategorias" => $subcategorias);
        }

        echo json_encode($dato);
    }

    public function eliminar_categoria_ventas()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $id = $this->input->post('id', true);
        $count = 0;
        $result = false;
        
        $ingresos_categoria = $this->app_model->get_ingreso_by_idCategoria($id);
        
        if ($ingresos_categoria) {
            foreach ($ingresos_categoria as $key => $value) {
                $count+=1;
                break;
            }
        } else {
            $count = 0;
        }
        
        if ($count == 0) {
            $result = $this->app_model->delete_categoria_ventas($id);
        }
        
        $userdata = $this->session->all_userdata();
        $idVendedor = $userdata['idUsuario'];

        //--- Guardo - Historico ---//
        $result_insert_historico = $this->app_model->set_historico(
            $idVendedor,
            $id,
            $tipoAccion = 3,
            $tipoOperacion = 10, //Agrega nuevo cobro
                "Se eliminó una categoría de venta", //detalle
                0 //montoCobro
        );
        
        if ($result && $result_insert_historico && $count == 0) {
            $msg = "Categoría de venta fue eliminada con exito";
            $dato = array("valid" => true, "msg" => $msg);
        } else if ($count != 0) {
            $msg = "Error no se puede eliminar esta categoría porque esta asociada al menos a una venta, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        } else {
            $msg = "Error al eliminar la categoría de venta, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function add_categorias_ventas()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        if ($_POST) {
            $inputDescripcion = $this->input->post('inputDescripcion_formCatVentas', true);

            $existe = $this->app_model->get_existe_categoria_ventas($inputDescripcion);


            if ($existe == 0) {
                $result = $this->app_model->insert_categoria_ventas($inputDescripcion);

                if ($result) {
                    $id = $this->app_model->get_ultimo_id_categoria_ventas($inputDescripcion);

                    $userdata = $this->session->all_userdata();
                    $idVendedor = $userdata['idUsuario'];
                    //--- Guardo - Historico ---//
                    $result_insert_historico = $this->app_model->set_historico(
                        $idVendedor,
                        $id[0]['id'],
                        $tipoAccion = 1,
                        $tipoOperacion = 10, //Agrega nuevo cobro
                            "Se agregó una categoría detalle de venta", //detalle
                            0 //montoCobro
                    );

                    for ($i = 0; $i < 26; $i++) {
                        $inputDescripcion_formCatVentas[] = $this->input->post('inputSubcategoria_formCatVentas' . $i, true);
                        if ($inputDescripcion_formCatVentas[$i] != false) {
                            $result_subcategoria = $this->app_model->insert_subcategoria_ventas($inputDescripcion_formCatVentas[$i], $id[0]['id']);
                        }
                    }

                    $msg = "Categoría de venta fue agregada con exito";
                    $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id[0]['id']);
                } else {
                    $msg = "Error al agregar una nueva categoría de venta, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg, 'existe' => $existe, 'inputDescripcion' => $inputDescripcion);
                }
            } else {
                $msg = "Existe esta categoría insertada";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }
    
    public function add_subcategorias_ventas()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        if ($_POST) {
            $inputDescripcion = $this->input->post('inputDescripcion_formSubCatVentas', true);
            $selectCategoriaDetalle = $this->input->post('selectCategoriaDetalle_formSubCatVentas', true);

            $result = $this->app_model->insert_subcategoria_ventas($inputDescripcion, $selectCategoriaDetalle);

            if ($result) {
                $msg = "Subcategoría fue añadida con exito";
                $id = $this->app_model->get_ultimo_id_subcategoria_ventas($inputDescripcion);

                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];
                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                    $idVendedor,
                    $id[0]['id'],
                    $tipoAccion = 1,
                    $tipoOperacion = 12, //Agrega nuevo cobro
                        "Se agregó una nueva subcategoría de venta", //detalle
                        0 //montoCobro
                );
                $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id[0]['id'], "selectCategoriaDetalle" => $selectCategoriaDetalle);
            } else {
                $msg = "Error al añadir la subcategoría, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function update_subcategorias_ventas()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $id = $this->input->post('inputId_formSubCatVentas', true);
        $inputDescripcion = $this->input->post('inputDescripcion_formSubCatVentas', true);
        $selectCategoriaDetalle = $this->input->post('selectCategoriaDetalle_formSubCatVentas', true);

        $result = $this->app_model->update_subcategoria_ventas($id, $inputDescripcion, $selectCategoriaDetalle);

        $userdata = $this->session->all_userdata();
        $idVendedor = $userdata['idUsuario'];
        //--- Guardo - Historico ---//
        $result_insert_historico = $this->app_model->set_historico(
            $idVendedor,
            $id,
            $tipoAccion = 2,
            $tipoOperacion = 12, //Agrega nuevo cobro
                "Se modificó una subcategoría de venta", //detalle
                0 //montoCobro
        );
        if ($result) {
            $msg = "Subcategoría actualizada con exito";
            $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id, "selectCategoriaDetalle" => $selectCategoriaDetalle);
        } else {
            $msg = "Error al actualizar la subcategoría, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_subcategorias_ventas()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $id = $this->input->post('id', true);
        $count = 0;
        $result = false;

        $ingresos_subcategoria = $this->app_model->get_ingreso_by_idSubCategoria($id);
        
        if ($ingresos_subcategoria) {
            foreach ($ingresos_subcategoria as $key => $value) {
                $count+=1;
                break;
            }
        } else {
            $count = 0;
        }
        
        if ($count == 0) {
            $result = $this->app_model->delete_subcategoria_ventas($id);
        }

        $userdata = $this->session->all_userdata();
        $idVendedor = $userdata['idUsuario'];

        //--- Guardo - Historico ---//
        $result_insert_historico = $this->app_model->set_historico(
            $idVendedor,
            $id,
            $tipoAccion = 3,
            $tipoOperacion = 12, //Agrega nuevo cobro
                "Se eliminó una subcategoria de venta", //detalle
                0 //montoCobro
        );

        if ($result && $result_insert_historico && $count == 0) {
            $msg = "Subcategoría eliminada con exito";
            $dato = array("valid" => true, "msg" => $msg);
        } else if ($count != 0) {
            $msg = "Error al eliminar la subcategoría ya que pertenece a algun ingreso, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        } else {
            $msg = "Error al eliminar la subcategoría, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function listar_venta_detalle_table($idGenIngreso)
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $ingreso_detalle = $this->app_model->get_ingreso_detalle_by_idGenIngreso($idGenIngreso);
        $ivaTipos = $this->app_model->get_iva_tipos();
        $empresa = $this->app_model->get_empresas();

        if ($ingreso_detalle) {
            foreach ($ingreso_detalle as $key => $value) {
                $idGenIngreso = "'" . $idGenIngreso . "'";

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
                    $cantidad = '<input type="text" value="' . $value["cantidad"] . '" id="cantProd' . $value["idProducto"] . '" onkeyup="calculoVentaEditar(' . $value["idProducto"] . ',' . $value["stock"] . ',' . $value["cantidad"] . ',' . $empresa[0]['stock'] . ')" class="form-control">';
                } elseif ($empresa[0]['stock'] == 1) {
                    $cantidad = '<input type="text" value="' . $value["cantidad"] . '" id="cantProd' . $value["idProducto"] . '"  onkeyup="calculoVentaEditar(' . $value["idProducto"] . ',' . $value["stock"] . ',' . $value["cantidad"] . ',' . $empresa[0]['stock'] . ')" class="form-control">';
                }

                $dato[] = array(
                    $value["idProducto"],
                    $value['codigo'],
                    $value['nombre'],
                    $cantidad .
                    '<div id="errorStock' . $value["idProducto"] . '" class="btn-danger erroBoxs" style="display: none">' .
                    'Stock: ' . $value["stock"] .
                    '</div>',
                    $value['stock'],
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["precio"] . '" id="precioProd' . $value["idProducto"] . '" disabled class="form-control">' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">%</span>' .
                    '<input type="text" value="' . $value["descuento"] . '" id="descProd' . $value["idProducto"] . '" onkeyup="calculoVentaEditar(' . $value["idProducto"] . ')" class="form-control">' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["subTotal"] . '" id="subTotalProd' . $value["idProducto"] . '" readonly class="form-control">' .
                    '</div>',
                    '<select id="selectIva' . $value["idProducto"] . '" onchange="calculoVentaEditar(' . $value["idProducto"] . ')" class="select-full" required>
                        <option value="0">IVA</option>' .
                    $opcines_iva .
                    '</select>',
                    '<i class="icon-remove4" onclick="deleteRowListaVentaEditar(' . $value["idProducto"] . ')"></i>',
                    "DT_RowId" => $value['idProducto']
                );
            }
        }

        $aa = array(
            'sEcho' => 1,
            'iTotalRecords' => count($dato),
            'iTotalDisplayRecords' => 10,
            'aaData' => $dato,
        );
        echo json_encode($aa);
    }

    public function listar_ventas_informe()
    {
        $this->data['tesoreriaCuenta'] = $this->app_model->get_tesoreria_cuentas();

        $this->load_view('informes/listar_ventas_informe', $this->data);
    }

    public function listar_ventas_informe_table()
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $ingresos = $this->app_model->get_ingresos();
        $estados = $this->app_model->get_estados();

        if ($ingresos) {
            foreach ($ingresos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-success";
                $texto = "Cobrado"; elseif ($value['idEstado'] == 2):
                    $class = "btn-info";
                $texto = "A Cobrar"; elseif ($value['idEstado'] == 3):
                    $class = "btn-danger";
                $texto = "Vencido"; else:
                    $class = "btn-warning";
                $texto = "Sin Estado";
                endif;

                $facturaIdIngreso = $this->app_model->get_factura_idGenIngreso($value['idGenIngreso']);

                $idGenIngreso = "'" . $value['idGenIngreso'] . "'";
                $opcion = ' <div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '</div>';

                $categoria = $this->app_model->get_categorias_ventas_byId($value['idCategoria']);

                $dato[] = array(
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVtoCobro'],
                    $value['nombEmpresa'],
                    $categoria[0]['descripcion'],
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

    public function listar_ventas_informe_table_filtro($desde, $hasta)
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $ingresos = $this->app_model->get_ingresos_desde_hasta($desde, $hasta);
        $estados = $this->app_model->get_estados();

        if ($ingresos) {
            foreach ($ingresos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-success";
                $texto = "Cobrado"; elseif ($value['idEstado'] == 2):
                    $class = "btn-info";
                $texto = "A Cobrar"; elseif ($value['idEstado'] == 3):
                    $class = "btn-danger";
                $texto = "Vencido"; else:
                    $class = "btn-warning";
                $texto = "Sin Estado";
                endif;

                $facturaIdIngreso = $this->app_model->get_factura_idGenIngreso($value['idGenIngreso']);

                $idGenIngreso = "'" . $value['idGenIngreso'] . "'";
                $opcion = ' <div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '</div>';

                $categoria = $this->app_model->get_categorias_ventas_byId($value['idCategoria']);

                $dato[] = array(
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVtoCobro'],
                    $value['nombEmpresa'],
                    $categoria[0]['descripcion'],
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

    public function exportar_to_excel_ventas()
    {
        $this->load->helper('mysql_to_excel_helper');

        //--- tomar datos del post ---//
        $fechaDesde = $this->input->post('fechaI_informeVenta', true);
        $fechaHasta = $this->input->post('fechaF_informeVenta', true);

        //--- fecha actual ---//
        $hoy = getdate();
        $fechaActual = $hoy['mday'] . $hoy['mon'] . $hoy['year'];

        //--- exportar excel ---//
        //--- verificar si es vacio o no el filtro de fechas ---//
        if ($fechaDesde == 0 && $fechaHasta == 0) {
            to_excel($this->app_model->get_ingresos_exportar(), "informeVentas" . $fechaActual);
        } elseif ($fechaDesde != 0 && $fechaHasta != 0) {
            to_excel($this->app_model->get_ingresos_desde_hasta_exportar($fechaDesde, $fechaHasta), "informeVentas" . $fechaActual . "-desde" . $fechaDesde . "-hasta" . $fechaHasta);
        }
    }

    public function ver_factura()
    {
        $this->load_view('ventas/factura', $this->data);
    }

    public function get_cliente($idCliente)
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Obtenemos datos necesarios ---//
        $cliente = $this->app_model->get_cliente_byIdCliente($idCliente);
        $cliente_detalle_ventas = $this->app_model->get_cliente_detalle_ventas_byIdCliente($cliente[0]['idGenCliente']);
        //--- Valor del descuento ---//
        $descuento = $cliente_detalle_ventas[0]['dtoGeneral'];

        if ($cliente && $cliente_detalle_ventas) {
            $msg = "Cliente";
            $dato = array("valid" => true, "msg" => $msg, "cliente" => $cliente, "descuento" => $descuento);
        } else {
            $msg = "No se pudo obtener los datos del cliente exitosamente";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function enviar_email_detalle_venta()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $email = $this->input->post('email', true);
        $idGenIngreso = $this->input->post('idGenIngreso', true);
        $asunto = $this->input->post('asunto', true);
        $cuerpo = $this->input->post('cuerpo', true);
        $url_pdf = $this->input->post('url_pdf', true);
        $nombreArchivo = $this->input->post('nombreArchivo', true);


        $fileatt = $url_pdf; //file location
        $fileatttype = "application/pdf";
        $fileattname = "$nombreArchivo"; //name that you want to use to send or you can use the same name
        // File
        $file = fopen($fileatt, 'rb');
        $data = fread($file, filesize($fileatt));
        fclose($file);

        $message .= utf8_decode($cuerpo) .
                "--{$mime_boundary}\n" .
                "Content-Type: {$fileatttype};\n" .
                " name=\"{$fileattname}\"\n" .
                "Content-Disposition: attachment;\n" .
                " filename=\"{$fileattname}\"\n" .
                "Content-Transfer-Encoding: base64\n\n" .
                $presupuesto_enviado = mail($email, utf8_decode($asunto), $message);

        if ($presupuesto_enviado) {
            $msg = "El presupuesto fue enviado";
            $dato = array("valid" => true, "msg" => $msg);
        } else {
            $msg = "producto o iva vacio";
            $dato = array("valid" => true, "msg" => $msg);
        }

        echo json_encode($dato);
    }
}
