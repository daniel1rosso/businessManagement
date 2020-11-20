<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Historial extends MY_Controller{
    
    protected $data = array(
        'active' => 'historial'
    );      
    
    public function __construct() {
        parent::__construct();
    }
    
    public function listar_operaciones() {
        
        
        $this->load_view('historial/listar_operaciones', $this->data);
    }
    
    
    public function listar_operaciones_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $operaciones = $this->app_model->get_historico();

        if ($operaciones) {
            foreach ($operaciones as $key => $value) {
                
                $dato[] = array(
                    $value['nombreCompleto'],
                    $value['descripcionTipo'],
                    $value['descripcionOperacion'],
                    "$" . number_format($value['total'], 2, ",", "."),
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
