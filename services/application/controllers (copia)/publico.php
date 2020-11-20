<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publico extends MY_Controller{

    public function index($success=null) {		
        $data['password'] = false;       

        if(!isset($success)){
            $this->data['success'] = "ok";
        }else{
            $this->data['success'] = null;
        }

        $this->data['active'] = "inicio";
        
        $this->load_view_public('index', $this->data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/publico');
    }
    
    public function correo_contacto(){
        if($_POST) {
            $name = $this->input->post('name', true);
            $email = $this->input->post('email', true);
            $message = $this->input->post('message', true);

            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                
                $subject = "Contacto";
                // To send HTML mail, the Content-type header must be set.
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: '.$name.' <'.$email.'>' . "\r\n"; // Sender's Email
                //$headers .= "To: Reparadito <noresponder@mutualiac.com.ar>\n";
                $headers .= "X-Priority: 1\n"; 
                $headers .= "X-MSMail-Priority: High\n"; 
                $headers .= "X-Mailer: PHP/" . phpversion() . " \r\n";    
                //$headers .= 'Cc: info@independienteac.com.ar, \rn';
                //$headers .= 'Cc: contacto@telepathicsoft.com.ar,';

                $template = '<div style="padding:50px; color:white;"><br/>'
                . 'Nombre:' . $name . '<br/>'
                . 'Correo:' . $email . '<br/>'
                . 'Mensaje:' . $message . '<br/>';
                $sendmessage = "<div style=\"background-color:#7E7E7E; color:white;\">" . $template . "</div>";                 
                
                //info@independienteac.com.ar
                //damianmarrone@outlook.com
                //ayudas@independienteac.com.ar
                //independienteac@futurnet.com.ar
                mail('iacchldo@gmail.com', utf8_decode($subject), utf8_decode($sendmessage), utf8_decode($headers), '-fnoresponder@mutualiac.com.ar');                
                
                echo "1";
            } else {
                echo "0";
            }
        }
    }      

}
