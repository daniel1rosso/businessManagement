<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Localidad extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function buscaLocalidad() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idProvincia = $this->input->post('idProvincia', true);
        $localidades = $this->app_model->get_localidades_by_provincia($idProvincia);

        echo '<option></option>';
        foreach ($localidades as $key) {
            echo '<option value="' . $key['idLocalidad'] . '">' . $key['localidad'] . '</option>';
        }
    }

    public function buscaLocalidadCliente() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idProvincia = $this->input->post('idProvincia', true);
        $localidades = $this->app_model->get_localidades_by_provincia($idProvincia);

        //--- obtenemos el idGenCliente para poder realizar la obtencion de los datos correspondientes al mismo y de esta forma obtener la localidad que sera seleccionada en el modal ---//
        $idGenCliente = $this->input->post('id', true);
        if ($idGenCliente != "") {
            $cliente = $this->app_model->get_info_cliente_byIdGen($idGenCliente);
            $idLocalidad = $cliente[0]['idLocalidad'];
            $idLocalidadFac = $cliente[0]['idLocalidadFacturacion'];
        } else {
            $idLocalidad = "";
            $idLocalidadFac = "";
        }

        $options = '<option></option>';
        foreach ($localidades as $key) {
            $options .= '<option value="' . $key['idLocalidad'] . '">' . $key['localidad'] . '</option>';
        }

        if ($options) {
            $msg = "true";
            $dato = array("valid" => true, "msg" => $msg, "options" => $options, "idLocalidad" => $idLocalidad, "idLocalidadFac" => $idLocalidadFac);
        } else {
            $msg = "false";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function buscaLocalidadProveedor() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idProvincia = $this->input->post('idProvincia', true);
        $localidades = $this->app_model->get_localidades_by_provincia($idProvincia);

        //--- obtenemos el idGenCliente para poder realizar la obtencion de los datos correspondientes al mismo y de esta forma obtener la localidad que sera seleccionada en el modal ---//
        $idGenProveedor = $this->input->post('id', true);
        if ($idGenProveedor != "") {
            $proveedor = $this->app_model->get_info_proveedor_byIdGen($idGenProveedor);
            $idLocalidad = $proveedor[0]['idLocalidad'];
            $idLocalidadFac = $proveedor[0]['idLocalidad'];
        } else {
            $idLocalidad = "";
            $idLocalidadFac = "";
        }

        $options = '<option></option>';
        foreach ($localidades as $key) {
            $options .= '<option value="' . $key['idLocalidad'] . '">' . $key['localidad'] . '</option>';
        }

        if ($options) {
            $msg = "true";
            $dato = array("valid" => true, "msg" => $msg, "options" => $options, "idLocalidad" => $idLocalidad, "idLocalidadFac" => $idLocalidadFac, "idGenProveedor" => $idGenProveedor);
        } else {
            $msg = "false";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
