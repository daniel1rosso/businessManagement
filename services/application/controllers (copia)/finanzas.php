<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Finanzas extends MY_Controller
{
    protected $data = array(
        'active' => 'finanzas'
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function listar_turnos_cajas()
    {
        $this->load_view('finanzas/listar_turnos_cajas', $this->data);
    }

    public function listar_turnos_cajas_table()
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- datos ---//
        $usuarios = $this->app_model->get_usuarios();

        if ($usuarios) {
            foreach ($usuarios as $key => $value) {
                if ($value['idNivel'] == 9 || $value['idNivel'] == 10) {
                    $texto = "";
                    $class = "";

                    if ($value['turno'] == 0) :
                        $class = "btn-success";
                    $texto = "Turno Abierto";

                    $turno_abierto = "none";
                    $turno_cerrado = "block";
                    $deposito = "block"; elseif ($value['turno'] == 1) :
                        $class = "btn-danger";
                    $texto = "Turno Cerrado";

                    $turno_abierto = "block";
                    $turno_cerrado = "none";
                    $deposito = "none";
                    endif;

                    $arqueo_cajas_turno_abierto = $this->app_model->get_arqueo_cajas_by_usuario_tunoNoAbierto($value['idUsuario']);
                    $idGenArqueo = "'" . $arqueo_cajas_turno_abierto[0]['idGenArqueoCajas'] . "'";

                    //--- Opciones cambio de estado ---//
                    $opcionesTurno = '<li  id="turnoAbierto' . $value['idUsuario'] . '" style="display:' . $turno_abierto . ';" ><a onclick="abrirTurno(' . $value['idUsuario'] . ')" ><i class="fas fa-user-check" style="font-size:1.4em;"></i> Abrir Turno</a></li>' .
                        '<li id="turnoCerrado' . $value['idUsuario'] . '" style="display:' . $turno_cerrado . ';" ><a onclick="cerrarTurno(' . $value['idUsuario'] . ',' . $idGenArqueo . ')" ><i class="fas fa-user-times" style="font-size:1.4em;"></i> Cerrar Turno</a></li>' .
                        '<li id="deposito' . $value['idUsuario'] . '" style="display:' . $deposito . ';" ><a onclick="depositar(' . $value['idUsuario'] . ')" ><i class="far fa-money-bill-alt" style="font-size:1.4em;"></i> Depósito</a></li>';

                    $opcion = '<div class="btn-group">' .
                        '<button id="btn' . $value['idUsuario'] . '" class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                        '<ul class="dropdown-menu icons-right">' .
                        $opcionesTurno .
                        '</ul>' .
                        '</div>';

                    $dato[] = array(
                        $value['idUsuario'],
                        $value['apellido'],
                        $value['nombreCompleto'],
                        $value['nombreNivel'],
                        $opcion,
                        "DT_RowId" => $value['idUsuario']
                    );
                }
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

    public function listar_arqueo_cajas()
    {
        $hoy = getdate();
        $d = $hoy['mday'];
        (($d < 10) ? $d = "0" . $d : $d);
        $m = $hoy['mon'];
        (($m < 10) ? $m = "0" . $m : $m);
        $y = $hoy['year'];
        //--- Fecha ---//
        $fecha = $y . "-" . $m . "-" . $d;
        $fechaHora = $y . "-" . $m . "-" . $d . "00:00:00";

        $primer_movimiento_cajas = $this->app_model->get_movimientos_caja_by_fecha_actual($fecha);
        $ultimo_movimiento_cajas = $this->app_model->get_movimientos_caja_ultimo();
        if ($primer_movimiento_cajas) {
            $valorApertura = $primer_movimiento_cajas[0]['saldoActual'];
        } else {
            $valorApertura = $ultimo_movimiento_cajas[0]['saldoActual'];
        }
        $saldoActualCaja = $ultimo_movimiento_cajas[0]['saldoActual'];
        $apertura = 0;
        $ultimo_arqueo_cajas = $this->app_model->get_arqueo_cajas_ultimo();
        if ($fecha == substr($ultimo_arqueo_cajas[0]['fechaInicioTurno'], 0, 10)) {
            $apertura = 1;
        }

        $this->data['apertura'] = $apertura;
        $this->data['saldoActualCaja'] = $saldoActualCaja;
        $this->data['valorApertura'] = $valorApertura;

        $this->load_view('finanzas/listar_arqueo_cajas', $this->data);
    }

    public function arqueo_cajas_fecha($fecha)
    {
        $fechaI = $fecha . " 00:00:00";
        $fechaF = $fecha . " 23:59:59";

        $primer_movimiento_cajas = $this->app_model->get_primer_movimiento_caja_by_fecha($fechaI, $fechaF);
        $ultimo_movimiento_cajas = $this->app_model->get_movimientos_caja_ultimo_by_fecha($fechaI, $fechaF);

        $aa = array(
            'primer_movimiento_cajas' => $primer_movimiento_cajas[0]['saldoActual'],
            'ultimo_movimiento_cajas' => $ultimo_movimiento_cajas[0]['saldoActual']
        );

        echo json_encode($aa);
    }

    public function listar_arqueo_cajas_table()
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        $hoy = getdate();
        $d = $hoy['mday'];
        (($d < 10) ? $d = "0" . $d : $d);
        $m = $hoy['mon'];
        (($m < 10) ? $m = "0" . $m : $m);
        $y = $hoy['year'];
        //--- Fecha ---//
        $fecha = $y . "-" . $m . "-" . $d;
        $fechaHora = $fecha . " " . "00:00:00";

        //--- datos ---//
        $arqueo_cajas = $this->app_model->get_arqueo_cajas_by_fechaInicio_hoy($fecha);

        if ($arqueo_cajas) {
            foreach ($arqueo_cajas as $key => $value) {
                if ($value['fechaFinTurno'] == "0000-00-00 00:00:00") {
                    $fechaCierre = "Turno sin finalizar";
                } else {
                    $fechaCierre = $value['fechaFinTurno'];
                }

                //--- Margen es el monto esperado menos el monto entregado por le mozo ---//
                $margen = $value['montoFinal'] - $value['montoEsperado'];

                $dato[] = array(
                    $value['idArqueoCajas'],
                    $value['fechaInicioTurno'],
                    $fechaCierre,
                    $value['usuario'],
                    "$" . number_format($value['montoInicial'], 2, ",", "."),
                    "$" . number_format($value['montoFinal'], 2, ",", "."),
                    "$" . number_format($value['montoEsperado'], 2, ",", "."),
                    "$" . number_format($value['pagosEfectivo'], 2, ",", "."),
                    "$" . number_format($margen, 2, ",", "."),
                    "DT_RowId" => $value['idArqueoCajas']
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

    public function listar_arqueo_cajas_table_by_fecha($fecha)
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        $fechaHoraI = $fecha . " " . "00:00:00";
        $fechaHoraF = $fecha . " " . "23:59:59";

        //--- datos ---//
        $arqueo_cajas = $this->app_model->get_arqueo_cajas_by_fechaInicio_rango_dia($fechaHoraI, $fechaHoraF);

        if ($arqueo_cajas) {
            foreach ($arqueo_cajas as $key => $value) {
                if ($value['fechaFinTurno'] == "0000-00-00 00:00:00") {
                    $fechaCierre = "Turno sin finalizar";
                } else {
                    $fechaCierre = $value['fechaFinTurno'];
                }

                //--- Margen es el monto esperado menos el monto entregado por le mozo ---//
                $margen = $value['montoFinal'] - $value['montoEsperado'];

                $dato[] = array(
                    $value['idArqueoCajas'],
                    $value['fechaInicioTurno'],
                    $fechaCierre,
                    $value['usuario'],
                    "$" . number_format($value['montoInicial'], 2, ",", "."),
                    "$" . number_format($value['montoFinal'], 2, ",", "."),
                    "$" . number_format($value['montoEsperado'], 2, ",", "."),
                    "$" . number_format($value['pagosEfectivo'], 2, ",", "."),
                    "$" . number_format($margen, 2, ",", "."),
                    "DT_RowId" => $value['idArqueoCajas']
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

    public function abrir_turno()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $montoInicial = $this->input->post('montoInicial', true);
            $idUsuario = $this->input->post('idUsuario', true);
            //--- idGenArqueCaja del mozo ---//
            $idGenArqueoCajas = substr(md5(microtime()), 15, 17);
            //--- idGenArqueoCaja del inicio de sesion ---//
            $idGenArqueoCajasInicio = substr(md5(microtime()), 15, 17);
            //--- Datos del Logeado ---//
            $userdata = $this->session->all_userdata();

            //--- Obtencion de Fecha ---//
            $hoy = getdate();
            $d = $hoy['mday'];
            (($d < 10) ? $d = "0" . $d : $d);
            $m = $hoy['mon'];
            (($m < 10) ? $m = "0" . $m : $m);
            $y = $hoy['year'];
            $h = $hoy['hours'];
            (($h < 10) ? $h = "0" . $h : $h);
            $min = $hoy['minutes'];
            (($min < 10) ? $min = "0" . $min : $min);
            $s = $hoy['seconds'];
            (($s < 10) ? $s = "0" . $s : $s);
            //--- Fecha ---//
            $fecha = $y . "-" . $m . "-" . $d;
            //--- Fecha Hora ---//
            $fechaHora = $fecha . " " . $h . ":" . $min . ":" . $s;

            $fechaHoraAnt = $fecha . " 00:00:00";

            $cajaNoEmpleado = $this->app_model->get_arqueo_cajas_by_tunoNoAbierto_cajaNoEmpleado();
            //            if ($cajaNoEmpleado) {
            if (($montoInicial >= 0)) {
                //--- Verificamos si el ultimo arqueo registrado corresponde a la fecha actual, si no corresponde entonces agregamos el registro que dara la apertura actual ---//
                $arqueo_cajas_ultimo = [];
                $arqueo_cajas_ultimo = $this->app_model->get_arqueo_cajas_ultimo();

                //--- Ultimo movimiento de caja ---//
                $ultimo_movimientos_caja = $this->app_model->get_movimientos_caja_ultimo();
                $saldo_actual = floatval(0);
                $saldo_actual = floatval($ultimo_movimientos_caja[0]['saldoActual']) - floatval($montoInicial);

                //--- Esta validacion (!$arqueo_cajas_ultimo) se realiza por el motivo que si la tabla esta vacia que se ingrese por ahi ---// 
                if (($montoInicial <= $ultimo_movimientos_caja[0]['saldoActual']) || ($arqueo_cajas_ultimo && count($arqueo_cajas_ultimo) == 0) || (!$arqueo_cajas_ultimo)) {

                    //--- Si no exite es porque no hay cajas no empleados abierta como una caja general y la abrimos ---//
                    if (!$cajaNoEmpleado) {
                        if (!$arqueo_cajas_ultimo) {
                            $saldoActual = 0;
                        } else {
                            $saldoActual = $ultimo_movimientos_caja[0]['saldoActual'];
                        }
                        if ($saldoActual >= 0) {
                            //--- Registro en el arqueo el inicio de la caja ---//
                            $arqueo_cajas = $this->app_model->insert_arqueo_cajas($idGenArqueoCajasInicio, $userdata['idUsuario'], $fechaHora, "00-00-0000 00:00:00", $saldoActual, 0, 0, 0, 0, 0);
                        }
                        $saldo_actual = floatval($ultimo_movimientos_caja[0]['saldoActual']);
                    }

                    $arqueo_cajas_no_cerrado = $this->app_model->get_arqueo_cajas_by_usuario_tunoNoCerrado($idUsuario);

                    if (!$arqueo_cajas_no_cerrado) {

                            //--- Registro del arqueo que se realizo de la caja por la apetura del turno de este usuario ---//
                        $arqueo_cajas = $this->app_model->insert_arqueo_cajas($idGenArqueoCajas, $idUsuario, $fechaHora, "00-00-0000 00:00:00", $montoInicial, 0, 0, $montoInicial, 0, 0);

                        //--- Registrado el egreso de la caja grande para darsela a la caja chica con los siguiente datos pasados por parametros y en el idGenEgresoIngreso esta el id del usuario en este caso con el tipo 4 ---//
                        $caja_ingreso_egreso = $this->app_model->insert_ingreso_egreso_caja_con_saldo_actual(1, $idGenArqueoCajas, 0, $montoInicial, "Caja chica del usuario iniciada", 0, 4, $saldo_actual);

                        //--- Actualizamos al usuarios dejandolo con la posibilidad de que inicie el sistema ---//
                        $turno_usuarios = $this->app_model->update_turno_usuarios($idUsuario, 0);

                        //--- Historico ---//
                        $result_insert_historico = $this->app_model->set_historico(
                            $userdata['idUsuario'],
                            $idUsuario,
                            $tipoAccion = 4,
                            $tipoOperacion = 24,
                            "Se abrío un turno ", //detalle
                                $montoInicial //total
                        );

                        if ($arqueo_cajas && $turno_usuarios && $caja_ingreso_egreso) {
                            $msg = "Turno Abierto";
                            $dato = array("valid" => true, "msg" => $msg, "idUsuario" => $idUsuario, "idGenArqueoCajas" => $idGenArqueoCajas);
                        } else {
                            $msg = "Error al abrir el turno, vuelva a intentarlo";
                            $dato = array("valid" => false, "msg" => $msg);
                        }
                    } else {
                        $msg = "No puede ser abierto el turno solicitado ya que no se encuentra cerrado el ultimo";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "El turno del dia anterior no fue cerrado.";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "El monto inicial no puede ser menor a 0";
                $dato = array("valid" => false, "msg" => $msg);
            }
            //            } else {
            //                $msg = "No se encuentra una caja general abierta";
            //                $dato = array("valid" => false, "msg" => $msg);
            //            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function cerrar_turno()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $montoFinal = $this->input->post('montoFinal', true);
            $idUsuario = $this->input->post('idUsuario', true);
            $idGenArqueoCajas = $this->input->post('idGenArqueoCajas', true);
            //--- Datos del Logeado ---//
            $userdata = $this->session->all_userdata();

            //--- Obtencion de Fecha ---//
            $hoy = getdate();
            $d = $hoy['mday'];
            (($d < 10) ? $d = "0" . $d : $d);
            $m = $hoy['mon'];
            (($m < 10) ? $m = "0" . $m : $m);
            $y = $hoy['year'];
            $h = $hoy['hours'];
            (($h < 10) ? $h = "0" . $h : $h);
            $min = $hoy['minutes'];
            (($min < 10) ? $min = "0" . $min : $min);
            $s = $hoy['seconds'];
            (($s < 10) ? $s = "0" . $s : $s);
            //--- Fecha ---//
            $fecha = $y . "-" . $m . "-" . $d;
            //--- Fecha Hora ---//
            $fechaHora = $fecha . " " . $h . ":" . $min . ":" . $s;

            if (($montoFinal > 0)) {

                //--- Obtencion del turno no abierto ---//
                $arqueo_cajas_no_abierto = $this->app_model->get_arqueo_cajas_by_usuario_tunoNoAbierto($idUsuario);

                if ($arqueo_cajas_no_abierto) {

                    //--- Obtencion de datos ---//
                    $arqueo_cajas = $this->app_model->get_arqueo_cajas_by_idGenArqueoCajas($idGenArqueoCajas);
                    $ingresos_empleado = $this->app_model->get_ingresos_by_idVendedor_fechaEmision($idUsuario, substr($arqueo_cajas[0]['fechaInicioTurno'], 0, 10));
                    $depositos = $this->app_model->get_deposito($idGenArqueoCajas, $arqueo_cajas[0]['fechaInicioTurno']);

                    //--- Ultimo movimiento de caja
                    $ultimo_movimientos_caja = $this->app_model->get_movimientos_caja_ultimo();
                    $saldo_actual = floatval(0);
                    $saldo_actual = floatval($ultimo_movimientos_caja[0]['saldoActual']) + floatval($montoFinal);

                    $pagosEfectivo = 0;
                    if ($ingresos_empleado) {
                        foreach ($ingresos_empleado as $key => $value) {
                            $array_fecha = date_parse($value['fechaAlta']);
                            $array_fechaInicio = date_parse($arqueo_cajas[0]['fechaInicioTurno']);
                            if ($array_fecha['hour'] >= $array_fechaInicio['hour'] && $array_fecha['minute'] >= $array_fechaInicio['minute'] && $array_fecha['second'] >= $array_fechaInicio['second']) {
                                //--- Monto total vendido en efectivo ---//
                                $pagosEfectivo += $value['total'];
                            }
                        }
                    } else {
                        $pagosEfectivo = 0;
                    }

                    //--- Monto total vendido en tarjeta (Por el momento sera en 0 hasta que el sistema soporte esta funcionalizadad) ---//
                    $pagosTarjeta = 0;

                    //--- Es la cantidad de dinero que fue entregando el mozo por seguridad a la caja local ---//
                    if ($depositos) {
                        foreach ($depositos as $key => $values) {
                            $deposito = $values['deposito'];
                        }
                    } else {
                        $deposito = 0;
                    }
                    //--- Monto esperado es la suma entre la plata con la que incio el mozo mas la plata con la que haya vendido en efectivo con la diferencia de lo que ya haya entregado como deposito ---//
                    $montoEsperado = ($arqueo_cajas[0]['montoInicial'] + $pagosEfectivo) - $deposito;

                    //--- registro del arqueo que se realizo de la caja por el cierre del turno de este usuario ---//
                    $update_arqueo_cajas = $this->app_model->update_arqueo_cajas($idGenArqueoCajas, $idUsuario, $arqueo_cajas[0]['fechaInicioTurno'], $fechaHora, $deposito, $montoFinal, $montoEsperado, $pagosEfectivo, $pagosTarjeta);

                    //--- Tesoreria Cuenta del Usuario ---///
                    $tesoreria_cuenta_usuario = $this->app_model->get_tesoreria_cuentas_by_idUsuario($idUsuario);
                    $idCuentaTesoreria = $tesoreria_cuenta_usuario[0]['idCuenta'];

                    //--- Registrado el egreso de la caja grande para darsela a la caja chica con los siguiente datos pasados por parametros y en el idGenEgresoIngreso esta el id del usuario en este caso con el tipo 4 ---//
                    $caja_ingreso_egreso = $this->app_model->insert_ingreso_egreso_caja_con_saldo_actual($idCuentaTesoreria, $idGenArqueoCajas, $montoFinal, 0, "Caja chica del usuario cerrada", 0, 4, $saldo_actual);

                    //--- actualizamos al usuarios dejandolo con la posibilidad de que inicie el sistema ---//
                    $turno_usuarios = $this->app_model->update_turno_usuarios($idUsuario, 1);

                    $arqueo_cajas_actual = $this->app_model->get_arqueo_cajas_by_idGenArqueoCajas($idGenArqueoCajas);

                    //--- Historico ---//
                    $result_insert_historico = $this->app_model->set_historico(
                        $userdata['idUsuario'],
                        $idUsuario,
                        $tipoAccion = 5,
                        $tipoOperacion = 24,
                        "Se cerró un turno", //detalle
                        $montoFinal //total
                    );

                    if ($update_arqueo_cajas && $turno_usuarios && $caja_ingreso_egreso) {
                        $msg = "Turno Cerrado";
                        $dato = array("valid" => true, "msg" => $msg, "idUsuario" => $idUsuario, "montoEsperado" => $arqueo_cajas_actual[0]['montoEsperado'], "montoFinal" => $montoFinal, "idGenArqueoCajas" => $idGenArqueoCajas, "arqueo" => $arqueo_cajas, "Depositos" => $depositos, "Pagos" => $ingresos_empleado);
                    } else {
                        $msg = "Error al abrir el turno";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "No puede ser cerrado el turno solicitado ya que no se encuentra abierto el último";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Error al obtener los datos.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function motivo_faltante()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $motivo = $this->input->post('motivo', true);
            $idGenArqueoCajas = $this->input->post('idGenArqueoCajas', true);

            $arqueo_cajas = $this->app_model->update_motivo_arqueo_cajas($idGenArqueoCajas, $motivo);

            if ($arqueo_cajas) {
                $msg = "Motivo registrado";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al registrar el motivo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function depositar()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $idUsuario = $this->input->post('idUsuario', true);
            $idGenArqueoCajas = $this->input->post('idGenArqueoCajas', true);
            $deposito = $this->input->post('deposito', true);
            //--- Datos del Logeado ---//
            $userdata = $this->session->all_userdata();

            $arqueo_cajas = $this->app_model->get_arqueo_cajas_by_usuario_tunoNoCerrado($idUsuario);
            $idGenArqueoCajas = $arqueo_cajas[0]['idGenArqueoCajas'];
            $montoEsperado = $arqueo_cajas[0]['montoEsperado'] - $deposito;

            $deposito = $this->app_model->insert_deposito($idGenArqueoCajas, $deposito);
            $deposito_arqueo = $this->app_model->update_deposito($idGenArqueoCajas, $montoEsperado);

            //--- Ultimo movimiento de caja
            $ultimo_movimientos_caja = $this->app_model->get_movimientos_caja_ultimo();
            $saldo_actual = floatval(0);
            $saldo_actual = floatval($ultimo_movimientos_caja[0]['saldoActual']) + floatval($deposito);
            //--- Tesoreria Cuenta del Usuario ---///
            $tesoreria_cuenta_usuario = $this->app_model->get_tesoreria_cuentas_by_idUsuario($idUsuario);
            $idCuentaTesoreria = $tesoreria_cuenta_usuario[0]['idCuenta'];
            //--- Registramos el ingreso del deposito a la cuenta corriente ---//
            $caja_ingreso_egreso = $this->app_model->insert_ingreso_egreso_caja_con_saldo_actual($idCuentaTesoreria, $idGenArqueoCajas, $deposito, 0, "Deposito", 0, 4, $saldo_actual);

            //--- Historico ---//
            $result_insert_historico = $this->app_model->set_historico(
                $userdata['idUsuario'],
                $idUsuario,
                $tipoAccion = 6,
                $tipoOperacion = 24,
                "Se realizò un deposito", //detalle
                $deposito //total
            );

            if ($deposito && $deposito_arqueo) {
                $msg = "Deposito registrado";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al registrar el deposito";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function cerrar_caja()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- obtencion de datos ---//
        $idCaja = $this->input->post('idCaja', true);
        $valorApertura = $this->input->post('valorApertura', true);
        $valorCaja = $this->input->post('valorCaja', true);
        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();

        //--- Verificamos el post ---//
        if ($_POST) {
            if ($idCaja && $valorApertura && $valorCaja) {

                //--- turnos cerrados o abiertos ---//
                $caja_turnos_empleados = $this->app_model->get_arqueo_cajas_by_tunoNoAbierto();
                $caja_turnos = $this->app_model->get_arqueo_cajas_by_tunoNoAbierto_cajaNoEmpleado();

                //                if (!$caja_turnos && $caja_turnos[0]['montoInicial'] == $valorApertura) {
                if (!$caja_turnos_empleados) {

                    //--- Obtencion de Fecha ---//
                    $hoy = getdate();
                    $d = $hoy['mday'];
                    (($d < 10) ? $d = "0" . $d : $d);
                    $m = $hoy['mon'];
                    (($m < 10) ? $m = "0" . $m : $m);
                    $y = $hoy['year'];
                    $h = $hoy['hours'];
                    (($h < 10) ? $h = "0" . $h : $h);
                    $min = $hoy['minutes'];
                    (($min < 10) ? $min = "0" . $min : $min);
                    $s = $hoy['seconds'];
                    (($s < 10) ? $s = "0" . $s : $s);
                    //--- Fecha ---//
                    $fecha = $y . "-" . $m . "-" . $d;
                    //--- Fecha Hora ---//
                    $fechaHora = $fecha . " " . $h . ":" . $min . ":" . $s;

                    //--- Update para cerrar la caja en el arqueo ---//
                    $cerrar_caja = $this->app_model->update_arqueo_cajas($caja_turnos[0]['idGenArqueoCajas'], $userdata['idUsuario'], $caja_turnos[0]['fechaInicioTurno'], $fechaHora, $caja_turnos[0]['deposito'], $valorCaja, $valorCaja, 0, 0);

                    if ($cerrar_caja) {

                        //--- Historico ---//
                        $result_insert_historico = $this->app_model->set_historico(
                            $userdata['idUsuario'],
                            $idCaja,
                            $tipoAccion = 5,
                            $tipoOperacion = 24,
                            "Se cerró la caja con " . $valorCaja . " y su valor de apertura fue de " . $valorApertura, //detalle
                            $valorCaja //total
                        );

                        $msg = "Caja cerrada con exito";
                        $dato = array("valid" => true, "msg" => $msg, "caja_turnos" => $caja_turnos);
                    } else {
                        $msg = "La caja general ya se encuentra cerrada";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "Error, turnos abiertos";
                    $dato = array("valid" => false, "msg" => $msg, "caja_turnos" => $caja_turnos);
                }
            } else {
                $msg = "Error, vuelva a intentarlo. No se obtuvieron los datos correctamente.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function detalle_arqueo()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $id = $this->input->post('id', true);

            $arqueo_cajas = $this->app_model->get_arqueo_cajas_by_idArqueoCajas($id);
            $arqueo_cajas_fecha = $this->app_model->get_arqueo_cajas_by_fechaInicio($arqueo_cajas[0]['fechaInicioTurno']);
            $depositos = $this->app_model->get_deposito($arqueo_cajas[0]['idGenArqueoCajas'], $arqueo_cajas[0]['fechaInicioTurno']);

            if ($arqueo_cajas && $arqueo_cajas_fecha) {
                $msg = "Detalle del arqueo obtenido";
                $dato = array("valid" => true, "msg" => $msg, "arqueo_cajas" => $arqueo_cajas, 'arqueo_cajas_fecha' => $arqueo_cajas_fecha, "depositos" => $depositos);
            } else {
                $msg = "Error al obtener el detalle del arqueo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }
}
