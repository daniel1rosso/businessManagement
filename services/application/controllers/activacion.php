<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activacion extends MY_Controller {
	
	public function index($codigoActivacion = null) {
           
            $result = $this->app_model->activacion_email($codigoActivacion);
           
                if ($result == 1){             
                    redirect('/publico/email_activado/1');
                }else{
                    redirect('/publico/email_activado/0');
                }

	}
	
	
}
