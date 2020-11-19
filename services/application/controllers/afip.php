<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Afip extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    private $wsdl;
    private $cert;
    private $privatekey;
    private $passphrase;
    private $proxy_host;
    private $proxy_port;
    private $url;
    # Author: Gerardo Fisanotti - DvSHyS/DiOPIN/AFIP - 13-apr-07
    # Function: Get an authorization ticket (TA) from AFIP WSAA
    # Input:
    #        $wsdl, $cert, $privatekey, $passphrase, SERVICE, $url
    #        Check below for its definitions
    # Output:
    #        TA.xml: the authorization ticket as granted by WSAA.
    #==============================================================================
//    define ("$wsdl", "wsaa.wsdl");     # The $wsdl corresponding to WSAA
//    define ("$cert", "ghf.crt");       # The X.509 certificate in PEM format
//    define ("$privatekey", "ghf.key"); # The private key correspoding to $cert (PEM)
//    define ("$passphrase", "xxxxx"); # The passphrase (if any) to sign
//    define ("$proxy_host", "10.20.152.112"); # Proxy IP, to reach the Internet
//    define ("$proxy_port", "80");            # Proxy TCP port
//    define ("$url", "https://wsaahomo.afip.gov.ar/ws/services/LoginCms");
    #define ("$url", "https://wsaa.afip.gov.ar/ws/services/LoginCms");
    #------------------------------------------------------------------------------
    # You shouldn't have to change anything below this line!!!
    #==============================================================================
//    wsfeca
    
    private function setWsdl(){
        $this->$wsdl= base_url()."assets/afip/wsaa.wsdl";
    }
    private function setCert(){
        $this->$cert= base_url()."assets/afip/certificado.pem";
    }
    private function setPrivateKey(){
        $this->$privatekey= base_url()."assets/afip/NicoTest";
    }
    private function setPassphrase(){
        $this->$passphrase= "";
    }
    private function setProxyHost(){
        $this->$proxy_host= "";
    }
    private function setProxyPort(){
        $this->$proxy_port= "";
    }
    private function setUrl(){
        $this->$url= "https://wsaahomo.afip.gov.ar/ws/services/LoginCms";
    }
    public function index (){
        $this->setWsdl();
        $this->setCert();
        $this->setPrivateKey();
        $this->setPassphrase();
        $this->setProxyHost();
        $this->setProxyPort();
        $this->setUrl();
        
        ini_set("soap.wsdl_cache_enabled", "0");
        if (!file_exists($cert)) {exit("Failed to open ".$cert."\n");}
        if (!file_exists($privatekey)) {exit("Failed to open ".$privatekey."\n");}
        if (!file_exists($wsdl)) {exit("Failed to open ".$wsdl."\n");}
        if ( $argc < 2 ) {ShowUsage($argv[0]); exit();}
        
        $this->CreateTRA("wsfeca");
        $CMS=$this->SignTRA();
        $TA=$this->CallWSAA($CMS);
        if (!file_put_contents("TA.xml", $TA)) {exit();}    
    }
    function CreateTRA($SERVICE){
      $TRA = new SimpleXMLElement(
        '<?xml version="1.0" encoding="UTF-8"?>' .
        '<loginTicketRequest version="1.0">'.
        '</loginTicketRequest>');
      $TRA->addChild('header');
      $TRA->header->addChild('uniqueId',date('U'));
      $TRA->header->addChild('generationTime',date('c',date('U')-60));
      $TRA->header->addChild('expirationTime',date('c',date('U')+60));
      $TRA->addChild('service',$SERVICE);
      $TRA->asXML('TRA.xml');
    }
    #==============================================================================
    # This functions makes the PKCS#7 signature using TRA as input file, $cert and
    # $privatekey to sign. Generates an intermediate file and finally trims the 
    # MIME heading leaving the final CMS required by WSAA.
    function SignTRA(){
      $STATUS=openssl_pkcs7_sign("TRA.xml", "TRA.tmp", "file://".$cert,
        array("file://".$privatekey, $passphrase),
        array(),
        !PKCS7_DETACHED
        );
      if (!$STATUS) {exit("ERROR generating PKCS#7 signature\n");}
      $inf=fopen("TRA.tmp", "r");
      $i=0;
      $CMS="";
      while (!feof($inf)) 
        { 
          $buffer=fgets($inf);
          if ( $i++ >= 4 ) {$CMS.=$buffer;}
        }
      fclose($inf);
    #  unlink("TRA.xml");
      unlink("TRA.tmp");
      return $CMS;
    }
    #==============================================================================
    function CallWSAA($CMS){
      $client=new SoapClient($wsdl, array(
              'proxy_host'     => $proxy_host,
              'proxy_port'     => $proxy_port,
              'soap_version'   => SOAP_1_2,
              'location'       => $url,
              'trace'          => 1,
              'exceptions'     => 0
              )); 
      $results=$client->loginCms(array('in0'=>$CMS));
      file_put_contents("request-loginCms.xml",$client->__getLastRequest());
      file_put_contents("response-loginCms.xml",$client->__getLastResponse());
      if (is_soap_fault($results)) 
        {exit("SOAP Fault: ".$results->faultcode."\n".$results->faultstring."\n");}
      return $results->loginCmsReturn;
    }
    #==============================================================================
    function ShowUsage($MyPath){
      printf("Uso  : %s Arg#1 Arg#2\n", $MyPath);
      printf("donde: Arg#1 debe ser el service name del WS de negocio.\n");
      printf("  Ej.: %s wsfe\n", $MyPath);
    }
    #==============================================================================

    
}