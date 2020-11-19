<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Libros extends MY_Controller {

    protected $data = array(
        'active' => 'libros'
    );

    public function __construct() {
        parent::__construct();
    }

    public function listar_libro_iva_ventas() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- declaraciones ---//
        $total = 0;

        //--- datos ---//
        //--- datos de clientes con todos sus datos ---// 
        $ingreso_con_iva = $this->app_model->get_ingresos_con_iva();
        $notas_debito_con_iva = $this->app_model->get_notas_debito_con_iva();
        $nota_credito_con_iva = $this->app_model->get_notas_credito_con_iva();

        //--- datos de clientes sin todos sus datos ---// 
        $ingreso_con_iva_sin_join = $this->app_model->get_ingresos_con_iva_sin_join();
        $notas_debito_con_iva_sin_join = $this->app_model->get_notas_debito_con_iva_sin_join();
        $nota_credito_con_iva_sin_join = $this->app_model->get_notas_credito_con_iva_sin_join();

        if ($ingreso_con_iva && !$ingreso_con_iva_sin_join) {
            $ingreso = $ingreso_con_iva;
        } else if ($ingreso_con_iva_sin_join && !$ingreso_con_iva) {
            $ingreso = $ingreso_con_iva_sin_join;
        } else if ($ingreso_con_iva_sin_join && $ingreso_con_iva) {
            $ingreso = array_merge($ingreso_con_iva_sin_join, $ingreso_con_iva);
        } else if (!$ingreso_con_iva_sin_join && !$ingreso_con_iva) {
            $ingreso = [];
        }

        if ($notas_debito_con_iva && !$notas_debito_con_iva_sin_join) {
            $notas_debito = $notas_debito_con_iva;
        } else if ($notas_debito_con_iva_sin_join && !$notas_debito_con_iva) {
            $notas_debito = $notas_debito_con_iva_sin_join;
        } else if ($notas_debito_con_iva_sin_join && $notas_debito_con_iva) {
            $notas_debito = array_merge($notas_debito_con_iva_sin_join, $notas_debito_con_iva);
        } else if (!$notas_debito_con_iva_sin_join && !$notas_debito_con_iva) {
            $notas_debito = [];
        }

        if ($nota_credito_con_iva && !$nota_credito_con_iva_sin_join) {
            $nota_credito = $nota_credito_con_iva;
        } else if ($nota_credito_con_iva_sin_join && !$nota_credito_con_iva) {
            $nota_credito = $nota_credito_con_iva_sin_join;
        } else if ($nota_credito_con_iva_sin_join && $nota_credito_con_iva) {
            $nota_credito = array_merge($nota_credito_con_iva_sin_join, $nota_credito_con_iva);
        } else if (!$nota_credito_con_iva_sin_join && !$nota_credito_con_iva) {
            $nota_credito = [];
        }

        //--- calculamos el total del iva, se suman el total del iva del egreso y nota de debito restandole el de credito ---//
        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($ingreso) {
            foreach ($ingreso as $key => $value) {
                $total += $value['ivaTotal'];
            }
        }

        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($notas_debito) {
            foreach ($notas_debito as $key => $value) {
                $total += $value['ivaTotal'];
            }
        }

        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($nota_credito) {
            foreach ($nota_credito as $key => $value) {
                $total -= $value['ivaTotal'];
            }
        }

        $this->data['total'] = "$" . number_format($total, 2, ",", ".");

        $this->load_view('libros/listar_libro_iva_ventas', $this->data);
    }

    public function listar_libro_iva_ventas_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- datos ---//
        //--- datos de clientes con todos sus datos ---// 
        $ingreso_con_iva = $this->app_model->get_ingresos_con_iva();
        $notas_debito_con_iva = $this->app_model->get_notas_debito_con_iva();
        $nota_credito_con_iva = $this->app_model->get_notas_credito_con_iva();

        //--- datos de clientes sin todos sus datos ---// 
        $ingreso_con_iva_sin_join = $this->app_model->get_ingresos_con_iva_sin_join();
        $notas_debito_con_iva_sin_join = $this->app_model->get_notas_debito_con_iva_sin_join();
        $nota_credito_con_iva_sin_join = $this->app_model->get_notas_credito_con_iva_sin_join();

        if ($ingreso_con_iva && !$ingreso_con_iva_sin_join) {
            $ingreso = $ingreso_con_iva;
        } else if ($ingreso_con_iva_sin_join && !$ingreso_con_iva) {
            $ingreso = $ingreso_con_iva_sin_join;
        } else if ($ingreso_con_iva_sin_join && $ingreso_con_iva) {
            $ingreso = array_merge($ingreso_con_iva_sin_join, $ingreso_con_iva);
        } else if (!$ingreso_con_iva_sin_join && !$ingreso_con_iva) {
            $ingreso = [];
        }

        if ($notas_debito_con_iva && !$notas_debito_con_iva_sin_join) {
            $notas_debito = $notas_debito_con_iva;
        } else if ($notas_debito_con_iva_sin_join && !$notas_debito_con_iva) {
            $notas_debito = $notas_debito_con_iva_sin_join;
        } else if ($notas_debito_con_iva_sin_join && $notas_debito_con_iva) {
            $notas_debito = array_merge($notas_debito_con_iva_sin_join, $notas_debito_con_iva);
        } else if (!$notas_debito_con_iva_sin_join && !$notas_debito_con_iva) {
            $notas_debito = [];
        }

        if ($nota_credito_con_iva && !$nota_credito_con_iva_sin_join) {
            $nota_credito = $nota_credito_con_iva;
        } else if ($nota_credito_con_iva_sin_join && !$nota_credito_con_iva) {
            $nota_credito = $nota_credito_con_iva_sin_join;
        } else if ($nota_credito_con_iva_sin_join && $nota_credito_con_iva) {
            $nota_credito = array_merge($nota_credito_con_iva_sin_join, $nota_credito_con_iva);
        } else if (!$nota_credito_con_iva_sin_join && !$nota_credito_con_iva) {
            $nota_credito = [];
        }

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($ingreso) {
            foreach ($ingreso as $key => $value) {
                array_push($dato, array(
                    $value["fechaAlta"],
                    ($value['nombEmpresa']) ? $value['nombEmpresa'] : "-",
                    (!empty($value['cuit'])) ? $value['cuit'] : "-",
                    (!empty($value['condicionIva'])) ? $value['condicionIva'] : "-",
                    $value['nroFactura'],
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Venta",
                ));
            }
        }

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($notas_debito) {
            foreach ($notas_debito as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    ($value['nombEmpresa']) ? $value['nombEmpresa'] : "-",
                    (!empty($value['cuit'])) ? $value['cuit'] : "-",
                    (!empty($value['condicionIva'])) ? $value['condicionIva'] : "-",
                    (!empty($value['idNotaDebito'])) ? $value['idNotaDebito'] : "-",
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Nota Débito",
                ));
            }
        }

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($nota_credito) {
            foreach ($nota_credito as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    ($value['nombEmpresa']) ? $value['nombEmpresa'] : "-",
                    (!empty($value['cuit'])) ? $value['cuit'] : "-",
                    (!empty($value['condicionIva'])) ? $value['condicionIva'] : "-",
                    (!empty($value['idNotaCredito'])) ? $value['idNotaCredito'] : "-",
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Nota Crédito",
                ));
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

    public function calculoTotalIvaVenta($fechaInicio = null, $fechaFin = null) {
        //--- declaraciones ---//
        $total = 0;
        $rango = 1;

        //--- datos ---//
        if (($fechaInicio == null && $fechaFin == null) || ($fechaInicio == "" && $fechaFin == "")) {
            $ingreso_con_iva = $this->app_model->get_ingresos_con_iva();
            $notas_debito = $this->app_model->get_notas_debito_con_iva();
            $nota_credito = $this->app_model->get_notas_credito_con_iva();
            $rango = 1;
        } else {
            $ingreso_con_iva = $this->app_model->get_ingresos_con_iva_by_rango_fechas($fechaInicio, $fechaFin);
            $notas_debito = $this->app_model->get_notas_debito_con_iva_con_rango($fechaInicio, $fechaFin);
            $nota_credito = $this->app_model->get_notas_credito_con_iva_con_rango($fechaInicio, $fechaFin);
            $rango = 2;
        }

        //--- calculamos el total del iva, se suman el total del iva del egreso y nota de debito restandole el de credito ---//
        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($ingreso_con_iva) {
            foreach ($ingreso_con_iva as $key => $value) {
                $total += $value['ivaTotal'];
            }
        }

        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($notas_debito) {
            foreach ($notas_debito as $key => $value) {
                $total += $value['ivaTotal'];
            }
        }

        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($nota_credito) {
            foreach ($nota_credito as $key => $value) {
                $total -= $value['ivaTotal'];
            }
        }

        $total = "$" . number_format($total, 2, ",", ".");

        $dato = array("valid" => true, "total" => $total, "conRango" => $rango);

        echo json_encode($dato);
    }

    public function listar_libro_iva_ventas_rango_fechas_table($fechaInicio, $fechaFin) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- datos ---//
        $ingreso_con_iva = $this->app_model->get_ingresos_con_iva_by_rango_fechas($fechaInicio, $fechaFin);
        $notas_debito = $this->app_model->get_notas_debito_con_iva_con_rango($fechaInicio, $fechaFin);
        $nota_credito = $this->app_model->get_notas_credito_con_iva_con_rango($fechaInicio, $fechaFin);

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($ingreso_con_iva) {
            foreach ($ingreso_con_iva as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    $value['nombEmpresa'],
                    $value['cuit'],
                    $value['condicionIva'],
                    $value['nroFactura'],
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Venta",
                ));
            }
        }

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($notas_debito) {
            foreach ($notas_debito as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    $value['nombEmpresa'],
                    $value['cuit'],
                    $value['condicionIva'],
                    $value['idNotaDebito'],
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Nota Débito",
                ));
            }
        }

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($nota_credito) {
            foreach ($nota_credito as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    $value['nombEmpresa'],
                    $value['cuit'],
                    $value['condicionIva'],
                    $value['idNotaCredito'],
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Nota Crédito",
                ));
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

    public function listar_libro_iva_compras() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- declaraciones ---//
        $total = 0;
        //--- datos ---//
        $egreso_con_iva = $this->app_model->get_egresos_con_iva();
        $notas_debito = $this->app_model->get_notas_debito_proveedor_con_iva();
        $nota_credito = $this->app_model->get_notas_credito_proveedor_con_iva();

        //--- calculamos el total del iva, se suman el total del iva del egreso y nota de debito restandole el de credito ---//
        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($egreso_con_iva) {
            foreach ($egreso_con_iva as $key => $value) {
                $total += $value['ivaTotal'];
            }
        }

        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($notas_debito) {
            foreach ($notas_debito as $key => $value) {
                $total += $value['ivaTotal'];
            }
        }

        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($nota_credito) {
            foreach ($nota_credito as $key => $value) {
                $total -= $value['ivaTotal'];
            }
        }

        $this->data['total'] = "$" . number_format($total, 2, ",", ".");

        $this->load_view('libros/listar_libro_iva_compras', $this->data);
    }

    public function listar_libro_iva_compras_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- datos ---//
        $egreso_con_iva = $this->app_model->get_egresos_con_iva();
        $notas_debito = $this->app_model->get_notas_debito_proveedor_con_iva();
        $nota_credito = $this->app_model->get_notas_credito_proveedor_con_iva();

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($egreso_con_iva) {
            foreach ($egreso_con_iva as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    $value['nombEmpresa'],
                    $value['cuit'],
                    $value['condicionIva'],
                    $value['idEgreso'],
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Egreso",
                ));
            }
        }

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($notas_debito) {
            foreach ($notas_debito as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    $value['nombEmpresa'],
                    $value['cuit'],
                    $value['condicionIva'],
                    $value['idNotaDebito'],
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Nota Débito",
                ));
            }
        }

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($nota_credito) {
            foreach ($nota_credito as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    $value['nombEmpresa'],
                    $value['cuit'],
                    $value['condicionIva'],
                    $value['idNotaCredito'],
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Nota Crédito",
                ));
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

    public function calculoTotalIvaCompra($fechaInicio = null, $fechaFin = null) {
        //--- declaraciones ---//
        $total = 0;
        $rango = 1;

        //--- datos ---//
        if (($fechaInicio == null && $fechaFin == null) || ($fechaInicio == "" && $fechaFin == "")) {
            $egreso_con_iva = $this->app_model->get_egresos_con_iva();
            $notas_debito = $this->app_model->get_notas_debito_proveedor_con_iva();
            $nota_credito = $this->app_model->get_notas_credito_proveedor_con_iva();
            $rango = 1;
        } elseif (($fechaInicio != null && $fechaFin != null) || ($fechaInicio != "" && $fechaFin != "")) {
            $egreso_con_iva = $this->app_model->get_egresos_con_iva_con_rango_fecha($fechaInicio, $fechaFin);
            $notas_debito = $this->app_model->get_notas_debito_proveedor_con_iva_con_rango_fecha($fechaInicio, $fechaFin);
            $nota_credito = $this->app_model->get_notas_credito_proveedor_con_iva_con_rango_fecha($fechaInicio, $fechaFin);
            $rango = 2;
        }

        //--- calculamos el total del iva, se suman el total del iva del egreso y nota de debito restandole el de credito ---//
        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($egreso_con_iva) {
            foreach ($egreso_con_iva as $key => $value) {
                $total += $value['ivaTotal'];
            }
        }

        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($notas_debito) {
            foreach ($notas_debito as $key => $value) {
                $total += $value['ivaTotal'];
            }
        }

        //--- validamos si contiene algo y realizamos el calculo ---//
        if ($nota_credito) {
            foreach ($nota_credito as $key => $value) {
                $total -= $value['ivaTotal'];
            }
        }

        $total = "$" . number_format($total, 2, ",", ".");

        $dato = array("valid" => true, "total" => $total, "conRango" => $rango);

        echo json_encode($dato);
    }

    public function listar_libro_iva_compras_rango_fecha_table($fechaIncio, $fechaFin) {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- datos ---//
        $egreso_con_iva = $this->app_model->get_egresos_con_iva_con_rango_fecha($fechaIncio, $fechaFin);
        $notas_debito = $this->app_model->get_notas_debito_proveedor_con_iva_con_rango_fecha($fechaIncio, $fechaFin);
        $nota_credito = $this->app_model->get_notas_credito_proveedor_con_iva_con_rango_fecha($fechaIncio, $fechaFin);

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($egreso_con_iva) {
            foreach ($egreso_con_iva as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    $value['nombEmpresa'],
                    $value['cuit'],
                    $value['condicionIva'],
                    $value['idEgreso'],
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Egreso",
                ));
            }
        }

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($notas_debito) {
            foreach ($notas_debito as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    $value['nombEmpresa'],
                    $value['cuit'],
                    $value['condicionIva'],
                    $value['idNotaDebito'],
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Nota Débito",
                ));
            }
        }

        //--- validamos si contiene algo y armamos los registros para la tabla ---//
        if ($nota_credito) {
            foreach ($nota_credito as $key => $value) {

                array_push($dato, array(
                    $value["fechaAlta"],
                    $value['nombEmpresa'],
                    $value['cuit'],
                    $value['condicionIva'],
                    $value['idNotaCredito'],
                    "$" . number_format($value['total'], 2, ",", "."),
                    "$" . number_format($value['importeNetoNoGravado'], 2, ",", "."),
                    "$" . number_format($value['ivaTotal'], 2, ",", "."),
                    "Nota Crédito",
                ));
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
