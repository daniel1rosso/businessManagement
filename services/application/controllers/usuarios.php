<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends MY_Controller {

    protected $data = array(
        'active' => 'usuarios'
    );

    public function __construct() {
        parent::__construct();

        $this->load->helper('ckeditor');

        $this->data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'content',
            'path' => 'js/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "550px", //Setting a custom width
                'height' => '100px', //Setting a custom height
            ),
            //Replacing styles from the "Styles tool"
            'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array(
                    'name' => 'Blue Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Blue',
                        'font-weight' => 'bold'
                    )
                ),
                //Creating a new style named "style 2"
                'style 2' => array(
                    'name' => 'Red Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Red',
                        'font-weight' => 'bold',
                        'text-decoration' => 'underline'
                    )
                )
            )
        );
    }

    public function listar_usuarios() {
        $this->data['active'] = 'usuarios';

        $localidad = $this->app_model->get_localidades();
        $provincia = $this->app_model->get_provincias();
        $nivel = $this->app_model->get_niveles();
        $menuAdmin = $this->app_model->get_menuAdmin();

        foreach ($menuAdmin as $key => $value) {
            $idNivelGen = $value['idNivelGen'];
            //obtengo los nombres del nivel con el menu relacionado y los pongo en un vector
            $menuNivel[$key] = $this->app_model->get_menuNivel($idNivelGen);
        }

        $this->data['menuNivel'] = $menuNivel;
        $this->data['menuAdmin'] = $menuAdmin;
        $this->data['localidad'] = $localidad;
        $this->data['provincia'] = $provincia;
        $this->data['nivel'] = $nivel;

        $this->load_view('usuarios/listar_usuarios', $this->data);
    }

    public function listar_usuarios_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $usuarios = $this->app_model->get_usuarios();

        if ($usuarios) {
            foreach ($usuarios as $key => $value) {

                $opcion = '<a href="#modal-editar-usuario" class="tip modificarUsuario" data-id="' . $value['idUsuario'] . '" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a>' .
                        '&nbsp;' .
                        '<a href="#modal-delete" class="tip deleteUsuario" role="button" data-id="' . $value['idUsuario'] . '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>';

                $dato[] = array(
                    $value['idUsuario'],
                    $value['apellido'] . ', ' . $value['nombreCompleto'],
                    $value['usuario'],
                    $value['email'],
                    $value['nombreNivel'],
                    $opcion,
                    "DT_RowId" => $value['idUsuario']
                );
            }
        }

        $aa = array(
            'sEcho' => 1,
            'iTotalRecords' => count($dato),
            'iTotalDisplayRecords' => 10,
            'aaData' => $dato
        );
        echo json_encode($aa);
    }

    public function add_usuario_post() {

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {


            $nivel = $this->input->post('nivel', true);
            $provincia = $this->input->post('provincia', true);
            $localidad = $this->input->post('localidad', true);
            $nombre = $this->input->post('nombrePersona', true);
            $apellido = $this->input->post('apellido', true);
            $nombreUsuario = $this->input->post('nombreUsuario', true);
            $password = $this->input->post('password', true);
            $email = $this->input->post('email', true);
            $telefono = $this->input->post('telefono', true);
            $menu = json_decode($this->input->post('menu', true));
            $idGeneradoUsuarioMenuAdmin = $this->generarID();
            $idGenCuenta = $this->generarID();

            if (!empty($telefono) && !empty($email) && !empty($localidad) && !empty($provincia) && !empty($nombre) && !empty($apellido) && !empty($nombreUsuario) && !empty($password) && !empty($nivel)) {

                $result = $this->app_model->add_usuario($provincia, $localidad, $nombre, $apellido, $nombreUsuario, md5($password), $nivel, $email, $telefono, $idGeneradoUsuarioMenuAdmin);

                $idUsuario = $this->app_model->get_idGeneradoUsuarioMenuAdmin($idGeneradoUsuarioMenuAdmin);
                //--- Verificamos que sea mozo o vendedor ---//
                if (intval($nivel) == 9 || intval($nivel) == 10) {
                    //--- Agregado de la cuenta de tesoreria (caja chica al vendedor o mozo ---//
                    $caja = $this->app_model->insert_tesoreria_cuentas($idGenCuenta, $idUsuario[0]['idUsuario'], 1, $nombreUsuario, 4);
                }

                $i = 0;
                foreach ($menu as $values) {
                    $result2 = $this->app_model->add_menu_usuario($idUsuario[0]['idUsuario'], $values);
                    $i++;
                }


                if ($result || $i > 0) {
                    $usuario = $this->app_model->get_usuario_info($idUsuario[0]['idUsuario']);
                    
                    $msg = "Se registro correctamente el usuario";
                    $dato = array("valid" => true, "msg" => $msg, "idUsuario" => $idUsuario[0]['idUsuario'], "usuario" => $usuario);
                } else {
                    $msg = "Se produjo un error al registrar el usuario, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Hay un faltante de datos mínimos, completelo y vuelva a intentar";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }


        echo json_encode($dato);
    }

    public function add_usuario_perfil_post() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $id = $this->input->post('idUsuarioAgregar', true);
            $perfil = $this->input->post('fileUserAgregar', true);

            if (!empty($id)) {

                $nombreImg = "";
                $file = 'fileUserAgregar';

                if (!empty($_FILES[$file]['name'])) {
                    $nombreImg = substr(md5(microtime()), 15, 17);
                    $urlCarpeta = './uploads/perfil/' . $nombreImg;
                    if (!file_exists($urlCarpeta)) {
                        mkdir($urlCarpeta, 0700);
                        mkdir($urlCarpeta . '/thumbs', 0700);
                    }

                    $config['upload_path'] = $urlCarpeta . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size'] = '0';
                    $config['overwrite'] = TRUE;


                    $config['file_name'] = $nombreImg;


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($file)) {
                        $error = array('error' => $this->upload->display_errors());
                        $resultIMG = false;
                        $dato = array("valid" => false, "error" => $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $nombreImg = $data['upload_data']['file_name'];
                        $extension = $data['upload_data']['file_ext'];


                        if ($extension != '.pdf') {
                            $imgWidth = $data['upload_data']['image_width'];
                            if ($imgWidth > 1024) {
                                //Creo Risize de la img grande
                                $config2['image_library'] = 'gd2';
                                //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                                $config2['source_image'] = $urlCarpeta . '/' . $nombreImg;
                                //$config2['create_thumb'] = TRUE;
                                $config2['maintain_ratio'] = TRUE;
                                $config2['width'] = 1024;
                                $config2['height'] = 1024;

                                $this->load->library('image_lib', $config2);
                                $this->image_lib->initialize($config2);
                                $this->image_lib->resize();
                            }
                        }
                    }
                }

                $resultImg = $this->app_model->update_usuario_perfil($id, $nombreImg);

                if ($resultImg) {
                    $msg = "Todo ok resultImg";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error BD resultImg";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay POST";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function modificar_usuario_post() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $id = $this->input->post('id', true);
            $nivel = $this->input->post('nivel', true);
            $provincia = $this->input->post('provincia', true);
            $localidad = $this->input->post('localidad', true);
            $nombre = $this->input->post('nombrePersona', true);
            $apellido = $this->input->post('apellido', true);
            $nombreUsuario = $this->input->post('nombreUsuario', true);
            $password = $this->input->post('password', true);
            $email = $this->input->post('email', true);
            $telefono = $this->input->post('telefono', true);
            $ext = $this->input->post('nombreImgModificar', true);
            $menu = json_decode($this->input->post('menu', true));

            if (!empty($id) && !empty($nivel) && !empty($provincia) && !empty($localidad) && !empty($nombre) && !empty($apellido) && !empty($nombreUsuario) && !empty($password) && !empty($email) && !empty($telefono)) {

                $usuario_antes_actualizarse = $this->app_model->get_usuario_byId($id);
                $result = $this->app_model->update_usuario($id, $provincia, $localidad, $nombre, $apellido, $nombreUsuario, md5($password), $nivel, $email, $telefono);

                $this->app_model->delete_usuarioMenuAdmin($id);

                $idUsuarioMenuAdmin = $this->app_model->get_id_usuarioMenuAdmin($id);

                //--- Verificamos que el usuario antes de actualizarse no sea ni mozo, ni vendedor ---//
                if ($usuario_antes_actualizarse[0]['idNivel'] != 9 && $usuario_antes_actualizarse[0]['idNivel'] != 10) {
                    //--- Verificamos que sea mozo o vendedor ---//
                    if (intval($nivel) == 9 || intval($nivel) == 10) {
                        $cuenta_corriente = $this->app_model->get_tesoreria_cuentas_by_idUsuario($id);
                        //--- Verificamos que no tenga una tesoreria_cuentas ---//
                        if (!$cuenta_corriente) {
                            //--- Id Gen ---//
                            $idGenCuenta = $this->generarID();
                            //--- Agregado de la cuenta de tesoreria (caja chica al vendedor o mozo ---//
                            $caja = $this->app_model->insert_tesoreria_cuentas($idGenCuenta, $id, 1, $nombreUsuario, 4);
                        }
                    }
                }

                foreach ($menu as $value) {
                    $result2 = $this->app_model->add_menu_usuario($id, $value);
                }

                if ($result || $result2) {
                    $usuario = $this->app_model->get_usuario_info($id);
                    
                    $msg = "La actualizaciòn de los datos del usuarios se registraron exitosamente";
                    $dato = array("valid" => true, "msg" => $msg, "id" => $id, "usuario" => $usuario);
                } else {
                    $msg = "Error al actualizar los datos del usuario, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay POST";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function modificar_usuario_perfil_post() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $id = $this->input->post('idUsuarioModificar', true);
            $perfil = $this->input->post('perfilUsuarioModificar', true);

            $resultImg = true;

            if (!empty($id)) {

                $file = 'file';
                if (!empty($_FILES[$file]['name'])) {
                    $nombreImg = substr(md5(microtime()), 15, 17);
                    $urlCarpeta = './uploads/perfil/' . $nombreImg;
                    if (!file_exists($urlCarpeta)) {
                        mkdir($urlCarpeta, 0700);
                        mkdir($urlCarpeta . '/thumbs', 0700);
                    }

                    $config['upload_path'] = $urlCarpeta . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size'] = '0';
                    $config['overwrite'] = TRUE;

                    $config['file_name'] = $nombreImg;


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($file)) {
                        $error = array('error' => $this->upload->display_errors());
                        $resultIMG = false;

                        $dato = array("valid" => false, "error" => $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $nombreImg = $data['upload_data']['file_name'];
                        $extension = $data['upload_data']['file_ext'];


                        if ($extension != '.pdf') {
                            $imgWidth = $data['upload_data']['image_width'];
                            if ($imgWidth > 1024) {
                                //Creo Risize de la img grande
                                $config2['image_library'] = 'gd2';
                                //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                                $config2['source_image'] = $urlCarpeta . '/' . $nombreImg;
                                //$config2['create_thumb'] = TRUE;
                                $config2['maintain_ratio'] = TRUE;
                                $config2['width'] = 1024;
                                $config2['height'] = 1024;

                                $this->load->library('image_lib', $config2);
                                $this->image_lib->initialize($config2);
                                $this->image_lib->resize();
                            }
                        }
                    }
                    $resultImg = $this->app_model->update_usuario_perfil($id, $nombreImg);
                }


                if ($resultImg) {
                    $msg = "Todo ok resultImg";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error BD resultImg";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay POST";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_usuario() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idUsuario = $this->input->post('id', true);
        $msg = "";

        if (!empty($idUsuario)) {

            $result = $this->app_model->delete_usuario_by_idUsuario($idUsuario);

            if ($result) {
                $msg = "El usuario fue eliminado con exito";
                $dato = array("valid" => true, "msg" => $msg, "id" => $idUsuario);
            } else {
                $msg = "Error al eliminar el usuario";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Id vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_usuario_byId() {

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {

            $id = $this->input->post('id', true);

            if (!empty($id)) {
                $result = $this->app_model->get_usuario_byId($id);

                $str = $result[0]['imgPerfil'];
                $nombreImg = explode('.', $str);
//                echo $nombreImg[0];


                if ($result) {
                    $msg = "Todo ok";
                    $dato = array("valid" => true, "msg" => $msg, "usuario" => $result, "nombreImagenPerfil" => $nombreImg);
                } else {
                    $msg = "Error BD";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay POST";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
