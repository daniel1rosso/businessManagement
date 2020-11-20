<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tesoreria extends MY_Controller{

    protected $data = array(
        'active' => 'tesoreria'
    );    
    
    public function __construct() {
        parent::__construct();
        parent::datosFormCuentaTesoreria();
    }
    
    public function listar_saldos() {
        
        $tesoreriaCuenta = $this->app_model->get_tesoreria_cuentas();
        $this->data['tesoreriaCuenta'] = $tesoreriaCuenta;
        
        $totalCuenta = 0;
        $totalAcobrar = 0;
        $totalApagar = 0;
        $totalDisponibleCajas = 0;
        $totalDisponibleBancos = 0;
                
        $saldoCtaCteClientes = $this->app_model->get_saldo_cta_cte_clientes();
        $cobrarCtaCteClientes = 0;
        if($saldoCtaCteClientes){
            foreach ($saldoCtaCteClientes as $key => $value) {
               $cobrarCtaCteClientes = $value['aCobrar'] + $cobrarCtaCteClientes;           
            }	
        }
        $this->data['cobrarCtaCteClientes'] = $cobrarCtaCteClientes;
        
        $saldoCtaCteProveedores = $this->app_model->get_saldo_cta_cte_proveredores();
        $cobrarCtaCteProveedores = 0;
        if($saldoCtaCteProveedores){
            foreach ($saldoCtaCteProveedores as $key => $value) {
               $cobrarCtaCteProveedores = $value['aPagar'] + $cobrarCtaCteProveedores;           
            }	
        }
        $this->data['cobrarCtaCteProveedores'] = $cobrarCtaCteProveedores;
        
        $gastosPendientes= $this->app_model->get_gastos_pendientes();
        $cobrarGastos = 0;
        if($gastosPendientes){
            foreach ($gastosPendientes as $key => $value) {
               $cobrarGastos = $value['montoGasto'] + $cobrarGastos;           
            }	
        }
        $this->data['cobrarGastos'] = $cobrarGastos;
        
        $aCobrar = $this->app_model->get_saldo_a_cobrar();
        if($aCobrar){
            foreach ($aCobrar as $key => $value) {
                $this->data['aCobrar'][$key]['idTipoCuenta']      = $value['idTipoCuenta'];
                $this->data['aCobrar'][$key]['descripcion'] = $value['descripcion'];
                $this->data['aCobrar'][$key]['totalCuenta']      = $totalCuenta;
                
                $cuentas = $this->app_model->get_saldo_cta_cte_clientes_by_idTipoCuenta($value['idCuenta']);
                if($cuentas){
                    foreach ($cuentas as $keyCuenta => $value) {
                        $totalCuenta = $totalCuenta + $value['credito'];
                    }	
                    $this->data['aCobrar'][$key]['totalCuenta']      = $totalCuenta;
                }
                
                $totalAcobrar = $totalCuenta + $totalAcobrar;
                $totalCuenta = 0;
            }	
        }      
        $this->data['totalAcobrar'] = $totalAcobrar + $cobrarCtaCteClientes;
        
        $aPagar = $this->app_model->get_saldo_a_pagar();
        if($aPagar){
            foreach ($aPagar as $key => $value) {
                $this->data['aPagar'][$key]['idTipoCuenta']      = $value['idTipoCuenta'];
                $this->data['aPagar'][$key]['descripcion'] = $value['descripcion'];
                $this->data['aPagar'][$key]['totalCuenta']      = $totalCuenta;
                
                $cuentas = $this->app_model->get_saldo_cta_cte_proveedores_by_idTipoCuenta($value['idCuenta']);
                if($cuentas){
                    foreach ($cuentas as $keyCuenta => $value) {
                        $totalCuenta = $totalCuenta + $value['pague'];
                    }	
                    $this->data['aPagar'][$key]['totalCuenta']      = $totalCuenta;
                }
                
                $totalApagar = $totalCuenta + $totalApagar;
                $totalCuenta = 0;
            }	
        }       
        $this->data['totalApagar'] = $totalApagar + $cobrarCtaCteProveedores + $cobrarGastos;
        
        $disponibleCajas = $this->app_model->get_saldo_disponible_cajas();
        if($disponibleCajas){
            foreach ($disponibleCajas as $key => $value) {
                $this->data['disponibleCajas'][$key]['idTipoCuenta']      = $value['idTipoCuenta'];
                $this->data['disponibleCajas'][$key]['descripcion'] = $value['descripcion'];
                $this->data['disponibleCajas'][$key]['totalCuenta']      = $totalCuenta;
                
                $cuentas = $this->app_model->get_saldo_cta_cte_clientes_by_idTipoCuenta($value['idCuenta']);
                if($cuentas){
                    foreach ($cuentas as $keyCuenta => $value) {
                        $totalCuenta = $totalCuenta + $value['credito'];
                    }	
                    $this->data['disponibleCajas'][$key]['totalCuenta']      = $totalCuenta;
                }
                
                $totalDisponibleCajas = $totalCuenta + $totalDisponibleCajas;
                $totalCuenta = 0;
            }	
        }      
        $this->data['totalDisponibleCajas'] = $totalDisponibleCajas;        
        
        $disponibleBancos = $this->app_model->get_saldo_disponible_bancos();
        if($disponibleBancos){
            foreach ($disponibleBancos as $key => $value) {
                $this->data['disponibleBancos'][$key]['idTipoCuenta']      = $value['idTipoCuenta'];
                $this->data['disponibleBancos'][$key]['descripcion'] = $value['descripcion'];
                $this->data['disponibleBancos'][$key]['totalCuenta']      = $totalCuenta;
                
                $cuentas = $this->app_model->get_saldo_cta_cte_clientes_by_idTipoCuenta($value['idCuenta']);
                if($cuentas){
                    foreach ($cuentas as $keyCuenta => $value) {
                        $totalCuenta = $totalCuenta + $value['credito'];
                    }	
                    $this->data['disponibleBancos'][$key]['totalCuenta']      = $totalCuenta;
                }
                
                $totalDisponibleBancos = $totalCuenta + $totalDisponibleBancos;
                $totalCuenta = 0;
            }	
        }      
        $this->data['totalDisponibleBancos'] = $totalDisponibleBancos; 
        $this->data['totalDisponible'] = $totalDisponibleCajas + $totalDisponibleBancos; 
        
        $this->load_view('tesoreria/listar_saldos', $this->data);
    }                  
    
    public function get_movimientos_by_fecha(){
        header("Access-Control-Allow-Origin: *");  
        header('Access-Control-Allow-Credentials: true');  
        
        $fechaDesde = $this->input->post('fechaDesde', true);
        $fechaHasta = $this->input->post('fechaHasta', true);
        $msg="";
        
        if (!empty($fechaDesde) AND !empty($fechaHasta)) {
            $tipo_cuenta = $this->app_model->get_tesoreria_tipo_cuenta();	
            if($tipo_cuenta){
                foreach ($tipo_cuenta as $key => $value) {
                    $this->data['tipo_cuenta'][$key]['idTipoCuenta']      = $value['idTipoCuenta'];
                    $this->data['tipo_cuenta'][$key]['descripcion'] = $value['descripcion'];

                    $cuentas = $this->app_model->get_tesoreria_cuentas_by_idTipoCuenta($value['idTipoCuenta']);
                    if($cuentas){
                        foreach ($cuentas as $keyCuenta => $value) {
                            $this->data['tipo_cuenta'][$key]['cuentas'][$keyCuenta]['idGenCuenta']      = $value['idGenCuenta'];
                            $this->data['tipo_cuenta'][$key]['cuentas'][$keyCuenta]['idCuenta']      = $value['idCuenta'];
                            $this->data['tipo_cuenta'][$key]['cuentas'][$keyCuenta]['descripcionCuenta']      = $value['descripcion'];
                        }	
                    }            
                }	
                $msg="Ok";
                $dato = array("valid"=>true,"msg"=>$msg,"cuenta"=>$tipo_cuenta);                   
            }else{
                $msg="Error al obtener datos";
                $dato = array("valid"=>false,"msg"=>$msg);    
            }
        }else{
            $msg="Debe completar ambas fechas";
            $dato = array("valid"=>false,"msg"=>$msg);    
        }
        
        echo json_encode($dato);
    } 
    
    public function listar_cuentas() {
        $tipo_cuenta = $this->app_model->get_tesoreria_tipo_cuenta();	
        if($tipo_cuenta){
            foreach ($tipo_cuenta as $key => $value) {
                $this->data['tipo_cuenta'][$key]['idTipoCuenta']      = $value['idTipoCuenta'];
                $this->data['tipo_cuenta'][$key]['descripcion'] = $value['descripcion'];
                
                $cuentas = $this->app_model->get_tesoreria_cuentas_by_idTipoCuenta($value['idTipoCuenta']);
                if($cuentas){
                    foreach ($cuentas as $keyCuenta => $value) {
                        $this->data['tipo_cuenta'][$key]['cuentas'][$keyCuenta]['idGenCuenta']      = $value['idGenCuenta'];
                        $this->data['tipo_cuenta'][$key]['cuentas'][$keyCuenta]['idCuenta']      = $value['idCuenta'];
                        $this->data['tipo_cuenta'][$key]['cuentas'][$keyCuenta]['descripcionCuenta']      = $value['descripcion'];
                    }	
                }            
            }	
        }

        $this->load_view('tesoreria/listar_cuentas', $this->data);
    }                  
    
    public function get_info_cuenta_tesoreria() {
        header("Access-Control-Allow-Origin: *");  
        header('Access-Control-Allow-Credentials: true');  
        
        $idGenCuenta = $this->input->post('id', true);
        $msg="";
        
        if (!empty($idGenCuenta)) {
            $cuenta = $this->app_model->get_cuenta_tesoreria_byIdGen($idGenCuenta);	
            if($cuenta){
                $msg="Ok";
                $dato = array("valid"=>true,"msg"=>$msg,"cuenta"=>$cuenta);                   
            }else{
                $msg="Error al obtener datos";
                $dato = array("valid"=>false,"msg"=>$msg);    
            }
        }else{
            $msg="No hay post";
            $dato = array("valid"=>false,"msg"=>$msg);    
        }
        
        echo json_encode($dato);
    } 
    
    public function set_cuenta_tesoreria() {
        header("Access-Control-Allow-Origin: *");  
        header('Access-Control-Allow-Credentials: true');  
     
        //--- Guardo ---//
        if($_POST) {
            $inputNombCuenta = $this->input->post('inputNombCuenta', true);          
            $selectTipoCuenta = $this->input->post('selectTipoCuenta', true);       
            
            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];       
            
            $idGenCuenta = $this->generarID();  

            if(
                empty($inputNombCuenta) OR            
                empty($selectTipoCuenta) 
            ){
                $msg="Datos vacios";
                $dato = array("valid"=>false,"msg"=>$msg); 
            }else{
                
                //--- Guardo - Cuenta Tesoreria ---//
                $result_insert_cuenta = $this->app_model->insert_cuenta_tesoreria(
                                    $idGenCuenta,
                                    $idUsuario,
                                    $inputNombCuenta,
                                    $selectTipoCuenta
                                );           

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                                    $idUsuario,
                                    $idGenCuenta,
                                    $tipoAccion=1,
                                    $tipoOperacion=7,
                                    $inputNombCuenta, //detalle
                                    $total=0
                                );                 
                
                if(
                        $result_insert_cuenta && 
                        $result_insert_historico
                    ){                
                    $cuenta = $this->app_model->get_cuenta_tesoreria_byIdGen($idGenCuenta);
                    if($cuenta){
                        $msg="Registro agregado";
                        $dato = array("valid"=>true,"msg"=>$msg,"cuenta"=>$cuenta);             
                    }  
                }else{
                    $msg="Error al procesar registro";
                    $dato = array("valid"=>false,"msg"=>$msg);                
                }              
            }
        }else{
            $msg="No hay post";
            $dato = array("valid"=>false,"msg"=>$msg);  
        }   
        
        echo json_encode($dato);
    }

    public function set_movimiento() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            $inputFechaMovimiento = $this->input->post('inputFechaMovimiento', true);          
            $montoMovimiento = $this->input->post('montoMovimiento', true);       
            $selectCuentaSalida = $this->input->post('selectCuentaSalida', true);       
            $selectCuentaEntrada = $this->input->post('selectCuentaEntrada', true);       
            $descripcionMovimiento = $this->input->post('descripcionMovimiento', true);       

            if(
                !empty($montoMovimiento) OR            
                !empty($selectCuentaSalida) OR            
                !empty($selectCuentaEntrada) OR            
                !empty($descripcionMovimiento) 
            ) {
                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];

                //--- Fecha del nuevo cobro ---//
                if (empty($inputFechaMovimiento)) {
                    $fechaMovimiento = date("Y-m-d");
                } else {
                    $fechaMovimiento = $inputFechaMovimiento;
                }
                
                $estadoCaja = $this->app_model->get_estado_caja_by_idCaja($selectCuentaSalida);
                $ingreso = 0;
                $egreso = 0;
                //Calculo todos credito y debito de esa deuda en particular
                foreach ($estadoCaja as $key => $value) {
                    $ingreso += $value['ingreso'];
                    $egreso += $value['egreso'];
                }
                
                $saldoCaja = $ingreso - $egreso;
                
                if($saldoCaja > 0 && $saldoCaja > $montoMovimiento){
                    $result = $this->app_model->insert_ingreso_egreso_caja(
                            $idCaja = $selectCuentaSalida, 
                            $idGenIngreso = 0, 
                            $ingreso = 0,
                            $egreso = $montoMovimiento,
                            $descripcionMovimiento,
                            $idTipo = 3 //indica Movimiento de cuentas
                    );
                    $result2 = $this->app_model->insert_ingreso_egreso_caja(
                            $idCaja = $selectCuentaEntrada, 
                            $idGenIngreso = 0, 
                            $ingreso = $montoMovimiento,
                            $egreso = 0,
                            $descripcionMovimiento,
                            $idTipo = 3 //indica Movimiento de cuentas
                    );


                    if ($result) {
                        $msg = "Registro agregado";
                        $dato = array("valid" => true, "msg" => $msg, "saldoCaja" => $saldoCaja);
                    } else {
                        $msg = "Error al procesar registro";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                    
                } else {
                    $msg = "El saldo de la caja no es suficiente";
                    $dato = array("valid" => false, "msg" => $msg, "saldoCaja" => $saldoCaja);
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
    public function update_cuenta_tesoreria() {
        header("Access-Control-Allow-Origin: *");  
        header('Access-Control-Allow-Credentials: true');  
     
        //--- Guardo ---//
        if($_POST) {
            $inputIdCuenta = $this->input->post('inputIdCuenta', true);          
            $inputNombCuenta = $this->input->post('inputNombCuenta', true);          
            $selectTipoCuenta = $this->input->post('selectTipoCuenta', true);              
            
            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];        

            if(
                empty($inputIdCuenta) OR            
                empty($inputNombCuenta) OR            
                empty($selectTipoCuenta)        
            ){
                $msg="Datos vacios";
                $dato = array("valid"=>false,"msg"=>$msg); 
            }else{
                //--- Actualizo - Cuenta Tesoreria ---//
                $result_update_cuenta = $this->app_model->update_cuenta_tesoreria(
                                    $inputIdCuenta,
                                    $idUsuario,
                                    $inputNombCuenta,
                                    $selectTipoCuenta
                                );

                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                                    $idUsuario,
                                    $inputIdCuenta,
                                    $tipoAccion=2,
                                    $tipoOperacion=7,
                                    $inputNombCuenta, //detalle
                                    $total=0
                                );                 
                
                if(
                        $result_update_cuenta || 
                        $result_insert_historico
                    ){                
                    $cuenta = $this->app_model->get_cuenta_tesoreria_byIdGen($inputIdCuenta);
                    if($cuenta){
                        $msg="Registro actualizado";
                        $dato = array("valid"=>true,"msg"=>$msg,"cuenta"=>$cuenta);             
                    }  
                }else{
                    $msg="Error al actualizar registro";
                    $dato = array("valid"=>false,"msg"=>$msg);                
                }              
            }
        }else{
            $msg="No hay post";
            $dato = array("valid"=>false,"msg"=>$msg);  
        }   
        
        echo json_encode($dato);
    }
    
    public function eliminar_cuenta_tesoreria() {
        header("Access-Control-Allow-Origin: *");  
        header('Access-Control-Allow-Credentials: true');  
        
        $userdata = $this->session->all_userdata();
        $idUsuario = $userdata['idUsuario'];        
        
        $idGenCuenta = $this->input->post('id', true);
        $msg="";
        
        if (!empty($idGenCuenta)) {
            //--- Guardo - Historico ---//
            $result_insert_historico = $this->app_model->set_historico(
                                $idUsuario,
                                $idGenCuenta,
                                $tipoAccion=3,
                                $tipoOperacion=7,
                                $detalle='', //detalle
                                $total=0
                            );                  
            
            //--- Borro Cuenta Tesoreria ---//            
            $result_eliminar_cuenta = $this->app_model->eliminar_cuenta_tesoreria($idGenCuenta);	
        
            if(
                    $result_eliminar_cuenta && 
                    $result_insert_historico
                ){                
                $msg="Registro eliminado";
                $dato = array("valid"=>true,"msg"=>$msg);    
            }else{
                $msg="Error al eliminar registro";
                $dato = array("valid"=>false,"msg"=>$msg);    
            }
        }else{
            $msg="No hay post";
            $dato = array("valid"=>false,"msg"=>$msg);    
        }
        
        echo json_encode($dato);
    }      
}
