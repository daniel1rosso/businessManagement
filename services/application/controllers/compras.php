<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Compras extends MY_Controller {

    protected $data = array(
        'active' => 'egresos'
    );

    public function __construct() {
        parent::__construct();
    }

    public function listar_compras() {
        $this->data['egresos'] = $this->app_model->get_egresos();

        $this->data['estados'] = $this->app_model->get_estados();

        $this->data['tesoreriaCuenta'] = $this->app_model->get_tesoreria_cuentas();

        $this->load_view('compras/listar_compras', $this->data);
    }

    public function generaPDFcupon($idGenEgreso) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";
        $result = $this->app_model->get_estado_cuenta_pdf_by_idGenEgreso($idGenEgreso);
        //print_r($result);

        $egreso = $this->app_model->get_egreso_by_idGenEgreso($idGenEgreso);

        if ($result && $egreso) {
            //-- NOMBRE Y DIRECTORIO --//
            $directorio = 'uploads/comprobantes/pago/' . $idGenEgreso;

            if (!is_dir($directorio)) {
                mkdir($directorio, 0777);
            }

            //-- CARGO LIBRERIAS --//
            $this->load->library('html2pdf');

            $this->html2pdf->folder('./uploads/comprobantes/pago/' . $idGenEgreso . "/");
            $this->html2pdf->filename($result[0]['idGenComprobante'] . ".pdf");
            $this->html2pdf->paper('a4', 'portrait');
           
            $acuTotal = 0;
            $cuerpo = "";

            foreach ($result as $key => $value) {
                //-- FECHA --//
                $fecha_pago = strtotime($value['fechaPago']);
                $fecha_pago = date("d/m/Y", $fecha_pago);

                //-- FILAS --//
                $cuerpo .= '<tr>
                            <td class="tg-swzm" colspan="2">'. $fecha_pago .'</td>
                            <td class="tg-swzm" colspan="2">'. $value['cuenta'] .'</td>
                            <td class="tg-swzm" colspan="6">'. $value['descripcion'] .'</td>
                            <td class="tg-swzm" colspan="2">'. "$" . number_format($value['pague'], 2, ',', '.') .'</td>
                        </tr>';
                
                $acuTotal = $value['pague'] + $acuTotal;
            }
            
            $fecha_alta = strtotime($result[0]['fechaAlta']);
            $fecha_alta = date("d/m/Y", $fecha_alta);

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
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold">RECIBO DE PAGO</span></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6"></td>
                        <td class="tg-704r" colspan="6"><br><br>Numero Remito: X ' . $result[0]['numeroPtoVta'] . '-' . $result[0]['idCuentaCorriente']. '<br>Fecha emisión:  ' . $fecha_alta . '<br><br><br></td>
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
            $dato = array("valid" => true, "msg" => $msg, "idGenComprobante" => $value['idGenComprobante'] . ".pdf", 'egreso' => $egreso);
        } else {
            $msg = "No se ha podiado realizar el pdf, esta vacio idGenIngreso";
            $dato = array("valid" => true, "msg" => $msg);
        }
        echo json_encode($dato);
    }

    public function generaPDFDetalleEgreso($idGenEgreso) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $egreso = $this->app_model->get_egreso_by_idGenEgreso($idGenEgreso);
        $detalleEgreso = $this->app_model->get_egreso_detalle_by_idGenEgreso($idGenEgreso);

        if ($egreso && $detalleEgreso && $idGenEgreso) {
            //-- NOMBRE Y DIRECTORIO --//
            $directorio = 'uploads/comprobantes/compras/' . $idGenEgreso;

            if (!is_dir($directorio)) {
                mkdir($directorio, 0777);
            }

            $nombreArchivo = $idGenEgreso . date("YmdHis");

            //-- CARGO LIBRERIAS --//
            $this->load->library('html2pdf');

            $this->html2pdf->folder('./uploads/comprobantes/compras/' . $idGenEgreso . "/");
            $this->html2pdf->filename($nombreArchivo . ".pdf");
            $this->html2pdf->paper('a4', 'portrait');

            //-- DATOS TABLA --//
            $acuTotal = 0;
            $cuerpo = "";
            foreach ($detalleEgreso as $key => $value) {
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
            
            if ($egreso[0]['razonSocial'] == "") {
                $razonSocial = "-";
            } else {
                $razonSocial = $egreso[0]['razonSocial'];
            }
            
            if ($egreso[0]['domicilio'] == "") {
                $domicilio = "-";
            } elseif ($egreso[0]['domicilio'] != "" && $egreso[0]['piso'] == "" && $egreso[0]['dpto'] == "") {
                $domicilio = $egreso[0]['domicilio'] . " " . $egreso[0]['nro'] . " piso -" . " dpto -";
            } elseif ($egreso[0]['domicilio'] != "" && $egreso[0]['piso'] != "" && $egreso[0]['dpto'] == "") {
                $domicilio = $egreso[0]['domicilio'] . " " . $egreso[0]['nro'] . " piso " . $egreso[0]['piso'] . " dpto -";
            } elseif ($egreso[0]['domicilio'] != "" && $egreso[0]['piso'] == "" && $egreso[0]['dpto'] != "") {
                $domicilio = $egreso[0]['domicilio'] . " " . $egreso[0]['nro'] . " piso -" . " dpto " . $egreso[0]['dpto'];
            } elseif ($egreso[0]['domicilio'] != "" && $egreso[0]['piso'] != "" && $egreso[0]['dpto'] != "") {
                $domicilio = $egreso[0]['domicilio'] . " " . $egreso[0]['nro'] . " piso " . $egreso[0]['piso'] . " dpto " . $egreso[0]['dpto'];
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
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold">DETALLE COMPRA</span></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6"></td>
                        <td class="tg-704r" colspan="6"><br><br>Fecha emisión:  ' . date("d/m/Y") . '<br><br><br></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="12">Fecha Vencimiento: ' . date("d/m/Y", strtotime($egreso[0]['fechaVtoPago'])) . '</td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6">Razón Social: ' . utf8_decode($razonSocial) . '<br>Nombre: ' . utf8_decode($egreso[0]['nombEmpresa']) . '<br>Celular: ' . $egreso[0]['cel'] . '<br>Domicilio: ' . utf8_decode($domicilio) . '</td>
                        <td class="tg-704r" colspan="6">' . $egreso[0]['tipoDoc'] . ': ' . $egreso[0]['cuit'] . '<br>Condición Iva: ' . $egreso[0]['condicionIva'] . '<br>Categoría: ' . utf8_decode($egreso[0]['categoriaGasto']) . '<br>Vendedor: ' . $egreso[0]['apellidoVend'] . ", " . $egreso[0]['nombreVend'] . '</td>
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
                            <td style="border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:right;" colspan="12">Importe Neto Gravado: $' . number_format($egreso[0]['importeNetoNoGravado'], 2, ',', '.') . '<br>Iva: $' . number_format($egreso[0]['ivaTotal'], 2, ',', '.') . '<br>Total: $' . number_format($egreso[0]['total'], 2, ',', '.') . '<br>Total A Pagar: $' . number_format($egreso[0]['aPagar'], 2, ',', '.') . '</td>
                        </tr>
                    </tfoot>
                    <!--  FIN TFOOD -->
                </table>
            </div>
        ');

            $this->html2pdf->create('save');


            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "nombrePdf" => $nombreArchivo . ".pdf", "longitud" => iconv_strlen($egreso[0]['tipoDoc']));
        } else {
            $msg = "No se ha podiado realizar el pdf, esta vacio idGenEgreso";
            $dato = array("valid" => true, "msg" => $msg, "idGenEgreso" => $idGenEgreso, "egreso" => $egreso, "detalleEgreso" => $detalleEgreso);
        }
        echo json_encode($dato);
    }

    public function agregar_compra() {
        $this->data['proveedores'] = $this->app_model->get_proveedores();

        $this->data['categoriasCompras'] = $this->app_model->get_categorias_compras();

        $this->data['categoriasComprasDetalle'] = $this->app_model->get_categorias_compras_detalle();

        $this->data['facturaTipos'] = $this->app_model->get_factura_tipos();

        $this->data['razonSocial'] = $this->app_model->get_razon_social();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['iva_tipos'] = $this->app_model->get_iva_tipos();

        $this->load_view('compras/agregar_compra', $this->data);
    }

    public function buscaSubcategoriaCompraDetalle() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idCategoriaCompra = $this->input->post('idCategoriaCompra', true);
        $subcategoriasCompras = $this->app_model->get_subcategorias_compras_detalle_by_idCategoriaCompra($idCategoriaCompra);

        echo '<option value="0">Seleccionar Subcategoria Compra</option>';
        if (!empty($subcategoriasCompras)) {
            foreach ($subcategoriasCompras as $key => $value) {
                echo '<option value="' . $value['idSubcategoriaCompra'] . '">' . $value['descripcion'] . '</option>';
            }
        } else {
            echo "No hay subcategorias para la cateogria seleccionada";
        }
    }

    public function editar_compra($idGenEgreso = null) {
        $this->data['idGenEgreso'] = $idGenEgreso;

        $egreso = $this->app_model->get_egreso_by_idGenEgreso($idGenEgreso);
        $this->data['egreso'] = $egreso;

        $this->data['egresoDetalle'] = $this->app_model->get_egreso_detalle_by_idGenEgreso($idGenEgreso);

        $this->data['proveedores'] = $this->app_model->get_proveedores();

        $this->data['categoriasCompras'] = $this->app_model->get_categorias_compras();

        $this->data['facturaTipos'] = $this->app_model->get_factura_tipos();

        $this->data['razonSocial'] = $this->app_model->get_razon_social();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['modalidadesAbono'] = $this->app_model->get_abono_modalidades();

        $this->data['ivaTipos'] = $this->app_model->get_iva_tipos();

        $this->load_view('compras/editar_compra', $this->data);
    }

    public function listar_egreso_detalle_table($idGenEgreso) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $egreso_detalle = $this->app_model->get_egreso_detalle_by_idGenEgreso($idGenEgreso);
        $ivaTipos = $this->app_model->get_iva_tipos();

        if ($egreso_detalle) {
            foreach ($egreso_detalle as $key => $value) {

                $idGenEgreso = "'" . $idGenEgreso . "'";

                $opcines_iva = "";

                if (isset($ivaTipos)):
                    for ($j = 0; $j < count($ivaTipos); $j++) :
                        if ($ivaTipos[$j]['descripcion'] == $value['ivaText']):
                            $opcines_iva .= '<option selected value="' . $ivaTipos[$j]['valorIva'] . '">' . $ivaTipos[$j]['descripcion'] . '</option>';
                        else:
                            $opcines_iva .= '<option value="' . $ivaTipos[$j]['valorIva'] . '">' . $ivaTipos[$j]['descripcion'] . '</option>';
                        endif;
                    endfor;
                endif;

                $dato[] = array(
                    $value["idProducto"],
                    $value['codigo'],
                    $value['nombre'],
                    '<input type="text" value="' . $value["cantidad"] . '" id="cantProd' . $value["idProducto"] . '" onkeyup="calculoCompraEditar(' . $value["idProducto"] . ',' . $value["stock"] . ',' . $value["cantidad"] . ')" class="form-control">' .
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
                    '<input type="text" value="' . $value["descuento"] . '" id="descProd' . $value["idProducto"] . '" onkeyup="calculoCompraEditar(' . $value["idProducto"] . ')" class="form-control">' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["subTotal"] . '" id="subTotalProd' . $value["idProducto"] . '" readonly class="form-control">' .
                    '</div>',
                    '<select id="selectIva' . $value["idProducto"] . '" onchange="calculoCompraEditar(' . $value["idProducto"] . ')" class="select-full" required>
                        <option value="0">IVA</option>' .
                    $opcines_iva .
                    '</select>',
                    '<i class="icon-remove4" onclick="deleteRowListaCompraEditar(' . $value["idProducto"] . ')"></i>',
                    "DT_RowId" => $value['idProducto']
                );
            }
        }

        $aa = array(
            'sEcho' => 1,
            'iTotalRecords' => count($dato),
            'iTotalDisplayRecords' => 10,
            'aaData' => $dato,
            'ivaTipos' => $ivaTipos,
            'egreso_detalle' => $egreso_detalle
        );
        echo json_encode($aa);
    }

    public function set_compra() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $datosFacturacion = $this->input->post('datosFacturacion', true);
            $datosCompra = $this->input->post('datosCompra', true);
            $acepto_menor = $this->input->post('acepto', true);

            $idGenEgreso = substr(md5(microtime()), 15, 17);
            $ivaTotal = 0;

            if (
                    !empty($datosFacturacion) AND ! empty($datosCompra)
            ) {
                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];

                //--- Fecha Emision ---//
                if (empty($datosFacturacion["inputFechaEmisionCompra"])) {
                    $fechaEmision = date("Y-m-d");
                } else {
                    $fechaEmision = $datosFacturacion["inputFechaEmisionCompra"];
                }

                //--- Fecha Vto. del Cobro ---//
                if (empty($datosFacturacion["inputFechaPagoCompra"])) {
                    $fechaPago = date("Y-m-d");
                } else {
                    $fechaPago = $datosFacturacion["inputFechaPagoCompra"];
                }

                //--- Obtencion de las configuraciones de la empresa ---//
                $empresa = $this->app_model->get_empresas();

                $aPagar = $datosFacturacion["total"];
                $saldado = 0; //
                
                //--- Fecha ---//
                $hoy = getdate();
                $d = $hoy['mday'];
                (($d < 10) ? $d = "0" . $d : $d);
                $m = $hoy['mon'];
                (($m < 10) ? $m = "0" . $m : $m);
                $y = $hoy['year'];
                $fecha = $d . "-" . $m . "-" . $y;
                //--- Fecha Hora ---//
                $h = $hoy['hours'];
                (($h < 10) ? $h = "0" . $h : $h);
                $min = $hoy['minutes'];
                (($min < 10) ? $min = "0" . $min : $min);
                $s = $hoy['seconds'];
                (($s < 10) ? $s = "0" . $s : $s);
                $fechaHora = $fecha . " " . $h . ":" . $min . ":" . $s;

                //--- Guardo - Detalle de Ingreso ---//
                //foreach($datosCompra as $key => $value){
                for ($i = 0; $i < count($datosCompra); $i++) {
                    $producto_idProducto = $this->app_model->get_productos_byId($datosCompra[$i]['idProducto']);
                    //--- Se realiza una peticion para saber si en este caso es el ultimo registro de este producto realizado, de serlo actualizara el precio del producto ---//
                    $compra_producto_mayor_fecha = $this->app_model->get_compra_producto_by_idProducto_fechaHora($datosCompra[$i]['idProducto'], $fechaHora);
                    if (!$compra_producto_mayor_fecha && $acepto_menor) {
                        $update_precio = $this->app_model->update_precio_producto($producto_idProducto[0]['idGenProducto'], $datosCompra[$i]['precio']);
                    }

                    $result_insert_compra_detalle = $this->app_model->insert_compra_detalle(
                            $idGenEgreso, $datosCompra[$i]['idProducto'], $datosCompra[$i]['cantidad'], $datosCompra[$i]['precio'], $datosCompra[$i]['descuento'], $datosCompra[$i]['subtotalProd'], $datosCompra[$i]['iva'], $datosCompra[$i]['ivaText']
                    );

                    $ivaTotal += $datosCompra[$i]['subtotalProd'] * $datosCompra[$i]['iva'];
                    
                    //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                    if ($empresa[0]['stock'] == 0) {
                        if ($producto_idProducto[0]['controlStock'] == 0) {
                            $cantidadActualizada = $datosCompra[$i]['stock'] + $datosCompra[$i]['cantidad'];
                            $result = $this->app_model->update_stock_by_idProducto($datosCompra[$i]['idProducto'], $cantidadActualizada);

                            //--- Guardo el movimiento del stock ---//
                            $movimiento_stock = $this->app_model->insert_movimiento_stock($producto_idProducto[0]['idGenProducto'], $idGenEgreso, 3, $datosCompra[$i]['cantidad'], "Se agregaron productos a la compra", 0, $idVendedor, $fecha);
                        }
                    }
                }

                $fechaPagoCuentaCorriente = date("Y-m-d H:i:s");
                $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente_proveedores(
                        $idGenEgreso, $idGenComprobante = 0, $datosFacturacion["selectProveedor"], $fechaPagoCuentaCorriente, $aPagar, //las deudas que vos tenes con tus proveedores..
                        $pague = 0, //Los pagos que realizo a los proveedores
                        $idMedioPago = 0, //Medio de cobro
                        $saldo = $aPagar, //Saldo
                        $descripcionPago = "Primer ingreso"
                );

                //--- Guardo - Compra ---//
                $result = $this->app_model->insert_compra(
                    $idGenEgreso, $tipoEgreso = 1, //Compra
                    $idVendedor, $datosFacturacion["selectProveedor"], //selectCliente
                    $fechaEmision, //fechaEmision
                    $fechaPago, //fechaPago
                    $datosFacturacion["selectTipoFactCompra"], //selectTipoFac
                    $datosFacturacion["selectCategoriaCompra"], //selectCatCompra
                    $datosFacturacion["notaInterna"], //notaInterna
                    $datosFacturacion["totalNoGravado"], //importeNoGravado
                    $datosFacturacion["total"], //totalCompra
                    $datosFacturacion["descTotal"], //descuentoTotal
                    $datosFacturacion["descProveedor"], //descuentoProveedor
                    $ivaTotal, //ivaTotal
                    $datosFacturacion["razonSocial"], //razonSocial
                    $aPagar, //aPagar                                    
                    $saldado, $idEstado = 1// Pendiende de pago                                  
                );

                if ($result && $result_cuenta_corriente) {
                    $msg = "Compra registrada con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al procesar la compra, vuelva a intentarlo";
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

    public function set_pago() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $idGenEgresoPagar = $this->input->post('idGenEgresoPagar', true);
            $inputFechaPago = $this->input->post('inputFechaPago', true);
            $montoPagar = $this->input->post('montoPagar', true);
            $selectMedioPago = $this->input->post('selectMedioPago', true);
            $descripcionPago = $this->input->post('descripcionPago', true);


            if (
                    !empty($idGenEgresoPagar) AND ! empty($montoPagar) AND ! empty($selectMedioPago)
            ) {
                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];

                //--- Fecha del nuevo cobro ---//
                if (empty($inputFechaPago)) {
                    $fechaPago = date("Y-m-d");
                } else {
                    $fechaPago = $inputFechaPago;
                }


                $estadoCuenta = $this->app_model->get_estado_cuenta_by_idGenEgreso($idGenEgresoPagar);
                $aPagar = 0;
                $pague = 0;
                //Calculo todos credito y debito de esa deuda en particular
                foreach ($estadoCuenta as $key => $value) {
                    $aPagar += $value['aPagar'];
                    $pague += $value['pague'];
                }
                $adeudado = $aPagar - $pague;
                if ($montoPagar > $adeudado) {
                    $msg = "El monto a cobrar no puede ser mayor al adeudado. Por favor actualice la pagina";
                    $dato = array("valid" => false, "msg" => $msg);
                } else {
                    $ultPosicion = count($estadoCuenta) - 1;
                    $nuevoSaldo = $estadoCuenta[$ultPosicion]['saldo'] - $montoPagar;

                    $idGenComprobante = md5(microtime());

                    $result = $this->app_model->insert_cuenta_corriente_proveedores(
                            $idGenEgresoPagar, $idGenComprobante, $estadoCuenta[0]['idProveedor'], //selectProveedor
                            $fechaPago, //fechaCobro
                            $aPagar = 0, //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                            $pague = $montoPagar, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                            $selectMedioPago, //Medio de cobro
                            $nuevoSaldo, //Saldo
                            $descripcionPago //descripcion
                    );

                    $result4 = $this->app_model->insert_ingreso_egreso_caja(
                            $idCaja = $selectMedioPago, $idGenEgresoPagar, $ingreso = 0, $egreso = $montoPagar, $descripcionMovimiento = "", $idGenMovimiento = 0, $idTipo = 2 //indica compra
                    );


                    if ($nuevoSaldo == 0) {
                        $resultUpdate = $this->app_model->update_estado_egreso_by_idGenEgreso($idGenEgresoPagar, $saldo = $nuevoSaldo, $saldado = 1, $idEstado = 2);
                    } else {
                        $resultUpdate = $this->app_model->update_estado_egreso_by_idGenEgreso($idGenEgresoPagar, $saldo = $nuevoSaldo, $saldado = 0, $idEstado = 1);
                    }
                    //--- Guardo - Historico ---//
                    $result_insert_historico = $this->app_model->set_historico(
                            $idVendedor, $idGenEgresoPagar, $tipoAccion = 1, $tipoOperacion = 9, "Se agregó una nueva compra de " . $estadoCuenta[0]['idProveedor'], //detalle
                            $montoPagar //total
                    );

                    if ($result && $result4) {
                        $msg = "Registro agregado";
                        $dato = array("valid" => true, "msg" => $msg, "idGenEgreso" => $idGenEgresoPagar);
                    } else {
                        $msg = "Error al procesar registro";
                        $dato = array("valid" => false, "msg" => $msg);
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

    public function get_monto_adeudado_by_idGenEgreso() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $id = $this->input->post('id', true);

            if (!empty($id)) {

                //--- Obtengo estado de cuenta de esa deuda puntual ---//
                $estadoCuenta = $this->app_model->get_estado_cuenta_by_idGenEgreso($id);

                $egreso = $this->app_model->get_egreso_by_idGenEgreso($id);
                $aPagar = 0;
                $pague = 0;
                $saldo = 0;
                if ($estadoCuenta && $egreso) {
                    //Calculo todos pague y aPagar de esa deuda en particular
                    foreach ($estadoCuenta as $key => $value) {
                        $aPagar += $value['aPagar'];
                        $pague += $value['pague'];
                        $saldo = $value['saldo'];
                    }
                    $adeudado = $saldo;

                    $msg = "Ok";
                    $dato = array("valid" => true, "msg" => $msg, "adeudado" => $adeudado, "aPagar" => $egreso[0]['aPagar'], 'id' => $id);
                } else {
                    $msg = "No se ha encontrado ningun registro con ese id";
                    $dato = array("valid" => false, "msg" => $msg, "id" => $id);
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

    public function update_compra() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $datosFacturacion = $this->input->post('datosFacturacion', true);
            $datosCompra = $this->input->post('datosCompra', true);
            $idGenEgreso = $this->input->post('idGenEgreso', true);

            if (
                    !empty($datosFacturacion) AND ! empty($datosCompra) AND ! empty($idGenEgreso)
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

                $egreso = $this->app_model->get_egreso_by_idGenEgreso($idGenEgreso);
                $egresoDetalle = $this->app_model->get_egreso_detalle_by_idGenEgreso($idGenEgreso);

                //--- calcular el monto a aPagar teniendo en cuenta la cuenta corriente de los proveedores ---//
                $estado_cuenta = $this->app_model->get_estado_cuenta_by_idGenEgreso($idGenEgreso);
                $aPagar = $datosFacturacion["total"];
                foreach ($estado_cuenta as $key => $value) {
                    $aPagar = $aPagar - $estado_cuenta[$key]['pague'];
                }
//                $aPagar = $egreso[0]['aPagar'] + ($datosFacturacion["total"] - $egreso[0]['total']);
                if ($aPagar > 0) {
                    $saldado = 0;
                    $idEstado = 1;
                } else {
                    $saldado = 1;
                    $idEstado = 2;
                    $aPagar = 0;
                }

                $ivaTotal = 0;

                //--- Obtencion de las configuraciones de la empresa ---//
                $empresa = $this->app_model->get_empresas();
                
                if (empty($egresoDetalle)) {

                    //--- Insertamos registros cuando la tabla esta vacia ---//
                    foreach ($datosCompra as $keys => $values) {
                        $producto_idProducto = $this->app_model->get_productos_byId($values['idProducto']);

                        $result_primero = $this->app_model->insert_compra_detalle(
                            $idGenEgreso,
                            $values['idProducto'],
                            $values['cantidad'],
                            $values['precio'],
                            $values['descuento'],
                            $values['subtotalProd'],
                            $values['iva'],
                            $values['ivaText']
                        );
                        //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                        if ($empresa[0]['stock'] == 0) {
                            if ($producto_idProducto[0]['controlStock'] == 0) {
                                $cantidadActualizada = $values['stock'] + $values['cantidad'];
                                $result2 = $this->app_model->update_stock_by_idProducto($values['idProducto'], $cantidadActualizada);
                                //--- Guardo el movimiento del stock ---//
                                $hoy = getdate();
                                $d = $hoy['mday'];
                                (($d < 10) ? $d = "0" . $d : $d);
                                $m = $hoy['mon'];
                                (($m < 10) ? $m = "0" . $m : $m);
                                $y = $hoy['year'];
                                $fecha = $d . "-" . $m . "-" . $y;
                                $movimiento_stock = $this->app_model->insert_movimiento_stock($producto_idProducto[0]['idGenProducto'], $idGenEgreso, 3, $values['cantidad'], "Se agregaron productos a la compra", 0, $idVendedor, $fecha);
                            }
                        }

                        $ivaTotal += $values[$key]['subtotalProd'] * $values[$key]['iva'];
                    }
                } else {

                    //--- Los valores que se encuentran en $datosVenta son los que se encuentran actualmente ingresados y en $ingresoDetalle se encuentran los valores que estan en la base de datos ---//
                    $valorComparar = [];
                    foreach ($egresoDetalle as $key => $value) {
                        array_push($valorComparar, $value['idProducto']);
                    }
                    foreach ($datosCompra as $key => $value) {
                        $producto_idProducto = $this->app_model->get_productos_byId($value['idProducto']);
                        if (!in_array($datosCompra[$key]['idProducto'], $valorComparar)) {
                            //--- INSERT ---//
                            $this->app_model->insert_compra_detalle($idGenEgreso, $datosCompra[$key]['idProducto'], $datosCompra[$key]['cantidad'], $datosCompra[$key]['precio'], $datosCompra[$key]['descuento'], $datosCompra[$key]['subtotalProd'], $datosCompra[$key]['iva'], $datosCompra[$key]['ivaText']);
                            //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                            if ($empresa[0]['stock'] == 0) {
                                if ($producto_idProducto[0]['controlStock'] == 0) {
                                    //--- Descontamos stock ---//
                                    $cantidadActualizada = $datosCompra[$key]['stock'] + $datosCompra[$key]['cantidad'];
                                    $this->app_model->update_stock_by_idProducto($datosCompra[$key]['idProducto'], $cantidadActualizada);
                                    //--- Guardo el movimiento del stock ---//
                                    $hoy = getdate();
                                    $d = $hoy['mday'];
                                    (($d < 10) ? $d = "0" . $d : $d);
                                    $m = $hoy['mon'];
                                    (($m < 10) ? $m = "0" . $m : $m);
                                    $y = $hoy['year'];
                                    $fecha = $d . "-" . $m . "-" . $y;
                                    $movimiento_stock = $this->app_model->insert_movimiento_stock($producto_idProducto[0]['idGenProducto'], $idGenEgreso, 3, $datosCompra[$key]['cantidad'], "Se agregaron productos a la compra", 0, $idVendedor, $fecha);
                                }
                            }

                            $ivaTotal += $datosCompra[$key]['subtotalProd'] * $datosCompra[$key]['iva'];
                        } else {
                            //--- Update ---//
                            if ($datosCompra[$key]['cantidad'] > $egresoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosCompra[$key]['idProducto']) {
//                                                                echo 'entro';
                                //--- Update registro detalle ingreso ---//
                                $this->app_model->update_egreso_detalle_by_idProducto($idGenEgreso, $datosCompra[$key]['idProducto'], $datosCompra[$key]['cantidad'], $datosCompra[$key]['precio'], $datosCompra[$key]['descuento'], $datosCompra[$key]['subtotalProd'], $datosCompra[$key]['iva'], $datosCompra[$key]['ivaText']);
                                //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                                if ($empresa[0]['stock'] == 0) {
                                    if ($producto_idProducto[0]['controlStock'] == 0) {
                                        //--- Diferencia para stock ---//
                                        $diferencia = $datosCompra[$key]['cantidad'] - $egresoDetalle[$key]['cantidad'];
                                        $cantidadActualizada = $datosCompra[$key]['stock'] - $diferencia;
                                        $producto = $this->app_model->get_producto($datosCompra[$key]['idProducto']);
                                        //--- Guardo el movimiento del stock ---//
                                        $hoy = getdate();
                                        $d = $hoy['mday'];
                                        (($d < 10) ? $d = "0" . $d : $d);
                                        $m = $hoy['mon'];
                                        (($m < 10) ? $m = "0" . $m : $m);
                                        $y = $hoy['year'];
                                        $fecha = $d . "-" . $m . "-" . $y;
                                        $movimiento_stock = $this->app_model->update_movimiento_stock($producto[0]['idGenProducto'], $idGenEgreso, 3, $diferencia, "Se agregaron productos a la compra", 0, $idVendedor, $fecha);
                                    }
                                }
                                //--- Update stock ---//
                                $result2 = $this->app_model->update_stock_by_idProducto($egresoDetalle[$key]['idProducto'], $cantidadActualizada);
                            } elseif ($datosCompra[$key]['cantidad'] < $egresoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosCompra[$key]['idProducto']) {
                                //--- Update registro detalle egreso ---//
                                $this->app_model->update_egreso_detalle_by_idProducto($idGenEgreso, $datosCompra[$key]['idProducto'], $datosCompra[$key]['cantidad'], $datosCompra[$key]['precio'], $datosCompra[$key]['descuento'], $datosCompra[$key]['subtotalProd'], $datosCompra[$key]['iva'], $datosCompra[$key]['ivaText']);
                                //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                                if ($empresa[0]['stock'] == 0) {
                                    if ($producto_idProducto[0]['controlStock'] == 0) {
                                        //--- Diferencia para stock ---//
                                        $diferencia = $egresoDetalle[$key]['cantidad'] - $datosCompra[$key]['cantidad'];
                                        $cantidadActualizada = $datosCompra[$key]['stock'] - $diferencia;
                                        $producto = $this->app_model->get_producto($datosCompra[$key]['idProducto']);
                                        //--- Guardo el movimiento del stock ---//
                                        $hoy = getdate();
                                        $d = $hoy['mday'];
                                        (($d < 10) ? $d = "0" . $d : $d);
                                        $m = $hoy['mon'];
                                        (($m < 10) ? $m = "0" . $m : $m);
                                        $y = $hoy['year'];
                                        $fecha = $d . "-" . $m . "-" . $y;
                                        $movimiento_stock = $this->app_model->update_movimiento_stock($producto[0]['idGenProducto'], $idGenEgreso, 3, $diferencia, "Se quitaron productos a la compra", 1, $idVendedor, $fecha);
                                    }
                                }
                                //--- Update stock ---//
                                $result2 = $this->app_model->update_stock_by_idProducto($egresoDetalle[$key]['idProducto'], $cantidadActualizada);
                            } elseif ($datosCompra[$key]['cantidad'] == $egresoDetalle[$key]['cantidad'] && $valorComparar[$key] == $datosCompra[$key]['idProducto']) {
                                //--- Update registro detalle egreso ---//
                                $this->app_model->update_egreso_detalle_by_idProducto($idGenEgreso, $datosCompra[$key]['idProducto'], $datosCompra[$key]['cantidad'], $datosCompra[$key]['precio'], $datosCompra[$key]['descuento'], $datosCompra[$key]['subtotalProd'], $datosCompra[$key]['iva'], $datosCompra[$key]['ivaText']);
                            }

                            $ivaTotal += $datosCompra[$key]['subtotalProd'] * $datosCompra[$key]['iva'];
                        }
                    }

                    $valorComparar = [];
                    foreach ($datosCompra as $key => $value) {
                        array_push($valorComparar, $value['idProducto']);
                    }

                    foreach ($egresoDetalle as $key => $value) {
                        if (!in_array($egresoDetalle[$key]['idProducto'], $valorComparar)) {
                            //--- Borrar ---//
                            $producto = $this->app_model->get_productos_byId($egresoDetalle[$key]['idProducto']);
                            //--- Verificacion del control de stock con respecto a las configuraciones iniciales del sistema ---//
                            if ($empresa[0]['stock'] == 0) {
                                if ($producto[0]['controlStock'] == 0) {
                                    //--- update stock producto ---//
                                    $cantidadTotal = $producto[0]['stock'] + $egresoDetalle[$key]['cantidad'];
                                    $update_stock_producto = $this->app_model->update_stock_by_idProducto($egresoDetalle[$key]['idProducto'], $cantidadTotal);
                                }
                            }

                            //--- Guardo el movimiento del stock ---//
                            $movimiento_stock = $this->app_model->drop_movimiento_stock($producto[0]['idGenProducto'], $idGenEgreso, 3, "Se elimino el producto de la compra", 0, $idVendedor);

                            //--- eliminar el detalle presupuesto ---//
                            $delete_ingreso = $this->app_model->eliminar_egreso_by_idGenEgreso_idProducto($idGenEgreso, $egresoDetalle[$key]['idProducto']);
                        }
                    }
                }

                //--- Actualizo - Egreso ---//
                $result_update_egreso = $this->app_model->update_egreso(
                    $idGenEgreso, $tipoEgreso = 1, $idVendedor, $datosFacturacion["selectProveedor"], //selectCliente
                    $datosFacturacion["inputFechaEmisionCompra"], //fechaEmision
                    $datosFacturacion["inputFechaPagoCompra"], //fechaPago
                    $datosFacturacion["selectTipoFactCompra"], //selectTipoFac
                    $datosFacturacion["selectCategoriaCompra"], //selectCatCompra
                    $datosFacturacion["notaInterna"], //notaInterna
                    $datosFacturacion["totalNoGravado"], //importeNoGravado
                    $datosFacturacion["total"], //totalCompra
                    $datosFacturacion["descTotal"], //descuentoTotal
                    $datosFacturacion["descProveedor"], //descuentoProveedor
                    $ivaTotal, //ivaTotal
                    $datosFacturacion["razonSocial"], //selectSubCategoriaCompra
                    $aPagar, //aPagar                                    
                    $saldado, $idEstado
                );

                //--- Update cuenta corriente ---//
                $aPagar = $datosFacturacion["total"];
                $cuenta_corriente_proveedor = $this->app_model->update_cuenta_corrientes_proveedores_by_idGenEgreso_ordenAsc_limit1($idGenEgreso, $datosFacturacion["selectProveedor"], $aPagar, $saldo = $aPagar, $descripcionCobro = "Ajuste al editar la compra");

                //--- Guardo - Historico ---//
                $resultHistorico = $this->app_model->set_historico($idVendedor, $idGenEgreso, $tipoAccion = 2, $tipoOperacion = 2, "Se modificó la compra de " . $datosFacturacion["selectProveedor"], $datosFacturacion["total"]);

                if ($resultHistorico) {
                    $msg = "Compra actualizada con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Fallo al actualiza la compra, vuelva a intentarlo";
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

    public function eliminar_compra($idEgreso) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];
        $msg = "";

        if (!empty($idEgreso)) {
            //--- Guardo - Historico ---//
            $result_insert_historico = $this->app_model->set_historico(
                    $idUsuario, $idEgreso, $tipoAccion = 3, $tipoOperacion = 2, $detalle = 'Se eliminó una compra', //detalle
                    $total = 0
            );

            $egreso = $this->app_model->get_egreso_by_idEgreso($idEgreso);
            if ($egreso) {

                $egresoDetalle = $this->app_model->get_egreso_detalle_by_idGenEgreso($egreso[0]['idGenEgreso']);
                if ($egresoDetalle) {
                    $count = count($egresoDetalle);
                    $checkCount = 0;
                    foreach ($egresoDetalle as $key => $value) {
                        if ($value['eliminado'] == 0) {
                            $productoDetalle = $this->app_model->get_producto($value['idProducto']);
                            $nuevoStock = $productoDetalle[0]['stock'] + $value['cantidad'];
                            $result = $this->app_model->update_stock_by_idProducto($value['idProducto'], $nuevoStock);

                            //--- Guardo el movimiento del stock ---//
                            $movimiento_stock = $this->app_model->drop_movimiento_stock($productoDetalle[0]['idGenProducto'], $egreso[0]['idGenEgreso'], 3, "Se elimino el producto de la compra", 0, $idUsuario);

                            if ($result) {
                                $checkCount++;
                            }
                        } else {
                            $checkCount++;
                        }
                    }
                    if ($count == $checkCount) {
                        $result2 = $this->app_model->eliminar_egreso_by_idGenEgreso($egreso[0]['idGenEgreso']);
                        $result3 = $this->app_model->eliminar_egreso_detalle_by_idGenEgreso($egreso[0]['idGenEgreso']);
                    }
                }
            }


            if ($result2 && $result3) {
                $msg = "Compra eliminada con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al eliminar la compra, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Id vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function listar_categorias() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $categorias_compras = $this->app_model->get_categorias_compras();
        $this->data['categorias_compras'] = $categorias_compras;

        $this->load_view('compras/listar_categorias', $this->data);
    }

    public function add_categorias_compras() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        if ($_POST) {
            $inputDescripcion = $this->input->post('inputDescripcion_formCatCompras', true);

            $existe = $this->app_model->get_existe_categoria_compras($inputDescripcion);

            if ($existe == 0) {

                $result = $this->app_model->insert_categorias_compras($inputDescripcion);

                if ($result) {
                    $msg = "Categoría de compra añadida con exito";
                    $id = $this->app_model->get_ultimo_id_categoria_compras($inputDescripcion);
                    $userdata = $this->session->all_userdata();
                    $idVendedor = $userdata['idUsuario'];
                    //--- Guardo - Historico ---//
                    $result_insert_historico = $this->app_model->set_historico(
                            $idVendedor, $id[0]['id'], $tipoAccion = 1, $tipoOperacion = 17, //Agrega nuevo cobro
                            "", //detalle
                            0 //montoCobro
                    );
                    $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id[0]['id']);
                } else {
                    $msg = "Error al añadir la categoría de compra, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
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

    public function update_categorias_compras() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $id = $this->input->post('inputId_formCatCompras', true);
        $inputDescripcion = $this->input->post('inputDescripcion_formCatCompras', true);

        $result = $this->app_model->update_categoria_compras($id, $inputDescripcion);

        $userdata = $this->session->all_userdata();
        $idVendedor = $userdata['idUsuario'];
        //--- Guardo - Historico ---//
        $result_insert_historico = $this->app_model->set_historico(
                $idVendedor, $id, $tipoAccion = 2, $tipoOperacion = 17, //Agrega nuevo cobro
                "", //detalle
                0 //montoCobro
        );
        if ($result) {
            $msg = "Categoría de compra actualizada con exito";
            $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id);
        } else {
            $msg = "Error al actualizar la categoría de compra, veulva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_categorias_compras() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $id = $this->input->post('id', true);
        $existe = 0;

        $egreso_idCategoriaCompra = $this->app_model->get_compra_by_idCategoriaCompras($id);
        if (!$egreso_idCategoriaCompra) {
            $result = $this->app_model->delete_categoria_compras($id);
        } else {
            $result = false;
            $existe = 1;
        }

        $userdata = $this->session->all_userdata();
        $idVendedor = $userdata['idUsuario'];
        //--- Guardo - Historico ---//
        $result_insert_historico = $this->app_model->set_historico(
                $idVendedor, $id, $tipoAccion = 3, $tipoOperacion = 17, //Agrega nuevo cobro
                "", //detalle
                0 //montoCobro
        );
        
        if ($result && $existe == 0) {
            $msg = "Categoría de compra eliminada con exito";
            $dato = array("valid" => true, "msg" => $msg);
        } else if (!$result && $existe == 1) {
            $msg = "Error al eliminar la categoría de compra porque existen compras con esta categoía, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        } else {
            $msg = "Error al eliminar la categoría de compra, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function listar_compras_informe() {
        $this->load_view('informes/listar_compras_informe', $this->data);
    }

    public function listar_compras_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $egresos = $this->app_model->get_egresos();
        $estados = $this->app_model->get_estados();

        if ($egresos) {
            foreach ($egresos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-info";
                    $texto = "A Cobrar";
                elseif ($value['idEstado'] == 2):
                    $class = "btn-success";
                    $texto = "Pagado";
                elseif ($value['idEstado'] == 3):
                    $class = "btn-danger";
                    $texto = "Vencido";
                else:
                    $class = "btn-warning";
                    $texto = "Sin Estado";
                endif;

                $idGenEgreso = "'" . $value["idGenEgreso"] . "'";

                if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29) {
                    $bloque1 = '<li><a href="' . base_url() . 'compras/ver_compra/' . $value['idGenEgreso'] . '"><i class="icon-grid3"></i> Ver</a></li>' .
                            '<li><a href="' . base_url() . 'compras/editar_compra/' . $value['idGenEgreso'] . '"><i class="icon-cogs"></i> Editar</a></li>' .
                            '<li><a class="tip deleteEgreso" data-id="' . $value['idEgreso'] . '" ><i class="icon-close"></i> Eliminar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li><a href="#modal-agregar-pago" class="tip agregarPago" data-id="' . $value['idGenEgreso'] . '" data-toggle="modal" ><i class="icon-tag5"></i> Agregar Pago</a></li>';
                }

                if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29) {
                    $bloque2 = '<li><a onclick="llenado_tabla_cta_cte_proveedores(' . $value['idProveedor'] . ')" ><i class="icon-clipboard"></i> Cta Cte</a></li>' .
                            '<li class="divider"></li>' .
                            '<li><a href="#" onclick="generarPdfDetalleEgreso(' . $idGenEgreso . ')" ><i class="icon-binoculars"></i> Ver detalle</a></li>';
                }

                $opcion = ' <div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                        '<ul class="dropdown-menu icons-right">' .
                        $bloque1 .
                        $bloque2 .
                        '</ul>' .
                        '</div>';

                $dato[] = array(
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVtoPago'],
                    $value['nombEmpresa'],
                    "$" . number_format($value['total'] + $value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['aPagar'], 2, ",", "."),
                    "$" . number_format($value['total'] - $value['aPagar'], 2, ",", "."),
                    $value['nombreVend'],
                    "DT_RowId" => $value['idEgreso']
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

    public function listar_compras_informe_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $egresos = $this->app_model->get_egresos();
        $estados = $this->app_model->get_estados();

        if ($egresos) {
            foreach ($egresos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-success";
                    $texto = "Pagado";
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

                $opcion = '<div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '</div>';

                $dato[] = array(
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVtoPago'],
                    $value['nombEmpresa'],
                    "$" . number_format($value['total'] + $value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['aPagar'], 2, ",", "."),
                    "$" . number_format($value['total'] - $value['aPagar'], 2, ",", "."),
                    $value['nombreVend'],
                    "DT_RowId" => $value['idEgreso']
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

    public function listar_egresos_informe_table_filtro($desde, $hasta) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $egresos = $this->app_model->get_egresos_desde_hasta($desde, $hasta);
        $estados = $this->app_model->get_estados();

        if ($egresos) {
            foreach ($egresos as $key => $value) {
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

                $opcion = '<div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '</div>';

                $dato[] = array(
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVtoPago'],
                    $value['nombEmpresa'],
                    "$" . number_format($value['total'] + $value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['aPagar'], 2, ",", "."),
                    "$" . number_format($value['total'] - $value['aPagar'], 2, ",", "."),
                    $value['nombreVend'],
                    "DT_RowId" => $value['idEgreso']
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

    public function exportar_to_excel_egresos() {
        $this->load->helper('mysql_to_excel_helper');

//        //--- tomar datos del post ---//
        $fechaDesde = $this->input->post('fechaI_informeEgreso', true);
        $fechaHasta = $this->input->post('fechaF_informeEgreso', true);

        //--- fecha actual ---//
        $hoy = getdate();
        $fechaActual = $hoy['mday'] . $hoy['mon'] . $hoy['year'];

        //--- exportar excel ---//
        //--- verificar si es vacio o no el filtro de fechas ---//
        if ($fechaDesde == 0 && $fechaHasta == 0) {
            to_excel($this->app_model->get_egresos_exportar(), "informeEgresos" . $fechaActual);
        } elseif ($fechaDesde != 0 && $fechaHasta != 0) {
            to_excel($this->app_model->get_egresos_desde_hasta_exportar($fechaDesde, $fechaHasta), "informeEgresos" . $fechaActual . "-desde" . $fechaDesde . "-hasta" . $fechaHasta);
        }
    }

    public function update_notificacion_leida() {
        $this->load->helper('mysql_to_excel_helper');

        $idGenEgreso = $this->input->post('idGenEgreso', true);
        $fechaRegistroNotificacion = $this->input->post('fechaRegistroNotificacion', true);

        $result = $this->app_model->update_notificacion_leida_egreso($idGenEgreso, $fechaRegistroNotificacion);

        if ($result) {
            $msg = "Notificacion leida";
            $dato = array("valid" => true, "msg" => $msg);
        } else {
            $msg = "Falla su proceso de marcar como leida";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_proveedor($idProveedor) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Obtenemos datos necesarios ---//
        $proveedor = $this->app_model->get_proveedor_byId($idProveedor);
        $proveedor_detalle_compra = $this->app_model->get_proveedor_detalle_compra($proveedor[0]['idGenProveedor']);
        //--- Valor del descuento ---//
        $descuento = $proveedor_detalle_compra[0]['dtoGeneral'];

        if ($proveedor && $proveedor_detalle_compra) {
            $msg = "Proveedor";
            $dato = array("valid" => true, "msg" => $msg, "proveedor" => $proveedor, "descuento" => $descuento);
        } else {
            $msg = "No se pudo obtener los datos del proveedor exitosamente";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function ver_compra($idGenEgreso = null) {
        $this->data['idGenEgreso'] = $idGenEgreso;

        $egreso = $this->app_model->get_egreso_by_idGenEgreso($idGenEgreso);
        $this->data['egreso'] = $egreso;

        $this->data['egresoDetalle'] = $this->app_model->get_egreso_detalle_by_idGenEgreso($idGenEgreso);

        $this->data['proveedores'] = $this->app_model->get_proveedores();

        $this->data['categoriasCompras'] = $this->app_model->get_categorias_compras();

        $this->data['subcategoriasComprasDetalle'] = $this->app_model->get_subcategorias_compras_detalle_by_idCategoriaCompra($egreso[0]['idCategoriaGasto']);

        $this->data['facturaTipos'] = $this->app_model->get_factura_tipos();

        $this->data['razonSocial'] = $this->app_model->get_razon_social();

        $this->data['modalidadesAbono'] = $this->app_model->get_abono_modalidades();

        $this->data['ivaTipos'] = $this->app_model->get_iva_tipos();

        $this->load_view('compras/ver_compra', $this->data);
    }

    public function listar_egreso_ver_table($idGenEgreso) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $egreso_detalle = $this->app_model->get_egreso_detalle_by_idGenEgreso($idGenEgreso);
        $ivaTipos = $this->app_model->get_iva_tipos();

        if ($egreso_detalle) {
            foreach ($egreso_detalle as $key => $value) {

                $idGenEgreso = "'" . $idGenEgreso . "'";

                $opcines_iva = "";

                if (isset($ivaTipos)):
                    for ($j = 0; $j < count($ivaTipos); $j++) :
                        if ($ivaTipos[$j]['idIva'] == $value['idIva']):
                            $opcines_iva .= '<option selected value="' . $ivaTipos[$j]['idIva'] . '" disabled>' . $ivaTipos[$j]['descripcion'] . '</option>';
                        else:
                            $opcines_iva .= '<option value="' . $ivaTipos[$j]['idIva'] . '" disabled>' . $ivaTipos[$j]['descripcion'] . '</option>';
                        endif;
                    endfor;
                endif;

                $dato[] = array(
                    $value["idProducto"],
                    $value['codigo'],
                    $value['nombre'],
                    '<input type="text" value="' . $value["cantidad"] . '" id="cantProd' . $value["idProducto"] . '" onkeyup="calculoCompraEditar(' . $value["idProducto"] . ',' . $value["stock"] . ',' . $value["cantidad"] . ')" class="form-control" disabled>' .
                    '<div id="errorStock' . $value["idProducto"] . '" class="btn-danger erroBoxs" style="display: none">' .
                    'Stock: ' . $value["stock"] .
                    '</div>',
                    $value['stock'],
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["precio"] . '" id="precioProd' . $value["idProducto"] . '" disabled class="form-control" disabled>' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">%</span>' .
                    '<input type="text" value="' . $value["descuento"] . '" id="descProd' . $value["idProducto"] . '" onkeyup="calculoCompraEditar(' . $value["idProducto"] . ')" class="form-control" disabled >' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["subTotal"] . '" id="subTotalProd' . $value["idProducto"] . '" readonly class="form-control" disabled >' .
                    '</div>',
                    '<select id="selectIva' . $value["idProducto"] . '" onchange="calculoCompraEditar(' . $value["idProducto"] . ')" class="select-full" required disabled>
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

    public function listar_cte_cta_proveedores_table($idProveedor) {
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
                    $fecha_pago,
                    "$" . number_format($value['aPagar'], 2, ",", "."),
                    "$" . number_format($value['pague'], 2, ",", "."),
                    "$" . number_format($egreso[0]['total'], 2, ",", "."),
                    "$" . number_format($value['saldo'], 2, ",", "."),
                    $opcionComprobante,
                    $cuenta,
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

    public function listar_cte_cta_clientes_table($idCliente) {
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
                            '</a>'; else:
                    $opcionComprobante = "-";
                endif;
                //--- Fin de la obtencion de los datos ---//

                $dato[] = array(
                    $fecha_cobro,
                    "$" . number_format($value['debito'], 2, ",", "."),
                    "$" . number_format($value['credito'], 2, ",", "."),
                    "$" . number_format($ingreso[0]['total'], 2, ",", "."),
                    "$" . number_format($value['saldo'], 2, ",", "."),
                    $opcionComprobante,
                    $cuenta,
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
}