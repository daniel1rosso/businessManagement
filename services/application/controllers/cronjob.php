<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cronjob extends MY_Controller {

    protected $data = array(
        'active' => 'egresos'
    );

    public function __construct() {
        parent::__construct();
    }

    public function abonos() {
        //--- Abonos ---//
        $result = $this->app_model->get_abonos_cronejob();
        
        foreach ($result as $key => $value) {
            
            $hoy = date("Y-m-d");
            if ($hoy < $value['fechaFinalizacion']) {
                $inicio = $value['fechaInicioAbono'];
                $fin = $hoy;

                $datetime1 = new DateTime($inicio);
                $datetime2 = new DateTime($fin);

                # obtenemos la diferencia entre las dos fechas
                $interval = $datetime2->diff($datetime1);

                # obtenemos la diferencia en meses
                $intervalMeses = $interval->format("%m");
                # obtenemos la diferencia en años y la multiplicamos por 12 para tener los meses
                $intervalAnos = $interval->format("%y") * 12;

//                echo $value['idGenAbono'] . " hay una diferencia de " . ($intervalMeses + $intervalAnos) . " meses <br>";
                switch ($value['idAbonoModalidad']) {
                    case 1:
                        //Mensual
                        $intervalMeses = $intervalMeses;
                        break;
                    case 2:
                        //Bimestral
                        if ($intervalMeses == 0) {
                            $intervalMeses = $intervalMeses;
                        } else {
                            $intervalMeses = $intervalMeses / $value['idAbonoModalidad'];
                        }
                        break;
                    case 3:
                        //Trimestral
                        if ($intervalMeses == 0) {
                            $intervalMeses = $intervalMeses;
                        } else {
                            $intervalMeses = $intervalMeses / $value['idAbonoModalidad'];
                        }
                        break;
                    case 4:
                        //Cuatrimestral
                        if ($intervalMeses == 0) {
                            $intervalMeses = $intervalMeses;
                        } else {
                            $intervalMeses = $intervalMeses / $value['idAbonoModalidad'];
                        }
                        break;

                    default:
                        break;
                }
                
                if ($intervalMeses == 0 && $value['ventasCreadas'] == 0) {
                    //SI NO TENGO VENTAS CREADAS Y LA FECHA DE LA PRIMER VENTA AUN NO PASO NO HAGO NADA. dE LO CONTRARIO CREO LA VENTA
                    
                    if ($hoy >= $value['fechaPrimerVenta']) {
                        
                        $idGenIngreso = substr(md5(microtime()), 15, 17);

                        $resultDetalleAbono = $this->app_model->get_detalle_abono_by_idGenAbono($value['idGenAbono']);
                        if ($resultDetalleAbono) {
                            //--- Guardo - Ingreso ---//
                            $result_insert_ingreso = $this->app_model->insert_ingreso(
                                    $idGenIngreso, $value['idGenAbono'], $tipoIngreso = 2, // Abonoo
                                    1, $value['idCliente'], //idCliente
                                    $hoy, //fechaEmision
                                    $hoy, //fechaCobro
                                    $value['tipoFactura'], //selectTipoFac
                                    $value['idCategoria'], //idCategoria
                                    "Abono generado por Cron", //notaCliente
                                    "Abono generado por Cron", //notaInterna
                                    $value['importeNetoNoGravado'], //importeNoGravado
                                    $value['total'], //totalVenta
                                    $value['descuentoTotal'], //descuentoTotal
                                    $value['descuentoCliente'], //descuentoCliente
                                    $value['ivaTotal'], //ivaTotal
                                    $value['idSubcategoriaVenta'], //selectSubCategoriaVenta
                                    $value['razonSocial'], //razonsocial
                                    "", //idGenPresupuesto
                                    $aCobrar = $value['total'], //aCobrar                                    
                                    $saldado = 0, $idEstado = 2,   //Estado de A cobrar 
                                    $value['fechaIncioServicio'],
                                    $value['fechaFinServicio']                               
                            );

                            $fechaCobroCuentaCorriente = date("Y-m-d H:i:s");

                            $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                                    $idGenIngreso, $idGenComprobante = 0, $value['idCliente'], //selectCliente
                                    $fechaCobroCuentaCorriente, //fechaCobro
                                    $debito = $value['total'], //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                                    $credito = 0, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                                    $idMedioCobro = 0, //Medio de cobro
                                    $saldo = $value['total'], //Saldo
                                    $descripcionCobro = "Primer ingreso"
                            );
                            //--- Guardo - Detalle de Ingreso ---//
                            //foreach($datosVenta as $key => $value){
                            for ($i = 0; $i < count($resultDetalleAbono); $i++) {

                                $result_insert_ingreso_detalle = $this->app_model->insert_ingreso_detalle(
                                        $idGenIngreso, $resultDetalleAbono[$i]['idProducto'], $resultDetalleAbono[$i]['cantidad'], $resultDetalleAbono[$i]['precio'], $resultDetalleAbono[$i]['descuento'], $resultDetalleAbono[$i]['subTotal'], $resultDetalleAbono[$i]['iva'], $resultDetalleAbono[$i]['ivaText']
                                );
                                $resultProducto = $this->app_model->get_producto($resultDetalleAbono[$i]['idProducto']);
                                if ($resultProducto) {
                                    $cantidadActualizada = $resultProducto[0]['stock'] - $resultDetalleAbono[$i]['cantidad'];
                                    $result = $this->app_model->update_stock_by_idProducto($resultDetalleAbono[$i]['idProducto'], $cantidadActualizada);
                                } else {
                                    //No se encontro el producto
                                }
                            }


                            $vtasCreadas = $value['ventasCreadas'] + 1;
                            $result_update_abono_vta = $this->app_model->update_abono_vtas_creadas_by_idGenAbono($value['idGenAbono'], $vtasCreadas);
                            $result_log_abono = $this->app_model->insert_log_abono($value['idGenAbono']);
                        } else {
                            // No se obtuvo el detalle
                        }
                    }
                } else if ($value['ventasCreadas'] == $intervalMeses) {
                    //SI EL INTERVALO DE MESES ES MAS CHICO QUE LAS VENTAS QUE ESTAN CREADAS, POR EJ, SI LA FECHA DE INICIO ES AGOSTO Y ESTOY EN SEPTIEMBRE,
                    //intervalMeses ME DA 1 PERO YO TENGO QUE TENER CREADAS DOS VENTAS (CON LA CORRESPONDIENTE A SEPTIEMBRE)

                    $idGenIngreso = substr(md5(microtime()), 15, 17);
                    $resultDetalleAbono = $this->app_model->get_detalle_abono_by_idGenAbono($value['idGenAbono']);
                    if ($resultDetalleAbono) {
                        //--- Guardo - Ingreso ---//
                        $result_insert_ingreso = $this->app_model->insert_ingreso(
                            $idGenIngreso, $value['idGenAbono'], $tipoIngreso = 2, // Abonoo
                            1, $value['idCliente'], //idCliente
                            $hoy, //fechaEmision
                            $hoy, //fechaCobro
                            $value['tipoFactura'], //selectTipoFac
                            $value['idCategoria'], //idCategoria
                            "Abono generado por Cron", //notaCliente
                            "Abono generado por Cron", //notaInterna
                            $value['importeNetoNoGravado'], //importeNoGravado
                            $value['total'], //totalVenta
                            $value['descuentoTotal'], //descuentoTotal
                            $value['descuentoCliente'], //descuentoCliente
                            $value['ivaTotal'], //ivaTotal
                            $value['idSubcategoriaVenta'], //selectSubCategoriaVenta
                            $value['razonSocial'], //razonsocial
                            "", //idGenPresupuesto
                            $aCobrar = $value['total'], //aCobrar                                    
                            $saldado = 0, $idEstado = 2,   //Estado de A cobrar 
                            $value['fechaInicioServicio'],
                            $value['fechaFinServicio']                                   
                        );
                        $fechaCobroCuentaCorriente = date("Y-m-d H:i:s");

                        $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                                $idGenIngreso, $idGenComprobante = 0, $value['idCliente'], //selectCliente
                                $fechaCobroCuentaCorriente, //fechaCobro
                                $debito = $value['total'], //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                                $credito = 0, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                                $idMedioCobro = 0, //Medio de cobro
                                $saldo = $value['total'], //Saldo
                                $descripcionCobro = "Venta generada cron"
                        );
                        //--- Guardo - Detalle de Ingreso ---//
                        //foreach($datosVenta as $key => $value){
                        for ($i = 0; $i < count($resultDetalleAbono); $i++) {

                            $result_insert_ingreso_detalle = $this->app_model->insert_ingreso_detalle(
                                    $idGenIngreso, $resultDetalleAbono[$i]['idProducto'], $resultDetalleAbono[$i]['cantidad'], $resultDetalleAbono[$i]['precio'], $resultDetalleAbono[$i]['descuento'], $resultDetalleAbono[$i]['subTotal'], $resultDetalleAbono[$i]['iva'], $resultDetalleAbono[$i]['ivaText']
                            );
                            $resultProducto = $this->app_model->get_producto($resultDetalleAbono[$i]['idProducto']);
                            if ($resultProducto) {
                                $cantidadActualizada = $resultProducto[0]['stock'] - $resultDetalleAbono[$i]['cantidad'];
                                $result = $this->app_model->update_stock_by_idProducto($resultDetalleAbono[$i]['idProducto'], $cantidadActualizada);
                            } else {
                                //No se encontro el producto
                            }
                        }

                        $vtasCreadas = $value['ventasCreadas'] + 1;
                        $result_update_abono_vta = $this->app_model->update_abono_vtas_creadas_by_idGenAbono($value['idGenAbono'], $vtasCreadas);
                        $result_log_abono = $this->app_model->insert_log_abono($value['idGenAbono']);
                    }
                }
            }
        }
    }

    public function abonos_julio() {
        //--- Abonos ---//
        $result = $this->app_model->get_abonos();

        foreach ($result as $key => $value) {

            $hoy = date("Y-m-d");
            $fechaEmision = date("2019-07-02");
            $idGenIngreso = substr(md5(microtime()), 15, 17);
            $o = 0;
            $resultDetalleAbono = $this->app_model->get_detalle_abono_by_idGenAbono($value['idGenAbono']);
            if ($resultDetalleAbono) {
                //--- Guardo - Ingreso ---//
                $result_insert_ingreso = $this->app_model->insert_ingreso(
                        $idGenIngreso, $value['idGenAbono'], $tipoIngreso = 2, // Abonoo
                        20, $value['idCliente'], //idCliente
                        $fechaEmision, //fechaEmision
                        $fechaEmision, //fechaCobro
                        $value['tipoFactura'], //selectTipoFac
                        $value['idCategoria'], //idCategoria
                        "Abono generado por Cron", //notaCliente
                        "Abono generado por Cron", //notaInterna
                        $value['importeNetoNoGravado'], //importeNoGravado
                        $value['total'], //totalVenta
                        $value['descuentoTotal'], //descuentoTotal
                        $value['ivaTotal'], //ivaTotal
                        $value['idCategoriaVenta'], //selectCategoriaVentaDetalle
                        $value['idSubcategoriaVenta'], //selectSubCategoriaVenta
                        $aCobrar = $value['total'], //aCobrar                                    
                        $saldado = 0, $idEstado = 2   //Estado de A cobrar                                
                );
                if ($result_insert_ingreso) {
                    $o++;
                }
                $fechaCobroCuentaCorriente = date("Y-m-d H:i:s");

                $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                        $idGenIngreso, $idGenComprobante = 0, $value['idCliente'], //selectCliente
                        $fechaCobroCuentaCorriente, //fechaCobro
                        $debito = $value['total'], //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                        $credito = 0, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                        $idMedioCobro = 0, //Medio de cobro
                        $saldo = $value['total'], //Saldo
                        $descripcionCobro = "Primer ingreso"
                );
                //--- Guardo - Detalle de Ingreso ---//
                //foreach($datosVenta as $key => $value){
                for ($i = 0; $i < count($resultDetalleAbono); $i++) {

                    $result_insert_ingreso_detalle = $this->app_model->insert_ingreso_detalle(
                            $idGenIngreso, $resultDetalleAbono[$i]['idProducto'], $resultDetalleAbono[$i]['cantidad'], $resultDetalleAbono[$i]['precio'], $resultDetalleAbono[$i]['descuento'], $resultDetalleAbono[$i]['subTotal'], $resultDetalleAbono[$i]['iva'], $resultDetalleAbono[$i]['ivaText']
                    );
                    $resultProducto = $this->app_model->get_producto($resultDetalleAbono[$i]['idProducto']);
                    if ($resultProducto) {
                        $cantidadActualizada = $resultProducto[0]['stock'] - $resultDetalleAbono[$i]['cantidad'];
                        $result = $this->app_model->update_stock_by_idProducto($resultDetalleAbono[$i]['idProducto'], $cantidadActualizada);
                    } else {
                        //No se encontro el producto
                    }
                }

                $result_log_abono = $this->app_model->insert_log_abono($value['idGenAbono']);
            } else {
                // No se obtuvo el detalle
            }
        }

        echo ("Registros recorridos: " . $key);
        echo ("Registros insertados: " . $o);
    }

    public function abonos_borrar_vtas() {
        //--- Abonos ---//
        $result = $this->app_model->get_ingresos();

        foreach ($result as $key => $value) {

            if (!($value['total'] == $value['aCobrar']) && $value['aCobrar'] != 0) {

                $elimina = $this->app_model->elimina_ingreso_cta_cte($value['idGenIngreso']);

                $fechaCobroCuentaCorriente = date("Y-m-d");
                $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                        $value['idGenIngreso'], $idGenComprobante = 0, $value['idCliente'], //selectCliente
                        $fechaCobroCuentaCorriente, //fechaCobro
                        $debito = $value['total'], //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                        $credito = 0, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                        $idMedioCobro = 0, //Medio de cobro
                        $saldo = $value['total'], //Saldo
                        $descripcionCobro = "Primer ingreso"
                );
                $elimina = $this->app_model->update_ingreso_monto($value['idGenIngreso'], $value['total']);
            }
        }
    }

    public function actualiza_ab() {
        //--- Abonos ---//
        $result = $this->app_model->get_abonos_ingresos();

        foreach ($result as $key => $value) {
//        echo "Key: ". $key;
//        echo "<br/>";
            $result_insert_ingreso_detalle = $this->app_model->insert_abono_detalle(
                    $value['idGenAbono'], $value['idProducto'], $value['cantidad'], $value['precio'], $value['descuento'], $value['subTotal'], $value['iva']
            );
        }
    }

    public function actualiza_ingresos_montos() {
        //--- Abonos ---//
        $result = $this->app_model->get_ingresos2();

        foreach ($result as $key => $value) {
            $result_insert_ingreso_detalle = $this->app_model->update_reset_monoto_ingreso($value['idGenIngreso'], $value['total']);
        }
    }

    public function actualiza_cta_cte_julio() {
        //--- Abonos ---//
        $result = $this->app_model->get_ingresos3();
//        print_r($result);
        $fechaCobroCuentaCorriente = date("Y-m-d H:i:s");
        foreach ($result as $key => $value) {
            $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                    $value['idGenIngreso'], $idGenComprobante = 0, $value['idCliente'], //selectCliente
                    $fechaCobroCuentaCorriente, //fechaCobro
                    $debito = $value['total'], //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                    $credito = 0, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                    $idMedioCobro = 0, //Medio de cobro
                    $saldo = $value['total'], //Saldo
                    $descripcionCobro = "Primer ingreso"
            );
        }
    }

    public function actualiza_cta_cte_septiembre() {
        //--- Abonos ---//
        $result = $this->app_model->get_ingresos4();

        $fechaCobroCuentaCorriente = date("Y-m-d H:i:s");

        $i = 0;
        foreach ($result as $key => $value) {
            $estadoCuenta = $this->app_model->get_estado_cuenta_by_idGenIngreso($value['idGenIngreso']);
            if (!$estadoCuenta) {
                $result_cuenta_corriente = $this->app_model->insert_cuenta_corriente(
                        $value['idGenIngreso'], $idGenComprobante = 0, $value['idCliente'], //selectCliente
                        $fechaCobroCuentaCorriente, //fechaCobro
                        $debito = $value['total'], //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
                        $credito = 0, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
                        $idMedioCobro = 0, //Medio de cobro
                        $saldo = $value['total'], //Saldo
                        $descripcionCobro = "Primer ingreso"
                );
                $i++;
            }
        }
        echo "i :" . $i;
    }

    public function deteccion_notificaciones_vencimientos() {
        //--- Definicion de arreglos ---//
        $notificacionesGastosTotales[] = [];
        $notificacionesEgresosTotales[] = [];

        //--- Inicio de la operacion para las notificaciones de vencimientos del dia ---//
        //--- Arreglos para verificar nuevamente si exite alguna notificacion ---//
        $notificacionesET = $this->app_model->get_notificaciones_egresos();
        $notificacionesGT = $this->app_model->get_notificaciones_gastos();
        if ($notificacionesET) {
            foreach ($notificacionesGT as $key => $value) {
                array_push($notificacionesGastosTotales, $value['idGenGasto']);
            }
        }
        if ($notificacionesGT) {
            foreach ($notificacionesET as $key => $value) {
                array_push($notificacionesEgresosTotales, $value['idGenEgreso']);
            }
        }

        //--- Fecha Actual ---//
        //--- Definicion de los arreglos ---//
        $notificacionesEgresos[] = [];
        $notificacionesGastos[] = [];
        //--- fecha actual ---//
        $hoy = date("Y-m-d");
        //--- egresos y gastos correspondientes a la fecha pasada por parametro ---//
        $notificacionesEgresos = $this->app_model->get_egresos_by_fecha_noSaldada($hoy);
        $notificacionesGastos = $this->app_model->get_gastos_by_fecha_noSaldada($hoy);
        if (!empty($notificacionesEgresos)) {
            foreach ($notificacionesEgresos as $key => $value) {
//                $idGenEgreso = "'" . $value['idGenEgreso'] . "'";
                if (!in_array($value['idGenEgreso'], $notificacionesEgresosTotales)) {
                    $this->app_model->insert_notificacion_egreso($value['idGenEgreso']);
                }
            }
        }
        if (!empty($notificacionesGastos)) {
            foreach ($notificacionesGastos as $key => $value) {
//                $idGenGasto = "'" . $value['idGenGasto'] . "'";
                if (!in_array($value['idGenGasto'], $notificacionesGastosTotales)) {
                    $this->app_model->insert_notificacion_gasto($value['idGenGasto']);
                }
            }
        }

        //--- Fin de la operacion para las notificaciones de vencimientos del dia ---//
        //--- Inicio de la operacion para las notificaciones de vencimientos de dos dias antes ---//
        //--- Arreglos para verificar nuevamente si exite alguna notificacion con las inserciones de arriba ---//
        $notificacionesET = $this->app_model->get_notificaciones_egresos();
        $notificacionesGT = $this->app_model->get_notificaciones_gastos();
        if ($notificacionesET) {
            foreach ($notificacionesGT as $key => $value) {
                array_push($notificacionesGastosTotales, $value['idGenGasto']);
            }
        }
        if ($notificacionesGT) {
            foreach ($notificacionesET as $key => $value) {
                array_push($notificacionesEgresosTotales, $value['idGenEgreso']);
            }
        }

        //--- Dos dias antes a la actual Fecha Actual ---//
        //--- Definicion de los arreglos ---//
        $notificacionesEgresos[] = [];
        $notificacionesGastos[] = [];
        //--- fecha actual sumandole dos dias ---//
        $dosDiasAntes = date("d-m-Y", strtotime($hoy . "+ 2 days"));
        //--- egresos y gastos correspondientes a la fecha pasada por parametro ---//
        $notificacionesEgresos = $this->app_model->get_egresos_by_fechaHastaHoy_noSaldada($dosDiasAntes, $hoy);
        $notificacionesGastos = $this->app_model->get_gastos_by_fechaHastaHoy_noSaldada($dosDiasAntes, $hoy);
        if (!empty($notificacionesEgresos)) {
            foreach ($notificacionesEgresos as $key => $value) {
                if (!in_array($value['idGenEgreso'], $notificacionesEgresosTotales)) {
                    $this->app_model->insert_notificacion_egreso($value['idGenEgreso']);
                }
            }
        }
        if (!empty($notificacionesGastos)) {
            foreach ($notificacionesGastos as $key => $value) {
                if (!in_array($value['idGenGasto'], $notificacionesGastosTotales)) {
                    $this->app_model->insert_notificacion_gasto($value['idGenGasto']);
                }
            }
        }

        //--- Fin de la operacion para las notificaciones de vencimientos de dos dias antes ---//
        //--- Inicio de la operacion para las notificaciones de vencimientos de un dia despues ---//
        //--- Arreglos para verificar nuevamente si exite alguna notificacion con las inserciones de arriba ---//
        $notificacionesET = $this->app_model->get_notificaciones_egresos();
        $notificacionesGT = $this->app_model->get_notificaciones_gastos();
        if ($notificacionesET) {
            foreach ($notificacionesGT as $key => $value) {
                array_push($notificacionesGastosTotales, $value['idGenGasto']);
            }
        }
        if ($notificacionesGT) {
            foreach ($notificacionesET as $key => $value) {
                array_push($notificacionesEgresosTotales, $value['idGenEgreso']);
            }
        }

        //--- Un dia despues a la actual Fecha Actual ---//
        //--- Definicion de los arreglos ---//
        $notificacionesEgresos[] = [];
        $notificacionesGastos[] = [];
        //--- fecha actual restandole un dia ---//
        $unDiaDespues = date("d-m-Y", strtotime($hoy . "- 1 days"));
        //--- egresos y gastos correspondientes a la fecha pasada por parametro ---//
        $notificacionesEgresos = $this->app_model->get_egresos_by_fecha_noSaldada($unDiaDespues);
        $notificacionesGastos = $this->app_model->get_gastos_by_fecha_noSaldada($unDiaDespues);
        if (!empty($notificacionesEgresos)) {
            foreach ($notificacionesEgresos as $key => $value) {
                if (!in_array($value['idGenEgreso'], $notificacionesEgresosTotales)) {
                    $this->app_model->insert_notificacion_egreso($value['idGenEgreso']);
                }
            }
        }
        if (!empty($notificacionesGastos)) {
            foreach ($notificacionesGastos as $key => $value) {
                if (!in_array($value['idGenGasto'], $notificacionesGastosTotales)) {
                    $this->app_model->insert_notificacion_gasto($value['idGenGasto']);
                }
            }
        }

        //--- Fin de la operacion para las notificaciones de vencimientos de un dia despues ---//
    }

    function deteccion_presupuesto_vencido() {
        //--- Fecha Actual ---//
        $hoy = date("Y-m-d");
        //--- Obtencion de los presupuestos ---//
        $presupuestos = $this->app_model->get_presupuestos();
        if ($presupuestos) {
            foreach ($presupuestos as $key => $value) {
                if ($value['fechaVtoPresupuesto'] <= $hoy) {
                    $this->app_model->update_presupuesto_estado($value['idGenPresupuesto'], 5);
                }
            }
        }
    }

}
