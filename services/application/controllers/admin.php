<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
    
    public function index() {
        $data['user'] = false;			
        $data['password'] = false;	
        $this->load_view('login', $data);
    }

    public function login() {
        $user = $this->input->post('username', true);
        $password = $this->input->post('password', true);		
        if(empty($user) || empty($password)) {
            $data['user'] = (empty($user)) ? null :  $user;			
            $data['password'] = (empty($password)) ? null : $password;		
            $this->load_view('login', $data);					
        } else {
            $result = $this->app_model->compare_user_password($user, md5($password));				
            if($result) {
                $user_session = array(
                    'idUsuario'  => $result[0]['idUsuario'],
                    'idArea'  => $result[0]['idArea'],
                    'apellido' => $result[0]['apellido'],			
                    'nombreCompleto' => $result[0]['nombreCompleto'],	
                    'email' => $result[0]['email'],
                    'usuario' => $result[0]['usuario'],
                    'idNivel' => $result[0]['idNivel'],
                    'logged_in' => true
                );
                $this->app_model->set_log_usuario($user_session['idUsuario'],$user_session['nombreCompleto'].' '.$user_session['apellido'],$result[0]['idNivel']);				
                
                $this->session->set_userdata($user_session);
                $this->userdata = $user_session;

                redirect('/dashboard');
            } else {
                $data['user'] = $user;					
                $this->load_view('login', $data);					
            }
        }			
    }
    
    public function logout() {
        $this->session->sess_destroy();  
        redirect('/admin');
    }
    public function busca_menuAdmin() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idNivel = $this->input->post('idNivel', true);


        //traigo todos los idGenMenuNivel donde aparezca el idNivel que le paso por parametro, con eso obtengo los menuAdmin
        //este no va en un for por que el idNivel es uno solo
        $menu_nivel = $this->app_model->get_menuNivel_by_idNivel($idNivel);
        //print_r($menu_nivel);
        //este  va a ir en un for por  que puede ser mas de un menu

        $arrayEncode = [];
        foreach ($menu_nivel as $key => $value) {
            $menuAdmin[$key] = $this->app_model->get_menuAdmin_by_Nivel($value['idGenMenuNivel']);
            array_push($arrayEncode, $menuAdmin[$key]);
        }

        //print_r($arrayEncode);

        echo json_encode($arrayEncode);
    }
    public function busca_localidad() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idProvincia = $this->input->post('idProvincia', true);
        $localidades = $this->app_model->get_localidades_by_provincia($idProvincia);

        echo '<option></option>';
        foreach ($localidades as $key) {
            echo '<option value="' . $key['idLocalidad'] . '">' . $key['localidad'] . '</option>';
        }
    } 
    public function buscar_localidad($idProvincia) {
        $localidades = $this->app_model->get_localidades_byIdProvincia($idProvincia);
        $this->data['localidad']->$localidades;
    }    
}
