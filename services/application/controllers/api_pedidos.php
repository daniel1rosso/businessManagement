<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Cache-Control, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

class Api_Pedidos extends MY_Controller {

    protected $data = array(
        'active' => 'pedidos'
    );
    private $valueCompara4;
    private $valueCompara;

    public function abrir_pedido() {
        if ($_POST) {
            $idMesa = $this->input->post('idMesa', true);
            $idMozo = $this->input->post('idMozo', true);
            $idTab = $this->input->post('idTab', true);

            if (!empty($idTab)) {
                if (!empty($idMesa)) {
                    $mesa = $this->app_model_bar->get_mesa_byId($idMesa);
                    if ($mesa) {
                        if ($mesa[0]['idPedido'] != "0") {
                            $idGenPedido = $mesa[0]['idPedido'];

                            $info_mesa = $this->app_model_bar->status_pedido($idGenPedido);
                            if ($info_mesa) {
                                $msg = "Obteniendo datos";
                                $dato = array("valid" => true, "msg" => $msg, "mesa" => $info_mesa, "nuevo" => false);
                            } else {
                                $msg = "Error al verificar el pedido";
                                $dato = array("valid" => false, "msg" => $msg);
                            }
                        } else {
                            if (!empty($idMozo)) {
                                $idGenPedido = $this->generarID();
                                $result_update_mesa = $this->app_model_bar->update_mesa_pedido($idMesa, $idGenPedido);
                                if ($result_update_mesa) {
                                    $result_nuevo_pedido = $this->app_model_bar->insert_nuevo_pedido($idMesa, $idGenPedido, $idMozo, $idTab);
                                    $info_mesa = $this->app_model_bar->status_pedido($idGenPedido);
                                    if ($result_nuevo_pedido) {
                                        $msg = "Abriendo mesa";
                                        $dato = array("valid" => true, "msg" => $msg, "mesa" => $info_mesa, "nuevo" => true, "idGenPedido" => $idGenPedido);
                                    } else {
                                        $msg = "Error al abrir mesa";
                                        $dato = array("valid" => false, "msg" => $msg);
                                    }
                                } else {
                                    $msg = "Error al abrir mesa";
                                    $dato = array("valid" => false, "msg" => $msg);
                                }
                            } else {
                                $msg = "Error al obtener los datos del mozo";
                                $dato = array("valid" => false, "msg" => $msg);
                            }
                        }
                    } else {
                        $msg = "Error al obtener la mesa";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $idGenPedido = $this->generarID();
                    //Si la mesa esta vacia significa que viene de mostrador o de delivery
                    $result_nuevo_pedido = $this->app_model_bar->insert_nuevo_pedido(0, $idGenPedido, $idMozo, $idTab);
                    $msg = "Pedido generado";
                    $dato = array("valid" => true, "msg" => $msg, "idGenPedido" => $idGenPedido);
                }
            } else {
                $msg = "Falta especificar el tab";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_pedido() {
        error_reporting(0);

        if ($_POST) {
            $idGenPedido = $this->input->post('idGenPedido', true);

            if (!empty($idGenPedido)) {
                $tabPedido = $this->app_model_bar->get_pedido_tab_by_idGenPedido($idGenPedido);
                $result = $this->app_model_bar->get_productos_pedido_by_group($idGenPedido);
                $result2 = $this->app_model_bar->get_sub_productos_pedido_by_group($idGenPedido);
                $pedido = $this->app_model_bar->get_pedidosByIdPedido($idGenPedido);

                //-- Enviamos las categorias y productos en esta instancia para evitar la doble peticion de datos en otro metodo particular --//
                $categorias = $this->app_model->get_categorias_productos();
                $productos = $this->get_producto_search();
                $prod_top1 = $this->app_model_bar->get_productos_destacados();
                $prod_top2 = $this->app_model_bar->get_sub_productos_destacados();
                $mesa = $this->app_model_bar->get_mesa_byIdGenPedido($idGenPedido);

                if ($tabPedido) {
                    $venta = $this->app_model_bar->get_venta_check_by_idGenPedido($idGenPedido);
                    if (!$mesa) {
                        $mesa = $tabPedido[0];
                    } else {
                        $mesa = array_merge($mesa[0], $tabPedido[0]);
                    }

                    //--- UNO ARRAY DETALLE PEDIDO Y DETALLE PEDIDO SUB ---//
                    if ($result && $result2) {
                        $detallePedido = array_merge($result, $result2);
                    } else if ($result) {
                        $detallePedido = $result;
                    } else if ($result2) {
                        $detallePedido = $result2;
                    } else {
                        $detallePedido = false;
                    }

                    if ($detallePedido) {
                        $detallePedidoFinal = array();
                        foreach ($detallePedido as $key => $value) {
                            if ($value['cantidad'] > 0) {
                                array_push($detallePedidoFinal, $value);
                            }
                        }
                    }

                    //--- UNO ARRAY PRODUCTOS Y PRODUCTOS SUB DESTACADOS ---//
                    if ($prod_top1 && $prod_top2) {
                        $productos_destacados = array_merge($prod_top2, $prod_top1);
                    } else if ($prod_top1) {
                        $productos_destacados = $prod_top1;
                    } else if ($prod_top2) {
                        $productos_destacados = $prod_top2;
                    } else {
                        $productos_destacados = false;
                    }
                    if ($productos_destacados) {
//                        aksort(array_column($productos_destacados, 'cantidad'),true);
                        usort($productos_destacados, function($a, $b) {
                            return $a['cantidad'] < $b['cantidad'];
                        });
                    }

                    if ($detallePedido) {
                        $msg = "Datos cargados";
                        $dato = array("valid" => true, "msg" => $msg,
                            "mesa" => $mesa,
                            "categorias" => $categorias,
                            "productos" => $productos,
                            "productos_destacados" => $productos_destacados,
                            "datos" => $detallePedidoFinal,
                            "idEstadoPedido" => $pedido[0]['idEstadoPedido'],
                            "venta" => $venta
                        );
                    } else {
                        $msg = "El pedido aún no tiene productos cargados";
                        $dato = array("valid" => true,
                            "msg" => $msg,
                            "mesa" => $mesa,
                            "categorias" => $categorias,
                            "productos" => $productos,
                            "productos_destacados" => $productos_destacados,
                            "datos" => false,
                            "idEstadoPedido" => $pedido[0]['idEstadoPedido'],
                            "venta" => $venta
                        );
                    }
                } else {
                    $msg = "El Pedido no existe";
                    $dato = array("valid" => false, "msg" => $msg,
                    );
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg, "mesa" => false, "categorias" => false, "productos" => false, "productos_destacados" => false, "datos" => false);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg, "mesa" => false, "categorias" => false, "productos" => false, "productos_destacados" => false, "datos" => false);
        }

        echo json_encode($dato);
    }

    public function update_data_delivery() {
        //--- Guardo ---//
        if ($_POST) {
            $idGenPedido = $this->input->post('idGenPedido', true);
            $nombreCli = $this->input->post('nombreCli', true);
            $direccionCli = $this->input->post('direccionCli', true);
            $telefonoCli = $this->input->post('telefonoCli', true);
            $observacionCli = $this->input->post('observacionCli', true);
            $fechaHora = $this->input->post('fechaHora', true);

            if (!empty($idGenPedido)) {


                $values = array(
                    'nombre' => $nombreCli,
                    'direccion' => $direccionCli,
                    'telefono' => $telefonoCli,
                    'observacion' => $observacionCli,
                    'horarioEntrega' => $fechaHora
                );
                $result = $this->app_model_bar->update_datos_delivery($idGenPedido, $values);



                $msg = "Datos actualizados";
                $dato = array("valid" => true, "msg" => $msg);
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

    private function get_pedido_order($idGenPedido) {

        $pedido = $this->app_model_bar->get_pedidos_by_estados_y_tab_group_nroTicket_idGenPedido($idGenPedido);
        $result = $pedido[0];
        //--- Obtengo - Detalle de Pedido ---//
        $items_pedido = $this->app_model_bar->get_productos_pedido_by_numero_pedido($idGenPedido);
        $sub_items_pedido = $this->app_model_bar->get_sub_productos_pedido_by_numero_pedido($idGenPedido);
        //--- UNO ARRAY ITEMS PEDIDOS Y ITEMS SUB PEDIDO ---//
        if ($items_pedido && $sub_items_pedido) {
            $result_detalle = array_merge($items_pedido, $sub_items_pedido);
        } else if ($items_pedido) {
            $result_detalle = $items_pedido;
        } else if ($sub_items_pedido) {
            $result_detalle = $sub_items_pedido;
        }

        $result["detalle_pedido"] = $result_detalle;
        $total = 0;
        foreach ($result_detalle as $key2 => $value) {
            $total = $total + (floatval($value["precio"]) * floatval($value["cantidad"]));
        }
        $result["totalVenta"] = $total;
        return $result;
    }

    public function set_pedido_new() {
        //--- Guardo ---//
        if ($_POST) {
            $idGenPedido = $this->input->post('idGenPedido', true);
            $datosPedido = $this->input->post('datosPedido', true);
            $datosDelivery = $this->input->post('datosDelivery', true);

            if (!empty($idGenPedido) && !empty($datosPedido)) {

                $detalle_pedido = $this->app_model_bar->get_pedido_detalle_by_idGenPedido($idGenPedido);
                //Si viene con datos del Delivery u horario de entrega actualizo pedido
                if (!empty($datosDelivery)) {
                    $values = array(
//                        'idCadete' => $datosDelivery['idCadete'],
                        'nombre' => $datosDelivery[0]['customerName'],
                        'direccion' => $datosDelivery[0]['adress'],
                        'telefono' => $datosDelivery[0]['telephone'],
                        'observacion' => $datosDelivery[0]['observation'],
                        'horarioEntrega' => $datosDelivery[0]['deliveryTime']
                    );
                    $result = $this->app_model_bar->asignar_datos_delivery_by_idGenPedido($idGenPedido, $values);
                }

                //Obtengo el ultimo nro de pedido
                $nroPedido = $this->app_model_bar->get_last_nroPedido();
                if ($nroPedido) {
                    if ($nroPedido[0]['reset'] == 1) {
                        $nroPedido = 1;
                    } else {
                        $nroPedido = $nroPedido[0]['nroPedido'] + 1;
                    }
                } else {
                    $nroPedido = 1;
                }


                $numeroTicket = $this->generarID();
                //Verifico que tenga detalle el pedido. Osea que se la primera vez o no que se carga.
                if ($detalle_pedido) {
                    //Primero hago el foreach para controlar los productos ya existentees en el pedido o los nuevos
                    foreach ($datosPedido as $key => $value) {
                        $this->valueCompara = $value['idGenProducto'];
                        //Chequeo que existe ese producto dentro del pedido para saber si hacer un update o insert. Si existe me devuelve la key sino False
                        $existeKey = array_search($value['idGenProducto'], array_column($detalle_pedido, 'idGenProducto'));
                        //Si existe el producto lo debo actualizar
                        if ($existeKey >= 0) {
                            //Traigo cantidad que hay de un producto en todo el pedido
                            $cantidadEnPedido = $this->app_model_bar->get_cantidad_producto_en_pedido($idGenPedido, $this->valueCompara);

                            //Si la cantidad que tengo en el pedido en la BD es igual al que ingreso por angular, lo dejo igual
                            if ($cantidadEnPedido[0]['cantidad'] == $value['cantidad']) {

                                //Si la cantidad que tengo en el pedido en la BD es menor al de que ingreso por angular, debo insertarlo con el nuevo nroTicket
                            } else if ($cantidadEnPedido[0]['cantidad'] < $value['cantidad']) {
                                $cantidad = $value['cantidad'] - $cantidadEnPedido[0]['cantidad'];
                                $subTotal = $cantidad * $value['precio'];
                                $valores = array(
                                    'idPedido' => $idGenPedido,
                                    'nroPedido' => $nroPedido,
                                    'idGenProducto' => $value['idGenProducto'],
                                    'numeroTicket' => $numeroTicket,
                                    'cantidad' => $cantidad,
                                    'precio' => $value['precio'],
                                    'subTotal' => $subTotal,
                                    'idTipoProducto' => $value['idTipoProducto'],
                                    'comentario' => $value['comment'],
                                    'idEstadoDetalle' => 1
                                );
                                $result = $this->app_model_bar->insert_pedido_detalle($valores);
                                //Si la cantidad que tengo en el pedido en la BD es mayor al de que ingreso por angular, debo eliminar de la BD los productos demas,
                                // poniendole por cada ticket la maxima cantidad que admita ese ticket siempre y cuando mi diferencia(entre bd y pedido) se mayor a la que hay en un ticket
                                // por ejemplo: tengo 2 tickets con dos pizzas en cada uno y quiero restar 3 debo insertar un registro de resta para el ticket 1 de dos pisas
                                // y 1 registro de 1 pizza para el ticket todo
                            } else if ($cantidadEnPedido[0]['cantidad'] > $value['cantidad']) {
                                //calculo diferencia entre bd y lo que me llega de angular para saber cuanto eliminar
                                $diferencia = $cantidadEnPedido[0]['cantidad'] - $value['cantidad'];

                                //Genero el array  completo con el producto a eliminar para saber cuanto insertar en la bd para la eliminacion (contrarestracion)
                                $arrayConProd = array_filter($detalle_pedido, function ($value2) {
                                    return $value2['idGenProducto'] == $this->valueCompara;
                                });
                                //Doy vuelta el arreglo para obtener los ultimos tickets y productos pedidos
                                $arrayConProd = array_reverse($arrayConProd);
                                foreach ($arrayConProd as $key => $value3) {
                                    //Si la cantidad que tengo en la bd es mayor a la diferencia directamente contraresto a ese ticket y corto el foreach
                                    if ($value3['cantidad'] > $diferencia) {
                                        $valores = array(
                                            'idPedido' => $idGenPedido,
                                            'nroPedido' => $nroPedido,
                                            'idGenProducto' => $value3['idGenProducto'],
                                            'numeroTicket' => $value3['numeroTicket'],
                                            'cantidad' => $diferencia * (-1),
                                            'precio' => $value3['precio'],
                                            'subTotal' => $value3['precio'] * ($diferencia * (-1)),
                                            'idTipoProducto' => $value3['idTipoProducto'],
                                            'comentario' => $value['comment'],
                                            'idEstadoDetalle' => 1
                                        );
                                        $result = $this->app_model_bar->insert_pedido_detalle($valores);
                                        break;
                                        //Si la cantidad que tengo en la bd es menor a la diferencia,  contraresto el maximo de ese ticket y le hago un continue al foreach
                                    } else if ($value3['cantidad'] < $diferencia) {
                                        $valores = array(
                                            'idPedido' => $idGenPedido,
                                            'nroPedido' => $nroPedido,
                                            'idGenProducto' => $value3['idGenProducto'],
                                            'numeroTicket' => $value3['numeroTicket'],
                                            'cantidad' => $value3['cantidad'] * (-1),
                                            'precio' => $value3['precio'],
                                            'subTotal' => $value3['precio'] * ($value['cantidad'] * (-1)),
                                            'idTipoProducto' => $value3['idTipoProducto'],
                                            'comentario' => $value['comment'],
                                            'idEstadoDetalle' => 1
                                        );
                                        $result = $this->app_model_bar->insert_pedido_detalle($valores);
                                        $diferencia = $diferencia - $value3['cantidad'];
                                        continue;
                                        //Si la cantidad que tengo en la bd es igual a la diferencia,  contraresto el maximo de ese ticket y le hago un break al foreach
                                    } else {
                                        $valores = array(
                                            'idPedido' => $idGenPedido,
                                            'nroPedido' => $nroPedido,
                                            'idGenProducto' => $value3['idGenProducto'],
                                            'numeroTicket' => $value3['numeroTicket'],
                                            'cantidad' => $diferencia * (-1),
                                            'precio' => $value3['precio'],
                                            'subTotal' => $value3['precio'] * ($diferencia * (-1)),
                                            'idTipoProducto' => $value3['idTipoProducto'],
                                            'comentario' => $value['comment'],
                                            'idEstadoDetalle' => 1
                                        );
                                        $result = $this->app_model_bar->insert_pedido_detalle($valores);
                                        break;
                                    }
                                }
                            }


//                            $values = array(
//                                'cantidad' => $value['cantidad']
//                            );
//                            $this->app_model_bar->update_detalle_pedido2($value['idGenProducto'],$idGenPedido,$values);
                        } else {
                            //Sino existe el producto en el detalle de la bd, lo debo agregar
                            $valores = array(
                                'idPedido' => $idGenPedido,
                                'nroPedido' => $nroPedido,
                                'idGenProducto' => $value['idGenProducto'],
                                'numeroTicket' => $numeroTicket,
                                'cantidad' => $value['cantidad'],
                                'precio' => $value['precio'],
                                'subTotal' => $value['precio'] * $value['cantidad'],
                                'idTipoProducto' => $value['idTipoProducto'],
                                'comentario' => $value['comment'],
                                'idEstadoDetalle' => 1
                            );
                            $result = $this->app_model_bar->insert_pedido_detalle($valores);
                        }
                    }
                    //Segundo chequeo si hay algun producto ya cargado que se haya eliminado completamente
                    foreach ($detalle_pedido as $key => $value4) {
                        $this->valueCompara4 = $value4['idGenProducto'];
                        //Chequeo que existe ese producto dentro del pedido para saber si hacer un update o insert. Si existe me devuelve la key sino False
//                        $existeKey = array_search($value4['idGenProducto'], array_column($datosPedido, 'idGenProducto'));   
                        $existeKey = in_array($value4['idGenProducto'], array_column($datosPedido, 'idGenProducto'));
                        //Sino existe la key elimino todo el producto del pedido contrarestando los valores por cantidad por nroTicket
//                        print_r($existeKey."<br/>");
                        if (!$existeKey) {
                            //Genero el array  completo con el producto a eliminar para saber cuanto insertar en la bd para la eliminacion (contrarestracion)
                            $cantidadesAEliminar = $this->app_model_bar->get_cantidad_producto_ticket_a_eliminar($idGenPedido, $value4['idGenProducto']);
//                            $arrayConProd = array_filter($detalle_pedido, function ($value2){
//                              return $value2['idGenProducto']  == $this->valueCompara;
//                            });
                            foreach ($cantidadesAEliminar as $key => $value5) {
                                if ($value5['cantidad'] > 0) {
                                    $valores = array(
                                        'idPedido' => $idGenPedido,
                                        'nroPedido' => $nroPedido,
                                        'idGenProducto' => $value5['idGenProducto'],
                                        'numeroTicket' => $value5['numeroTicket'],
                                        'cantidad' => $value5['cantidad'] * (-1),
                                        'precio' => $value5['precio'],
                                        'subTotal' => $value5['precio'] * ($value5['cantidad'] * (-1)),
                                        'idTipoProducto' => $value5['idTipoProducto'],
                                        'idEstadoDetalle' => 1
                                    );
                                    $result = $this->app_model_bar->insert_pedido_detalle($valores);
                                }
                            }
                        }
                    }
                    $msg = "Pedido actualizado correctamente";
                    $dato = array("valid" => true, "msg" => $msg, "Post" => $_POST);
                } else {
                    //Si no se cargo nunca el pedido, cargamos todo por primera vez
                    $values = [];
                    foreach ($datosPedido as $key => $value) {
                        $valores = array(
                            'idPedido' => $idGenPedido,
                            'nroPedido' => $nroPedido,
                            'idGenProducto' => $value['idGenProducto'],
                            'numeroTicket' => $numeroTicket,
                            'cantidad' => $value['cantidad'],
                            'precio' => $value['precio'],
                            'subTotal' => $value['cantidad'] * $value['precio'],
                            'idTipoProducto' => $value['idTipoProducto'],
                            'comentario' => $value['comment'],
                            'idEstadoDetalle' => 1
                        );
//                        array_push($values,$valores);                        
                        $result = $this->app_model_bar->insert_pedido_detalle($valores);
                    }
                    $resultOrder = $this->get_pedido_order($idGenPedido);

                    $msg = "Pedido generado correctamente";
                    $dato = array("valid" => true, "msg" => $msg, "order" => $resultOrder);
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }
//        $msg = "OK";
//        $dato = array("valid" => false, "msg" => $msg,"POST"=>$_POST);

        echo json_encode($dato);
    }

    public function set_venta_pedido_new() {
        $this->load->library('afip', array('CUIT' => 20352778754, 'production' => FALSE)); //Reemplazar el CUIT
        //--- idGenIngreso ---//
        $idGenIngreso = $this->generarID();

        //--- Guardo ---//
        if ($_POST) {
            $idGenPedido = $this->input->post('idGenPedido', true);
            $idCliente = $this->input->post('idCliente', true);
            $tipoFac = $this->input->post('tipoFac', true);
            $idMozo = $this->input->post('idMozo', true);
            $idTab = $this->input->post('idTab', true); // 1 Mesas - 2 Mostrador - 3 Delivery - 4 Cocina
            $idEstado = $this->input->post('idEstado', true); //$idEstado = 1; // 1: Cobrado -- 2: A cobrar -- 3: Vencido

            if (!empty($idGenPedido) && !empty($idCliente) && !empty($tipoFac) && !empty($idMozo) && !empty($idEstado)) {
                $pedido = $this->app_model_bar->get_pedidosByIdPedido($idGenPedido);

                //Si el pedido esta abierto procedo con el resto
                if ($pedido[0]['idEstadoPedido'] != 8 && $pedido[0]['idEstadoPedido'] != 6) {
                    $detalle_pedido = $this->app_model_bar->get_pedido_detalle_by_idGenPedido($idGenPedido);
                    $setVenta = $this->app_model_bar->check_seteada_venta($idGenPedido);
//                    print_r($setVenta);
                    //Chequeo que ya nose haya seteado la venta para ese pedido en otra ocasion
                    if ($detalle_pedido) {
                        if (!$setVenta) {

                            $productos_pedido = $this->app_model_bar->get_productos_pedido_detalle($idGenPedido);
                            $sub_productos_pedido = $this->app_model_bar->get_sub_productos_pedido_detalle($idGenPedido);

                            //--- UNO ARRAY PRODUCTOS Y SUB PRODUCTOS ---//
                            if ($productos_pedido && $sub_productos_pedido) {
                                $result = array_merge($productos_pedido, $sub_productos_pedido);
                            } else if ($productos_pedido) {
                                $result = $productos_pedido;
                            } else if ($sub_productos_pedido) {
                                $result = $sub_productos_pedido;
                            }

                            $importeGravadoTotal = 0;
                            $importeGravado21 = 0;
                            $importeGravado105 = 0;
                            $importeGravado5 = 0;
                            $importeGravado25 = 0;
                            $importeGravado27 = 0;
                            $importeGravado0 = 0;
                            $importeIva = 0;
                            $importeNetoExento = 0;
                            $importeNetoNoGravado = 0;
                            $iva21 = 0;
                            $iva105 = 0;
                            $iva5 = 0;
                            $iva25 = 0;
                            $iva27 = 0;
                            $iva0 = 0;
                            $total = 0;
                            $sumaImp21 = 0;
                            $sumaImp105 = 0;
                            $sumaImp5 = 0;
                            $sumaImp25 = 0;
                            $sumaImp27 = 0;
                            $sumaImp0 = 0;

                            $productos = array();
                            //**///////////////////////////////////////////////////////////////////////////////////////////////////
                            //LOS IMPORTES DE IVA SON CALCULADOS A PARTIR DEL PRECIO FINAL, NO SE LE SUMA EL IVA ARRIBA DEL PRECIO/
                            //**///////////////////////////////////////////////////////////////////////////////////////////////////
                            foreach ($result as $key => $value) {
                                if ($value['cantidad'] > 0) {

                                    ////////////////////////////
                                    //Subtotal de cada producto/
                                    ////////////////////////////
                                    $subTotal = $value['precio'] * $value['cantidad'];
                                    ////////////////////////////////
                                    //Sumatoria total de las ventas/
                                    ////////////////////////////////
                                    $total += $subTotal; //Total con Iva

                                    if ($value['descripcion'] == "21") {
                                        $sumaImp21 += $subTotal;
                                    } else if ($value['descripcion'] == "10,5") {
                                        $sumaImp105 += $subTotal;
                                    } else if ($value['descripcion'] == "5") {
                                        $sumaImp5 += $subTotal;
                                    } else if ($value['descripcion'] == "2,5") {
                                        $sumaImp25 += $subTotal;
                                    } else if ($value['descripcion'] == "27") {
                                        $sumaImp27 += $subTotal;
                                    } else if ($value['descripcion'] == "0") {
                                        //ver si esto esta bien
                                        $importeGravadoTotal += $subTotal;
                                        $importeGravado0 += $subTotal;
                                        $iva0 = 0;
                                        $importeIva += 0;
                                    } else if ($value['descripcion'] == 'Exento') {
                                        $importeNetoExento += $subTotal;
                                    } else if ($value['descripcion'] == 'No Gravado') {
                                        $importeNetoNoGravado += $subTotal;
                                    }
                                    //**
                                    //VER COMO AGRUPAR LOS MISMOS PRODUYCTOS PARA QUE SALGAN EN EL TICKET
                                    //**//
                                    $array_push = array($value['nombre'], $value['precio'], $value['cantidad'], $value['descripcion'], $value['idGenProducto']);
                                    array_push($productos, $array_push);

                                    //--- Descontar Stock ---//
                                    $cantidadActualizada = $value['stock'] - $value['cantidad'];
                                    $descontarStock = $this->app_model->update_stock_by_idProducto($value['idProducto'], $cantidadActualizada);
                                    /////////////////////////////////////////////////////////////////////////////
                                    //Ingreso el detalle del ingreso antes del ingreso para no repetir el foreach
                                    /////////////////////////////////////////////////////////////////////////////
                                    //                    $idGenIngreso, $idProducto, $cantidad, $precio, $descuento, $subtotalProd, $iva,$ivaText,$idTipoProducto
                                    $result_insert_ingreso_detalle = $this->app_model->insert_ingreso_detalle(
                                            $idGenIngreso, $value['idProducto'], $value['cantidad'], $value['precio'], $descuento = 0, $subtotalProd = $value['precio'], $value['valorIva'], $value['descripcion'], $value['idTipoProducto']
                                    );
                                }
                            }

                            //--- Fecha Emision ---//
                            $fechaEmision = date("Y-m-d");
                            //--- Fecha Vto. del Cobro ---//
                            $fechaCobro = date("Y-m-d");

                            //                $idEstado = 1; // 1: Cobrado -- 2: A cobrar -- 3: Vencido
                            if ($idEstado == 1) {
                                $aCobrar = 0;
                                $saldado = 1;
                            } else if ($idEstado == 2) {
                                $aCobrar = $total;
                                $saldado = 0;
                            }
                            //--- Insert Ingreso ---//
                            $result_insert_ingreso = $this->app_model->insert_ingreso(
                                    $idGenIngreso, $idGenAbono = "", $tipoIngreso = 2, $idMozo, $idCliente, $fechaEmision, //fechaEmision
                                    $fechaCobro, //fechaCobro
                                    $tipoFac, //selectTipoFac
                                    //$selectCatVenta = 0, 
                                    $notaCliente = "", $notaInterna = "", $importeNetoNoGravado, //$importeNoGravado
                                    $total, //Total venta 
                                    $descuentoTotal = 0, $importeIva, $aCobrar, $saldado, $idEstado, $idGenPedido
                            );
                            /////////////////////////////////////////
                            //INGRESOS Y EGRESOS DE LAS CAJAS///////
                            /////////////////////////////////////////                
                            $result4 = $this->app_model->insert_ingreso_egreso_caja(
                                    $idCaja = 1, $idGenIngreso, $ingreso = $total, $egreso = 0, $descripcionMovimiento = "Venta bar", $idGenMovimiento = 0, $idTipo = 1 //indica venta
                            );
                            /////////////////////////////////////////
                            //CUENTA CORRIENTE DE LOS CLIENTES//////
                            /////////////////////////////////////////                  
                            $fechaCobroCuentaCorriente = date("Y-m-d H:i:s");
                            $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                                    $idGenIngreso, $idGenComprobante = 0, $idCliente, //selectCliente
                                    $fechaCobroCuentaCorriente, //fechaCobro
                                    $debito = $total, //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                                    $credito = $total, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                                    $idMedioCobro = 0, //Medio de cobro
                                    $saldo = $aCobrar, //Saldo
                                    $descripcionCobro = "Primer ingreso"
                            );
                            /////////////////////////////////////////
                            //HISTORICOS/////////////////////////////
                            /////////////////////////////////////////  
                            $result_insert_historico = $this->app_model->set_historico(
                                    $idMozo, $idGenIngreso, $tipoAccion = 1, $tipoOperacion = 2, $idCliente, //detalle
                                    $total //total
                            );
                            /////////////////////////////////////////
                            //Armo array para el iva de las facturas/
                            /////////////////////////////////////////              
                            $arraysIVA = array();
                            if ($sumaImp21 != 0) {
                                $importeGravadoTotal += round(floatval(bcdiv(($sumaImp21 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $importeGravado21 += round(floatval(bcdiv(($sumaImp21 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $ivaCalc21 = $sumaImp21 - round(floatval(bcdiv(($sumaImp21 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $iva21 += $ivaCalc21;
                                $importeIva += $ivaCalc21;
                                $arrayIva21 = array(
                                    'Id' => 5, // Id del tipo de IVA (5 = 21%)
                                    'BaseImp' => $importeGravado21,
                                    'Importe' => $iva21
                                );
                                array_push($arraysIVA, $arrayIva21);
                            }
                            if ($sumaImp105 != 0) {
                                $importeGravadoTotal += round(floatval(bcdiv(($sumaImp105 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $importeGravado105 += round(floatval(bcdiv(($sumaImp105 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $iva1Cal05 = $sumaImp105 - round(floatval(bcdiv(($sumaImp105 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $iva105 += $iva1Cal05;
                                $importeIva += $iva1Cal05;
                                $arrayIva105 = array(
                                    'Id' => 4, // Id del tipo de IVA (4 = 10.5%)
                                    'BaseImp' => $importeGravado105,
                                    'Importe' => $iva105
                                );
                                array_push($arraysIVA, $arrayIva105);
                            }
                            if ($sumaImp5 != 0) {
                                $importeGravadoTotal += round(floatval(bcdiv(($sumaImp5 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $importeGravado5 += round(floatval(bcdiv(($sumaImp5 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $ivaCalc5 = $sumaImp5 - round(floatval(bcdiv(($sumaImp5 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $iva5 += $ivaCalc5;
                                $importeIva += $ivaCalc5;
                                $arrayIva5 = array(
                                    'Id' => 8, // Id del tipo de IVA (8 = 5%)
                                    'BaseImp' => $importeGravado5,
                                    'Importe' => $iva5
                                );
                                array_push($arraysIVA, $arrayIva5);
                            }
                            if ($sumaImp25 != 0) {
                                $importeGravadoTotal += round(floatval(bcdiv(($sumaImp25 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $importeGravado25 += round(floatval(bcdiv(($sumaImp25 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $ivaCalc25 = $sumaImp25 - round(floatval(bcdiv(($sumaImp25 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $iva25 += $ivaCalc25;
                                $importeIva += $ivaCalc25;
                                $arrayIva25 = array(
                                    'Id' => 9, // Id del tipo de IVA (9 = 2.5%)
                                    'BaseImp' => $importeGravado25,
                                    'Importe' => $iva25
                                );
                                array_push($arraysIVA, $arrayIva25);
                            }
                            if ($sumaImp27 != 0) {
                                $importeGravadoTotal += round(floatval(bcdiv(($sumaImp27 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $importeGravado27 += round(floatval(bcdiv(($sumaImp27 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $ivaCalc27 = $sumaImp27 - round(floatval(bcdiv(($sumaImp27 / 1.21), '1', 2)), 2, PHP_ROUND_HALF_UP);
                                $iva27 += $ivaCalc27;
                                $importeIva += $ivaCalc27;
                                $arrayIva27 = array(
                                    'Id' => 6, // Id del tipo de IVA (6 = 27%)
                                    'BaseImp' => $importeGravado27,
                                    'Importe' => $iva27
                                );
                                array_push($arraysIVA, $arrayIva27);
                            }
                            if ($importeGravado0 != 0) {
                                $arrayIva0 = array(
                                    'Id' => 3, // Id del tipo de IVA (3 = 0%)
                                    'BaseImp' => $importeGravado0,
                                    'Importe' => $iva0
                                );
                                array_push($arraysIVA, $arrayIva0);
                            }


                            if ($result_insert_ingreso && $result4) {
                                //'idEstadoPedido' => 1, //5: Abierto -- 8 Cerrado
                                $result_pedido2 = $this->app_model_bar->cerrar_mesa_pedido_transaccion($idGenPedido, $pedido[0]['idMesa'], $idTab, $idEstado);


                                $tickets_pedido = $this->app_model_bar->get_productos_pedido_by_numero_pedido($idGenPedido);

                                $datosEmp = parent::getDatosEmpresa();
                                if ($tipoFac == 2 || $tipoFac == 1 || $tipoFac == 3) {
                                    $idCliente = $this->app_model->get_cliente_facturacion_byIdCliente($idCliente);

                                    if ($idCliente) {
                                        $tipoFactura = 6;
                                        // Si es factura B
                                        if ($tipoFac == 2) {

                                            //Si sos consumidor final
                                            if ($idCliente[0]['idCondIva'] == 1) {
                                                //Si no tenes asignado ningun tipo de doc, Usuario Consumidor FInal Generico
                                                if ($idCliente[0]['idTipoDoc'] == 0) {
                                                    $tipoDoc = 99;
                                                    $creo_factura = true;
                                                    $nroDocValido = true;

                                                    //Si tenes DNI
                                                } else if ($idCliente[0]['idTipoDoc'] == 8) {
                                                    $tipoDoc = 96;
                                                    $creo_factura = true;
                                                    //El campo se llama cuit pero hace referencia a cualquier nro de doc
                                                    if ($idCliente[0]['cuit'] == 0) {
                                                        $nroDocValido = false;
                                                    } else {
                                                        $nroDocValido = true;
                                                    }
                                                    //Si tenes CUIT
                                                } else if ($idCliente[0]['idTipoDoc'] == 7) {
                                                    $tipoDoc = 80;
                                                    $creo_factura = true;
                                                    //El campo se llama cuit pero hace referencia a cualquier nro de doc
                                                    if ($idCliente[0]['cuit'] == 0) {
                                                        $nroDocValido = false;
                                                    } else {
                                                        $nroDocValido = true;
                                                    }
                                                    //Si tenes CUIL
                                                } else if ($idCliente[0]['idTipoDoc'] == 6) {
                                                    $tipoDoc = 86;
                                                    $creo_factura = true;
                                                    //El campo se llama cuit pero hace referencia a cualquier nro de doc
                                                    if ($idCliente[0]['cuit'] == 0) {
                                                        $nroDocValido = false;
                                                    } else {
                                                        $nroDocValido = true;
                                                    }
                                                } else {
                                                    $nroDocValido = false;
                                                    $creo_factura = false;
                                                    $msg = "El Cliente no tiene asignado un CUIT, DNI, CUIL para poder facturar";
                                                    $dato = array("valid" => false, "msg" => $msg);
                                                }
                                                //Si sos IVA Sujeto Exento, Monotributista
                                            } else if ($idCliente[0]['idCondIva'] == 2 || $idCliente[0]['idCondIva'] == 3) {
                                                if ($idCliente[0]['idTipoDoc'] == 7) {
                                                    $tipoDoc = 80;
                                                    $creo_factura = true;
                                                    //El campo se llama cuit pero hace referencia a cualquier nro de doc
                                                    if ($idCliente[0]['cuit'] == 0) {
                                                        $nroDocValido = false;
                                                    } else {
                                                        $nroDocValido = true;
                                                    }
                                                } else {
                                                    $nroDocValido = false;
                                                    $creo_factura = false;
                                                    $msg = "El Cliente no tiene asignado un CUIT";
                                                    $dato = array("valid" => false, "msg" => $msg);
                                                }
                                            } else {
                                                $nroDocValido = false;
                                                $creo_factura = false;
                                                $msg = "El Cliente no cumple con las condiciones para facturar. Debe ser IVA Sujeto Exento, Monotributista o Consumidor Final";
                                                $dato = array("valid" => false, "msg" => $msg);
                                            }
                                            //Si es A
                                        } else if ($tipoFac == 1) {
                                            $tipoFactura = 1;
                                            //Tenes que ser si o si responsable inscripto y tener CUIT
                                            if ($idCliente[0]['idCondIva'] == 5) {
                                                if ($idCliente[0]['idTipoDoc'] == 7) {
                                                    $tipoDoc = 80;
                                                    $creo_factura = true;
                                                    //El campo se llama cuit pero hace referencia a cualquier nro de doc
                                                    if ($idCliente[0]['cuit'] == 0 || strlen($idCliente[0]['cuit']) < 10 || strlen($idCliente[0]['cuit']) > 11) {
                                                        $nroDocValido = false;
                                                    } else {
                                                        $nroDocValido = true;
                                                    }
                                                } else {
                                                    $nroDocValido = false;
                                                    $creo_factura = false;
                                                    $msg = "El Cliente no tiene asignado un CUIT o no cumple con la cantidad de digitos del mismo";
                                                    $dato = array("valid" => false, "msg" => $msg);
                                                }
                                            } else {
                                                $nroDocValido = false;
                                                $creo_factura = false;
                                                $msg = "El Cliente no cumple con las condiciones para facturar. Debe ser IVA Responsable Inscripto";
                                                $dato = array("valid" => false, "msg" => $msg);
                                            }
                                        } else if ($tipoFac == 3) {
                                            //Si sos consumidor final
                                            if ($idCliente[0]['idCondIva'] == 1) {
                                                //Si no tenes asignado ningun tipo de doc, Usuario Consumidor FInal Generico
                                                if ($idCliente[0]['idTipoDoc'] == 0) {
                                                    $tipoDoc = 99;
                                                    $creo_factura = true;
                                                    $nroDocValido = true;

                                                    //Si tenes DNI
                                                } else if ($idCliente[0]['idTipoDoc'] == 8) {
                                                    $tipoDoc = 96;
                                                    $creo_factura = true;
                                                    //El campo se llama cuit pero hace referencia a cualquier nro de doc
                                                    if ($idCliente[0]['cuit'] == 0) {
                                                        $nroDocValido = false;
                                                    } else {
                                                        $nroDocValido = true;
                                                    }
                                                    //Si tenes CUIT
                                                } else if ($idCliente[0]['idTipoDoc'] == 7) {
                                                    $tipoDoc = 80;
                                                    $creo_factura = true;
                                                    //El campo se llama cuit pero hace referencia a cualquier nro de doc
                                                    if ($idCliente[0]['cuit'] == 0) {
                                                        $nroDocValido = false;
                                                    } else {
                                                        $nroDocValido = true;
                                                    }
                                                    //Si tenes CUIL
                                                } else if ($idCliente[0]['idTipoDoc'] == 6) {
                                                    $tipoDoc = 86;
                                                    $creo_factura = true;
                                                    //El campo se llama cuit pero hace referencia a cualquier nro de doc
                                                    if ($idCliente[0]['cuit'] == 0) {
                                                        $nroDocValido = false;
                                                    } else {
                                                        $nroDocValido = true;
                                                    }
                                                } else {
                                                    $nroDocValido = false;
                                                    $creo_factura = false;
                                                    $msg = "El Cliente no tiene asignado un CUIT, DNI, CUIL para poder facturar";
                                                    $dato = array("valid" => false, "msg" => $msg);
                                                }
                                                //Si sos IVA Sujeto Exento, Monotributista
                                            } else if ($idCliente[0]['idCondIva'] == 2 || $idCliente[0]['idCondIva'] == 3) {
                                                if ($idCliente[0]['idTipoDoc'] == 7) {
                                                    $tipoDoc = 80;
                                                    $creo_factura = true;
                                                    //El campo se llama cuit pero hace referencia a cualquier nro de doc
                                                    if ($idCliente[0]['cuit'] == 0) {
                                                        $nroDocValido = false;
                                                    } else {
                                                        $nroDocValido = true;
                                                    }
                                                } else {
                                                    $nroDocValido = false;
                                                    $creo_factura = false;
                                                    $msg = "El Cliente no tiene asignado un CUIT";
                                                    $dato = array("valid" => false, "msg" => $msg);
                                                }
                                            } else {
                                                $nroDocValido = false;
                                                $creo_factura = false;
                                                $msg = "El Cliente no cumple con las condiciones para facturar. Debe ser IVA Sujeto Exento, Monotributista o Consumidor Final";
                                                $dato = array("valid" => false, "msg" => $msg);
                                            }
                                        }
                                    } else {
                                        $msg = "No se ha encontrado el cliente seleccionado";
                                        $dato = array("valid" => false, "msg" => $msg);
                                    }

                                    if ($creo_factura && $nroDocValido) {
                                        $nroDoc = $idCliente[0]['cuit']; //El campo se llama cuit pero hace referencia a cualquier nro de doc
                                        try {
                                            $importeGravadoTotal = floatval(bcdiv($importeGravadoTotal, '1', 2));
                                            $importeNetoExento = floatval(bcdiv($importeNetoExento, '1', 2));
                                            $importeIva = floatval(bcdiv($importeIva, '1', 2));
                                            $importeNetoNoGravado = floatval(bcdiv($importeNetoNoGravado, '1', 2));

                                            if ($tipoFac == 3) {
                                                $res = $this->crearFacturaC($datosEmp, $tipoDoc, $nroDoc, $total);
                                            } else if ($tipoFac == 1 || $tipoFac == 2) {
                                                $res = $this->crearFacturaAB($tipoFactura, $datosEmp, $tipoDoc, $nroDoc, $importeGravadoTotal, $importeNetoExento, $importeIva, $importeNetoNoGravado, $arraysIVA);
                                            }

                                            if ($res['CAE'] != null && $result_insert_ingreso) {
                                                $result_cae = $this->app_model->insert_cae_fecha($res['CAE'], $res['CAEFchVto'], $res['numero_de_factura'], $datosEmp['puntoVta'], $idGenIngreso);
                                                $msg = "Ok";
                                                $dato = array(
                                                    "valid" => true,
                                                    "msg" => $msg,
                                                    "res" => $res, // CAE
                                                    "importeNetoExento" => $importeNetoExento,
                                                    "importeNetoNoGravado" => $importeNetoNoGravado,
                                                    "arraysIVA" => $arraysIVA,
                                                    "datosEmpresa" => $datosEmp,
                                                    "total" => $total,
                                                    //                                        "datosFacturacion"=>$datosFacturacion,
                                                    "datosCliente" => $idCliente[0],
                                                    "productos" => $productos,
                                                    "ticketsPedido" => $tickets_pedido,
                                                    "result_pedido2" => $result_pedido2,
                                                );
                                            } else {
                                                $msg = "Algo salio mal en la afip o inserto en la BD. Comunicarse con el administrador del sistema";
                                                $dato = array("valid" => false, "msg" => $msg, "res" => $res);
                                            }
                                        } catch (Exception $e) {
                                            //                            $msg = "Algo salio mal";
                                            $dato = array("valid" => false, "msg" => $e->getMessage(), "importeGravadoTotal" => $importeGravadoTotal, "importeIva" => $importeIva, "importeNetoExento" => $importeNetoExento, "importeNetoNoGravado" => $importeNetoNoGravado);
                                        }
                                    } else {
                                        $msg = "El Cliente no cumple con las condiciones para facturar. Verificar condicion de IVA y Nro documento asignado.";
                                        $dato = array("valid" => false, "msg" => $msg, "creo_factura" => $creo_factura, "nroDocValido" => $nroDocValido, "cliente" => $idCliente);
                                    }
                                } else {

                                    $msg = "El pago se efectuó correctamente";
                                    $dato = array(
                                        "valid" => true,
                                        "msg" => $msg,
                                        "importeNetoExento" => $importeNetoExento,
                                        "importeNetoNoGravado" => $importeNetoNoGravado,
                                        "arraysIVA" => $arraysIVA,
                                        "datosEmpresa" => $datosEmp,
                                        "total" => $total,
                                        //                                        "datosFacturacion"=>$datosFacturacion,
                                        "datosCliente" => $idCliente[0],
                                        "productos" => $productos,
                                        "ticketsPedido" => $tickets_pedido,
                                        "result_pedido2" => $result_pedido2,
                                    );
                                }
                            } else {
                                $msg = "Ha ocurrido un error en la inserccion de los ingresos";
                                $dato = array("valid" => false, "msg" => $msg, "pedido" => $pedido);
                            }
                        } else {
                            //'idEstadoPedido' => 1, //1: Abierto -- 0 Cerrado
                            $result_pedido2 = $this->app_model_bar->cerrar_mesa_pedido_transaccion($idGenPedido, $pedido[0]['idMesa'], $idTab);

                            $msg = "La venta ya ha sido generada. Se cerrara el pedido y la mesa.";
                            $dato = array("valid" => false, "msg" => $msg, "result_pedido2" => $result_pedido2,);
                        }
                    } else {
                        $msg = "El pedido no tiene ningun detalle creado";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "El pedido ya ha sido cerrado o cancelado";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios y el mozo debe estar logeado para cerrar la mesa.Verifique que lo este";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    private function crearFacturaAB($tipoFactura, $datosEmp, $tipoDoc, $nroDoc, $importeGravadoTotal, $importeNetoExento, $importeIva, $importeNetoNoGravado, $arrayIva) {
        /**
         * Numero del punto de venta
         * */
        $punto_de_venta = $datosEmp['puntoVta'];
        /**
         * Tipo de factura
         * */
        $tipo_de_factura = $tipoFactura; // 6 = Factura B -- 1 = Factura A
        /**
         * NÃºmero de la ultima Factura B
         * */
        $last_voucher = $this->afip->ElectronicBilling->GetLastVoucher($punto_de_venta, $tipo_de_factura);
        /**
         * Concepto de la factura
         *
         * Opciones:
         *
         * 1 = Productos
         * 2 = Servicios
         * 3 = Productos y Servicios
         * */
        $concepto = $datosEmp['idConceptoFactura'];
        /**
         * Tipo de documento del comprador
         *
         * Opciones:
         *
         * 80 = CUIT
         * 86 = CUIL
         * 96 = DNI
         * 99 = Consumidor Final
         * */
        $tipo_de_documento = $tipoDoc;
        /**
         * Numero de documento del comprador (0 para consumidor final)
         * */
        $numero_de_documento = $nroDoc;
        /**
         * Numero de factura
         * */
        $numero_de_factura = $last_voucher + 1;
        /**
         * Fecha de la factura en formato aaaa-mm-dd (hasta 10 dias antes y 10 dias despues)
         * */
        $fecha = date('Y-m-d');
        /**
         * Importe sujeto al IVA (sin icluir IVA)
         * */
        $importe_gravado = $importeGravadoTotal;
        /**
         * Importe exento al IVA
         * */
        $importe_exento_iva = $importeNetoExento;
        /**
         * Importe de IVA
         * */
        $importe_iva = $importeIva;
        /**
         * Importe Neto No Gravado
         * */
        $importe_neto_no_gravado = $importeNetoNoGravado;

        if ($importe_iva != 0) {
            $data = array(
                'CantReg' => 1, // Cantidad de facturas a registrar
                'PtoVta' => $punto_de_venta,
                'CbteTipo' => $tipo_de_factura,
                'Concepto' => $concepto,
                'DocTipo' => $tipo_de_documento,
                'DocNro' => $numero_de_documento,
                'CbteDesde' => $numero_de_factura,
                'CbteHasta' => $numero_de_factura,
                'CbteFch' => intval(str_replace('-', '', $fecha)),
                'ImpTotal' => $importe_gravado + $importe_iva + $importe_exento_iva + $importe_neto_no_gravado,
                'ImpTotConc' => $importe_neto_no_gravado, // Importe neto no gravado
                'ImpNeto' => $importe_gravado,
                'ImpOpEx' => $importe_exento_iva,
                'ImpIVA' => $importe_iva,
                'ImpTrib' => 0, //Importe total de tributos
                'MonId' => 'PES', //Tipo de moneda usada en la factura ('PES' = pesos argentinos)
                'MonCotiz' => 1, // CotizaciÃ³n de la moneda usada (1 para pesos argentinos)
                'Iva' => $arrayIva// AlÃ­cuotas asociadas al factura
            );
        } else {
            $data = array(
                'CantReg' => 1, // Cantidad de facturas a registrar
                'PtoVta' => $punto_de_venta,
                'CbteTipo' => $tipo_de_factura,
                'Concepto' => $concepto,
                'DocTipo' => $tipo_de_documento,
                'DocNro' => $numero_de_documento,
                'CbteDesde' => $numero_de_factura,
                'CbteHasta' => $numero_de_factura,
                'CbteFch' => intval(str_replace('-', '', $fecha)),
                'ImpTotal' => $importe_gravado + $importe_iva + $importe_exento_iva + $importe_neto_no_gravado,
                'ImpTotConc' => $importe_neto_no_gravado, // Importe neto no gravado
                'ImpNeto' => $importe_gravado,
                'ImpOpEx' => $importe_exento_iva,
                'ImpIVA' => $importe_iva,
                'ImpTrib' => 0, //Importe total de tributos
                'MonId' => 'PES', //Tipo de moneda usada en la factura ('PES' = pesos argentinos)
                'MonCotiz' => 1, // CotizaciÃ³n de la moneda usada (1 para pesos argentinos)
            );
        }

        /**
         * Creamos la Factura
         * */
        $res = $this->afip->ElectronicBilling->CreateVoucher($data);
        $res = array("CAE" => $res['CAE'], "CAEFchVto" => $res['CAEFchVto'], "numero_de_factura" => $numero_de_factura);
        /**
         * Mostramos por pantalla los datos de la nueva Factura
         * */
//       var_dump(array(
//               'cae' => $res['CAE'], //CAE asignado a la Factura
//               'vencimiento' => $res['CAEFchVto'] //Fecha de vencimiento del CAE
//       ));    
        return $res;
    }

    private function crearFacturaC($datosEmp, $tipoDoc, $nroDoc, $total) {
        /**
         * Numero del punto de venta
         * */
        $punto_de_venta = $datosEmp['puntoVta'];
        /**
         * Tipo de factura
         * */
        $tipo_de_factura = 11; // 11 = Factura C 
        /**
         * NÃºmero de la ultima Factura C
         * */
        $last_voucher = $this->afip->ElectronicBilling->GetLastVoucher($punto_de_venta, $tipo_de_factura);
        /**
         * Concepto de la factura
         *
         * Opciones:
         *
         * 1 = Productos
         * 2 = Servicios
         * 3 = Productos y Servicios
         * */
        $concepto = $datosEmp['idConceptoFactura'];
        /**
         * Tipo de documento del comprador
         *
         * Opciones:
         *
         * 80 = CUIT
         * 86 = CUIL
         * 96 = DNI
         * 99 = Consumidor Final
         * */
        $tipo_de_documento = $tipoDoc;
        /**
         * Numero de documento del comprador (0 para consumidor final)
         * */
        $numero_de_documento = $nroDoc;
        /**
         * Numero de factura
         * */
        $numero_de_factura = $last_voucher + 1;
        /**
         * Fecha de la factura en formato aaaa-mm-dd (hasta 10 dias antes y 10 dias despues)
         * */
        $fecha = date('Y-m-d');


        $data = array(
            'CantReg' => 1, // Cantidad de facturas a registrar
            'PtoVta' => $punto_de_venta,
            'CbteTipo' => $tipo_de_factura,
            'Concepto' => $concepto,
            'DocTipo' => $tipo_de_documento,
            'DocNro' => $numero_de_documento,
            'CbteDesde' => $numero_de_factura,
            'CbteHasta' => $numero_de_factura,
            'CbteFch' => intval(str_replace('-', '', $fecha)),
            'ImpTotal' => $total,
            'ImpTotConc' => 0, // Importe neto no gravado
            'ImpNeto' => $total,
            'ImpOpEx' => 0,
            'ImpIVA' => 0,
            'ImpTrib' => 0, //Importe total de tributos
            'MonId' => 'PES', //Tipo de moneda usada en la factura ('PES' = pesos argentinos)
            'MonCotiz' => 1, // CotizaciÃ³n de la moneda usada (1 para pesos argentinos)
        );

        /**
         * Creamos la Factura
         * */
        $res = $this->afip->ElectronicBilling->CreateVoucher($data);
        $res = array("CAE" => $res['CAE'], "CAEFchVto" => $res['CAEFchVto'], "numero_de_factura" => $numero_de_factura);
        /**
         * Mostramos por pantalla los datos de la nueva Factura
         * */
//       var_dump(array(
//               'cae' => $res['CAE'], //CAE asignado a la Factura
//               'vencimiento' => $res['CAEFchVto'] //Fecha de vencimiento del CAE
//       ));    
        return $res;
    }

    public function actualizar_pedido() {
        if ($_POST) {
            $idGenPedido = $this->input->post('idGenPedido', true);
            $numeroTicket = $this->input->post('numeroTicket', true);
            $idEstado = $this->input->post('idEstado', true);

            if (!empty($idGenPedido) && !empty($numeroTicket) && !empty($idEstado)) {
                $result = $this->app_model_bar->update_pedido_by_idGenPedido_nroTicket($idGenPedido, $numeroTicket, $idEstado);
                if ($result) {
                    $msg = "El pedido ha actualizado su estado";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Ha ocurrido un error al actualizar el pedido";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Hay datos vacios.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_pedidos_tab() {
        if ($_POST) {
            $idTab = $this->input->post('idTab', true); //A que corresponde.Si a MOstrador, delivery, comun,cocina,etc
            $idEstadoPedido = $this->input->post('idEstadoPedido', true); //Estado en el cual se encuentra el pedido en general: Abierto, Cerrado o Cancelado
            $idEstadoPedidoDetalle = $this->input->post('idEstadoPedidoDetalle', true); //Estado en el cual se encuentra el pedido, Pendiente, Listo, entregado,etc
            if ($idTab) {
                switch ($idTab) {
                    case 1:
                        //Mesas
                        $result = $this->app_model_bar->get_pedidos_by_estados_y_tab_group_nroTicket($idTab, $idEstadoPedidoDetalle);
                        if ($result) {
                            foreach ($result as $key => $value) {
                                //--- Obtengo - Detalle de Pedido ---//
                                $items_pedido = $this->app_model_bar->get_productos_pedido_by_numero_ticket($value['idGenPedido'], $value['numeroTicket']);
                                $sub_items_pedido = $this->app_model_bar->get_sub_productos_pedido_by_numero_ticket($value['idGenPedido'], $value['numeroTicket']);

                                //--- UNO ARRAY ITEMS PEDIDOS Y ITEMS SUB PEDIDO ---//
                                if ($items_pedido && $sub_items_pedido) {
                                    $result_detalle = array_merge($items_pedido, $sub_items_pedido);
                                } else if ($items_pedido) {
                                    $result_detalle = $items_pedido;
                                } else if ($sub_items_pedido) {
                                    $result_detalle = $sub_items_pedido;
                                }
                                $result[$key]["detalle_pedido"] = $result_detalle;
                            }

                            $msg = "Ok";
                            $dato = array("valid" => true, "msg" => $msg, "pedidos" => $result);
                        } else {
                            $msg = "No hay pedidos para mostrar";
                            $dato = array("valid" => false, "msg" => $msg);
                        }
                        break;
                    case 2:
                        //Mostrador
                        $result = $this->app_model_bar->get_pedidos_by_estados_y_tab_group_nroTicket($idTab, $idEstadoPedidoDetalle);
                        $result_ult_pedido = $this->app_model_bar->get_ultimo_pedido();

                        if ($result) {
                            foreach ($result as $key => $value) {
                                //--- Obtengo - Detalle de Pedido ---//
                                $items_pedido = $this->app_model_bar->get_productos_pedido_by_numero_pedido($value['idGenPedido']);
                                $sub_items_pedido = $this->app_model_bar->get_sub_productos_pedido_by_numero_pedido($value['idGenPedido']);
                                //--- UNO ARRAY ITEMS PEDIDOS Y ITEMS SUB PEDIDO ---//
                                if ($items_pedido && $sub_items_pedido) {
                                    $result_detalle = array_merge($items_pedido, $sub_items_pedido);
                                } else if ($items_pedido) {
                                    $result_detalle = $items_pedido;
                                } else if ($sub_items_pedido) {
                                    $result_detalle = $sub_items_pedido;
                                }

                                $result[$key]["detalle_pedido"] = $result_detalle;
                                $total = 0;
                                foreach ($result_detalle as $key2 => $value) {
                                    $total = $total + (floatval($value["precio"]) * floatval($value["cantidad"]));
                                }
                                $result[$key]["totalVenta"] = $total;
                            }

                            $msg = "Ok";
                            $dato = array("valid" => true, "msg" => $msg, "pedidos" => $result, "ult_pedido" => $result_ult_pedido[0]['nroPedido'], "reset_ult_pedido" => $result_ult_pedido[0]['reset']);
                        } else {
                            $msg = "No hay pedidos para mostrar";
                            $dato = array("valid" => false, "msg" => $msg, "pedidos" => false, "ult_pedido" => $result_ult_pedido[0]['nroPedido'], "reset_ult_pedido" => $result_ult_pedido[0]['reset']);
                        }
                        break;
                    case 3:
                        //Delivery
                        $result = $this->app_model_bar->get_pedidos_by_estados_y_tab_group_nroTicket($idTab, $idEstadoPedidoDetalle);
                        $result_ult_pedido = $this->app_model_bar->get_ultimo_pedido();

                        if ($result) {
                            foreach ($result as $key => $value) {
                                //--- Obtengo - Detalle de Pedido ---//
                                $items_pedido = $this->app_model_bar->get_productos_pedido_by_numero_pedido($value['idGenPedido']);
                                $sub_items_pedido = $this->app_model_bar->get_sub_productos_pedido_by_numero_pedido($value['idGenPedido']);
                                //--- UNO ARRAY ITEMS PEDIDOS Y ITEMS SUB PEDIDO ---//
                                if ($items_pedido && $sub_items_pedido) {
                                    $result_detalle = array_merge($items_pedido, $sub_items_pedido);
                                } else if ($items_pedido) {
                                    $result_detalle = $items_pedido;
                                } else if ($sub_items_pedido) {
                                    $result_detalle = $sub_items_pedido;
                                }

                                $result[$key]["detalle_pedido"] = $result_detalle;
                                $total = 0;
                                foreach ($result_detalle as $key2 => $value) {
                                    $total = $total + (floatval($value["precio"]) * floatval($value["cantidad"]));
                                }
                                $result[$key]["totalVenta"] = $total;
                            }

                            $msg = "Ok";
                            $dato = array("valid" => true, "msg" => $msg, "pedidos" => $result, "ult_pedido" => $result_ult_pedido[0]['nroPedido'], "reset_ult_pedido" => $result_ult_pedido[0]['reset']);
                        } else {
                            $msg = "No hay pedidos para mostrar";
                            $dato = array("valid" => false, "msg" => $msg, "pedidos" => false, "ult_pedido" => $result_ult_pedido[0]['nroPedido'], "reset_ult_pedido" => $result_ult_pedido[0]['reset']);
                        }
                        break;
                    case 4:
                        //Cocina
                        $result = $this->app_model_bar->get_pedidos_by_estados_y_tab_group_nroTicket($idTab, $idEstadoPedidoDetalle);
//                        $result = $this->app_model_bar->get_pedidos_pendientes_agrupados_nroTicket();

                        $pedidos = array();
                        if ($result) {
                            foreach ($result as $key => $value) {
                                //--- Obtengo - Detalle de Pedido ---//
                                $items_pedido = $this->app_model_bar->get_productos_pedido_by_numero_ticket($value['idGenPedido'], $value['numeroTicket']);
                                $sub_items_pedido = $this->app_model_bar->get_sub_productos_pedido_by_numero_ticket($value['idGenPedido'], $value['numeroTicket']);
                                //--- UNO ARRAY ITEMS PEDIDOS Y ITEMS SUB PEDIDO ---//
                                if ($items_pedido && $sub_items_pedido) {
                                    $result_detalle = array_merge($items_pedido, $sub_items_pedido);
                                } else if ($items_pedido) {
                                    $result_detalle = $items_pedido;
                                } else if ($sub_items_pedido) {
                                    $result_detalle = $sub_items_pedido;
                                }
                                $result[$key]["detalle_pedido"] = $result_detalle;
                            }
                            $msg = "Ok";
                            $dato = array("valid" => true, "msg" => $msg, "pedidos" => $result, "sdsd" => $this->db->last_query());
                        } else {
                            $msg = "Error al listar pedidos";
                            $dato = array("valid" => false, "msg" => $msg);
                        }

                        break;

                    default:
                        $msg = "No hay pedidos pendientes";
                        $dato = array("valid" => false, "msg" => $msg);
                        break;
                }
            } else {
                $msg = "Falta ingresar tab";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_producto_search() {
        //--- Obtencion de todos los productos ---//
        $producto = $this->app_model->get_productos();
        if ($producto) {
            foreach ($producto as $key => $value) {
                $productos[$key]['idProducto'] = $value['idProducto'];
                $productos[$key]['idGenProducto'] = $value['idGenProducto'];
                $productos[$key]['idCategoriaProducto'] = $value['idCategoriaProducto'];
                $productos[$key]['precioVenta'] = $value['precioVenta'];
                $productos[$key]['codigo'] = $value['codigo'];
                $productos[$key]['nombre'] = $value['nombre'];
                $productos[$key]['stock'] = $value['stock'];
                $productos[$key]['idTipoProducto'] = $value['idTipoProducto'];
                $productos[$key]['subProductos'] = false;

                //Sub Productos
                if ($productos[$key]['idTipoProducto'] == 1) {
                    $sub_productos = $this->app_model->get_sub_productos_byIdGen($value['idGenProducto']);
                    if ($sub_productos) {
                        $productos[$key]['subProductos'] = $sub_productos;
                    }
                }
            }
        } else {
            return false;
        }

        return ($productos);
    }

    public function asignar_pedido_cadete() {
        $noSelect = 0;
        $deleteSelect = 0;

        if ($_POST) {
            $arrayPedidos = json_decode($this->input->post('arrayPedidos', true), true);
            $idCadete = $this->input->post('idCadete', true);

            if (!empty($arrayPedidos) && !empty($idCadete)) {
                $arrayPedidosRebotados = [];
                $arrayPedidosAsignados = [];

                //Obtengo los pedidos que ya tenia asignado el cadete para validar si debo resetear algun estado
                $pedidos = $this->app_model_bar->get_pedido_by_idCadete($idCadete);

//                print_r($arrayPedidos);

                foreach ($arrayPedidos as $key => $value) {
                    //Solicito la info del pedido
                    $pedido = $this->app_model_bar->get_pedido_by_idGenPedido($value['idGenPedido']);
                    if ($pedido) {
                        //Verifico si agrego o borro
                        if ($value['isChecked']) {
                            $values = array(
                                'idCadete' => $idCadete
                            );
                            $result = $this->app_model_bar->asignar_datos_delivery_by_idGenPedido($value['idGenPedido'], $values);

                            // El idEstadoDetalle=9 significa enviado
                            $result2 = $this->app_model_bar->update_pedido_detalle_by_idGenPedido($value['idGenPedido'], 9);

                            //Guardo los pedidos actualizados exitosamente
                            array_push($arrayPedidosAsignados, $pedido);
                        } else {
                            if ($pedidos) {
                                $existeKey = array_search($value['idGenPedido'], array_column($pedidos, 'idGenPedido'));
                                //Si  existe el producto le debo cambiar el estado en pedido detalle para volverlo al estado anterior completamente
                                if ($existeKey !== false) {
                                    // El idEstadoDetalle=7 significa listo para enviar
                                    $result2 = $this->app_model_bar->update_pedido_detalle_by_idGenPedido($value['idGenPedido'], 7);

                                    //Tambien se le saco el id del cadete al pedido en gral
                                    $values = array(
                                        'idCadete' => 0
                                    );
                                    $result = $this->app_model_bar->asignar_datos_delivery_by_idGenPedido($value['idGenPedido'], $values);
                                }
                                $noSelect++;
                            }
                        }
                    } else {
                        //El pedido no existe
                        $pedido[0]['idGenPedido'] = $value['idGenPedido'];
                        $pedido[0]['mensaje'] = "El pedido no existe";
                        array_push($arrayPedidosRebotados, $pedido);
                    }
                }

                $msg = "Pedidos asignados correctamente";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Hay datos vacios.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function actualizar_pedido_cadete() {
        if ($_POST) {
            $idGenPedido = $this->input->post('idGenPedido', true);
            $idCadete = $this->input->post('idCadete', true);
            if (!empty($idGenPedido) && !empty($idCadete)) {
                //Si no tiene asignado un cadete actualizo el pedido con el cadete para enviar
                $values = array(
                    'idCadete' => $idCadete
                );
                $result = $this->app_model_bar->asignar_datos_delivery_by_idGenPedido($idGenPedido, $values);
                if ($result) {
                    $msg = "Pedido actualizado correctamente";
                    $dato = array("valid" => true, "msg" => $msg,);
                } else {
                    $msg = "El pedido ya tiene asignado el mismo cadete o ha ocurrido un error";
                    $dato = array("valid" => true, "msg" => $msg,);
                }
            } else {
                $msg = "Hay datos vacios.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function set_cadete() {
        if ($_POST) {
            $nombre = $this->input->post('nombre', true);
            $celular = $this->input->post('celular', true);
            if (!empty($nombre)) {
                $values = array(
                    'nombre' => $nombre,
                    'celular' => $celular
                );

                $result = $this->app_model_bar->set_cadete($values);
                if ($result) {
                    $msg = "Cadete insertado correctamente";
                    $dato = array("valid" => true, "msg" => $msg,);
                } else {
                    $msg = "Ha ocurrido un error en la inserccion del cadete";
                    $dato = array("valid" => true, "msg" => $msg,);
                }
            } else {
                $msg = "Hay datos vacios.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_cadetes() {
        $cadetes = $this->app_model_bar->get_cadetes();

        if (!empty($cadetes)) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "datos" => $cadetes);
        } else {
            $msg = "No se encontraron cadetes registrados";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_costos_envios() {
        $costos_envios = $this->app_model_bar->get_costos_envios();

        if (!empty($costos_envios)) {
            $msg = "Ok";
            $dato = array("valid" => true, "msg" => $msg, "datos" => $costos_envios);
        } else {
            $msg = "No se encontraron costos de envios registrados";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function reset_numeracion_pedidos() {
        //Obtengo el ultimo nro de pedido
        $idPedido = $this->app_model_bar->get_last_nroPedido();

        if ($idPedido) {
            $result = $this->app_model_bar->resetear_numeracion($idPedido[0]['id']);
            if ($result) {
                $msg = "Numeración reseteada";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "No se ha podido resetear la numeración.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Aún no hay pedidos generados";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
