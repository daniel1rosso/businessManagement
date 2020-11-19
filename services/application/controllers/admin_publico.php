<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_publico extends MY_Controller {
    
    public function index() {
        $data['user'] = false;			
        $data['password'] = false;	
        $this->load_view_public_admin('login_public', $data);
    }

    public function login() {
        $user = $this->input->post('username', true);
        $password = $this->input->post('password', true);
		
		
        if(empty($user) || empty($password)) {
            $data['user'] = (empty($user)) ? null :  $user;			
            $data['password'] = (empty($password)) ? null : $password;		            
            
            $this->load_view_public_admin('login_public', $data);					
        } else {
            $result = $this->app_model->compare_user_password_public_admin($user, $password);				

            if($result) {
                $user_session = array(
                    'idPasajero'  => $result[0]['idPasajero'],
                    'nombreCompleto' => $result[0]['nombre'],			
                    'apellido' => $result[0]['apellido'],			
                    'email' => $result[0]['email'],
                    'dni' => $result[0]['dni'],
                    'idNivel' => 6,
                    'logged_in' => true
                );
                $this->session->set_userdata($user_session);
                $this->userdata = $user_session;
                $data['idPasajero'] =$result[0]['idPasajero'];
                //$data['usuario'] =$user_session;
                $data['active'] ='';
                
                
                redirect('/dashboard_public/index');
                //$this->load_view_public_admin('dashboard_public', $data);
    
            } else {
                $data['user'] = $user;	

                $this->load_view_public_admin('login_public', $data);					
            }
        }			
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('/admin_publico');
    }
   
}