<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configuracion_Ecommerce extends MY_Controller {

    protected $data = array(
        'active' => 'configuracion_ecommerce'
    );

    public function listar_configuracion_ecommerce() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->data['configuracion_ecommerce'] = $this->app_model->get_configuracion_ecommerce();
        $configuraciones_ecommercer_imagen = $this->app_model->get_configuracion_ecommerce_imagenes();
        if (!$configuraciones_ecommercer_imagen) {
            $configuraciones_ecommercer_imagen = "";
        }
        $this->data['configuracion_ecommerce_imagen'] = $configuraciones_ecommercer_imagen;
        $envios_costos = $this->app_model->get_envios_costos();
        $this->data['envios_costos'] = $envios_costos;

        //--- Buscamos el ultimo id ---//
        if ($envios_costos) {
            foreach ($envios_costos as $key => $value) {
                $id = $value['idEnvioCosto'];
            }
        } else {
            $id = "";
        }

        $this->data['id'] = $id;

        $this->load_view('configuracion_ecommerce/listar_configuracion_ecommerce', $this->data);
    }

    public function guardar_configuracion_ecommerce() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        if ($_POST) {
            //--- Datos ---//
            //--- Configuraciones Principales ---//
            $configuracion_ecommerce = $this->app_model->get_configuracion_ecommerce();
            $idGenConfiguracionEcommerce = $configuracion_ecommerce[0]['idGenConfiguracionEcommerce'];
            $titulo = $this->input->post('inputTitulo_formConfiguracionEcommerce', true);
            $nombreEmpresa = $this->input->post('inputNombreEmpesa_formConfiguracionEcommerce', true);
            $facebook = $this->input->post('inputFecebook_formConfiguracionEcommerce', true);
            $colorSecundario = $this->input->post('inputColorSecundario_formConfiguracionEcommerce', true);
            $colorTexto = $this->input->post('inputColorTexto_formConfiguracionEcommerce', true);
            $whatsapp = $this->input->post('inputWhatsApp_formConfiguracionEcommerce', true);
            $twitter = $this->input->post('inputTwitter_formConfiguracionEcommerce', true);
            $colorEnlacePrincipal = $this->input->post('inputColorEnlacePrincipal_formConfiguracionEcommerce', true);
            $productoEcommerce = $this->input->post('selectProductoEcommerce_formConfiguracionEcommerce', true);
            //--- Envios ---//
            $selectTarifaInternacional = $this->input->post('selectTarifaInternacional_formConfiguracionEcommerce', true);
            $inputTarifaInternacional = $this->input->post('inputTarifaInternacional_formConfiguracionEcommerce', true);
            $selectTarifaNacional = $this->input->post('selectTarifaNacional_formConfiguracionEcommerce', true);
            $inputTarifaNacional = $this->input->post('inputTarifaNacional_formConfiguracionEcommerce', true);
            $selectTarifaCadeteria = $this->input->post('selectTarifaCadeteria_formConfiguracionEcommerce', true);
            $inputTarifaCadeteria = $this->input->post('inputTarifaCadeteria_formConfiguracionEcommerce', true);
            $inputCantidadCuadras = $this->input->post('inputCantidadCuadras_formConfiguracionEcommerce', true);
            $selectTarifaMercadoEnvio = $this->input->post('selectTarifaMercadoEnvio_formConfiguracionEcommerce', true);
            $inputTarifaMercadoEnvio = $this->input->post('inputTarifaMercadoEnvio_formConfiguracionEcommerce', true);
            $selectTarifaMercadoEnvio = $this->input->post('selectTarifaMercadoEnvio_formConfiguracionEcommerce', true);
            $inputTarifaMercadoEnvio = $this->input->post('inputTarifaMercadoEnvio_formConfiguracionEcommerce', true);
            //--- Pagos ---//
            $selectPagosEfectivo = $this->input->post('selectPagosEfectivo_formConfiguracionEcommerce', true);
            $selectPagosEfectivoContraEntrega = $this->input->post('selectPagosEfectivoContraEntrega_formConfiguracionEcommerce', true);
            $selectPagosMercadoPago = $this->input->post('selectPagosMercadoPago_formConfiguracionEcommerce', true);

            $file = 'fileImagen_formConfiguracionEcommerce';
            if (!empty($_FILES[$file]['name'])) {
                $nombreImgLogo = substr(md5(microtime()), 15, 17);

                $urlCarpeta = './uploads/ecommerce/logo/';
                if (!file_exists($urlCarpeta)) {
                    mkdir($urlCarpeta, 0700);
                }

                $config['upload_path'] = $urlCarpeta . '/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '0';
                $config['overwrite'] = TRUE;

                $config['file_name'] = $nombreImgLogo;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($file)) {
                    $error = array('error' => $this->upload->display_errors());
                    $resultIMG = false;

                    $dato = array("valid" => false, "error" => $error);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $nombreImgLogo = $data['upload_data']['file_name'];
                    $extension = $data['upload_data']['file_ext'];

                    $imgWidth = $data['upload_data']['image_width'];

                    //--- config sola para las img ---//
                    $config3['width'] = 100;
                    $config3['height'] = 100;

                    //Creo el thumb
                    $config3['image_library'] = 'gd2';
                    //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                    $config3['source_image'] = './uploads/ecommerce/logo/' . $nombreImgLogo;
                    $config3['maintain_ratio'] = TRUE;

                    $this->load->library('image_lib', $config3);
                    $this->image_lib->initialize($config3);
                    $this->image_lib->resize();
                }
                $nombreExtension = $nombreImgLogo;
                $this->app_model->update_configuracion_ecommerce_logo($idGenConfiguracionEcommerce, $nombreImgLogo);
            }

            //--- Configuracion del e-commerce ---//
            $configuracion_ecommerce_exitencia = $this->app_model->get_configuracion_ecommerce();
            if (!$configuracion_ecommerce_exitencia) {    
                $idGenConfiguracionEcommerce = substr(md5(microtime()), 15, 17);
                $result_configuracion_ecommerce = $this->app_model->insert_configuracion_ecommerce($idGenConfiguracionEcommerce, $titulo, $nombreEmpresa, $whatsapp, $facebook, $twitter, $colorEnlacePrincipal, $colorSecundario, $colorTexto, $productoEcommerce, $selectTarifaInternacional, $inputTarifaInternacional, $selectTarifaNacional, $inputTarifaNacional, $selectTarifaCadeteria, $selectTarifaMercadoEnvio, $inputTarifaMercadoEnvio, $selectPagosEfectivo, $selectPagosEfectivoContraEntrega, $selectPagosMercadoPago);
                
                //--- Imagenes ---//
                for ($index = 0; $index < 5; $index++) {
                    $this->app_model->insert_configuracion_ecommerce_imagen($idGenConfiguracionEcommerce, "", $index);
                }
            } else {
                $result_configuracion_ecommerce = $this->app_model->update_configuracion_ecommerce($idGenConfiguracionEcommerce, $titulo, $nombreEmpresa, $whatsapp, $facebook, $twitter, $colorEnlacePrincipal, $colorSecundario, $colorTexto, $productoEcommerce, $selectTarifaInternacional, $inputTarifaInternacional, $selectTarifaNacional, $inputTarifaNacional, $selectTarifaCadeteria, $selectTarifaMercadoEnvio, $inputTarifaMercadoEnvio, $selectPagosEfectivo, $selectPagosEfectivoContraEntrega, $selectPagosMercadoPago);
            }
            
            //--- Tarifas de envios ---//
            for ($i = 0; $i < 100; $i++) {
                $inputTarifaCadeteria_formConfiguracionEcommerce[] = $this->input->post('inputTarifaCadeteria_formConfiguracionEcommerce' . $i, true);
                $inputCantidadCuadras_formConfiguracionEcommerce[] = $this->input->post('inputCantidadCuadras_formConfiguracionEcommerce' . $i, true);
                if ($inputTarifaCadeteria_formConfiguracionEcommerce[$i] != null && $inputTarifaCadeteria_formConfiguracionEcommerce[$i] != null) {
                    $envio_costo = $this->app_model->get_envios_costos_by_id($i);
                    if ($envio_costo) {
                        $this->app_model->update_envio_costo($i, $inputTarifaCadeteria_formConfiguracionEcommerce[$i], $inputCantidadCuadras_formConfiguracionEcommerce[$i], $inputCantidadCuadras_formConfiguracionEcommerce[$i] . " Cuadras");
                    } else {
                        $this->app_model->insert_envio_costo($i, $inputTarifaCadeteria_formConfiguracionEcommerce[$i], $inputCantidadCuadras_formConfiguracionEcommerce[$i], $inputCantidadCuadras_formConfiguracionEcommerce[$i] . " Cuadras");
                    }
                }
            }

            //--- Guardo - Historico ---//
            $userdata = $this->session->all_userdata();
            $idVendedor = $userdata['idUsuario'];
            $result_insert_historico = $this->app_model->set_historico(
                    $idVendedor, $idGenConfiguracionEcommerce, $tipoAccion = 2, $tipoOperacion = 22, "Se modificó la configuracion del e-commerce", //detalle
                    0 //montoCobro
            );


            if ($result_insert_historico) {
                $msg = "La configuración e-commerce fue guardada con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al guardar la configuración del e-commerce, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg, "result_configuracion_ecommerce" => $result_configuracion_ecommerce);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function obtener_nombre_imagen($id, $operacion) {
        $nombreImgImagenBanner = "";
        $borrado = false;
        $idVacio = false;
        $count = 0;
        $condiguracionEcommerceImg = $this->app_model->get_configuracion_ecommerce_imagenes();
        $idGenConfiguracionEcommerce = $condiguracionEcommerceImg[0]['idGenConfiguracionEcommerce'];

        foreach ($condiguracionEcommerceImg as $key => $value) {
            if ($value['nombre'] != "") {
                $count += 1;
            } else {
                $idVacio = $value['posicion'];
            }
        }

        if ($operacion == 3) {
            $borrado = $this->app_model->drop_configuracion_ecommerce_imagen($idGenConfiguracionEcommerce, $id);
        } else {
            if ($count < 5) {
                $file = 'fileImagenBanner_formConfiguracionEcommerce' . $id;
                if (!empty($_FILES[$file]['name'])) {
                    $nombreImgImagenBanner = substr(md5(microtime()), 15, 17);

                    $urlCarpeta = './uploads/ecommerce/banner/';
                    if (!file_exists($urlCarpeta)) {
                        mkdir($urlCarpeta, 0700);
                    }

                    $config['upload_path'] = $urlCarpeta . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '0';
                    $config['overwrite'] = TRUE;

                    $config['file_name'] = $nombreImgImagenBanner;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($file)) {
                        $error = array('error' => $this->upload->display_errors());
                        $resultIMG = false;

                        $dato = array("valid" => false, "error" => $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $nombreImgImagenBanner = $data['upload_data']['file_name'];
                        $extension = $data['upload_data']['file_ext'];

                        $imgWidth = $data['upload_data']['image_width'];

                        //--- config sola para las img ---//
                        $config3['width'] = 1335;
                        $config3['height'] = 400;

                        //Creo el thumb
                        $config3['image_library'] = 'gd2';
                        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                        $config3['source_image'] = './uploads/ecommerce/banner/' . $nombreImgImagenBanner;
                        $config3['maintain_ratio'] = TRUE;

                        $this->load->library('image_lib', $config3);
                        $this->image_lib->initialize($config3);
                        $this->image_lib->resize();
                    }

                    $nombreExtension = $nombreImgImagenBanner;

//                if ($operacion == 1) {
//                    $this->app_model->insert_configuracion_ecommerce_imagen($idGenConfiguracionEcommerce, $nombreImgImagenBanner, $id);
//                } elseif ($operacion == 2) {
                    $this->app_model->update_configuracion_ecommerce_imagen($idGenConfiguracionEcommerce, $nombreImgImagenBanner, $idVacio);
//                }
                }
            } else {
                $dato = array("valid" => false, "msg" => "Usted a llegado a la carga maxima de imagenes para el banner");
            }
        }


        if ($borrado || $nombreImgImagenBanner != "") {
            $dato = array("valid" => true, "id" => $id, "nombreImg" => $nombreImgImagenBanner);
        } else {
            $dato = array("valid" => false, "msg" => "Se produjo un error al cargar la imagen, vuelva a intentarlo", "id" => $idVacio, "nombreImg" => $nombreImgImagenBanner, "urlCarpeta" => $urlCarpeta, "file" => $file);
        }

        echo json_encode($dato);
    }

    public function count_img_configuracion_ecommerce() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Declaracion y peticion de get ---//
        $count = 0;
        $imgs = $this->app_model->get_configuracion_ecommerce_imagenes();

        //--- recorremos y contamos la cantidad de registros sin nombre ---//
        foreach ($imgs as $key => $value) {
            if ($value['nombre'] != "") {
                $count += 1;
            }
        }

        $dato = array("valid" => true, "count" => $count);

        echo json_encode($dato);
    }

    public function envios_costos_configuracion_ecommerce() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Declaracion y peticion de get ---//
        $count = 0;
        $envios_costos = $this->app_model->get_envios_costos();

        //--- Buscamos el ultimo id ---//
        foreach ($envios_costos as $key => $value) {
            $id = $value['idEnvioCosto'];
        }

        $id += 1;

        $dato = array("valid" => true, "envios_costos" => $envios_costos, "longitud" => count($envios_costos), "idProximo" => $id);

        echo json_encode($dato);
    }

    public function delete_envio_costo() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $id = $this->input->post('id', true);

        if ($id) {

            $drop_envios_costos = $this->app_model->drop_envios_costos($id);

            if ($drop_envios_costos) {
                $dato = array("valid" => true, "msg" => "Se pudo remover con exito", "id" => $id);
            } else {
                $dato = array("valid" => false, "msg" => "No pudo se removido con exito, vuelva a intentarlo");
            }
        } else {
            $dato = array("valid" => false, "msg" => "No se contiene el id para realizar la operación, vuelva a intentarlo", "id" => $id);
        }



        echo json_encode($dato);
    }

}
