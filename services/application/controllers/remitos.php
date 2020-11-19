<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Remitos extends MY_Controller
{
    protected $data = array(
        'active' => 'remitos'
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function agregar_remito($idGenIngreso)
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['tipos_remito'] = $this->app_model->get_tipos_remitos();
        
        $this->data['transportistas'] = $this->app_model->get_transportistas();

        $ingreso = $this->app_model->get_ingresos_by_idGenIngresos($idGenIngreso);
        $this->data['ingreso'] = $ingreso;

        $hoy = getdate();
        $d = $hoy['mday'];
        (($d < 10) ? $d = "0" . $d: $d);
        $m = $hoy['mon'];
        (($m < 10) ? $m = "0" . $m: $m);
        $y = $hoy['year'];
        $this->data['hoy'] = $y . "-" . $m . "-" . $d;

        if ($ingreso[0]['piso'] != "" && $ingreso[0]['dpto'] != "") {
            $direccion = $ingreso[0]['domicilio'] . " " . $ingreso[0]['numero'] . " piso: " . $ingreso[0]['piso'] . " dpto: " . $ingreso[0]['dpto'] . " - " . $ingreso[0]['provincia'] . " - " . $ingreso[0]['localidad'] . " - cp: " . $ingreso[0]['cp'];
        } elseif ($ingreso[0]['piso'] == "" && $ingreso[0]['dpto'] != "") {
            $direccion = $ingreso[0]['domicilio'] . " " . $ingreso[0]['numero'] . " dpto: " . $ingreso[0]['dpto'] . " - " . $ingreso[0]['provincia'] . " - " . $ingreso[0]['localidad'] . " - cp: " . $ingreso[0]['cp'];
        } elseif ($ingreso[0]['piso'] != "" && $ingreso[0]['dpto'] == "") {
            $direccion = $ingreso[0]['domicilio'] . " " . $ingreso[0]['numero'] . " piso: " . $ingreso[0]['piso'] . " - " . $ingreso[0]['provincia'] . " - " . $ingreso[0]['localidad'] . " - cp: " . $ingreso[0]['cp'];
        } elseif ($ingreso[0]['piso'] == "" && $ingreso[0]['dpto'] == "") {
            $direccion = $ingreso[0]['domicilio'] . " " . $ingreso[0]['numero'] . " - " . $ingreso[0]['provincia'] . " - " . $ingreso[0]['localidad'] . " - cp: " . $ingreso[0]['cp'];
        }

        $this->data['direccion'] = $direccion;

        $this->load_view('remitos/agregar_remito', $this->data);
    }

    public function agregar_transportista()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $nombreTransportista = $this->input->post('nombreTransportista', true);

        if (!empty($nombreTransportista)) {
            $transportista = $this->app_model->insert_transportista($nombreTransportista);

            if ($transportista) {
                //--- Obtenemos los datos todos a la inversa ---//
                $datos_transportista = $this->app_model->get_transportistas_inversa();
                if ($datos_transportista) {
                    $msg = "Se registro el transportista correctamente";
                    $dato = array("valid" => true, "msg" => $msg, "datos_transportista" => $datos_transportista);
                } else {
                    $msg = "Seprodujo un error al obtener los datos del transportista, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Error la registrar un nuevo transportista, vuelva a intentarlo";
                $dato = array("valid" => true, "msg" => $msg);
            }
        } else {
            $msg = "No se obtuvo el nombre del transportista";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function listar_remito_table($idGenIngreso)
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $productos = $this->app_model->get_productos();
        $detalle = $this->app_model->get_ingreso_detalle_by_idGenIngreso($idGenIngreso);

        if ($detalle) {
            foreach ($detalle as $key => $value) {
                $productos_select = '<select style="width: 100%;" name="selectProductos_formNuevoRemito'. $value['idDetalleIngreso'].'" id="selectProductos_formNuevoRemito'. $value['idDetalleIngreso'].'" class="select-full form-control" required>';
                if (isset($productos)) :
                    for ($i = 0; $i < count($productos); $i++) :
                        if ($value['idProducto'] == $productos[$i]['idProducto']):
                            $productos_select .= '<option selected="selected" value="' . $productos[$i]['idProducto'] . '">(' . $productos[$i]['codigo'] . ") - " . $productos[$i]['nombre'] . '</option>'; else:
                            $productos_select .= '<option value="' . $productos[$i]['idProducto'] . '">(' . $productos[$i]['codigo'] . ") - " . $productos[$i]['nombre'] . '</option>';
                endif;
                endfor;
                endif;
                $productos_select .= '</select>';

                $cantidad = '<input type="number" id="cantidad_formNuevoRemito'. $value['idDetalleIngreso'].'" class="form-control" value="' . $value['cantidad'] . '">';

                $dato[] = array(
                    $value['idDetalleIngreso'],
                    $productos_select,
                    '<input type="text" id="observacion_formNuevoRemito'. $value['idDetalleIngreso'].'" class="form-control" value="" placeholder="Observación">',
                    $cantidad,
                    '<i class="icon-remove4" onclick="deleteRowListaRemito(' . $value["idDetalleIngreso"] . ')"></i>',
                    "DT_RowId" => $value['idDetalleIngreso']
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

    public function guardar_remito()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Obtencion de datos ---//
        $detalle = json_decode($this->input->post('detalle', true));
        $cliente = json_decode($this->input->post('cliente', true));
        $domicilio = json_decode($this->input->post('domicilio', true));
        $fechaEmision = json_decode($this->input->post('fechaEmision', true));
        $tipoRemito = $this->input->post('selectTipoRemito_formNuevoRemito', true);
        $transportista = $this->input->post('selectTransportista_formNuevoRemito', true);
        $nota_cliente = json_decode($this->input->post('notaCliente', true));
        $idGenIngreso = json_decode($this->input->post('idGenIngreso', true));
        $cantidadBultos = json_decode($this->input->post('cantidadBultos', true));
        $montoAsegurado = $this->input->post('montoAsegurado', true);
        $idGenRemito = substr(md5(microtime()), 15, 17);

        $result_remito = $this->app_model->insert_remito($idGenRemito, $idGenIngreso, $cliente, $domicilio, $fechaEmision, intval($tipoRemito), intval($transportista), $nota_cliente, intval($cantidadBultos), floatval($montoAsegurado));
        
        foreach ($detalle as $key => $value) {
            $this->app_model->insert_detalle_remito($idGenRemito, $value->idProducto, $value->observacion, $value->cantidad);
        }

        if ($result_remito) {
            $msg = "Remito agregado con exito";
            $dato = array("valid" => true, "msg" => $msg, "cantidadBultos" => intval($cantidadBultos), "idGenRemito" => $idGenRemito);
        } else {
            $msg = "Error al agregar el remito, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }
 
        echo json_encode($dato);
    }

    public function modificar_remito($idGenRemito)
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['idGenRemito'] = $idGenRemito;

        $this->data['remito'] = $this->app_model->get_remito_by_idGenRemito($idGenRemito);

        $this->data['tipos_remito'] = $this->app_model->get_tipos_remitos();

        $this->data['transportistas'] = $this->app_model->get_transportistas();

        $this->data['remito_detalle'] = $this->app_model->get_remitos_detalle_by_idGenRemito($idGenRemito);

        $this->load_view('remitos/modificar_remito', $this->data);
    }

    
    public function listar_remito_modicar_table($idGenRemito)
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $productos = $this->app_model->get_productos();
        $detalle = $this->app_model->get_remitos_detalle_by_idGenRemito($idGenRemito);

        if ($detalle) {
            foreach ($detalle as $key => $value) {
                $productos_select = '<select style="width: 100%;" name="selectProductos_formModificarRemito'. $value['idDetalleRemito'].'" id="selectProductos_formModificarRemito'. $value['idDetalleRemito'].'" class="select-full form-control" required>';
                if (isset($productos)) :
                    for ($i = 0; $i < count($productos); $i++) :
                        if ($value['idProducto'] == $productos[$i]['idProducto']):
                            $productos_select .= '<option selected="selected" value="' . $productos[$i]['idProducto'] . '">(' . $productos[$i]['codigo'] . ") - " . $productos[$i]['nombre'] . '</option>'; else:
                            $productos_select .= '<option value="' . $productos[$i]['idProducto'] . '">(' . $productos[$i]['codigo'] . ") - " . $productos[$i]['nombre'] . '</option>';
                endif;
                endfor;
                endif;
                $productos_select .= '</select>';

                $cantidad = '<input type="number" id="cantidad_formModificarRemito'. $value['idDetalleRemito'].'" class="form-control" value="' . $value['cantidad'] . '">';

                $dato[] = array(
                    $value['idDetalleRemito'],
                    $productos_select,
                    '<input type="text" id="observacion_formModificarRemito'. $value['idDetalleRemito'].'" class="form-control" value="' . $value['observacion'] . '" placeholder="Observación">',
                    $cantidad,
                    '<i class="icon-remove4" onclick="deleteRowListaRemitoModificar(' . $value["idDetalleRemito"] . ')"></i>',
                    "DT_RowId" => $value['idDetalleRemito']
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

    public function update_remito()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Obtencion de datos ---//
        $detalle = json_decode($this->input->post('detalle', true));
        $cliente = json_decode($this->input->post('cliente', true));
        $domicilio = json_decode($this->input->post('domicilio', true));
        $fechaEmision = json_decode($this->input->post('fechaEmision', true));
        $tipoRemito = $this->input->post('selectTipoRemito_formModificarRemito', true);
        $transportista = $this->input->post('selectTransportista_formModificarRemito', true);
        $nota_cliente = json_decode($this->input->post('notaCliente', true));
        $idGenIngreso = json_decode($this->input->post('idGenIngreso', true));
        $idGenRemito = json_decode($this->input->post('idGenRemito', true));
        $cantidadBultos = json_decode($this->input->post('cantidadBultos', true));
        $montoAsegurado = $this->input->post('montoAsegurado', true);

        //--- Actualizamos el remito ---//
        $result_remito = $this->app_model->update_remito($idGenRemito, $cliente, $domicilio, $fechaEmision, intval($tipoRemito), intval($transportista), $nota_cliente, intval($cantidadBultos), floatval($montoAsegurado));
        
        //--- Obtenemso detalle actual ---//
        $result_remito_detalle = $this->app_model->get_remitos_detalle_by_idGenRemito($idGenRemito);

        //--- Realizamos el borrado de los detalle ---//
        if ($result_remito_detalle) {
            foreach ($result_remito_detalle as $key => $value) {
                $i=0;
                foreach ($detalle as $key => $values) {
                    //--- Comprobamos el idProducto del registro actual en el datatable con el persistente en la BD ---//
                    if ($value['idProducto'] != $values->idProducto) {
                        $i+=1;
                    }
                    //--- Si coincide es porque no encontro el idProducto que se encontraba persistente en la actual tabla del DataTable y lo borra ---//
                    if ($i == count($detalle)) {
                        $this->app_model->drop_detalle_remito($value['idGenRemito'], $value['idProducto']);
                    }
                }
            }
        }

        //--- Realizamos las modificaciones de los detalles
        if ($detalle) {
            foreach ($detalle as $key => $value) {
                
                //--- Comprobamos el detalle actual con el persistente ---//
                if (!in_array(intval($value->idProducto), $result_remito_detalle)) {
                    $i = 0;
                    foreach ($result_remito_detalle as $key => $values) {
                        //--- si el registro esta actualmente pero fue modificado entonces el mismo se procedera a modificar ---//
                        if ($values['idProducto'] == $value->idProducto) {
                            if (intval($value->cantidad) != intval($result_remito_detalle[$key]['cantidad'])) {
                                $this->app_model->update_detalle_remito($idGenRemito, $value->idProducto, $value->observacion, $value->cantidad);
                            } elseif (intval($value->cantidad) == intval($result_remito_detalle[$key]['cantidad'])) {
                                $this->app_model->update_detalle_remito($idGenRemito, $value->idProducto, $value->observacion, $value->cantidad);
                            }
                        } else {
                            $i += 1;
                        }
                    }
                    //--- Si este registro no se encuentra persistente entonces va a coincidir el contado con la longitud recorrida por lo que procedera a añadirlo ---//
                    if ($i == count($result_remito_detalle)) {
                        $this->app_model->insert_detalle_remito($idGenRemito, $value->idProducto, $value->observacion, $value->cantidad);
                    }
                }
            }
        }

        if ($result_remito) {
            $msg = "Remito modificado con exito";
            $dato = array("valid" => true, "msg" => $msg, "idGenRemito" => $idGenRemito);
        } else {
            $msg = "Error al modificar el remito, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }


    public function generar_pdf_remito()
    {
        $idGenIngreso = $this->input->post('idGenIngreso', true);
        $idGenRemito = $this->input->post('idGenRemito', true);
        
        //--- Datos ---//
        $remito = $this->app_model->get_remito_by_idGenRemito($idGenRemito);
        $remito_detalle = $this->app_model->get_remitos_detalle_by_idGenRemito($idGenRemito);
        $result_transportista = $this->app_model->get_transportistas_by_idTransportista($remito[0]['idTransportista']);
        $ingreso = $this->app_model->get_ingreso_clientes_by_idGenIngreso($idGenIngreso);

        //-- CARGO LIBRERIAS --//
        $this->load->library('html2pdf');

        $this->html2pdf->folder('./uploads/remitos/');
        $this->html2pdf->filename($idGenRemito . ".pdf");
        $this->html2pdf->paper('a4', 'portrait');

        $cuerpo = "";
        foreach ($remito_detalle as $key => $value) :
            $cuerpo .= '<tr id="'. $value['idDetalleRemito'] .'">
                            <td class="tg-swzm" colspan="1">'. $value['codigo'] .'</td>
                            <td class="tg-swzm" colspan="4">'. $value['producto'] .'</td>
                            <td class="tg-swzm" colspan="5">'. $value['observacion'] .'</td>
                            <td class="tg-swzm" colspan="2">'. intval($value['cantidad']) .'</td>
                        </tr>';
        endforeach;

        //--- Tipo de Remito ---//
        if ($remito[0]['idTipoRemito'] == 0 || $remito[0]['idTipoRemito'] == 1) {
            $tipoRemito = "X";
        } elseif ($remito[0]['idTipoRemito'] == 2) {
            $tipoRemito = "R";
        }

        //--- Transportista ---//
        if ($result_transportista) {
            $transportista = $result_transportista[0]['nombre'];
        } else {
            $transportista = "-";
        }

        //--- Cliente ---//
        if($ingreso[0]['nombreEmpresa']){
            $nombreEmpresa = $ingreso[0]['nombreEmpresa'];
        } else {
            $nombreEmpresa = "-";
        }

        //--- Cel ---//
        if ($ingreso[0]['cel']) {
            $cel = $ingreso[0]['cel'];
        } else {
            $cel = "-";
        }

        //--- Condicion de iva ---//
        if ($ingreso[0]['cuit']) {
            $cuit = $ingreso[0]['cuit'];
        } else {
            $cuit = "-";
        }

        //--- Condicion de iva ---//
        if ($ingreso[0]['condicionIva']) {
            $condicionIva = $ingreso[0]['condicionIva'];
        } else {
            $condicionIva = "-";
        }

        //--- Condicion de iva ---//
        if ($remito[0]['notaCliente']) {
            $observaciones = '<tr>
                                <th class="tg-n21a" colspan="12">Observaciones: ' . $remito[0]['notaCliente'] . '</th>
                              </tr>';
        } else {
            $observaciones = "";
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
                                <td class="tg-zb0m" colspan="4"><span style="font-weight:bold"></span></td>
                                <td class="tg-zb0z" colspan="2"><span style="font-weight:bold;font-size:35px;">' . $tipoRemito .'</span><br> <span style="font-weight:bold;font-size:15px;">COD. ' . ($remito[0]['idRemito'] == "" ? "-" : $remito[0]['idRemito']) . '</span></td>
                                <td class="tg-zb0m" colspan="6"><span style="font-weight:bold">REMITO</span></td>
                            </tr>
                            <tr>
                                <td class="tg-704r" colspan="5"></td>
                                <td class="tg-704r" colspan="7"><br><br>Numero Remito: ' . $tipoRemito .' xxxxx-xxxxxxxxx<br>Fecha emisión:  ' . substr($remito[0]['fechaEmision'], 0, 10) . '<br><br><br></td>
                            </tr>
                            <tr>
                                <td class="tg-704r" colspan="12">Transportista: ' . $transportista . '</td>
                            </tr>
                            <tr>
                                <td class="tg-704r" colspan="5">Apllido y Nombre: ' . $nombreEmpresa . '<br>Teléfono: ' . $cel . '<br>Persona Contacto: ' . $remito[0]['nombreApellido'] . '</td>
                                <td class="tg-704r" colspan="7">Condición IVA: ' . $condicionIva . '<br>CUIT: ' . $cuit . '<br>Domicilio de Entrega: ' . $remito[0]['direccionEntrega'] . '</td>
                            </tr>
                            <tr>
                                <td class="tg-r0gd" colspan="1">Código</td>
                                <td class="tg-r0gd" colspan="4">Producto / Servicio</td>
                                <td class="tg-r0gd" colspan="5">Observacion</td>
                                <td class="tg-r0gd" colspan="2">Cantidad</td>
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
                                    <td style="border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:right;" colspan="12">Total Bultos: ' . $remito[0]['cantidadBultos'] . '</td>
                                </tr>
                                ' . $observaciones . '
                                <tr >
                                    <td style="border-color:black;border-style:solid;border-width:1px;font-size:12px;font-family:Arial, Helvetica, sans-serif !important;;background-color:#f9f9f9;border-color:inherit;text-align:left;" colspan="12">RECIBIDO<br><br> &nbsp; &nbsp; &nbsp; Firma:.................................... Aclaración:.................................... DNI:.................................... Fecha:....................................</td>
                                </tr>
                            </tfoot>
                            <!--  FIN TFOOD -->
                        </table>
                    </div>
                ');

        $this->html2pdf->create('save');
    }
}
