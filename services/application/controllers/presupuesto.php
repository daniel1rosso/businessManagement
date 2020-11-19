<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Presupuesto extends MY_Controller {

    protected $data = array(
        'active' => 'ingresos'
    );

    public function __construct() {
        parent::__construct();
    }

    public function listar_presupuesto() {
        $presupuestos = $this->app_model->get_presupuestos();
        $this->data['presupuestos'] = $presupuestos;

        $estados = $this->app_model->get_estados();
        $this->data['estados'] = $estados;

        $tesoreriaCuenta = $this->app_model->get_tesoreria_cuentas();
        $this->data['tesoreriaCuenta'] = $tesoreriaCuenta;

        $this->load_view('presupuesto/listar_presupuesto', $this->data);
    }

    public function listar_presupuesto_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();

        //--- datos ---//
        $presupuestos = $this->app_model->get_presupuestos();

        if ($presupuestos) {
            foreach ($presupuestos as $key => $value) {
                //--- Defincion de la clase, texto y opciones de cada estado ---//
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-warning";
                    $texto = "Pendiente";

                    $estado_pendiente = "none";
                    $estado_enviar = "block";
                    $estado_rechazar = "block";
                    $estado_aceptado = "block";
                elseif ($value['idEstado'] == 2):
                    $class = "btn-info";
                    $texto = "Enviado";

                    $estado_pendiente = "block";
                    $estado_enviar = "none";
                    $estado_rechazar = "block";
                    $estado_aceptado = "block";
                elseif ($value['idEstado'] == 3):
                    $class = "btn-danger";
                    $texto = "Rechazado";

                    $estado_pendiente = "block";
                    $estado_enviar = "block";
                    $estado_rechazar = "none";
                    $estado_aceptado = "block";
                elseif ($value['idEstado'] == 4):
                    $class = "btn-success";
                    $texto = "Aceptado";

                    if ($value['facturado'] == 1) {
                        $estado_pendiente = "none";
                        $estado_enviar = "none";
                        $estado_rechazar = "none";
                        $estado_aceptado = "none";
                    } else {
                        //--- Como no es vendido ---//
                        $estado_pendiente = "block";
                        $estado_enviar = "block";
                        $estado_rechazar = "block";
                        $estado_aceptado = "none";
                    } elseif ($value['idEstado'] == 5):
                    $class = "btn-danger";
                    $texto = "Vencido";

                    $estado_pendiente = "none";
                    $estado_enviar = "none";
                    $estado_rechazar = "none";
                    $estado_aceptado = "none";
                endif;
                //--- Fin defincion de la clase, texto y opciones de cada estado ---//

                $idGenPresupuesto = "'" . $value['idGenPresupuesto'] . "'";
                $idGenPresupuesto_comun = $value['idGenPresupuesto'];

                //--- Opciones cambio de estado ---//
                $opcionesEstado = '<li id="pendiente' . $idGenPresupuesto_comun . '" style="display:' . $estado_pendiente . ';"><a href="" class="tip" data-toggle="modal" onclick="cambiar_estado_presupuesto_pendiente(' . $idGenPresupuesto . ')" ><i class="fas fa-inbox fa-lg"></i> Pendiente</a></li>' .
                        '<li id="enviar' . $idGenPresupuesto_comun . '" style="display:' . $estado_enviar . ';"><a href="" class="tip" data-toggle="modal" onclick="cambiar_estado_presupuesto_enviado(' . $idGenPresupuesto . ')" ><i class="fas fa-paper-plane fa-lg"></i> Enviado</a></li>' .
                        '<li id="rechazar' . $idGenPresupuesto_comun . '" style="display:' . $estado_rechazar . ';"><a href="" class="tip" data-toggle="modal" onclick="cambiar_estado_presupuesto_rechazado(' . $idGenPresupuesto . ')" ><i class="icon-close fa-lg"></i> Rechazado</a></li>' .
                        '<li id="aceptado' . $idGenPresupuesto_comun . '" style="display:' . $estado_aceptado . ';"><a href="" class="tip" data-toggle="modal" onclick="cambiar_estado_presupuesto_aceptado(' . $idGenPresupuesto . ')" ><i class="fas fa-check fa-lg"></i> Aceptado</a></li>';

                if ($estado_pendiente != 'none' || $estado_enviar != 'none' || $estado_rechazar != 'none' || $estado_aceptado != 'none') {
                    $divisor = '<li class="divider"></li>';
                } else if (($estado_pendiente == 'none' && $estado_enviar == 'none' && $estado_rechazar == 'none' && $estado_aceptado == 'none')) {
                    $divisor = '';
                }
                //--- Fin opciones cambio de estado ---//
                //--- Opciones de venta ---//
                if ($value['facturado'] == 1) {
                    $ingreso = $this->app_model->get_ingreso_by_idGenPresupuesto($idGenPresupuesto_comun);
                    if ($ingreso) {
                        $idGenIngreso = $ingreso[0]['idGenIngreso'];
                        $idGenIngreso = "'" . $idGenIngreso . "'";
                        $venta_presupuesto = '<li><a href="#" onclick="generarPdfDetalleVenta(' . $idGenIngreso . ')"><i class="icon-binoculars"></i> Ver detalle Venta</a></li>' .
                                '<li class="divider"></li>';
                    } else {
                        $venta_presupuesto = "";
                    }
                } elseif ($value['facturado'] == 0) {
                    $venta_presupuesto = '<li><a class="tip" onclick="agregar_venta_presupuesto(' . $idGenPresupuesto . ')" data-toggle="modal" ><i class="fas fa-shopping-cart fa-lg"></i> Crear Venta</a></li>' .
                            '<li class="divider"></li>';
                }
                //--- Fin opciones de venta ---//
                //--- Un registro de la tabla presupuesto ---//
                $opcion = ' <div class="btn-group">' .
                        '<button id="btn' . $idGenPresupuesto_comun . '" class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                        '<ul class="dropdown-menu icons-right">' .
                        '<li><a href="' . base_url() . 'presupuesto/modificar_presupuesto/' . $value['idGenPresupuesto'] . '"><i class="icon-cogs"></i> Editar</a></li>' .
                        '<li><a class="tip delete_presupuesto" data-id="' . $value['idGenPresupuesto'] . '"><i class="icon-close"></i> Eliminar</a></li>' .
                        $divisor .
                        $opcionesEstado .
                        '<li class="divider"></li>' .
                        $venta_presupuesto .
                        '<li><a href="#" onclick="generarPdfDetallePresupuesto(' . $idGenPresupuesto . ', 0)"><i class="icon-binoculars"></i> Ver detalle</a></li>' .
                        '<li><a href="#" onclick="enviarPresupuesto(' . $idGenPresupuesto . ')" ><i class="icon-attachment"></i> Enviar detalle</a></li>' .
                        '</ul>' .
                        '</div>';
                //--- Fin un registro de la tabla presupuesto ---//
                //--- Tabla presupuesto ---//
                $dato[] = array(
                    $opcion,
                    $value['fechaEmision'],
                    $value['fechaVtoPresupuesto'],
                    $value['nombreVend'],
                    "$" . number_format($value['descuentoTotal'], 2, ",", "."),
                    "$" . number_format($value['total'], 2, ",", "."),
                    $value['fechaAlta'],
                    "DT_RowId" => $value['idGenPresupuesto']
                );
                //--- Fin tabla presupuesto ---//
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

    public function generaPDFDetallePresupuesto($idGenPresupuesto) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $presupuesto = $this->app_model->get_presupuesto_clientes_by_idGenPresupuesto($idGenPresupuesto);
        $detallePresupuesto = $this->app_model->get_presupuesto_detalle_by_idGenPresupuesto($idGenPresupuesto);

        if ($presupuesto && $detallePresupuesto && $idGenPresupuesto) {
            //-- NOMBRE Y DIRECTORIO --//
            $directorio = 'uploads/comprobantes/presupuestos/' . $idGenPresupuesto;

            if (!is_dir($directorio)) {
                mkdir($directorio, 0777);
            }

            $nombreArchivo = $idGenPresupuesto . date("YmdHis");

            //-- CARGO LIBRERIAS --//
            $this->load->library('html2pdf');

            $this->html2pdf->folder('./uploads/comprobantes/presupuestos/' . $idGenPresupuesto . "/");
            $this->html2pdf->filename($nombreArchivo . ".pdf");
            $this->html2pdf->paper('a4', 'portrait');

            //-- DATOS TABLA --//
            $acuTotal = 0;
            $cuerpo = "";
            foreach ($detallePresupuesto as $key => $value) {
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

            if ($presupuesto[0]['razonSocial'] == "") {
                $razonSocial = "-";
            } else {
                $razonSocial = $presupuesto[0]['razonSocial'];
            }

            if ($presupuesto[0]['domicilio'] == "") {
                $domicilio = "-";
            } elseif ($presupuesto[0]['domicilio'] != "" && $presupuesto[0]['piso'] == "" && $presupuesto[0]['dpto'] == "") {
                $domicilio = $presupuesto[0]['domicilio'] . " " . $presupuesto[0]['nro'] . " piso -" . " dpto -";
            } elseif ($presupuesto[0]['domicilio'] != "" && $presupuesto[0]['piso'] != "" && $presupuesto[0]['dpto'] == "") {
                $domicilio = $presupuesto[0]['domicilio'] . " " . $presupuesto[0]['nro'] . " piso " . $presupuesto[0]['piso'] . " dpto -";
            } elseif ($presupuesto[0]['domicilio'] != "" && $presupuesto[0]['piso'] == "" && $presupuesto[0]['dpto'] != "") {
                $domicilio = $presupuesto[0]['domicilio'] . " " . $presupuesto[0]['nro'] . " piso -" . " dpto " . $presupuesto[0]['dpto'];
            } elseif ($presupuesto[0]['domicilio'] != "" && $presupuesto[0]['piso'] != "" && $presupuesto[0]['dpto'] != "") {
                $domicilio = $presupuesto[0]['domicilio'] . " " . $presupuesto[0]['nro'] . " piso " . $presupuesto[0]['piso'] . " dpto " . $presupuesto[0]['dpto'];
            }

            $this->html2pdf->html('
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{font-family:Arial, sans-serif;font-size:7px;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg th{font-family:Arial, sans-serif;font-size:7px;font-weight:normal;padding:10px 9px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg .tg-704r{border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:left;vertical-align:middle;width: 50%;}
                .tg .tg-nkla{background-color:#f9f9f9;border-color:inherit;font-family:Arial, Helvetica, sans-serif !important;;font-size:12px; text-align:left;vertical-align:top}
                .tg .tg-swzm{font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f0f0f0;border-color:inherit;text-align:center;vertical-align:middle;height: auto;}
                .tg .tg-zb0m{font-size:18px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:center;vertical-align:middle;width: 45%;}
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
                        <td class="tg-zb0z" colspan="2"><span style="font-weight:bold;font-size:40px;text-align: center;">X</span></td>
                        <td class="tg-zb0m" colspan="5"><span style="font-weight:bold">DETALLE PRESUPUESTO</span></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6"></td>
                        <td class="tg-704r" colspan="6"><br><br>Fecha emisión:  ' . date("d/m/Y") . '<br><br><br></td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="12">Fecha Vencimiento: ' . date("d/m/Y", strtotime($presupuesto[0]['fechaVtoPresupuesto'])) . '</td>
                    </tr>
                    <tr>
                        <td class="tg-704r" colspan="6">Razón Social: ' . $razonSocial . '<br>Nombre: ' . $presupuesto[0]['nombreCliente'] . '<br>Apellido: ' . $presupuesto[0]['apellidoCliente'] . '<br>Celular: ' . $presupuesto[0]['cel'] . '<br></td>
                        <td class="tg-704r" colspan="6">Domicilio: ' . $domicilio . '<br>Categoría: ' . $presupuesto[0]['categoria'] . '<br>Vendedor: ' . $presupuesto[0]['apellidoVend'] . ", " . $presupuesto[0]['nombreVend'] . '</td>
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
                            <td style="border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:right;" colspan="12">Importe Neto Gravado: $' . number_format($presupuesto[0]['importeNetoNoGravado'], 2, ',', '.') . '<br>Iva: $' . number_format($presupuesto[0]['ivaTotal'], 2, ',', '.') . '<br>Total: $' . number_format($presupuesto[0]['total'], 2, ',', '.') . '<br></td>
                        </tr>
                    </tfoot>
                    <!--  FIN TFOOD -->
                </table>
            </div>');

            $this->html2pdf->create('save');

            $msg = "Ok";
            //$dato = array("valid" => true, "msg" => $msg, "nombrePdf" => $nombreArchivo . ".pdf", "longitud" => iconv_strlen($tipoDoc), "idGenPresupuesto" => $idGenPresupuesto, 'presupuesto' => $presupuesto);
            $dato = array("valid" => true, "msg" => $msg, "nombrePdf" => $nombreArchivo . ".pdf", "idGenPresupuesto" => $idGenPresupuesto, 'presupuesto' => $presupuesto);
        } else {
            $msg = "No se ha podiado realizar el pdf, esta vacio idGenPresupuesto";
            $dato = array("valid" => true, "msg" => $msg, "idGenPresupuesto" => $idGenPresupuesto, "presupuesto" => $presupuesto, "detallePresupuesto" => $detallePresupuesto);
        }
        echo json_encode($dato);
    }

    public function agregar_presupuesto() {
        $this->data['clientes'] = $this->app_model->get_clientes();

        $this->data['categoriasPresupuesto'] = $this->app_model->get_categorias_ventas();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['modalidadesAbono'] = $this->app_model->get_abono_modalidades();

        $this->load_view('presupuesto/agregar_presupuesto', $this->data);
    }

    public function buscaSubcategoriaPresupuestoDetalle() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idCategoriaPresupuestoDetalle = $this->input->post('idCategoriaPresupuestoDetalle', true);
        $subcategoriasPresupuestoDetalle = $this->app_model->get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($idCategoriaPresupuestoDetalle);

        echo '<option value="0">Seleccionar Subcategoria Presupuesto</option>';
        foreach ($subcategoriasPresupuestoDetalle as $key) {
            echo '<option value="' . $key['idSubcategoriaVenta'] . '">' . $key['descripcion'] . '</option>';
        }
    }

    public function modificar_presupuesto($idGenPresupuesto = null) {

        //--- Datos para llenar los select de la vista ---//
        $this->data['idGenPresupuesto'] = $idGenPresupuesto;

        $this->data['clientes'] = $this->app_model->get_clientes();

        $this->data['categoriasPresupuesto'] = $this->app_model->get_categorias_ventas();

        $this->data['productos'] = $this->app_model->get_productos();

        $this->data['modalidadesAbono'] = $this->app_model->get_abono_modalidades();

        $this->data['condicion_iva'] = $this->app_model->get_iva_condiciones();

        //-- Datos correspondientes al idGenPresupuesto para la seleccion de los datos prexistentes
        //--- Obtenemos el presupuesto ---//
        $presupuesto_by_idGenPresupuesto = $this->app_model->get_presupuestos_by_idGenPresupuesto($idGenPresupuesto);
        $this->data['presupuesto'] = $presupuesto_by_idGenPresupuesto;

        //--- Obtenemos las subcategorias para el llenado ---//
        $this->data['subCategorias'] = $this->app_model->get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($presupuesto_by_idGenPresupuesto[0]['idCategoria']);

        //--- Obtencion del detalle ---//
        $this->data['presupuesto_detalle'] = $this->app_model->get_presupuestos_detalle_by_idGenPresupuesto($idGenPresupuesto);

        $this->load_view('presupuesto/modificar_presupuesto', $this->data);
    }

    public function set_presupuesto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $datosFacturacion = $this->input->post('datosFacturacion', true);
            $datosVenta = $this->input->post('datosVenta', true);

            $idGenPresupuesto = substr(md5(microtime()), 15, 17);

            if (
                    !empty($datosFacturacion) AND ! empty($datosVenta)
            ) {
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

                $idEstado = 1; //Estado de pendiente por defecto
                //--- Guardo - Presupuesto ---//
                $result_insert_presupuesto = $this->app_model->insert_presupuesto(
                        $idGenPresupuesto, $idVendedor, $datosFacturacion["selectCliente"], //selectCliente
                        $fechaEmision, //fechaEmision
                        $fechaCobro, //fechaCobro
                        $datosFacturacion["fechaVigencia"], //selectCatVenta
                        //$datosFacturacion["selectTipoFact"], //selectTipoFac
                        $datosFacturacion["selectCategoriaVenta"], //selectCatVenta
                        $datosFacturacion["notaCliente"], //notaCliente
                        $datosFacturacion["notaInterna"], //notaInterna
                        $datosFacturacion["totalNoGravado"], //importeNoGravado
                        $datosFacturacion["total"], //totalVenta
                        $datosFacturacion["descTotal"], //descuentoTotal
                        $datosFacturacion["descCliente"], //descuentoTotal
                        $datosFacturacion["totalIva"], //ivaTotal
                        $datosFacturacion["selectSubCategoriaVenta"], //selectSubCategoriaVenta
                        $idEstado
                );

                //--- Guardo - Detalle de Ingreso ---//
                //foreach($datosVenta as $key => $value){
                for ($i = 0; $i < count($datosVenta); $i++) {

                    $result_insert_ingreso_detalle = $this->app_model->insert_presupuesto_detalle(
                            $idGenPresupuesto, $datosVenta[$i]['idProducto'], $datosVenta[$i]['cantidad'], $datosVenta[$i]['precio'], $datosVenta[$i]['descuento'], $datosVenta[$i]['subtotalProd'], $datosVenta[$i]['iva'], $datosVenta[$i]['ivaText'], $eliminado = 0
                    );
                }

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idVendedor, $idGenPresupuesto, $tipoAccion = 1, $tipoOperacion = 25, "Se agregó un presupuesto a " . $datosFacturacion["selectCliente"], //detalle
                        $datosFacturacion["total"] //total
                );

                if ($result_insert_presupuesto) {
                    $msg = "Presupuesto registrado con exito";
                    $dato = array("valid" => true, "msg" => $msg, "idGenPresupuesto" => $idGenPresupuesto);
                } else {
                    $msg = "Error al procesar registro, vuelva a intentarlo";
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

    public function update_presupuesto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            //--- Obtencion de datos ---//
            $datosFacturacion = $this->input->post('datosFacturacion', true);
            $datosVenta = $this->input->post('datosVenta', true);
            $idGenPresupuesto = $this->input->post('idGenPresupuesto', true);

            $presupuesto = $this->app_model->get_presupuestos_by_idGenPresupuesto($idGenPresupuesto);
            $detallePresupuesto = $this->app_model->get_presupuestos_detalle_by_idGenPresupuesto($idGenPresupuesto);

            //--- idVendedor ---//
            $userdata = $this->session->all_userdata();
            $idVendedor = $userdata['idUsuario'];

            if (
                    !empty($datosFacturacion) AND ! empty($datosVenta) AND ! empty($idGenPresupuesto) AND ! empty($presupuesto) AND ! empty($detallePresupuesto)
            ) {

                //--- Datos por defecto ---//
                //--- Fecha Emision ---//
                $fechaEmision = $datosFacturacion["inputFechaEmision"];

                //--- Fecha Vto. del Cobro ---//
                $fechaCobro = $datosFacturacion["inputFechaCobro"];

                $idEstado = 1; //Estado pendiente
                //--- Actualizo - Presupuesto ---//
                $result_update_presupuesto = $this->app_model->update_presupuesto(
                        $idGenPresupuesto, $datosFacturacion["selectCliente"], //selectCliente
                        $fechaEmision, //fechaEmision
                        $fechaCobro, //fechaCobro
                        $datosFacturacion["fechaVigencia"], //fechaVigencia
                        $datosFacturacion["selectCategoriaVenta"], //selectCategoriaVenta
                        $datosFacturacion["notaCliente"], //notaCliente
                        $datosFacturacion["notaInterna"], //notaInterna
                        $datosFacturacion["totalNoGravado"], //importeNoGravado
                        $datosFacturacion["total"], //totalVenta
                        $datosFacturacion["descTotal"], //descuentoTotal
                        $datosFacturacion["descCliente"], //descuentoCliente
                        $datosFacturacion["totalIva"], //ivaTotal
                        $datosFacturacion["selectSubCategoriaVenta"], //selectSubCategoriaVenta  
                        $idEstado
                );

                if (empty($detallePresupuesto)) {

                    //--- Insertamos registros cuando la tabla esta vacia ---//
                    //--- insertar nuevo detalle ---//

                    foreach ($datosVenta as $keys => $values) {
                        $result_primero = $this->app_model->insert_presupuesto_detalle(
                                $idGenPresupuesto, $values['idGenProducto'], $values['cantidad'], $values['precio'], $values['descuento'], $values['subtotalProd'], $values['iva'], $values['ivaText'], $eliminado = 0
                        );
                        $cantidadActualizada = $values['stock'] - $values['cantidad'];
                        $result2 = $this->app_model->update_stock_by_idProducto($values['idProducto'], $cantidadActualizada);
                    }
                } else {

                    //--- Los valores que se encuentran en $datosVenta son los que se encuentran actualmente ingresados y en $ingresoDetalle se encuentran los valores que estan en la base de datos ---//
                    $valorComparar = [];
                    foreach ($detallePresupuesto as $key => $value) {
                        array_push($valorComparar, $value['idProducto']);
                    }

                    foreach ($datosVenta as $key => $values) {
                        if (!in_array($datosVenta[$key]['idProducto'], $valorComparar)) {
                            //--- Insertar nuevo detalle ---//
                            $insert_presupuesto_detalle = $this->app_model->insert_presupuesto_detalle(
                                    $idGenPresupuesto, $values['idProducto'], $values['cantidad'], $values['precio'], $values['descuento'], $values['subtotalProd'], $values['iva'], $values['ivaText'], $eliminado = 0
                            );
                        } else {
                            //--- update detalle ---//
                            $update_presupuesto_detalle = $this->app_model->update_presupuesto_detalle(
                                    $idGenPresupuesto, $values['idProducto'], $values['cantidad'], $values['descuento'], $values['subtotalProd'], $values['iva'], $values['ivaText']
                            );
                        }
                    }

                    $valorComparar = [];
                    foreach ($datosVenta as $key => $value) {
                        array_push($valorComparar, $value['idProducto']);
                    }

                    foreach ($detallePresupuesto as $key => $value) {
                        if (!in_array($detallePresupuesto[$key]['idProducto'], $valorComparar)) {
                            //--- Borrar ---//
                            $producto = $this->app_model->get_productos_byId($detallePresupuesto[$key]['idProducto']);

                            //--- eliminar el detalle presupuesto ---//
                            $delete_ingreso = $this->app_model->eliminar_presupuesto_detalle_by_idGenPresupuesto($idGenPresupuesto, $detallePresupuesto[$key]['idProducto']);
                        }
                    }
                }

                //--- Guardo - Historico ---//
                $historico = $this->app_model->set_historico(
                        $idVendedor, $idGenPresupuesto, $tipoAccion = 2, $tipoOperacion = 25, "Se actualizó un presupuesto a " . $datosFacturacion["selectCliente"], //detalle
                        $datosFacturacion["total"] //total
                );

                if ($historico) {
                    $msg = "Registro agregado";
                    $dato = array("valid" => true, "msg" => $msg, "idGenPresupuesto" => $idGenPresupuesto);
                } else {
                    $msg = "Error al procesar registro";
                    $dato = array("valid" => false, "msg" => $msg, "idGenPresupuesto" => $idGenPresupuesto);
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

    public function buscaSubcategoriaPresupuesto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idCategoriaPresupuesto = $this->input->post('idCategoriaPresupuesto', true);
        $subcategoriasPresupuestoDetalle = $this->app_model->get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($idCategoriaPresupuesto);

        echo '<option value="0">Seleccionar Subcategoria Venta</option>';
        foreach ($subcategoriasPresupuestoDetalle as $key) {
            echo '<option value="' . $key['idSubcategoriaVenta'] . '">' . $key['descripcion'] . '</option>';
        }
    }

    public function eliminar_presupuesto($idPresupuesto) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];
        $msg = "";

        if (!empty($idPresupuesto)) {

            //--- eliminar el presupuesto ---//
            $result2 = $this->app_model->eliminar_presupuesto_by_idGenPresupuesto($idPresupuesto);

            //--- Guardo - Historico ---//
            $result_insert_historico = $this->app_model->set_historico(
                    $idUsuario, $idPresupuesto, $tipoAccion = 3, $tipoOperacion = 25, $detalle = 'Se eliminó un presupuesto', //detalle
                    $total = 0
            );

            if ($result2 && $result_insert_historico) {
                $msg = "Presupuesto eliminado con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al eliminar el presupuesto, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Id vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_detalle_presupuesto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        $idPresupuesto = $this->input->post('idGenPresupuesto', true);
        $idProducto = $this->input->post('idProducto', true);
        $cantidad = $this->input->post('cantidad', true);
        $totalPresupuesto = $this->input->post('totalPresupuesto', true);
        $descEfectuado = $this->input->post('descEfectuado', true);
        $importeNoGravado = $this->input->post('importeNoGravado', true);
        $msg = "";

        if (!empty($idPresupuesto) && !empty($idProducto)) {

            //--- Obtencion del presupuesto segun si idGenPresupuesto ---//
            $presupuesto = $this->app_model->get_presupuestos_by_idGenPresupuesto($idPresupuesto);
            //--- Obtencion del producto segun su id ---//
            $producto = $this->app_model->get_productos_byId($idProducto);

            //--- update stock producto ---//
            $cantidadTotal = $producto[0]['stock'] + $cantidad;
            $update_stock_producto = $this->app_model->update_stock_by_idProducto($idProducto, $cantidadTotal);
            //--- update montos presupuesto ---//
            $update_montos_presupuesto = $this->app_model->update_presupuesto_monto_by_idGenPresupuesto($idPresupuesto, $totalPresupuesto, $descEfectuado, $importeNoGravado);
            //--- eliminar el detalle presupuesto ---//
            $delete_presupuesto = $this->app_model->eliminar_presupuesto_by_idGenPresupuesto_idProducto($idPresupuesto, $idProducto);
            //--- Guardo - Historico ---//
            $result_insert_historico = $this->app_model->set_historico(
                    $idUsuario, $idPresupuesto, $tipoAccion = 3, $tipoOperacion = 25, $detalle = '', //detalle
                    $total = 0
            );

            if ($presupuesto && $producto && $update_stock_producto && $update_montos_presupuesto && $delete_presupuesto) {
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

    public function listar_presupuesto_detalle_table($idGenPrespuesto) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $presupuesto_detalle = $this->app_model->get_presupuestos_detalle_by_idGenPresupuesto($idGenPrespuesto);
        $ivaTipos = $this->app_model->get_iva_tipos();

        if ($presupuesto_detalle) {
            foreach ($presupuesto_detalle as $key => $value) {

                $idGenIngreso = "'" . $idGenPrespuesto . "'";

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

                $dato[] = array(
                    $value["idProducto"],
                    $value['codigo'],
                    $value['nombre'],
                    '<input type="text" value="' . $value["cantidad"] . '" id="cantProd' . $value["idProducto"] . '" onkeyup="calculoPresupuestoDetalle(' . $value["idProducto"] . ',' . $value["stock"] . ',' . $value["cantidad"] . ')" class="form-control">' .
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
                    '<input type="text" value="' . $value["descuento"] . '" id="descProd' . $value["idProducto"] . '" onkeyup="calculoPresupuestoDetalle(' . $value["idProducto"] . ')" class="form-control">' .
                    '</div>',
                    '<div class="input-group">' .
                    '<span class="input-group-addon">$</span>' .
                    '<input type="text" value="' . $value["subTotal"] . '" id="subTotalProd' . $value["idProducto"] . '" readonly class="form-control">' .
                    '</div>',
                    '<select id="selectIva' . $value["idProducto"] . '" onchange="calculoPresupuestoDetalle(' . $value["idProducto"] . ')" class="select-full" required>
                        <option value="0">IVA</option>' .
                    $opcines_iva .
                    '</select>',
                    '<i class="icon-remove4" onclick="deleteRowListaPresupuestoDetalle(' . $value["idProducto"] . ')"></i>',
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

    public function get_producto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $idGenPresupuesto = $this->input->post('idGenPresupuesto', true);

        if (!empty($idGenPresupuesto)) {
            $producto = $this->app_model->get_productos_presupuestos_by_idGenPresupuesto($idGenPresupuesto);
            $iva_tipos = $this->app_model->get_iva_tipos();

            if ($producto && $iva_tipos) {
                $msg = "Ok";
                $dato = array("valid" => true, "msg" => $msg, "producto" => $producto, "iva_tipos" => $iva_tipos);
            } else {
                $msg = "producto o iva vacio";
                $dato = array("valid" => true, "msg" => $msg, "producto" => $producto, "iva_tipos" => $iva_tipos);
            }
        } else {
            $msg = "idGenPresupuesto vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function enviar_presupuesto($idGenPresupuesto) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];
        
        if (!empty($idGenPresupuesto)) {
            $presupuesto_enviado = $this->app_model->update_estado_presupuesto_enviado($idGenPresupuesto);

            $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenPresupuesto, $tipoAccion = 10, $tipoOperacion = 25, "Se envio el presupuesto", //detalle
                        0 //total
                );
            
            if ($presupuesto_enviado) {
                $msg = "Ok";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "producto o iva vacio";
                $dato = array("valid" => true, "msg" => $msg);
            }
        } else {
            $msg = "idGenPresupuesto vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function pendiente_presupuesto($idGenPresupuesto) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        
        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        if (!empty($idGenPresupuesto)) {
            $presupuesto_pendiente = $this->app_model->update_estado_presupuesto_pendiente($idGenPresupuesto);

            $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenPresupuesto, $tipoAccion = 13, $tipoOperacion = 25, "El presupuesto esta en pendiente", //detalle
                        0 //total
                );
            
            if ($presupuesto_pendiente) {
                $msg = "Ok";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "producto o iva vacio";
                $dato = array("valid" => true, "msg" => $msg);
            }
        } else {
            $msg = "idGenPresupuesto vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function rechazar_presupuesto($idGenPresupuesto) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        
        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        if (!empty($idGenPresupuesto)) {
            $presupuesto_rechazar = $this->app_model->update_estado_presupuesto_rechazar($idGenPresupuesto);

            $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenPresupuesto, $tipoAccion = 11, $tipoOperacion = 25, "Se rechazó el presupuesto", //detalle
                        0 //total
                );
            
            if ($presupuesto_rechazar) {
                $msg = "Ok";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "producto o iva vacio";
                $dato = array("valid" => true, "msg" => $msg);
            }
        } else {
            $msg = "idGenPresupuesto vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function aceptar_presupuesto($idGenPresupuesto) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        
        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        if (!empty($idGenPresupuesto)) {
            $presupuesto_aceptar = $this->app_model->update_estado_presupuesto_aceptar($idGenPresupuesto);

            $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenPresupuesto, $tipoAccion = 12, $tipoOperacion = 25, "Se acepto el presupuesto", //detalle
                        0 //total
                );
            
            if ($presupuesto_aceptar) {
                $msg = "Ok";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "producto o iva vacio";
                $dato = array("valid" => true, "msg" => $msg);
            }
        } else {
            $msg = "idGenPresupuesto vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function enviar_email_presupuesto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $email = $this->input->post('email', true);
        $idGenPresupuesto = $this->input->post('idGenPresupuesto', true);
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
