<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restaurar_password extends MY_Controller {
	
    public function index($keyPassword = null) {
        $this->data['password'] = false;
        $this->data['active'] = '-';
        
        $result = $this->app_model->check_key_password($keyPassword);
        
        if($result == 1){
            $this->data['keyPassword']= $keyPassword;
            $this->load_view_public('recuperar_password/restaurar_password', $this->data);
        }else{
            $this->load_view_public('recuperar_password/fallado', $this->data);
        }
    }
    
    public function restaurar_password_nuevo($keyPassword = null) {
        $this->data['active'] = '-';

        if($_POST) {
            $password = $this->input->post('password', true);
            $password2 = $this->input->post('password2', true);

            $this->data['password'] = (empty($password) || ($password != $password2)) ? null :  $password;
            
            if ((!empty($this->data['password']))){
                
                $result = $this->app_model->restaurar_password($keyPassword,md5($password));
                
                if($result == 1){
                    //redirect("/recupeperar_password/exitoso");
                    $this->data['success'] = "Exitoso";
                    $this->load_view_public('recuperar_password/exitoso', $this->data);
                }else{
                    
                    //redirect("/recupeperar_password/fallado");
                    $this->data['success'] = "Fallado";
                    $this->load_view_public('recuperar_password/fallado', $this->data);
                    
                }
            }
        }
    }
        
	
}
