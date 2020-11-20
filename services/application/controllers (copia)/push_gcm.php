<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Push_gcm extends MY_Controller {
    
    public function index() {
        // API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AIzaSyCHDrDxTHe1Wiibd0S11ZHz0bkVrHB8Zd4' );
        
        $nroMicroNotificacion = $this->input->post('nroMicroNotificacion', true);
        $mensajeNotificaciones = $this->input->post('mensajeNotificaciones', true);
        if(!empty($nroMicroNotificacion) && !empty($mensajeNotificaciones)){
            

            $result = $this->app_model->get_idMicro($nroMicroNotificacion);
            $regIDs = $this->app_model->get_regIDs($result[0]['idMicro']);
            
            if($regIDs){
                
                foreach ($regIDs as $key => $value){
                    $registrationIds[$key]          = $value['regID'];
                }                
                //$registrationIds = array( 'e5rVJcMBLQw:APA91bFwyqo2CIdH_hIiuna6VS8f7ktvc7wPL1rz944g-hh8Zlze6CqAPwPUsf_w770ndJpn3oiOCcNTp8h9pqhLZOj50MMWUmm9zDGvMpyaKhywBsvz74owLS_HqlqmPtHy0v8Pdm01' );
                // prep the bundle
                $msg = array
                (
                        'message' 	=> ''.$mensajeNotificaciones.'',
                        'title'		=> ''.$mensajeNotificaciones.'',
                        'subtitle'	=> ''.$mensajeNotificaciones.'',
                        'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
                        'vibrate'	=> 1,
                        'sound'		=> 1,
                        'largeIcon'	=> 'https://ibin.co/2t1lLdpfS06F.png',
                        'smallIcon'	=> 'https://ibin.co/2t1lLdpfS06F.png'
                );
                $fields = array
                (
                        'registration_ids' 	=> $registrationIds,
                        'data'			=> $msg
                );

                $headers = array
                (
                        'Authorization: key=' . API_ACCESS_KEY,
                        'Content-Type: application/json'
                );

                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch );
                curl_close( $ch );
                
                $result= json_decode($result);
                
                //$result1 = $this->app_model->insert_notificacion($nroMicroNotificacion,$mensajeNotificaciones);
                
                if($result->success != 0){
                    $result1 = $this->app_model->insert_notificacion($nroMicroNotificacion,$mensajeNotificaciones);
                    echo true;
                }else{
                    echo false;
                }
            }
        }
    }

}
