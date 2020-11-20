<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactenos extends MY_Controller{
    
    public function index() {
        $this->data['active'] = 'contacto';
        $this->load_view_public_admin('contactenos',$this->data);
    }
    
    public function contact_form(){
            
            if($_POST) {
                $name = $this->input->post('name', true);
                $motivo = $this->input->post('motivo', true);
                $telefono = $this->input->post('telefono', true);
                $empresa = $this->input->post('empresa', true);
                $email = $this->input->post('email', true);
                $mensaje = $this->input->post('mensaje', true);

                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $subject = $name;
                    // To send HTML mail, the Content-type header must be set.
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From:' . $email. "\r\n"; // Sender's Email
                    $headers .= 'Cc:' . $email. "\r\n"; // Carbon copy to Sender
                    $template = '<div style="padding:50px; color:white;"><br/>'
                    . 'Nombre:' . $name . '<br/>'
                    . 'Motivo:' . $motivo . '<br/>'
                    . 'Telefono:' . $telefono . '<br/>'
                    . 'Empresa:' . $empresa . '<br/>'
                    . 'Correo:' . $email . '<br/>'
                    . 'Mensaje:' . $mensaje . '<br/><br/>';
                    $sendmessage = "<div style=\"background-color:#7E7E7E; color:white;\">" . $template . "</div>";
                    // Message lines should not exceed 70 characters (PHP rule), so wrap it.
                    $sendmessage = wordwrap($sendmessage, 70);
                    // Send mail by PHP Mail Function.
                    mail("iacchldo@gmail.com", $subject, $sendmessage, $headers);
                    echo "Gracias por contactarnos. Su consulta nos interesa.";
                } else {
                    echo "<span>Correo incorrecto</span>";
                }
            }
    }    
    
}

