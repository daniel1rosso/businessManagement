<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Gastos extends MY_Controller
{
    protected $data = array(
        'active' => 'egresos'
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function listar_gastos()
    {
        $this->data['categorias'] = $this->app_model->get_gastos_categorias();

        $this->data['estados'] = $this->app_model->get_estados();

        $this->data['tesoreriaCuenta'] = $this->app_model->get_tesoreria_cuentas();

        $this->data['gastosCategorias'] = $this->app_model->get_gastos_categorias();

        $this->data['tiposFacturas'] = $this->app_model->get_factura_tipos();

        $this->load_view('gastos/listar_gastos', $this->data);
    }

    public function listar_gastos_table()
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $gastos = $this->app_model->get_gastos();
        $estados = $this->app_model->get_estados();

        if ($gastos) {
            foreach ($gastos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['estado'] == "Pendiente") :
                    $class = "btn-warning";
                $texto = "Pendiente"; elseif ($value['estado'] == "Pagado") :
                    $class = "btn-success";
                $texto = "Pagado"; else :
                    $class = "btn-info";
                $texto = "Sin Estado";
                endif;

                $idGenGasto = "'" . $value['idGenGasto'] . "'";

                if ($texto == "Pendiente") {
                    $opcion = '<div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                        '<ul class="dropdown-menu icons-right">' .
                        '<li><a onclick="llenadoGastosModificar(' . $idGenGasto . ', 1)"><i class="icon-grid3"></i> Ver</a></li>' .
                        '<li><a href="#modal-agregar-cobro-gasto" class="tip agregarCobroGasto" data-id="' . $value['idGenGasto'] . '" data-toggle="modal" ><i class="icon-tag5"></i> Agregar cobranza</a></li>' .
                        '<li><a onclick="llenadoGastosModificar(' . $idGenGasto . ', 2)"><i class="icon-cogs"></i> Editar</a></li>' .
                        '<li><a class="tip deleteGasto" data-id="' . $value['idGasto'] . '"><i class="icon-close"></i> Eliminar</a></li>' .
                        '<li class="divider"></li>' .
                        '</ul>' .
                        '</div>';
                } else {
                    $opcion = '<div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                        '<ul class="dropdown-menu icons-right">' .
                        '<li><a onclick="llenadoGastosModificar(' . $idGenGasto . ', 1)"><i class="icon-grid3"></i> Ver</a></li>' .
                        '<li><a class="tip deleteGasto" data-id="' . $value['idGasto'] . '"><i class="icon-close"></i> Eliminar</a></li>' .
                        '<li class="divider"></li>' .
                        '</ul>' .
                        '</div>';
                }

                $dato[] = array(
                    $opcion,
                    $value['fechaGasto'],
                    $value['categoria'],
                    $value['subcategoria'],
                    "$" . number_format($value['montoGasto'], 2, ",", "."),
                    $value['descripcionGasto'],
                    $value['medioPago'],
                    $value['fechaAlta'],
                    "DT_RowId" => $value['idGasto']
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

    public function buscaSubcategoriaGasto()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idCatGasto = $this->input->post('selectCatGasto', true);
        $subcategoriasGasto = $this->app_model->get_subcategorias_gastos_by_idCategoriaGasto($idCatGasto);

        echo '<option value="0">Seleccionar Subcategoria Gasto</option>';
        foreach ($subcategoriasGasto as $key) {
            echo '<option value="' . $key['idSubCatGasto'] . '">' . $key['descripcion'] . '</option>';
        }
    }

    public function set_gasto()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            //--- recoleccion de datos ---//
            $inputFechaGasto = $this->input->post('inputFechaGasto', true);
            $montoGasto = $this->input->post('montoGasto', true);
            $selectCatGasto = $this->input->post('selectCatGasto', true);
            $selectSubCatGasto = $this->input->post('selectSubCatGasto', true);
            $selectMedioPago = $this->input->post('selectMedioPago', true);
            $descripcionGasto = $this->input->post('descripcionGasto', true);
            $selectTipoFactura = $this->input->post('selectTipoFactura', true);
            $inputFechaVtoGasto = $this->input->post('inputFechaVtoGasto', true);
            $idEstado = $this->input->post('idEstado', true);

            if (
                !empty($montoGasto) AND isset($selectCatGasto) AND isset($selectSubCatGasto) AND isset($selectMedioPago) AND isset($selectTipoFactura) AND !empty($inputFechaVtoGasto)
            ) {
                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];

                //--- Fecha del nuevo cobro ---//
                if (empty($inputFechaGasto)) {
                    $fechaGasto = date("Y-m-d");
                } else {
                    $fechaGasto = $inputFechaGasto;
                }

                $idGenGasto = md5(microtime());

                $nombreExtension = "";

                //--- insertar un nuevo archivo ---//
                $file = 'fileGasto';
                if (!empty($_FILES[$file]['name'])) {
                    $nombreImg = substr(md5(microtime()), 15, 17);

                    $urlCarpeta = './uploads/gastos/' . $nombreImg;
                    if (!file_exists($urlCarpeta)) {
                        mkdir($urlCarpeta, 0700);
                    }

                    $config['upload_path'] = $urlCarpeta . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|txt|xls';
                    $config['max_size'] = '0';
                    $config['overwrite'] = true;

                    $config['file_name'] = $nombreImg;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($file)) {
                        $error = array('error' => $this->upload->display_errors());
                        $resultIMG = false;

                        $dato = array("valid" => false, "error" => $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $nombreImg = $data['upload_data']['file_name'];
                        $extension = $data['upload_data']['file_ext'];

                        if ($extension != '.pdf' && $extension != '.xls' && $extension != '.txt') {
                            $imgWidth = $data['upload_data']['image_width'];

                            //Creo Risize de la img grande
                            $config2['image_library'] = 'gd2';
                            //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                            $config2['source_image'] = './uploads/gastos/' . $nombreImg;
                            //$config2['create_thumb'] = TRUE;
                            $config2['maintain_ratio'] = true;
                            $config2['width'] = 450;
                            //$config2['height'] = 1024;

                            $this->load->library('image_lib', $config2);
                            $this->image_lib->initialize($config2);
                            $this->image_lib->resize();

                            //--- config sola para las img ---//
                            $config3['width'] = 250;
                            $config3['height'] = 250;
                        }

                        //Creo el thumb
                        $config3['image_library'] = 'gd2';
                        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                        $config3['source_image'] = './uploads/gastos/' . $nombreImg;
                        //$config2['create_thumb'] = TRUE;
                        $config3['maintain_ratio'] = true;

                        $this->load->library('image_lib', $config3);
                        $this->image_lib->initialize($config3);
                        $this->image_lib->resize();
                    }
                    $nombreExtension = $nombreImg;
                }

                $result = $this->app_model->insert_gasto($idVendedor, $idGenGasto, $idEstado, $fechaGasto, $montoGasto, $selectCatGasto, $selectSubCatGasto, $selectMedioPago, $descripcionGasto, $nombreExtension, $selectTipoFactura, $inputFechaVtoGasto);

                //--- Si el gasto es pagado registramos el egreso o la deuda de este gasto ---//
                if ($idEstado == 2) {
                    $result4 = $this->app_model->insert_ingreso_egreso_caja(
                        $idCaja = $selectMedioPago,
                        $idGenGasto,
                        $ingreso = 0,
                        $egreso = $montoGasto,
                        $descripcionMovimiento = "",
                        $idGenMovimiento = 0,
                        $idTipo = 3 //indica gasto
                    );
                }
                
                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                    $idVendedor,
                    $idGenGasto,
                    $tipoAccion = 1,
                    $tipoOperacion = 8,
                    "Se agregó un gasto con la descripción " . $descripcionGasto, //detalle
                    $montoGasto
                );

                $result5 = $this->app_model->get_gastos_by_idGenGasto($idGenGasto);

                if ($result && $result_insert_historico && $result5) {
                    $msg = "El gasto se registro con exito";
                    $dato = array("valid" => true, "msg" => $msg, "gasto" => $result5, "nombreExtension" => $nombreExtension, "idEstado" => $idEstado);
                } else {
                    $msg = "Error al registrar el gasto";
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

    public function eliminar_gasto($idGasto)
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];
        $msg = "";

        if (!empty($idGasto)) {

            //--- Eliminamos el gato ---//
            $result = $this->app_model->eliminar_gasto_idGasto($idGasto);

            //--- Obtenemos el gasto ---//
            $gasto = $this->app_model->get_gastos_by_idGasto($idGasto);
            
            $caja = $this->app_model->get_estado_caja_by_idGenGasto($gasto[0]['idGenGasto']);
            if ($caja) {
                //--- Eliminamos los registros de caja ---//
                $drop_cajas = $this->app_model->eliminar_caja_ingreso_by_idGenIngreso($gasto[0]['idGenGasto']);
            } else {
                $drop_cajas = true;
            }

            if ($result && $drop_cajas) {

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                    $idUsuario,
                    $idGasto,
                    $tipoAccion = 3,
                    $tipoOperacion = 8,
                    "Se eliminó un gasto", //detalle
                    0
                );

                $msg = "El gasto fue eliminado con exito";
                $dato = array("valid" => true, "msg" => $msg, "gasto" => $gasto[0], "idGasto" => $idGasto);
            } else {
                $msg = "Error al eliminar el gasto, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg, "gasto" => $gasto[0], "idGasto" => $idGasto);
            }
        } else {
            $msg = "Id vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function listar_categorias()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $this->data['categorias_gastos'] = $this->app_model->get_gastos_categorias();

        $this->load_view('gastos/listar_categorias', $this->data);
    }

    public function listar_subcategorias()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $this->data['subcategorias_gastos'] = $this->app_model->get_subcategorias_gastos_categoria_gastos();

        $this->data['categorias_gastos'] = $this->app_model->get_categorias_gastos();

        $this->load_view('gastos/listar_subcategorias', $this->data);
    }

    public function add_categorias_gastos()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        if ($_POST) {
            $inputDescripcion = $this->input->post('inputDescripcion_formCatGastos', true);

            $existe = $this->app_model->get_existe_categoria_gastos($inputDescripcion);

            if ($existe == 0) {
                $result = $this->app_model->insert_categorias_gastos($inputDescripcion);

                if ($result) {
                    $msg = "Categoría gasto fue añadida con exito";
                    $id = $this->app_model->get_ultimo_id_categoria_gastos($inputDescripcion);

                    for ($i = 0; $i < 26; $i++) {
                        $inputDescripcion_formCatGastos[] = $this->input->post('inputSubcategoria_formCatGastos' . $i, true);
                        if ($inputDescripcion_formCatGastos[$i] != false) {
                            $result_subcategoria = $this->app_model->insert_subcategoria_gastos($inputDescripcion_formCatGastos[$i], $id[0]['id']);
                        }
                    }
                    $userdata = $this->session->all_userdata();
                    $idVendedor = $userdata['idUsuario'];
                    //--- Guardo - Historico ---//
                    $result_insert_historico = $this->app_model->set_historico(
                        $idVendedor,
                        $id[0]['id'],
                        $tipoAccion = 1,
                        $tipoOperacion = 15, //Agrega nuevo cobro
                        "Se agregó una categoría de gastos", //detalle
                        0 //montoCobro
                    );

                    $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id[0]['id']);
                } else {
                    $msg = "Error al añadir la categoría de gasto, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Existe esta categoría añadida";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function add_categorias_ventas_detalle()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        if ($_POST) {
            $inputDescripcion = $this->input->post('inputDescripcion_formCatDetVentas', true);

            $existe = $this->app_model->get_existe_categoria_ventas_detalle($inputDescripcion);


            if ($existe == 0) {
                $result = $this->app_model->insert_categoria_ventas_detalle($inputDescripcion);

                if ($result) {
                    $id = $this->app_model->get_ultimo_id_categoria_ventas_detalle($inputDescripcion);

                    for ($i = 0; $i < 26; $i++) {
                        $inputDescripcion_formCatVentas[] = $this->input->post('inputSubcategoria_formCatVentas' . $i, true);
                        if ($inputDescripcion_formCatVentas[$i] != false) {
                            $result_subcategoria = $this->app_model->insert_subcategoria_ventas($inputDescripcion_formCatVentas[$i], $id[0]['id']);
                        }
                    }

                    $msg = "Categoría insertada";
                    $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id[0]['id']);
                } else {
                    $msg = "Error al insertar la categoría";
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

    public function update_categorias_gastos()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $id = $this->input->post('inputIdModificar_formCatGastos', true);
        $inputDescripcion = $this->input->post('inputDescripcionModificar_formCatGastos', true);

        $result = $this->app_model->update_categoria_gastos($id, $inputDescripcion);


        //--- Recoleccion de datos ---//
        for ($i = 0; $i < 26; $i++) {
            $inputSubcategoria_formModificarCatGastos[] = $this->input->post('inputSubcategoria_formModificarCatGastos' . $i, true);
            $idSubcategoria_formModificarCatGastos[] = $this->input->post('idSubcategoria_formModificarCatGastos' . $i, true);
        }
        
        //--- Operaciones ---//
        //--- Borrado ---//
        $subcategorias = $this->app_model->get_subcategorias_gastos_by_idCategoriaGasto($id);
        if ($subcategorias) {
            foreach ($subcategorias as $key => $value) {
                $contador=0;
                for ($i = 0; $i < 26; $i++) {
                    if ($idSubcategoria_formModificarCatGastos[$i] != $value['idSubCatGasto']) {
                        $contador+=1;
                    }
                }

                if(25 != $contador){
                    $gastos_categoria = $this->app_model->get_gastos_by_idSubCategoriaGasto($value['idSubCatGasto']);
                    if (!$gastos_categoria) {
                        $result_subcategoria = $this->app_model->delete_subcategoria_gastos($value['idSubCatGasto']);
                    } else {
                        $result_subcategoria = true;
                    }
                }
            }
        }

        //--- Insert and Update ---//
        for ($i = 0; $i < 26; $i++) {
            $subcategoria = $this->app_model->get_subcategorias_gastos_by_idSubCategoriaGasto($idSubcategoria_formModificarCatGastos[$i]);
            if (!$subcategoria && $inputSubcategoria_formModificarCatGastos[$i] != false) {
                $result_subcategoria = $this->app_model->insert_subcategoria_gastos($inputSubcategoria_formModificarCatGastos[$i], $id);
            } else if ($subcategoria && $inputSubcategoria_formModificarCatGastos[$i] != false) {
                $result_subcategoria = $this->app_model->update_subcategoria_gastos($idSubcategoria_formModificarCatGastos[$i], $inputSubcategoria_formModificarCatGastos[$i], $id);
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
            $tipoOperacion = 15, //Agrega nuevo cobro
            "Se modificó una categoría de gasto", //detalle
            0 //montoCobro
        );
        if (true) {
            $msg = "Categoría de gasto fue actualizada con exito";
            $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id);
        } else {
            $msg = "Error al actualizar la categoría de gasto, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg, "result" => $result, "result_subcategoria" => $result_subcategoria);
        }

        echo json_encode($dato);
    }

    public function eliminar_categorias_gastos()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $id = $this->input->post('id', true);
        $existe = 0;

        $gastos_idCategoria = $this->app_model->get_gastos_by_idCategoriaGasto($id);
        if(!$gastos_idCategoria) {
            $result = $this->app_model->delete_categoria_gastos($id);
        } else {
            $result = false;
            $existe = 1;
        }

        $userdata = $this->session->all_userdata();
        $idVendedor = $userdata['idUsuario'];
        //--- Guardo - Historico ---//
        $result_insert_historico = $this->app_model->set_historico(
            $idVendedor,
            $id,
            $tipoAccion = 3,
            $tipoOperacion = 15, //Agrega nuevo cobro
            "Se eliminó una categoria de gasto", //detalle
            0 //montoCobro
        );
        if ($result && $existe == 0) {
            $msg = "Categoría de gastos fue eliminada con exito";
            $dato = array("valid" => true, "msg" => $msg);
        } else if ($result && $existe == 1) {
            $msg = "Error al eliminar la categoría de gasto porque existe un gasto con esta categoría, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        } else {
            $msg = "Error al eliminar la categoría de gasto, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function add_subcategorias_gastos()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        if ($_POST) {
            $inputDescripcion = $this->input->post('inputDescripcion_formSubCatGastos', true);
            $selectCategoria = $this->input->post('selectCategoriaDetalle_formSubCatGastos', true);

            $result = $this->app_model->insert_subcategoria_gastos($inputDescripcion, $selectCategoria);

            if ($result) {
                $msg = "Subcategoría de gasto fue añadida con exito";
                $id = $this->app_model->get_ultimo_id_subcategoria_gastos($inputDescripcion);

                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];
                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                    $idVendedor,
                    $id[0]['id'],
                    $tipoAccion = 1,
                    $tipoOperacion = 16, //Agrega nuevo cobro
                    "Se agregó una subcategoria de gasto", //detalle
                    0 //montoCobro
                );
                $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id[0]['id'], "selectCategoria" => $selectCategoria);
            } else {
                $msg = "Error al añadir la subcategoría de gastos, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function update_subcategorias_gastos()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $id = $this->input->post('inputId_formSubCatGastos', true);
        $inputDescripcion = $this->input->post('inputDescripcion_formSubCatGastos', true);
        $selectCategoria = $this->input->post('selectCategoriaDetalle_formSubCatGastos', true);

        $result = $this->app_model->update_subcategoria_gastos($id, $inputDescripcion, $selectCategoria);

        $userdata = $this->session->all_userdata();
        $idVendedor = $userdata['idUsuario'];
        //--- Guardo - Historico ---//
        $result_insert_historico = $this->app_model->set_historico(
            $idVendedor,
            $id,
            $tipoAccion = 2,
            $tipoOperacion = 16, //Agrega nuevo cobro
            "Se modificó una subcategoría de gasto", //detalle
            0 //montoCobro
        );
        if ($result) {
            $msg = "Subcategoría de gasto fue actualizada con exito";
            $dato = array("valid" => true, "msg" => $msg, 'inputDescripcion' => $inputDescripcion, 'id' => $id, "selectCategoria" => $selectCategoria);
        } else {
            $msg = "Error al actualizar la subcategoría de gasto, veulva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_subcategorias_gastos()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $id = $this->input->post('id', true);
        $existe = 0;

        $gasto_idSubCategoria = $this->app_model->get_gastos_by_idSubCategoriaGasto($id);
        if (!$gasto_idSubCategoria) {
            $result = $this->app_model->delete_subcategoria_gastos($id);
        } else {
            $result = false;
            $existe = 1;
        }

        $userdata = $this->session->all_userdata();
        $idVendedor = $userdata['idUsuario'];
        //--- Guardo - Historico ---//
        $result_insert_historico = $this->app_model->set_historico(
            $idVendedor,
            $id,
            $tipoAccion = 3,
            $tipoOperacion = 16, //Agrega nuevo cobro
            "Se eliminó una subcategoria de gasto", //detalle
            0 //montoCobro
        );
        if ($result && $existe == 0) {
            $msg = "Subcategoría de gasto fue eliminada con exito";
            $dato = array("valid" => true, "msg" => $msg);
        } else if (!$result && $existe == 1) {
            $msg = "Error al eliminar la subcategoría de gasto porque existe un gasto con esta subcategoria, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        } else {
            $msg = "Error al eliminar la subcategoría de gasto, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_gasto_idGenGasto()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $idGenGasto = $this->input->post('idGenGasto', true);

        //--- Gasto correspondiente al idGenGasto ---//
        $gasto = $this->app_model->get_gastos_by_idGenGasto($idGenGasto);

        if ($gasto) {
            $msg = "Gasto obtenido";
            $dato = array("valid" => true, "msg" => $msg, "gasto" => $gasto);
        } else {
            $msg = "Error al Obtener el gasto";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_categoria_subcategoria_gasto()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        $idCategoriaGasto = $this->input->post('idCategoriaGasto', true);

        //--- Gasto correspondiente al idGenGasto ---//
        $categoria_gasto = $this->app_model->get_categorias_gastos_by_idCategoria($idCategoriaGasto);

        $subcategorias_gasto = $this->app_model->get_subcategorias_gastos_by_idCategoriaGasto($idCategoriaGasto);

        if ($categoria_gasto && $subcategorias_gasto) {
            $msg = "Categoría y subcategorías de gasto obtenido";
            $dato = array("valid" => true, "msg" => $msg, "categoria_gasto" => $categoria_gasto, "subcategorias_gasto" => $subcategorias_gasto);
        } else {
            $msg = "Error al Obtener el gasto";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function update_gasto()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['active'] = "categorias";

        //--- Guardo ---//
        if ($_POST) {
            //--- recoleccion de datos ---//
            $inputFechaGasto = $this->input->post('inputFechaGasto_modificarGasto', true);
            $montoGasto = $this->input->post('montoGasto_modificarGasto', true);
            $selectCatGasto = $this->input->post('selectCatGasto_modificarGasto', true);
            $selectSubCatGasto = $this->input->post('selectSubCatGasto_modificarGasto', true);
            $selectMedioPago = $this->input->post('selectMedioPago_modificarGasto', true);
            $descripcionGasto = $this->input->post('descripcionGasto_modificarGasto', true);
            $selectTipoFactura = $this->input->post('selectTipoFactura_modificarGasto', true);
            $idGenGasto = $this->input->post('idModificarGasto', true);
            $inputFechaVtoGasto = $this->input->post('inputFechaVtoGasto_modificarGasto', true);
            $montoGastoDiferencia = 0;


            if (
                !empty($montoGasto) AND isset($selectCatGasto) AND isset($selectSubCatGasto) AND isset($selectMedioPago) AND isset($selectTipoFactura) AND !empty($inputFechaVtoGasto)
            ) {
                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];

                $gasto_by_idGenGasto = $this->app_model->get_gastos_by_idGenGasto($idGenGasto);
                $descripcionHistorico = "Se modificó un gasto de " . $gasto_by_idGenGasto[0]['montoGasto'] . " a " . $montoGasto;

                //--- Fecha del nuevo cobro ---//
                if (empty($inputFechaGasto)) {
                    $fechaGasto = date("Y-m-d");
                } else {
                    $fechaGasto = $inputFechaGasto;
                }

                $idEstado = $gasto_by_idGenGasto[0]['idEstado']; /* estado del gasto */

                //--- insertar un nuevo archivo ---//
                $file = 'fileGasto';
                if (!empty($_FILES[$file]['name'])) {
                    $nombreImg = substr(md5(microtime()), 15, 17);

                    $urlCarpeta = './uploads/gastos/' . $nombreImg;
                    if (!file_exists($urlCarpeta)) {
                        mkdir($urlCarpeta, 0700);
                    }

                    $config['upload_path'] = $urlCarpeta . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|txt|xls';
                    $config['max_size'] = '0';
                    $config['overwrite'] = true;

                    $config['file_name'] = $nombreImg;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($file)) {
                        $error = array('error' => $this->upload->display_errors());
                        $resultIMG = false;

                        $dato = array("valid" => false, "error" => $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $nombreImg = $data['upload_data']['file_name'];
                        $extension = $data['upload_data']['file_ext'];

                        if ($extension != '.pdf' && $extension != '.xls' && $extension != '.txt') {
                            $imgWidth = $data['upload_data']['image_width'];

                            //Creo Risize de la img grande
                            $config2['image_library'] = 'gd2';
                            //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                            $config2['source_image'] = './uploads/gastos/' . $nombreImg;
                            //$config2['create_thumb'] = TRUE;
                            $config2['maintain_ratio'] = true;
                            $config2['width'] = 450;
                            //$config2['height'] = 1024;

                            $this->load->library('image_lib', $config2);
                            $this->image_lib->initialize($config2);
                            $this->image_lib->resize();

                            //--- config sola para las img ---//
                            $config3['width'] = 250;
                            $config3['height'] = 250;
                        }

                        //Creo el thumb
                        $config3['image_library'] = 'gd2';
                        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                        $config3['source_image'] = './uploads/gastos/' . $nombreImg;
                        //$config2['create_thumb'] = TRUE;
                        $config3['maintain_ratio'] = true;

                        $this->load->library('image_lib', $config3);
                        $this->image_lib->initialize($config3);
                        $this->image_lib->resize();
                    }
                    $nombreExtension = $nombreImg;
                } else {
                    $nombreExtension = $gasto_by_idGenGasto[0]['nombreImg'];
                }

                $gasto = $this->app_model->update_gasto($idVendedor, $idGenGasto, $idEstado, $fechaGasto, $montoGasto, $selectCatGasto, $selectSubCatGasto, $selectMedioPago, $descripcionGasto, $nombreExtension, $selectTipoFactura, $inputFechaVtoGasto);

                //--- Guardo - Historico ---//
                $historico = $this->app_model->set_historico(
                    $idVendedor,
                    $idGenGasto,
                    $tipoAccion = 2,
                    $tipoOperacion = 8,
                    "Se modifico un gasto con una descripcion " . $descripcionHistorico,
                    $montoGasto
                );

                //--- Actualizacion de ingreso_egreso caja ---//
                /*
                if ($gasto_by_idGenGasto[0]['montoGasto'] != $montoGasto) {
                    $montoGastoDiferencia = $gasto_by_idGenGasto[0]['montoGasto'] + ($montoGasto - $gasto_by_idGenGasto[0]['montoGasto']);

                    $ingreso_egreso_caja = $this->app_model->update_ingreso_egreso_caja(
                        $idCaja = $selectMedioPago,
                        $idGenGasto,
                        $ingreso = 0,
                        $egreso = $montoGastoDiferencia,
                        $descripcionMovimiento = "",
                        $idGenMovimiento = 0,
                        $idTipo = 3 //indica gasto
                    );
                } else { */
                    $ingreso_egreso_caja = true;
                /* } */

                if ($gasto && $historico && $ingreso_egreso_caja) {
                    $gasto_ultimo = $this->app_model->get_gastos_by_idGenGasto($idGenGasto);
                    if ($gasto_ultimo) {
                        $msg = "El gasto fue actualizado con exito";
                        $dato = array("valid" => true, "msg" => $msg, "gasto" => $gasto_ultimo, "nombreExtension" => $nombreExtension, "montoGastoDiferencia" => $montoGastoDiferencia);
                    } else {
                        $msg = "Error al obtener el gasto, vuelva a intentarlo";
                        $dato = array("valid" => false, "msg" => $msg, "montoGastoDiferencia" => $montoGastoDiferencia);
                    }
                } else {
                    $msg = "Error al actualizar el gasto, vuelva a intentarlo";
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

    public function listar_gastos_informe()
    {
        $this->load_view('informes/listar_gastos_informe', $this->data);
    }

    public function listar_gastos_informe_table()
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $gastos = $this->app_model->get_gastos();
        $estados = $this->app_model->get_estados();

        if ($gastos) {
            foreach ($gastos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-info";
                $texto = "A Pagar"; elseif ($value['idEstado'] == 2) :
                    $class = "btn-success";
                $texto = "Pagado"; elseif ($value['idEstado'] == 3) :
                    $class = "btn-danger";
                $texto = "Vencido"; else :
                    $class = "btn-warning";
                $texto = "Sin Estado";
                endif;

                $opcion = '<div class="btn-group">' .
                    '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                    '</div>';

                $dato[] = array(
                    $opcion,
                    $value['fechaGasto'],
                    $value['categoria'],
                    $value['subcategoria'],
                    "$" . number_format($value['montoGasto'], 2, ",", "."),
                    $value['descripcionGasto'],
                    $value['medioPago'],
                    $value['fechaAlta'],
                    "DT_RowId" => $value['idGasto']
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

    public function listar_gastos_informe_table_filtro($desde, $hasta)
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $gastos = $this->app_model->get_gastos_desde_hasta($desde, $hasta);
        $estados = $this->app_model->get_estados();

        if ($gastos) {
            foreach ($gastos as $key => $value) {
                $texto = "";
                $class = "";
                if ($value['idEstado'] == 1) :
                    $class = "btn-info";
                $texto = "A Pagar"; elseif ($value['idEstado'] == 2) :
                    $class = "btn-success";
                $texto = "Pagado"; elseif ($value['idEstado'] == 3) :
                    $class = "btn-danger";
                $texto = "Vencido"; else :
                    $class = "btn-warning";
                $texto = "Sin Estado";
                endif;

                $opcion = '<div class="btn-group">' .
                    '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                    '</div>';

                $dato[] = array(
                    $opcion,
                    $value['fechaGasto'],
                    $value['categoria'],
                    $value['subcategoria'],
                    "$" . number_format($value['montoGasto'], 2, ",", "."),
                    $value['descripcionGasto'],
                    $value['medioPago'],
                    $value['fechaAlta'],
                    "DT_RowId" => $value['idGasto']
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

    public function exportar_to_excel_gastos()
    {
        $this->load->helper('mysql_to_excel_helper');

        //        //--- tomar datos del post ---//
        $fechaDesde = $this->input->post('fechaI_informeGasto', true);
        $fechaHasta = $this->input->post('fechaF_informeGasto', true);

        //--- fecha actual ---//
        $hoy = getdate();
        $fechaActual = $hoy['mday'] . $hoy['mon'] . $hoy['year'];

        //--- exportar excel ---//
        //--- verificar si es vacio o no el filtro de fechas ---//
        if ($fechaDesde == 0 && $fechaHasta == 0) {
            to_excel($this->app_model->get_gastos_exportar(), "informeGastos" . $fechaActual);
        } elseif ($fechaDesde != 0 && $fechaHasta != 0) {
            to_excel($this->app_model->get_gastos_desde_hasta_exportar($fechaDesde, $fechaHasta), "informeGastos" . $fechaActual . "-desde" . $fechaDesde . "-hasta" . $fechaHasta);
        }
    }

    public function update_notificacion_leida()
    {
        $this->load->helper('mysql_to_excel_helper');

        $idGenGasto = $this->input->post('idGenGasto', true);
        $fechaRegistroNotificacion = $this->input->post('fechaRegistroNotificacion', true);

        $result = $this->app_model->update_notificacion_leida_gasto($idGenGasto, $fechaRegistroNotificacion);

        if ($result) {
            $msg = "Notificacion leida";
            $dato = array("valid" => true, "msg" => $msg);
        } else {
            $msg = "Falla su proceso de marcar como leida";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_monto_adeudado()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        if ($_POST) {
            //--- Obtencion de datos ---//
            $idGenGasto = $this->input->post('idGenGasto', true);
            //--- Declaracion de variables ---//
            $ingresos = 0;
            //--- obtencion de datos de la bd ---//
            $gasto = $this->app_model->get_gastos_by_idGenGasto($idGenGasto);
            $movimientos_cuenta = $this->app_model->get_estado_caja_by_idGenGasto($idGenGasto);
            
            if ($movimientos_cuenta) {
                foreach ($movimientos_cuenta as $key => $value) {
                    $ingresos += $value['egreso'];
                }
            }

            $gasto_adeudado = $gasto[0]['montoGasto'] - $ingresos;

            if($gasto){
                $msg = "Datos obtenidos";
                $dato = array("valid" => true, "msg" => $msg, "gasto" => $gasto, "movimientos_cuenta" => $movimientos_cuenta, "gasto_adeudado" => $gasto_adeudado);
            } else {
                $msg = "No se obtuvieron los datos necesarios, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function set_cobro_gasto(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        if ($_POST) {

            //--- Obtencion de datos del modal ---//
            $idGenGasto = $this->input->post('idGenGasto', true);
            $monto_adeudado = $this->input->post('montoAdeudado_formAgregarCobroGasto', true);
            $montoCobro = $this->input->post('montoCobro_formAgregarCobroGasto', true);
            $medio_cobro = $this->input->post('selectMedioCobro_formAgregarCobroGasto', true);
            $descripcion = $this->input->post('descripcionCobro', true);
            //---- Declaracion de la variable ---//
            $insert_ingreso_egreso = true;
            $diferencia = 0;
            $saldado = false;
            $gasto = false;

            if (!empty($monto_adeudado) AND isset($medio_cobro)) {
                if ($montoCobro >= 0){
                    $insert_ingreso_egreso = $this->app_model->insert_ingreso_egreso_caja(
                        $idCaja = $medio_cobro,
                        $idGenGasto,
                        $ingreso = 0,
                        $egreso = $montoCobro,
                        $descripcionMovimiento = $descripcion,
                        $idGenMovimiento = 0,
                        $idTipo = 3 //indica gasto
                    );
                }

                $diferencia = $monto_adeudado - $montoCobro;
                if ($diferencia == 0) {
                    $this->app_model->update_gasto_estado( $idGenGasto, 2);
                    $saldado = true;
                    $gasto = $this->app_model->get_gastos_by_idGenGasto($idGenGasto);
                }

                if ($insert_ingreso_egreso) {
                    $msg = "Se registro el pago del gasto exitosamente";
                    $dato = array("valid" => true, "msg" => $msg, "saldado" => $saldado, "gasto" => $gasto);
                } else {
                    $msg = "No se puedo registrar el pago, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos minimos faltantes, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }

        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
