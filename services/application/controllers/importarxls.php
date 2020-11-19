<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ImportarXls extends MY_Controller {

    protected $data = array(
        'active' => 'importarClientes'
    );

    public function __construct() {
        parent::__construct();
    }

    public function clientes() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->load_view('importarxls/clientes', $this->data);
    }

    public function insert_file_clientes() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        $path = './uploads/clientes/';
        require_once( APPPATH . 'third_party/PHPExcel-master/Classes/PHPExcel.php');
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('fileXLSClientes')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        if (empty($error)) {
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i = 1;
                $inserdata = [];

                foreach ($allDataInSheet as $key => $value) {
                    if ($flag) {
                        $flag = false;
                        continue;
                    }

//                    if ($key <= 11) {
                    if (!empty($value['A'])) {
                        $inserdata[$key]['A'] = $value['A'];
                    } else {
                        $inserdata[$key]['A'] = "";
                    }

                    if (!empty($value['B'])) {
                        $inserdata[$key]['B'] = $value['B'];
                    } else {
                        $inserdata[$key]['B'] = "";
                    }

                    if (!empty($value['C'])) {
                        $inserdata[$key]['C'] = $value['C'];
                    } else {
                        $inserdata[$key]['C'] = "";
                    }

                    if (!empty($value['D'])) {
                        $inserdata[$key]['D'] = $value['D'];
                    } else {
                        $inserdata[$key]['D'] = "";
                    }

                    if (!empty($value['E'])) {
                        $inserdata[$key]['E'] = $value['E'];
                    } else {
                        $inserdata[$key]['E'] = "";
                    }

                    if (!empty($value['F'])) {
                        $inserdata[$key]['F'] = $value['F'];
                    } else {
                        $inserdata[$key]['F'] = "";
                    }

                    if (!empty($value['G'])) {
                        $inserdata[$key]['G'] = $value['G'];
                    } else {
                        $inserdata[$key]['G'] = "";
                    }

                    $i++;
//                    }
                }

                if (!empty($inserdata)) {
                    $msg = "Datos obtenido";
                    $dato = array("valid" => true, "msg" => $msg, 'inserdata' => $inserdata, 'longitud' => sizeof($inserdata));
                } else {
                    $msg = "Error al obtener los datos";
                    $dato = array("valid" => false, "msg" => $msg, 'inserdata' => $inserdata);
                }
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
        } else {
            $msg = "Error al abrir el archivo " . $error['error'];
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function insert_datos_file_clientes() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $datos_clientes = $this->input->post('datos_clientes', true);
            $datos_clientes_datalle_facturacion = $this->input->post('datos_clientes_datalle_facturacion', true);
            $datos_clientes_datalle_ventas = $this->input->post('datos_clientes_datalle_ventas', true);

            $result = $this->app_model_importarXLS->insert_datos_file_clientes(json_decode($datos_clientes, true));
            $result1 = $this->app_model_importarXLS->insert_datos_file_clientes_detalle_facturacion(json_decode($datos_clientes_datalle_facturacion, true));
            $result2 = $this->app_model_importarXLS->insert_datos_file_clientes_detalle_ventas(json_decode($datos_clientes_datalle_ventas, true));

            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];

            $idGenOperacion = $this->generarID();

            $historico = $this->app_model_importarXLS->set_historico($idUsuario, $idGenOperacion, 1, 18, 'Importo un xls de clientes', 0);

            if ($result && $result1 && $result2 && $historico) {
                $msg = "Datos de clientes importados con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al añadir los datos de los cliente, vuelva a intentarlo";
                $dato = array("valid" => true, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function proveedores() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->load_view('importarxls/proveedores', $this->data);
    }

    public function insert_file_proveedores() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        $path = './uploads/proveedores/';
        require_once( APPPATH . 'third_party/PHPExcel-master/Classes/PHPExcel.php');
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('fileXLSProveedores')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        if (empty($error)) {
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i = 1;
                $inserdata = [];

                foreach ($allDataInSheet as $key => $value) {
                    if ($flag) {
                        $flag = false;
                        continue;
                    }

//                    if ($key <= 11) {
                    if (!empty($value['A'])) {
                        $inserdata[$key]['A'] = $value['A'];
                    } else {
                        $inserdata[$key]['A'] = "";
                    }

                    if (!empty($value['B'])) {
                        $inserdata[$key]['B'] = $value['B'];
                    } else {
                        $inserdata[$key]['B'] = "";
                    }

                    if (!empty($value['C'])) {
                        $inserdata[$key]['C'] = $value['C'];
                    } else {
                        $inserdata[$key]['C'] = "";
                    }

                    if (!empty($value['D'])) {
                        $inserdata[$key]['D'] = $value['D'];
                    } else {
                        $inserdata[$key]['D'] = "";
                    }

                    if (!empty($value['E'])) {
                        $inserdata[$key]['E'] = $value['E'];
                    } else {
                        $inserdata[$key]['E'] = "";
                    }

                    if (!empty($value['F'])) {
                        $inserdata[$key]['F'] = $value['F'];
                    } else {
                        $inserdata[$key]['F'] = "";
                    }

                    if (!empty($value['G'])) {
                        $inserdata[$key]['G'] = $value['G'];
                    } else {
                        $inserdata[$key]['G'] = "";
                    }

                    $i++;
//                    }
                }

                if (!empty($inserdata)) {
                    $msg = "Datos obtenido";
                    $dato = array("valid" => true, "msg" => $msg, 'inserdata' => $inserdata, 'longitud' => sizeof($inserdata));
                } else {
                    $msg = "Error al obtener los datos";
                    $dato = array("valid" => false, "msg" => $msg, 'inserdata' => $inserdata);
                }
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
        } else {
            $msg = "Error al abrir el archivo " . $error['error'];
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function insert_datos_file_proveedores() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $datos_proveedores = $this->input->post('datos_proveedores', true);
            $datos_proveedores_datalle_facturacion = $this->input->post('datos_proveedores_datalle_facturacion', true);
            $datos_proveedores_datalle_compras = $this->input->post('datos_proveedores_datalle_compras', true);
            
            $result = $this->app_model_importarXLS->insert_datos_file_proveedores(json_decode($datos_proveedores, true));
            $result1 = $this->app_model_importarXLS->insert_datos_file_proveedores_detalle_facturacion(json_decode($datos_proveedores_datalle_facturacion, true));
            $result2 = $this->app_model_importarXLS->insert_datos_file_proveedores_detalle_compras(json_decode($datos_proveedores_datalle_compras, true));

            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];

            $idGenOperacion = $this->generarID();

            $historico = $this->app_model_importarXLS->set_historico($idUsuario, $idGenOperacion, 1, 18, 'Importo un xls de proveedores', 0);

            if ($result && $result1 && $result2 && $historico) {
                $msg = "Datos de los proveedores añadidos con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al añadir los datos de los proveedores, vuelva a intentarlo";
                $dato = array("valid" => true, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    
    public function productos() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $this->load_view('importarxls/productos', $this->data);
    }

    public function insert_file_productos() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        $path = './uploads/productos/';
        require_once( APPPATH . 'third_party/PHPExcel-master/Classes/PHPExcel.php');
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('fileXLSProductos')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        if (empty($error)) {
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i = 1;
                $inserdata = [];

                foreach ($allDataInSheet as $key => $value) {
                    if ($flag) {
                        $flag = false;
                        continue;
                    }

//                    if ($key <= 11) {
                    if (!empty($value['A'])) {
                        $inserdata[$key]['A'] = $value['A'];
                    } else {
                        $inserdata[$key]['A'] = "";
                    }

                    if (!empty($value['B'])) {
                        $inserdata[$key]['B'] = $value['B'];
                    } else {
                        $inserdata[$key]['B'] = "";
                    }

                    if (!empty($value['C'])) {
                        $inserdata[$key]['C'] = $value['C'];
                    } else {
                        $inserdata[$key]['C'] = "";
                    }

                    if (!empty($value['D'])) {
                        $inserdata[$key]['D'] = $value['D'];
                    } else {
                        $inserdata[$key]['D'] = "";
                    }

                    if (!empty($value['E'])) {
                        $inserdata[$key]['E'] = $value['E'];
                    } else {
                        $inserdata[$key]['E'] = "";
                    }

                    if (!empty($value['F'])) {
                        $inserdata[$key]['F'] = $value['F'];
                    } else {
                        $inserdata[$key]['F'] = "";
                    }

                    if (!empty($value['G'])) {
                        $inserdata[$key]['G'] = $value['G'];
                    } else {
                        $inserdata[$key]['G'] = "";
                    }

                    $i++;
//                    }
                }

                if (!empty($inserdata)) {
                    $msg = "Datos obtenido";
                    $dato = array("valid" => true, "msg" => $msg, 'inserdata' => $inserdata, 'longitud' => sizeof($inserdata));
                } else {
                    $msg = "Error al obtener los datos";
                    $dato = array("valid" => false, "msg" => $msg, 'inserdata' => $inserdata);
                }
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
        } else {
            $msg = "Error al abrir el archivo " . $error['error'];
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function insert_datos_file_productos() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $datos_productos = $this->input->post('datos_productos', true);
            
            $result = $this->app_model_importarXLS->insert_datos_file_productos(json_decode($datos_productos, true));

            $userdata = $this->session->all_userdata();
            $idUsuario = $userdata['idUsuario'];

            $idGenProducto = $this->generarID();

            $historico = $this->app_model_importarXLS->set_historico($idUsuario, $idGenProducto, 1, 18, 'Importo un xls de productos', 0);

            if ($result && $historico) {
                $msg = "Datos de los productos añadidos con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al añadir los productos, vuelva a intentarlo";
                $dato = array("valid" => true, "msg" => $msg);
            }
        } else {
            $msg = "No hay post";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }
    
}
