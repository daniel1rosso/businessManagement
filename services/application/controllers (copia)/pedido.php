<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedido extends MY_Controller {

    protected $data = array(
        'active' => 'pedido'
    );
    
    public function add_mesa() {
        header("Access-Control-Allow-Origin: *");  
        header('Access-Control-Allow-Credentials: true');  
        
        if($_POST) {
            $descripcion = $this->input->post('inputDescripcion_formAddMesa', true);
            
            if( !empty($descripcion) ) {
                $msg="Datos vacios";
                $dato = array("valid"=>false,"msg"=>$msg); 
            } else {
                $result = $this->app_model->insert_mesa( $descripcion );
                if( $result ){                
                    $mesa = $this->app_model->get_mesa_byDescripcion( $descripcion );
                    if($mesa){
                        $msg="Registro agregado";
                        $dato = array("valid"=>true,"msg"=>$msg,"id" => $mesa[0]['id'], 'descripcion' => $descripcion);             
                    }  
                }else{
                    $msg="Error al procesar registro";
                    $dato = array("valid"=>false,"msg"=>$msg);                
                }              
            }
        } else {
            $msg="No hay post";
            $dato = array("valid"=>false,"msg"=>$msg);  
        }   
        
        echo json_encode($dato);
    }
    
    public function listar_mesas() {
        $this->load_view('pedido/listar_mesas', $this->data);
    }
    
    public function listar_mesas_table() {
        $mesas = $this->app_model->get_mesas(1);
        foreach ($mesas as $key => $value) {
            $dato[] = array(                  
                $value['id'],
                $value['descripcion'],
                '<a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_mesa" data-id="' . $value['id'] . '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>'
                . '&nbsp;'
                . '<a onclick="show_update_mesa(' . $value['id'] . ',' . $value['descripcion'] . ')" data-toggle="modal" class="tip update_mesa" data-id="' . $value['id'] . '" data-descripcion="' . $value['descripcion'] . '" data-toggle="modal" data-original-title="Editar">'
                . '<i class="icon-pencil3"></i></a>',
                "DT_RowId" => $value['id'],
            );           
        }

        $aa = array(
            'sEcho' => 1,
            'iTotalRecords' => count($dato),
            'iTotalDisplayRecords' => 10,
            'aaData' => $dato
        );

        echo json_encode($aa);
    }
    
    public function update_mesa() {
        header("Access-Control-Allow-Origin: *");  
        header('Access-Control-Allow-Credentials: true');  
        
        if($_POST) {
            $id = $this->input->post('inputIdMesa_formUpdateMesa', true);
            $descripcion = $this->input->post('inputDescripcion_formUpdateMesa', true);
            
            if( !empty($id) && !empty($descripcion) ) {
                $msg="Datos vacios";
                $dato = array("valid"=>false,"msg"=>$msg); 
            } else {
                $result = $this->app_model->update_mesa( $id, $descripcion );
                if( $result ){
                    $msg="Registro actualizado";
                    $dato = array("valid"=>true,"msg"=>$msg, 'id'=>$id, 'descripcion'=>$descripcion);
                }else{
                    $msg="Error al procesar la actualización de los datos";
                    $dato = array("valid"=>false,"msg"=>$msg);                
                }              
            }
        } else {
            $msg="No hay post";
            $dato = array("valid"=>false,"msg"=>$msg);  
        }   
        
        echo json_encode($dato);
    }
    
    public function eliminar_mesa() {
        header("Access-Control-Allow-Origin: *");  
        header('Access-Control-Allow-Credentials: true');  
        
        if($_POST) {
            $id = $this->input->post('id', true);
            
            if( !empty($id) ) {
                $msg="Datos vacios";
                $dato = array("valid"=>false,"msg"=>$msg); 
            } else {
                $result = $this->app_model->delete_mesa( $id );
                if( $result ){
                    $msg="Registro eliminado";
                    $dato = array("valid"=>true,"msg"=>$msg, 'id'=>$id);
                }else{
                    $msg="Error al procesar la eliminacion del registro";
                    $dato = array("valid"=>false,"msg"=>$msg);                
                }              
            }
        } else {
            $msg="No hay post";
            $dato = array("valid"=>false,"msg"=>$msg);  
        }   
        
        echo json_encode($dato);
    }
    
    public function add_mozo(){
        $this->load_view('pedido/add_mozo', $this->data);
    }
    
    public function listar_mozo() {
        $this->load_view('pedido/listar_mozos', $this->data);
    }

}