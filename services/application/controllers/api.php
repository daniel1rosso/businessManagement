<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        //--- RECIBIR PETICIONES DESDE CUALQUIER LADO ---//
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        
        /*
            if (isset($_SERVER['HTTP_ORIGIN'])) {  
                header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");  
                header('Access-Control-Allow-Credentials: true');  
                header('Access-Control-Max-Age: 86400');   
            }  

            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {  

                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))  
                    //header("Access-Control-Allow-Methods: POST");  
                    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  

                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))  
                    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");  
            }
        */   
    }
    
}
