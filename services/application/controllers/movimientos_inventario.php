<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movimientos_Inventario extends MY_Controller{
    
    protected $data = array(
        'active' => 'movimientos_inventario'
    );      
    
    public function __construct() {
        parent::__construct();
    }
    
    public function listar_movimientos_inventario() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        
        $this->load_view('movimientos/listar_movimientos_inventario', $this->data);
    }
    
    
    public function listar_movimientos_inventario_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $movimientos_stock = $this->app_model->get_movimientos_inventario();

        if ($movimientos_stock) {
            foreach ($movimientos_stock as $key => $value) {
                if ($value['aumento'] == 0) {
                    $aumento = "Aumentó";
                } else {
                    $aumento = "Disminuyó";
                }
                $nombreApellido = $value['apellidoVend'] . ", " . $value['nombreVend'];
                $dato[] = array(
                    $value['nombreProducto'],
                    $aumento,
                    $value['tipoMovimiento'],
                    $value['cantidad'],
                    $nombreApellido,
                    $value['fechaAlta'],
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