<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MenuAdmin extends MY_Controller
{
    protected $data = array(
        'active' => 'menuAdmin'
    );

    public function __construct()
    {
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

    public function listar_menuAdmin()
    {
        $nivel = $this->app_model->get_niveles();
        $tipoInterna = $this->app_model->get_tipoInterna();

        $this->data['nivel'] = $nivel;
        $this->data['tipoInterna'] = $tipoInterna;
        $this->load_view('menuAdmin/listar_menuAdmin', $this->data);
    }

    public function listar_menuAdmin_table()
    {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- Datos del Logeado ---//
        $userdata = $this->session->all_userdata();
        //--- datos ---//
        $menuAdmin = $this->app_model->get_menuAdmin();

        if ($menuAdmin) {
            foreach ($menuAdmin as $key => $value) {
                $idNivelGen = $value['idNivelGen'];
                //obtengo los nombres del nivel con el menu relacionado y los pongo en un vector
                $menuNivel[$key] = $this->app_model->get_menuNivel($idNivelGen);
            }

            foreach ($menuAdmin as $key => $value) {
                $options = "";

                if ($menuNivel[$key]) {
                    foreach ($menuNivel[$key] as $keys => $valueMenuNivel) {
                        $options .= '<option value="' . $valueMenuNivel['idNivel'] . '">' . $valueMenuNivel['nombreNivel'] . '</option>';
                    }
                }

                $selectNivelMenu = '<select class="select-full" style="text-transform:uppercase;width: 100%;">' .
                        $options .
                        '</select>';

                $opcion = '<a href="#" class="tip modificarMenuAdmin" data-id="' . $value['idMenu'] . '" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a>' .
                        '&nbsp;' .
                        '<a href="#modal-delete" class="tip deleteMenuAdmin" role="button" data-id="' . $value['idMenu'] . '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>';


                $dato[] = array(
                    $value['posicion'],
                    $value['nombre'],
                    "Nivel " . $value['idTipoInterna'],
                    $value['idSubItem'],
                    $selectNivelMenu,
                    $opcion,
                    "DT_RowId" => $value['idMenu']
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

    public function get_menuAdmin_byId()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";
        if ($_POST) {
            $idMenuAdmin = $this->input->post('id', true);

            if (!empty($idMenuAdmin)) {
                $menuAdmin = $this->app_model->get_menuAdmin_byId($idMenuAdmin);


                $menuAdminNivelUsuario = $this->app_model->get_menuNivel($menuAdmin[0]['idNivelGen']);


                if ($menuAdmin && $menuAdminNivelUsuario) {
                    $msg = "Todo ok";
                    $dato = array("valid" => true, "msg" => $msg, "menuAdminModificar" => $menuAdmin, "menuAdminNivelUsuario" => $menuAdminNivelUsuario);
                } else {
                    $msg = "Ha ocurrido un error al obtener los datos";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            }
        } else {
            $msg = "Algun dato obligatorio falta";
            $dato = array("valid" => false, "msg" => $msg);
        }


        echo json_encode($dato);
    }

    public function add_menuAdmin_post()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";
        if ($_POST) {
            $nombre = $this->input->post('nombre', true);
            $posicion = $this->input->post('posicion', true);
            $icono = $this->input->post('icono', true);
            $link = $this->input->post('link', true);
            $nivel = json_decode($this->input->post('nivel', true));
            $color = $this->input->post('color', true);
            $tipoInterna = json_decode($this->input->post('tipoInterna', true));
            $subItem = $this->input->post('subItem', true);

            //traer el usuario logeado en el sistema
            $user['usuarios'] = $this->session->all_userdata();
            $usuarioAdmin = $user['usuarios']['idUsuario'];

            $idNivel = $this->generarID();

            if (!empty($subItem) || !empty($tipoInterna) || !empty($nombre) || !empty($idNivel) || !empty($posicion) || !empty($icono) || !empty($link) || !empty($nivel) || !empty($color) || !empty($usuarioAdmin)) {
                $result = $this->app_model->add_menuAdmin($nombre, $posicion, $icono, $link, $idNivel, $color, $usuarioAdmin, $tipoInterna, $subItem);


                if ($result) {
                    $cont = 0;
                    foreach ($nivel as $value) {
                        $resultMenuNivel = $this->app_model->add_menuNivel($idNivel, $value);
                        $cont++;
                    }

                    if ($cont > 0) {
                        $menuAdmin = $this->app_model->get_menuAdmin();

                        foreach ($menuAdmin as $key => $value) {
                            $idNivelGen = $value['idNivelGen'];
                            //obtengo los nombres del nivel con el menu relacionado y los pongo en un vector
                            $menuNivel[$key] = $this->app_model->get_menuNivel($idNivelGen);
                            $ultimoKey = $key;
                        }

                        $msg = "Item del menú añadido con exito";
                        $dato = array("valid" => true, "msg" => $msg, "menuAdmin" => $menuAdmin, "menuNivel" => $menuNivel, "ultimoKey" => $ultimoKey);
                    } else {
                        $msg = "Error al añadir un item al menú, vuelva a intentarlo";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "Error al añadir un item del menu, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            }
        } else {
            $msg = "Faltan completar datos obligatorios, vuelva a intentarlo";
            $dato = array("valid" => false, "msg" => $msg);
        }


        echo json_encode($dato);
    }

    public function modificar_menuAdmin_post()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $idMenuAdmin = $this->input->post('idMenuAdmin', true);
            $nivel = json_decode($this->input->post('nivel', true));
            $nombre = $this->input->post('nombre', true);
            $color = $this->input->post('color', true);
            $link = $this->input->post('link', true);
            $posicion = $this->input->post('posicion', true);
            $icono = $this->input->post('icono', true);
            $idNivelGen = $this->input->post('idNivelGen', true);
            $idNivelGenDOS = $this->generarID();
            $tipoInterna = json_decode($this->input->post('tipoInterna', true));
            $subItem = $this->input->post('subItem', true);

            //traer el usuario logeado en el sistema
            $user['usuarios'] = $this->session->all_userdata();
            $usuarioAdmin = $user['usuarios']['idUsuario'];

            if (!empty($subItem) || !empty($tipoInterna) || !empty($idMenuAdmin) || !empty($idNivelGen) || !empty($nivel) || !empty($nombre) || !empty($color) || !empty($link) || !empty($posicion) || !empty($icono) || !empty($usuarioAdmin)) {
                $result = $this->app_model->actualizar_menuAdmin($idMenuAdmin, $idNivelGenDOS, $nombre, $color, $link, $posicion, $icono, $usuarioAdmin, $tipoInterna, $subItem);



                if ($result) {
                    $result2 = $this->app_model->delete_nivel_byIdMenuGen($idNivelGen);
                    $cont = 0;
                    foreach ($nivel as $value) {
                        $resultMenuNivel = $this->app_model->add_menuNivel($idNivelGenDOS, $value);
                        $cont++;
                    }
                    if ($cont > 0) {
                        $menuAdmin = $this->app_model->get_menuAdmin_byId($idMenuAdmin);

                        foreach ($menuAdmin as $key => $value) {
                            $idNivelGen = $value['idNivelGen'];
                            //obtengo los nombres del nivel con el menu relacionado y los pongo en un vector
                            $menuNivel[$key] = $this->app_model->get_menuNivel($idNivelGen);
                            $ultimoKey = $key;
                        }

                        $msg = "Item del menú modificado con exito";
                        $dato = array("valid" => true, "msg" => $msg, "menuAdmin" => $menuAdmin, "menuNivel" => $menuNivel, "ultimoKey" => $ultimoKey);
                    } else {
                        $msg = "Item del menú no pudo ser modificado con exito";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "Error al modificar el item del menú, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay POST";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_menuAdmin()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idMenuAdmin = $this->input->post('id', true);
        $msg = "";

        if (!empty($idMenuAdmin)) {
            $result = $this->app_model->delete_menuAdmin($idMenuAdmin);

            if ($result) {
                $msg = "Item del menú eliminado con exito";
                $dato = array("valid" => true, "msg" => $msg, "id" => $idMenuAdmin );
            } else {
                $msg = "Error al eliminar el item del menú, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Id vacio";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }
}
