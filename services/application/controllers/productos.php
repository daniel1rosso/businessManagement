<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos extends MY_Controller {

    protected $data = array(
        'active' => 'productos'
    );

    public function __construct() {
        parent::__construct();
        parent::datosFormProductos();
    }

    public function listar_productos() {
        $empresa = $this->app_model->get_empresas();
        $productos = $this->app_model->get_productos();

        $totStock = 0;
        $costoTotal = 0;
        $subCostoTotal = 0;
        $valorVentaTotal = 0;
        $subValorVentaTotal = 0;

        if ($productos) {
            foreach ($productos as $key => $value) {
                $this->data['productos'][$key]['idProducto'] = $value['idProducto'];
                $this->data['productos'][$key]['idGenProducto'] = $value['idGenProducto'];
                $this->data['productos'][$key]['nombre'] = $value['nombre'];
                $this->data['productos'][$key]['stock'] = $value['stock'];
                $this->data['productos'][$key]['precioCompra'] = $value['precioCompra'];
                $this->data['productos'][$key]['precioVenta'] = $value['precioVenta'];
                $this->data['productos'][$key]['descIvaVentas'] = $value['descIvaVentas'];
                $this->data['productos'][$key]['descIvaCompras'] = $value['descIvaCompras'];
                $this->data['productos'][$key]['nombEmpresa'] = $value['nombEmpresa'];

                //Total Stock
                $totStock = $totStock + $value['stock'];

                $subCostoTotal = $value['stock'] * $value['precioCompra'];
                $costoTotal = $costoTotal + $subCostoTotal;

                $subValorVentaTotal = $value['stock'] * $value['precioVenta'];
                $valorVentaTotal = $valorVentaTotal + $subValorVentaTotal;
            }
        }

        $this->data['totStock'] = $totStock;
        $this->data['costoTotal'] = $costoTotal;
        $this->data['valorVentaTotal'] = $valorVentaTotal;
        $this->data['empresa'] = $empresa;
        $this->data['configuracion_ecommerce'] = $this->app_model->get_configuracion_ecommerce();

        $this->load_view('productos/listar_productos', $this->data);
    }

    public function get_info_producto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idGenProducto = $this->input->post('id', true);
        $msg = "";

        if (!empty($idGenProducto)) {
            $producto = $this->app_model->get_info_producto_byIdGen($idGenProducto);
            if ($producto) {
                $msg = "Ok";
                $dato = array("valid" => true, "msg" => $msg, "producto" => $producto);
            } else {
                $msg = "Error al obtener datos";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function set_producto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $inputNombre = $this->input->post('inputNombre', true);
            $inputCodigo = $this->input->post('inputCodigo', true);
            $selectProveedor = $this->input->post('selectProveedor', true);
            $inputStock = $this->input->post('inputStock', true);
            $inputDescripcion = $this->input->post('inputDescripcion', true);
            $selectEstado = $this->input->post('selectEstado', true);
            $inputPrecioVenta = $this->input->post('inputPrecioVenta', true);
            $selectIvaVenta = $this->input->post('selectIvaVenta', true);
            $inputPrecioCompra = $this->input->post('inputPrecioCompra', true);
            $selectIvaCompra = $this->input->post('selectIvaCompra', true);
            $selectControlStock = $this->input->post('selectControlStock_formProducto', true);
            $productoEcommerce = $this->input->post('selectProductoEcommerce_formDatosProducto', true);
            $porcentajeDescuento = $this->input->post('inputPorcentajeDescuento_formProducto', true);

            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];

            $idGenProducto = $this->generarID();

            if (
                    ! empty($inputNombre) AND
                    ! empty($inputCodigo) AND ! isset($selectProveedor) AND
                    ! empty($inputStock) AND
                    ! empty($inputDescripcion) AND ! isset($selectEstado) AND
                    ! empty($inputPrecioVenta) AND ! isset($selectIvaVenta) AND
                    ! empty($inputPrecioCompra) AND ! isset($selectIvaCompra) AND ! isset($selectControlStock)
            ) {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            } else {
                //--- Guardo Imagen - Producto ---//
                if (!empty($_FILES['file']['name'])) {
                    if (!file_exists('./uploads/productos/' . $idGenProducto)) {
                        mkdir('./uploads/productos/' . $idGenProducto, 0777, true);
                    }

                    if (!file_exists('./uploads/productos/' . $idGenProducto . '/thumbs')) {
                        mkdir('./uploads/productos/' . $idGenProducto . '/thumbs', 0777, true);
                    }

                    $config['upload_path'] = './uploads/productos/' . $idGenProducto . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '0';
                    $config['overwrite'] = TRUE;
                    $nombreImg = substr(md5(microtime()), 15, 17);
                    $config['file_name'] = $nombreImg;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $nombreImg = $data['upload_data']['file_name'];

                        //Creo el thumb
                        $config3['image_library'] = 'gd2';
                        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                        $config3['source_image'] = './uploads/productos/' . $idGenProducto . '/' . $nombreImg;
                        //$config2['create_thumb'] = TRUE;
                        $config3['maintain_ratio'] = TRUE;
                        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
                        $config3['new_image'] = './uploads/productos/' . $idGenProducto . '/thumbs/' . $nombreImg;
                        $config3['width'] = 250;
                        $config3['height'] = 250;

                        $this->load->library('image_lib', $config3);
                        $this->image_lib->initialize($config3);
                        $this->image_lib->resize();
                    }

                    $insert_img_producto = $this->app_model->insert_img_producto($idGenProducto, $nombreImg);
                }

                //--- Guardo - Producto ---//
                $result_insert_producto = $this->app_model->insert_producto(
                        $idGenProducto, $idUsuario, $inputNombre, $inputCodigo, $selectProveedor, $inputStock, $inputDescripcion, $selectEstado, $inputPrecioVenta, $selectIvaVenta, $inputPrecioCompra, $selectIvaCompra, $selectControlStock, $productoEcommerce, $porcentajeDescuento
                );

                //--- Guardo - Historial Precio---//
                $historico_precio = $this->app_model->insert_historico_precio($idGenProducto, $inputStock, $porcentajeDescuento);

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenProducto, $tipoAccion = 1, $tipoOperacion = 5, "Se agregó un nuevo producto llamado " . $inputNombre, //detalle
                        $total = 0
                );

                //--- Guardo el movimiento del stock ---//
                $hoy = getdate();
                $d = $hoy['mday'];
                (($d < 10) ? $d = "0" . $d : $d);
                $m = $hoy['mon'];
                (($m < 10) ? $m = "0" . $m : $m);
                $y = $hoy['year'];
                $fecha = $d . "-" . $m . "-" . $y;
                $movimiento_stock = $this->app_model->insert_movimiento_stock($idGenProducto, $idGenProducto, 1, $inputStock, "Se agrego el producto", 0, $idUsuario, $fecha);

                if ($result_insert_producto && $result_insert_historico && $movimiento_stock && $historico_precio) {
                    $producto = $this->app_model->get_productos_byIdGen($idGenProducto);
                    if ($producto) {
                        $msg = "Registro agregado";
                        $dato = array("valid" => true, "msg" => $msg, "producto" => $producto);
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

    public function set_producto_temporal() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $idGenProducto = $this->input->post('idGenProducto', true);
            $inputCodigo = $this->input->post('inputCodigo', true);
            $inputNombre = $this->input->post('inputNombre', true);
            $inputPrecioVenta = $this->input->post('inputPrecioVenta', true);

            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];


            if (
                    ! empty($idGenProducto) AND
                    ! empty($inputCodigo) AND
                    ! empty($inputNombre) AND
                    ! empty($inputPrecioVenta)
            ) {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            } else {


                //--- Guardo - Producto ---//
                $result_insert_producto = $this->app_model->insert_producto(
                        $idGenProducto, $idUsuario, $inputNombre, $inputCodigo, $selectProveedor = 0, $inputStock = 1, $inputDescripcion = "Producto temporal: " . $inputNombre, $selectEstado = 0, $inputPrecioVenta, $selectIvaVenta = 5, $inputPrecioCompra = $inputPrecioVenta, $selectIvaCompra = 5, $controlStock = 1
                );

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenProducto, $tipoAccion = 1, $tipoOperacion = 5, "Se agregó un nuevo producto temporal llamado " . $inputNombre, //detalle
                        $total = 0
                );

                if ($result_insert_producto && $result_insert_historico) {
                    $producto = $this->app_model->get_producto_byIdGen($idGenProducto);
                    $iva_tipos = $this->app_model->get_iva_tipos();
                    if ($producto) {
                        $msg = "Registro agregado";
                        $dato = array("valid" => true, "msg" => $msg, "producto" => $producto, "iva_tipos" => $iva_tipos);
                    } else {
                        $msg = "Producto no encontrado";
                        $dato = array("valid" => false, "msg" => $msg);
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

    public function update_producto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $idGenProducto = $this->input->post('inputIdGenProducto', true);
            $inputNombre = $this->input->post('inputNombre', true);
            $inputCodigo = $this->input->post('inputCodigo', true);
            $selectProveedor = $this->input->post('selectProveedor', true);
            $inputStock = $this->input->post('inputStock', true);
            $inputDescripcion = $this->input->post('inputDescripcion', true);
            $selectEstado = $this->input->post('selectEstado', true);
            $inputPrecioVenta = $this->input->post('inputPrecioVenta', true);
            $selectIvaVenta = $this->input->post('selectIvaVenta', true);
            $inputPrecioCompra = $this->input->post('inputPrecioCompra', true);
            $selectIvaCompra = $this->input->post('selectIvaCompra', true);
            $selectControlStock = $this->input->post('selectControlStock_formProducto', true);
            $productoEcommerce = $this->input->post('selectProductoEcommerce_formDatosProducto', true);
            $porcentajeDescuento = $this->input->post('inputPorcentajeDescuento_formProducto', true);

            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];

            if (
                    ! empty($idGenProducto)
                    AND ! empty($inputNombre)
                    AND ! empty($inputCodigo)
                    AND ! isset($selectProveedor)
                    AND ! empty($inputStock)
                    AND ! empty($inputDescripcion)
                    AND ! empty($inputPrecioVenta)
                    AND ! isset($selectIvaVenta)
                    AND ! empty($inputPrecioCompra)
                    AND ! isset($selectIvaCompra)
            ) {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            } else {
                
                //--- Obtenemos los datos del producto antes de modificarse ---//
                $producto_datos_anterior = $this->app_model->get_productos_byIdGen($idGenProducto);
                
                //--- Guardo Imagen - Producto ---//
                if (!empty($_FILES['file']['name'])) {
                    if (!file_exists('./uploads/productos/' . $idGenProducto)) {
                        mkdir('./uploads/productos/' . $idGenProducto, 0777, true);
                    }

                    if (!file_exists('./uploads/productos/' . $idGenProducto . '/thumbs')) {
                        mkdir('./uploads/productos/' . $idGenProducto . '/thumbs', 0777, true);
                    }

                    $config['upload_path'] = './uploads/productos/' . $idGenProducto . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '0';
                    $config['overwrite'] = TRUE;
                    $nombreImg = substr(md5(microtime()), 15, 17);
                    $config['file_name'] = $nombreImg;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $nombreImg = $data['upload_data']['file_name'];

                        //Creo el thumb
                        $config3['image_library'] = 'gd2';
                        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                        $config3['source_image'] = './uploads/productos/' . $idGenProducto . '/' . $nombreImg;
                        //$config2['create_thumb'] = TRUE;
                        $config3['maintain_ratio'] = TRUE;
                        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
                        $config3['new_image'] = './uploads/productos/' . $idGenProducto . '/thumbs/' . $nombreImg;
                        $config3['width'] = 250;
                        $config3['height'] = 250;

                        $this->load->library('image_lib', $config3);
                        $this->image_lib->initialize($config3);
                        $this->image_lib->resize();
                    }

                    $insert_img_producto = $this->app_model->insert_img_producto($idGenProducto, $nombreImg);
                }

                //--- Actualizo - Producto ---//
                $result_update_producto = $this->app_model->update_producto(
                        $idGenProducto, $idUsuario, $inputNombre, $inputCodigo, $selectProveedor, $inputStock, $inputDescripcion, $selectEstado, $inputPrecioVenta, $selectIvaVenta, $inputPrecioCompra, $selectIvaCompra, $selectControlStock, $productoEcommerce, $porcentajeDescuento
                );

                //--- Guardo - Historico precio ---//
                $historico_precio = $this->app_model->insert_historico_precio($idGenProducto, $inputStock, $porcentajeDescuento);

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idUsuario, $idGenProducto, $tipoAccion = 2, $tipoOperacion = 5, "Se modificó el producto " . $inputNombre, //detalle
                        $total = 0
                );

                //--- Guardo el movimiento del stock ---//
                $hoy = getdate();
                $d = $hoy['mday'];
                (($d < 10) ? $d = "0" . $d : $d);
                $m = $hoy['mon'];
                (($m < 10) ? $m = "0" . $m : $m);
                $y = $hoy['year'];
                $fecha = $d . "-" . $m . "-" . $y;
                if ($producto_datos_anterior[0]['stock'] >= $inputStock) {
                    $diferencia = $producto_datos_anterior[0]['stock'] - $inputStock;
                    $movimiento_stock = $this->app_model->update_movimiento_stock($idGenProducto, $idGenProducto, 1, $diferencia, "Se actualizo el producto", 1, $idUsuario, $fecha);
                } else {
                    $diferencia = $inputStock - $producto_datos_anterior[0]['stock'];
                    $movimiento_stock = $this->app_model->update_movimiento_stock($idGenProducto, $idGenProducto, 1, $diferencia, "Se actualizo el producto", 0, $idUsuario, $fecha);
                }

                if ($result_update_producto && $result_insert_historico) {
                    $producto = $this->app_model->get_productos_byIdGen($idGenProducto);
                    if ($producto) {
                        $msg = "Registro actualizado";
                        $dato = array("valid" => true, "msg" => $msg, "producto" => $producto);
                    }
                } else {
                    $msg = "Error al actualizar registro";
                    $dato = array("valid" => false, "msg" => $msg, "productoEcommerce" => $productoEcommerce);
                }
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_producto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        $idGenProducto = $this->input->post('id', true);
        $msg = "";

        if (!empty($idGenProducto)) {
            //--- Borro Img Producto ---//
            $result_eliminar_img_producto = $this->app_model->eliminar_img_producto($idGenProducto);

            if ($result_eliminar_img_producto) {
                $path_to_folder = './uploads/productos/' . $idGenProducto . '/';
                $this->emptyDir($path_to_folder);
                rmdir($path_to_folder);
            }

            //--- Guardo - Historico ---//
            $result_insert_historico = $this->app_model->set_historico(
                    $idUsuario, $idGenProducto, $tipoAccion = 3, $tipoOperacion = 5, $detalle = 'Se eliminó un producto', //detalle
                    $total = 0
            );

            //--- Borro el historico del producto ---//
            $historico_precio = $this->app_model->drop_historico_precio($idGenProducto);

            //--- Guardo el movimiento del stock ---//
            $hoy = getdate();
            $d = $hoy['mday'];
            (($d < 10) ? $d = "0" . $d : $d);
            $m = $hoy['mon'];
            (($m < 10) ? $m = "0" . $m : $m);
            $y = $hoy['year'];
            $fecha = $d . "-" . $m . "-" . $y;
            $movimiento_stock = $this->app_model->insert_movimiento_stock($idGenProducto, $idGenProducto, 1, 0, "Se elimino el producto", 0, $idUsuario, $fecha);

            //--- Borro Producto ---//
            $result_eliminar_producto = $this->app_model->eliminar_producto($idGenProducto);

            if ($result_eliminar_producto && $result_insert_historico) {
                $msg = "Registro eliminado";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al eliminar registro";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_producto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $idProducto = $this->input->post('idProducto', true);

        if (!empty($idProducto)) {
            $producto = $this->app_model->get_producto($idProducto);
            $iva_tipos = $this->app_model->get_iva_tipos();
            $empresa = $this->app_model->get_empresas();

            if ($producto) {
                $msg = "Ok";
                $dato = array("valid" => true, "msg" => $msg, "producto" => $producto, "iva_tipos" => $iva_tipos, "empresa" => $empresa, "ivaDefecto" => $producto[0]['idIvaVta']);
            } else {
                $msg = "No se encontro ningun producto con ese id";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "idProducto vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_productos() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";

        $productos = $this->app_model->get_productos();
        if ($productos) {
            $fecha = getdate();
            if ($fecha['mon'] < 10) {
                $mes = "0" . $fecha['mon'];
            } else {
                $mes = $fecha['mon'];
            }
            if ($fecha['mday'] < 10) {
                $dia = "0" . $fecha['mday'];
            } else {
                $dia = $fecha['mday'];
            }

            $hoy = $fecha['year'] . "-" . $mes . "-" . $dia ;
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "productos" => $productos, "hoy" => $hoy);
        } else {
            $msg = "No se encontro ningun producto";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_idGenProducto() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        $idGenProducto = substr(md5(microtime()), 15, 17);
        $iva_tipos = $this->app_model->get_iva_tipos();

        if ($iva_tipos) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "idGenProducto" => $idGenProducto);
        } else {
            $msg = "No se encontraron registros iva tipos";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function control_stock() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $msg = "";
        //--- Toma de datos por el post ---//
        $fecha = $this->input->post('fecha', true);
        $cantidad = $this->input->post('cantidad', true);
        $idGenProducto = $this->input->post('productos', true);
        $descripcion = $this->input->post('descripcion', true);
        $aumentar_disminuir = $this->input->post('aumentar_disminuir', true);
        //--- Producto ---//
        $producto = $this->app_model->get_producto_byIdGen($idGenProducto);

        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];

        if ($producto) {
            //--- validar si es aumentar(1) o disminuir(2) ---//
            if ($aumentar_disminuir == 1) {
                $movimiento_aumentado = $this->app_model->insert_movimiento_stock($idGenProducto, $idGenProducto, 1, $cantidad, "Se añadio un aumento de stock", 0, $idUsuario, $fecha);

                if ($movimiento_aumentado) {
                    $cantidad_stock = $producto[0]['stock'] + $cantidad;
                    $actualizacion_stock = $this->app_model->update_stock_by_idProducto($producto[0]['idProducto'], $cantidad_stock);
                    if ($actualizacion_stock) {
                        $producto = $this->app_model->get_producto_byIdGen($idGenProducto);
                        $msg = "Ok";
                        $dato = array("valid" => true, "msg" => $msg, "producto" => $producto, "idUsuario" => $idUsuario);
                    } else {
                        $msg = "Error al actualizar el stock del producto";
                        $dato = array("valid" => true, "msg" => $msg);
                    }
                } else {
                    $msg = "Se produjo un error al actualizar el stock, vuelva a intentarlo.";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } elseif ($aumentar_disminuir == 2) {
                $movimiento_disminuido = $this->app_model->insert_movimiento_stock($idGenProducto, $idGenProducto, 1, $cantidad, "Se añadio una disminucion de stock", 1, $idUsuario, $fecha);

                if ($movimiento_disminuido) {
                    $cantidad_stock = $producto[0]['stock'] - $cantidad;
                    $actualizacion_stock = $this->app_model->update_stock_by_idProducto($producto[0]['idProducto'], $cantidad_stock);
                    if ($actualizacion_stock) {
                        $producto = $this->app_model->get_producto_byIdGen($idGenProducto);
                        $msg = "Ok";
                        $dato = array("valid" => true, "msg" => $msg, "producto" => $producto, "idUsuario" => $idUsuario);
                    } else {
                        $msg = "Error al actualizar el stock del producto";
                        $dato = array("valid" => true, "msg" => $msg);
                    }
                } else {
                    $msg = "Se produjo un error al actualizar el stock, vuelva a intentarlo.";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            }
        } else {
            $msg = "Se produjo un error al obtener los datos del producto, vuelva a intentarlo.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
