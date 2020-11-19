<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configuracion_Sistema extends MY_Controller {

    protected $data = array(
        'active' => 'configuracion_sistema'
    );

    public function __construct() {
        parent::__construct();
    }

    public function listar_configuracion_sistema() {
        $this->data['paises'] = $this->app_model->get_paises();
        
        $this->data['provincias'] = $this->app_model->get_provincias();
        
        $this->data['iva_condiciones'] = $this->app_model->get_iva_condiciones();
        
        $this->data['tipo_moneda'] = $this->app_model->get_tipo_moneda();
        
        $this->data['condicion_facturacion'] = $this->app_model->get_condicion_facturacion();
        
        $empresasLocalidadProvincia = $this->app_model->get_empresas();
        $empresasLocalidad = $this->app_model->get_empresas_sin_localidad_provincia();
        if ($empresasLocalidadProvincia && $empresasLocalidad) {
            $empresas = array_merge($empresasLocalidadProvincia, $empresasLocalidad);
        } else if (!$empresasLocalidadProvincia && $empresasLocalidad) {
            $empresas = $empresasLocalidad;
        } else if ($empresasLocalidadProvincia && !$empresasLocalidad) {
            $empresas = $empresasLocalidadProvincia;
        } else if (!$empresasLocalidadProvincia && !$empresasLocalidad) {
            $empresas = [];
        }
        
        $this->data['empresa'] = $empresas;
        
        $this->data['tesoreria_cuentas'] = $this->app_model->get_tesoreria_cuentas();

        $this->load_view('configuracion_sistema/listar_configuracion_sistema', $this->data);
    }

    public function configuracion_sistemas() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Guardo ---//
        if ($_POST) {
            //--- Datos ---//
            $id = $this->input->post('id_formConfiguracionSistema', true);
            $nombre = $this->input->post('inputNombre_formConfiguracionSistema', true);
            $nombreEmpesa = $this->input->post('inputNombreEmpesa_formConfiguracionSistema', true);
            $cuit = $this->input->post('inputCuit_formConfiguracionSistema', true);
            $tipoMoneda = $this->input->post('selectTipoMoneda_formConfiguracionSistema', true);
            $correo = $this->input->post('inputCorreo_formConfiguracionSistema', true);
            $direccion = $this->input->post('inputDomicilio_formConfiguracionSistema', true);
            $inicioActividad = $this->input->post('inputInicioActividad_formConfiguracionSistema', true);
            $iibb = $this->input->post('inputIibb_formConfiguracionSistema', true);
            $tipoAnteAfip = $this->input->post('selectTipoAnteAfip_formConfiguracionSistema', true);
            $puntoVenta = $this->input->post('inputPuntoVenta_formConfiguracionSistema', true);
            $numTel = $this->input->post('inputNumTel_formConfiguracionSistema', true);
            $numCel = $this->input->post('inputNumCel_formConfiguracionSistema', true);
            $pais = $this->input->post('selectPais_formConfiguracionSistema', true);
            $provincia = $this->input->post('selectProvincia_formConfiguracionSistema', true);
            $localidad = $this->input->post('selectLocalidad_formConfiguracionSistema', true);
            $facturaElectronica = $this->input->post('selectFacturaElectronica_formConfiguracionSistema', true);
            $razonSocial = $this->input->post('inputRazonSocial_formConfiguracionSistema', true);
            $token = $this->input->post('inputToken_formConfiguracionSistema', true);
            $condicionFacturacion = $this->input->post('selectCondicionFacturacion_formConfiguracionSistema', true);
            $certificado = $this->input->post('inputCertificado_formConfiguracionSistema', true);
            $stock = $this->input->post('selectStock_formConfiguracionSistema', true);
            $arqueo = $this->input->post('selectArqueo_formConfiguracionSistema', true);
            $caja = $this->input->post('selectCaja_formConfiguracionSistema', true);

            //--- Declaracion de variables ---//
            $img_config_sistema = false;
            $insert_configuracion_sistema = false;
            $update_configuracion_sistema = false;

            $localidadText = "";

            if ($pais != 13) {
                $localidad = 0;
                $provincia = 0;
                $localidadText = $this->input->post('inputLocalidad_formConfiguracionSistema', true);
            }
            

            if ( (!empty($cuit) && !empty($iibb) && !empty($puntoVenta) && !empty($razonSocial) && isset($condicionFacturacion) && $facturaElectronica == 0 && !empty($caja)) || (!empty($razonSocial) && isset($condicionFacturacion) && $facturaElectronica == 1 && !empty($caja)) ) {
                
                //--- Aca obtenemos las empresas dependiendo si tienen o no la localidades y provincia segun el pais que tiene seleccionado ---//
                $empresasLocalidadProvincia = $this->app_model->get_empresas();
                $empresasLocalidad = $this->app_model->get_empresas_sin_localidad_provincia();
                if ($empresasLocalidadProvincia && $empresasLocalidad) {
                    $configuracion_sistema = array_merge($empresasLocalidadProvincia, $empresasLocalidad);
                } else if (!$empresasLocalidadProvincia && $empresasLocalidad) {
                    $configuracion_sistema = $empresasLocalidad;
                } else if ($empresasLocalidadProvincia && !$empresasLocalidad) {
                    $configuracion_sistema = $empresasLocalidadProvincia;
                } else if (!$empresasLocalidadProvincia && !$empresasLocalidad) {
                    $configuracion_sistema = "";
                }

                if (!$configuracion_sistema) {
                    //--- Insert configuraciones del sistema ---//
                    $insert_configuracion_sistema = $this->app_model->insert_configuracion_sistema($nombre, $nombreEmpesa, $cuit, $tipoMoneda, $correo, $direccion, $inicioActividad, $iibb, $tipoAnteAfip, $puntoVenta, $numTel, $numCel, $pais, $provincia, $localidad, $localidadText, $facturaElectronica, $razonSocial, $condicionFacturacion, $stock, $arqueo, $token, $certificado, $caja);
                } else {
                    //--- Update configuraciones del sistema ---//
                    $update_configuracion_sistema = $this->app_model->update_configuracion_sistema($id, $nombre, $nombreEmpesa, $cuit, $tipoMoneda, $correo, $direccion, $inicioActividad, $iibb, $tipoAnteAfip, $puntoVenta, $numTel, $numCel, $pais, $provincia, $localidad, $localidadText, $facturaElectronica, $razonSocial, $condicionFacturacion, $stock, $arqueo, $token, $certificado);
                }
                
//
                //--- Guardo Imagen - Config Sistema ---//
                if (!empty($_FILES['fileImagen_formConfiguracionSistema']['name'])) {
                    if (!file_exists('./uploads/logo/')) {
                        mkdir('./uploads/logo/', 0777, true);
                    }
                    $config['upload_path'] = './uploads/logo/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '0';
                    $config['overwrite'] = TRUE;
                    $nombreImg = substr(md5(microtime()), 15, 17);
                    $config['file_name'] = $nombreImg;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('fileImagen_formConfiguracionSistema')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $nombreImg = $data['upload_data']['file_name'];

                        //Creo el thumb
                        $config3['image_library'] = 'gd2';
                        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                        $config3['source_image'] = './uploads/logo/' . $nombreImg;
                        $config3['width'] = 200;
                        $config3['height'] = 200;

                        $this->load->library('image_lib', $config3);
                        $this->image_lib->initialize($config3);
                        $this->image_lib->resize();
                    }

                    $img_config_sistema = $this->app_model->update_logo_empresa($id, $nombreImg);
                }

                if ($arqueo == 0) {
                    $this->app_model->update_arqueo_menu(36, 0);
                } elseif ($arqueo == 1) {
                    $this->app_model->update_arqueo_menu(36, 1);
                }

                $userdata = $this->session->all_userdata();
                $idVendedor = $userdata['idUsuario'];
                //--- Guardo - Historico ---//
                $result_insert_historico = $this->app_model->set_historico(
                        $idVendedor, $id, $tipoAccion = 2, $tipoOperacion = 23, "Se modificó la configuracion del sistema", //detalle
                        0 //montoCobro
                );

                if ($update_configuracion_sistema || $img_config_sistema || $insert_configuracion_sistema) {
                    $msg = "Su configuración del sistema fue realizada con exito.";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Se produjo un error al actualizar la configuracion del sistema, vuelva a intentarlo.";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "No llego correctamente la razon social, vuelva a intentarlo.";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_empresa() {
        $empresa = $this->app_model->get_empresas();
        $dato = array("empresa" => $empresa);

        echo json_encode($dato);
    }

}
